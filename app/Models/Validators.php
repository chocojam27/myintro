<?php
namespace App\Models;

Use Auth, Crypt, Session, Validator;
use Illuminate\Database\Eloquent\Model;

class Validators extends Model{
    public static function frontendValidate($request,$key)
    {
        switch($key) {
            case 'contact-form':
                $rules = [
                    'full_name' => 'required',
                    'email'     => 'required|email',
                    'phone'     => 'required',
                    'comment'   => 'required'
                ];
                break;
        }
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            // Check if the request is not an ajax
            if (!$request->ajax()) {
                Session::flash('session_header','Action failed');
                Session::flash('session_content','Please check your inputs or connection and try again.');
                Session::flash('session_boolean','error');
            } return $validator;
    	} return true;
    }
    public static function backendValidate($request,$key)
    {
        switch ($key) {
            case 'reset_password':
                $rules = [
                    'new_password'              => 'required|min:3|confirmed',
                    'new_password_confirmation' => 'required|min:3',
                    'id'                    => 'required'
                ];
                break;
            case 'forgot_password':
                $rules = [
                    'email' => 'required|email|exists:users,email',
                ];
                break;
            case 'settings_social':
                $rules = [];
                if ($request->has('facebook_link')) {
                    $rules['facebook_link'] = "required";
                }
                if ($request->has('instagram_link')) {
                    $rules['instagram_link'] = "required";
                }
                if ($request->has('twitter_link')) {
                    $rules['twitter_link'] = "required";
                }
                break;
            case 'configuration_password':
                $rules = [
                    'current_password'      => 'required|min:3|in:'.Crypt::decrypt(Auth::user()->crypted_password),
                    'password'              => 'required|min:3|confirmed',
                    'password_confirmation' => 'required|min:3'
                ];
                break;
            case 'settings_general':
                $rules = [
                    'website_logo'    => 'image',
                    'website_name'    => 'required',
                    'website_email'   => 'required|email',
                    'copyright'       => 'required'
                ];
                break;
            case 'settings_avatar':
                $rules = [
                    'avatar'       => 'required|image'
                ];
                break;
            case 'settings_cover':
                $rules = [
                    'cover'       => 'required|image'
                ];
                break;
            case 'configuration_email':
                $rules = [
                    'current_email'      => 'required|email|in:'.Auth::user()->email,
                    'email'              => 'required|email|unique:users,email|confirmed',
                    'email_confirmation' => 'required|email|unique:users,email'
                ];
                break;
            case 'cms_custom_add':
                $rules = [];
                $rules['page_dropdown'] = 'required';
                if ($request->page_dropdown == 'custom_page') {
                   $rules['page_name'] = 'required|unique:pages,name';
                }
                $rules['section']    = 'required';
                $rules['field_type'] = 'required';
                $rules['field_name'] = 'required';
                if ($request->has('repeater_field_type')) {
                   $rules['repeater_field_type.*'] = 'required|regex:/^[a-zA-Z0-9_ ]*$/';
                   $rules['repeater_field_name.*'] = 'required|regex:/^[a-zA-Z0-9_ ]*$/';
                }
                break;
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Check if the request is not an ajax
            if (!$request->ajax()) {
                Session::flash('session_header','Action failed');
                Session::flash('session_content','Please check your inputs or connection and try again.');
                Session::flash('session_boolean','error');
            } return $validator;
        } return true;
    }
}
