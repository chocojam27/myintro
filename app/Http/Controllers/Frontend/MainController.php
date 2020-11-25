<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page\Page;
use Illuminate\Http\Request;
use App\Models\Page\PageContent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function getIndex()
    {
        $page = Page::where('name', 'Home')->first(); // home page
        $this->data['content'] = PageContent::getData('none', $page->id); // content of home

        $page = Page::where('name', 'Subscription')->first(); // subscription
        $this->data['subscription_content'] = PageContent::getData('none', $page->id); // content of subscription
        return view('frontend.index', $this->data);
    }

    public function getPricing()
    {
        $page = Page::where('name', 'Pricing')->first(); // pricing page
        $this->data['content'] = PageContent::getData('none', $page->id); // content of home

        $page = Page::where('name', 'Subscription')->first(); // subscription
        $this->data['subscription_content'] = PageContent::getData('none', $page->id); // content of subscription
        return view('frontend.pricing', $this->data);
    }

    public function getFeatures()
    {
        $page = Page::where('name', 'Features')->first(); // features page
        $this->data['content'] = PageContent::getData('none', $page->id); // content of features
        return view('frontend.features', $this->data);
    }

    public function getPrivacyPolicy()
    {
        $page = Page::where('name', 'Privacy-policy')->first(); // features page
        $this->data['content'] = PageContent::getData('none', $page->id); // content of features
        return view('frontend.privacy-policy', $this->data);
    }

    public function getTermsAndConditions()
    {
        $page = Page::where('name', 'Terms and Conditions')->first(); // features page
        $this->data['content'] = PageContent::getData('none', $page->id); // content of features
        return view('frontend.terms-and-conditions', $this->data);
    }

    public function getContact()
    {
        return view('frontend.contact');
    }

    public function postContact(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ];
        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message_body' => $request->message,
        ];
        try {
            Mail::send('emails.contact', $data, function ($message) use ($data) {
                $message->from($data['email'], $data['name']);
                $message->to('limuel@maverickheroes.com', 'Limuel Humirang');
                $message->subject('New Contact Message | My Intro Page');
            });
        } catch (\Throwable $th) {
            throw $th;
        }

        return back()->with('message', "Your request has been successfully sent!");
    }
}
