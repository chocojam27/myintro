<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CancelRequest;
use App\Models\Invoice;
use App\Models\Subscription;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    protected $provider;
    public function __construct() {
        $this->provider = new ExpressCheckout();
    }
    public function expressCheckout(Request $request) {
        $recurring = $request->input('recurring', false) ? true : false; // check if payment is recurring
        $invoice = Invoice::latest()->first(); // get new invoice id
        $invoice_id =$invoice->id + 1;
        $cart = $this->getCart($recurring, $invoice_id); // Get the cart data
        $invoice = new Invoice();
        $invoice->user_id = Auth::user()->id;
        $invoice->transaction_id = $cart['invoice_id'];
        $invoice->title = $cart['invoice_description'];
        $invoice->price = $cart['total'];
        $invoice->save();
        $response = $this->provider->setExpressCheckout($cart, $recurring);
        // dd($response);
        if (!$response['paypal_link']) {
            return response()->json(["result" => 'failed checout']);
        }
        return redirect($response['paypal_link']);
    }
    private function getCart($recurring, $invoice_id){
        if ($recurring) {
            return [
                'items' => [
                    [
                        'name' => 'MyIntro Yearly Subscription ' . config('paypal.invoice_prefix').'_'.$invoice_id . ' #' . $invoice_id,
                        'price' => 20,
                        'qty' => 1,
                    ],
                ],
                'return_url' => url('/paypal/express-checkout-success?recurring=1'),
                'subscription_desc' => 'Yearly Subscription ' . config('paypal.invoice_prefix').'_'.$invoice_id . ' #' . $invoice_id,
                'invoice_id' => config('paypal.invoice_prefix') . '_' . $invoice_id,
                'invoice_description' => "Order #". $invoice_id ." Invoice",
                'cancel_url' => url('/'),
                'total' => 20,
            ];
        }else{
            return response()->json(["result" => 'failed cart']);
        }
    }
    public function expressCheckoutSuccess(Request $request) {
        $recurring = $request->input('recurring', false) ? true : false;
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        $getDetails = $this->provider->getExpressCheckoutDetails($token);

        if (!in_array(strtoupper($getDetails['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
             return response()->json(["result" => 'failed']);
        }
        $invoice_id = explode('_', $getDetails['INVNUM'])[1];

        $cart = $this->getCart($recurring, $invoice_id);

        if ($recurring === true) {
            $startdate = Carbon::now()->toAtomString();
            $profile_desc = !empty($cart['subscription_desc']) ? $cart['subscription_desc'] : $cart['invoice_description'];
            $data = [
                'PROFILESTARTDATE' => $startdate,
                'DESC' => $profile_desc,
                'BILLINGPERIOD' => 'Year', // Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
                'BILLINGFREQUENCY' => 1, //
                'AMT' => 20, // Billing amount for each billing cycle
                'INITAMT' => 20, // Billing amount for each billing cycle
                'CURRENCYCODE' => 'USD', // Currency code
                'TRIALBILLINGPERIOD' => '',  // (Optional) Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
                'TRIALBILLINGFREQUENCY' => '', // (Optional) set 12 for monthly, 52 for yearly
                'TRIALTOTALBILLINGCYCLES' => '', // (Optional) Change it accordingly
                'TRIALAMT' => 0, // (Optional) Change it accordingly
            ];
            $rcrngDetails = $this->provider->createRecurringPaymentsProfile($data, $token);
            $status = 'Invalid';
            if (strtoupper($rcrngDetails['ACK']) == 'SUCCESS') {
                $status = 'Processed';
                $invoice = Invoice::find($invoice_id);
                $invoice->transaction_id =$getDetails['INVNUM'];
                $invoice->payment_status = $status;
                $invoice->recurring_id = $rcrngDetails['PROFILEID'];
                $invoice->save();
                $subs = Subscription::where('user_id', $invoice->user_id)->update(['subscription_type' => 1, 'start_date' =>$startdate]);
            } else{
                return response()->json(["message" => $rcrngDetails['L_LONGMESSAGE0'] ]);
            }
        } else {
            return response()->json(["result" => 'failed']);
        }
        if ($invoice->paid) {
            return redirect('/')->with(['code' => 'success', 'message' => 'Order ' . $invoice->id . ' has been paid successfully!']);
        }
            dd('error');
        return redirect('/')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment for Order ' . $invoice->id . '!']);
    }
    public function cancelSubscription($user_id=null)
    {
        // Cancel recurring payment profile
        if(!$user_id){
            $profile = Invoice::where('user_id',Auth::user()->id)->where('cancelled_date',null)->latest()->first();
            $cancelled = $this->provider->cancelRecurringPaymentsProfile($profile->recurring_id);
            $subs = Subscription::where('user_id',Auth::user()->id)->first();
        }else{
            $profile = Invoice::where('user_id',$user_id)->where('cancelled_date',null)->latest()->first();
            $cancelled = $this->provider->cancelRecurringPaymentsProfile($profile->recurring_id);
            $subs = Subscription::where('user_id',$user_id)->first();
        }
        if(strtoupper($cancelled['ACK']) == 'SUCCESS'){
            $invoice = Invoice::findOrFail($profile->id);
            $invoice->cancelled_date = $cancelled['TIMESTAMP'];
            $invoice->save();
            $toFree = Subscription::findOrFail($subs->id);
            $toFree->subscription_type = 0;
            $toFree->save();
            return 'success';
        }else{
            dd($cancelled);
        }
    }
    public function requestCancelSubscription()
    {
        // Cancel recurring payment profile
        $request= null;
        $requested = CancelRequest::where('user_id',Auth::user()->id)->first();
        if(!$requested){
            $request = CancelRequest::create([
                'user_id' => Auth::user()->id,
            ]);
        }
        if($request){
            return response()->json(["response" => 'success']);
        }else if($requested){
            return response()->json(["response" => 'warning']);
        }else{
            return response()->json(["response" => 'failed']);
        }
    }
    public function getPaymentProfile($id)
    {
        $data = $this->provider->getRecurringPaymentsProfileDetails($id);
        return $data ;
    }
    public function updatePaymentProfile($data)
    {   $dt = DateTime::createFromFormat("Y-m-d", $data['NEXTBILLINGDATE']);
        $new = Carbon::parse($dt)->toAtomString();
        $datas = [
            'NEXTBILLINGDATE' => $new,
        ];
        return $this->provider->updateRecurringPaymentsProfile($datas, $data['id']);
    }

}
