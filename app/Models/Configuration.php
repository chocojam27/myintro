<?php

namespace App\Models;

use Image, File, Mail;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    public static function updateGeneral($request)
    {
        $data        = self::find(1);
        $data->name  = $request->website_name;
        $data->email = $request->website_email;
        $path = public_path().'/uploads/logo/';
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        if($request->hasFile('website_logo')){
            $file_name = $request->file('website_logo');
            $file = Image::make($file_name);
            $generated_filename = $file_name->getClientOriginalName();
            // $file->move($path, $generated_filename);
            $file->save($path.''.$generated_filename);
            $data->logo = $generated_filename;
        }
        $contact = json_encode($request->contact_number);
        $data->contact_number = $contact;
        $data->address = $request->address;
        $data->copyright = $request->copyright;
        $data->save();
        return $data;
    }

    public static function updateSocialLinks($request)
    {
                $social_links = [
                    'facebook'    => $request->facebook_link,
                    'twitter'   => $request->twitter_link,
                    'instagram'   => $request->instagram_link,
                ];
        $data = self::find(1);
        $data->social_media_links = json_encode($social_links);
        $data->save();
    }

    public static function contactUs($request)
    {
        $configuration = self::find(1);
        // Send the concern to the admin
        Mail::send(
                    'emails.contact-us', // The page of the email
                    [
                        'request'       => $request,
                        'configuration' => $configuration
                    ],
                    function($message) use ($configuration,$request)
                    {
                        $message->to($configuration->email);
                        $message->subject($configuration->name.': Concern');
                        $message->from($request->email, $configuration->name);
                    }
        );
        Mail::send(
                    'emails.contact-us', // The page of the email
                    [
                        'request'       => $request,
                        'configuration' => $configuration
                    ],
                    function($message) use ($configuration,$request)
                    {
                        $message->to($request->email);
                        $message->subject($configuration->name.': Concern');
                        $message->from($configuration->email, $configuration->name);
                    }
        );
    }

    public static function UpdatePaypal($request)
    {
        $data = self::find(1);
        $data->paypal_username = $request->userPaypal;
        $data->paypal_password = $request->passPaypal;
        $data->paypal_secret = $request->secretPaypal;
        $data->save();
        return $data;
    }
}
