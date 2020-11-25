<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\PaypalController;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\User;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::where('role','<>','10')->with(['subscription.invoice' => function($q){
            $q->where('cancelled_date', null);
        }])->latest('updated_at')->get();
        return view('admin.subscription.index', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->id){
            $details = new PaypalController();
            $datas = $details->getPaymentProfile($request->id);
            return view('admin.subscription.edit', compact('datas'));
        }else if($request->sub_id){
            $datas = Subscription::findOrFail($request->sub_id);
            return view('admin.subscription.editSub', compact('datas'));
        }else{
            return back()->withErrors('Error Occured');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->id){
            $details = new PaypalController();
            $response = $details->updatePaymentProfile($request->all());
            dd($response);
        }else if($request->sub_id){
            $sub = Subscription::findOrFail($request->sub_id);
            $sub->subscription_type = $request->subscription_type;
            $sub->save();
            if($sub){
                return back()->withSuccess('User Subscription Succesfully Changed');
            }else{
                return back()->withErrors('Error, Subscription Has not Changed!!');
            }
        }else {
            return back()->withErrors('Error Occured');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        if($request->id){
            $details = new PaypalController();
            $response = $details->cancelSubscription($request->user_id);
            if($response == 'success'){
                return back()->withSuccess('Subscription Successfully Cancelled');
            }
            dd($response);
        }else{
            return back()->withErrors('Error Occured')->withWarning('Maybe The Subscription Doesn\'t Go Through Paypal');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDetails(Request $request)
    {
        if($request->id){
            $details = new PaypalController();
            $this->data['response'] = $details->getPaymentProfile($request->id);
            return view('admin.subscription.details', $this->data);
        }else if($request->sub_id){
            $this->data['datas'] = Subscription::with('user')->findOrFail($request->sub_id);
            return view('admin.subscription.details', $this->data);
        }else{
            return back()->withErrors('Error Occured');
        }
    }
}
