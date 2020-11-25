<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\ContactMe;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $profile = Profile::where('user_id', decrypt($request->id))->first();
        $data['fullname'] = $request->fname;
        $data['email'] = $request->email;
        $data['subject'] = $request->subject;
        $data['content'] = $request->message;
        // $data['email_to'] = $request->email_to;
        // $mail = Mail::to($profile->contact_email)->send(new ContactMe($data));

        $mail = Mail::send('emails.contact', $data, function($message) use ($profile,$data){
            $message->to($profile->contact_email, $profile->fullname)->subject( $data['subject']);
        });

        if (Mail::failures()) {
            return back();
        }else{
            $profile->email_count += 1;
            $profile->save();
            return back();
        }
    }
}
