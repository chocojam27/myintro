@extends('admin.default')
@section('title','Settings')
@section('content')
<div class="row gap-20 masonry pos-r">
    <div class="masonry-sizer col-md-4"></div>
    <div class="masonry-item col-md-10 offset-md-1">
        <div class="bgc-white p-20 bd">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="defaults-tab" data-toggle="tab" href="#defaults" role="tab" aria-controls="defaults" aria-selected="false">Default Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="social-links-tab" data-toggle="tab" href="#social-links" role="tab" aria-controls="social-links" aria-selected="false">Social Links</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="paypal-tab" data-toggle="tab" href="#paypal" role="tab" aria-controls="paypal" aria-selected="false">Paypal Settings</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <div class="p-20">
                        <h5>General Settings</h5>
                        <form id="general-form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="image">Website Logo</label>
                                    <div id="image-preview" style="border-radius: 50%;width: 200px;height: 200px;object-fit: cover; background: url({{$settings->logo != '' ? URL('uploads/logo/'.rawurlencode($settings->logo)) : ''}});background-size: cover;background-position: center;">
                                        <label for="image-upload" id="image-label">Choose Logo</label>
                                        <input type="file" name="website_logo" id="image-upload" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Admin E-mail</label>
                                    <input type="text" name="new_email" class="form-control" value="{{$user->email != '' ? $user->email : ''}}">
                                    <div class="invalid-feedback" id="new_email"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Admin New Password</label>
                                    <input type="password" name="new_password" class="form-control" value="">
                                    <div class="invalid-feedback" id="new_password"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Website Name</label>
                                    <input type="text" name="website_name" class="form-control" value="{{$settings->name != '' ? $settings->name : ''}}">
                                    <div class="invalid-feedback" id="website_name"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Website Email</label>
                                    <input type="text" name="website_email" class="form-control" value="{{$settings->email != '' ? $settings->email : ''}}">
                                    <div class="invalid-feedback" id="website_email"></div>
                                </div>
                            </div>
                            <div class="append">
                                @foreach ($contacts as $value)
                                @if($loop->first)
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Contact Number</label>
                                        <input type="text" name="contact_number[]" class="form-control" value="{{$value != '' ? $value : ''}}">
                                        <div class="invalid-feedback" id="contact_number"></div>
                                    </div>
                                </div>
                                @else
                                <div class='form-row'>
                                    <div class='form-group col-md-6'>
                                        <input type='text' name='contact_number[]' class='form-control' value='{{$value != '' ? $value : ''}}'>
                                        <a class='close-form' ><i class='fa fa-times' aria-hidden='true'></i></a>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="add-field-holder clearfix">
                                        <a id="add-field" style="float: right;background: #2196f3;font-size: 10px;text-transform: uppercase;color: #FFF;border-radius: 13px;padding: 5px 15px;letter-spacing: 1px;border: 0;"><i class="fa fa-plus" aria-hidden="true"></i>Add field</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{$settings->address != '' ? $settings->address : ''}}">
                                    <div class="invalid-feedback" id="address"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Copyright</label>
                                    <input type="text" name="copyright" class="form-control" value="{{$settings->copyright != '' ? $settings->copyright : ''}}">
                                    <div class="invalid-feedback" id="copyright"></div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary submit-general">Save Changes</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="defaults" role="tabpanel" aria-labelledby="defaults-tab">
                    <div class="p-20">
                        <h5>Default Settings</h5>
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar" aria-selected="true">Avatar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="cover-tab" data-toggle="tab" href="#cover" role="tab" aria-controls="cover" aria-selected="false">Cover Photo</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">
                                <div class="p-20">
                                    <form id="avatar-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="avatar">Default Avatar Profile</label>
                                                <div id="avatar-preview" style="border-radius: 50%;width: 150px;height: 150px;object-fit: cover; background: url({{$defaults->avatar != '' ? asset('uploads/avatar/'.rawurlencode($defaults->avatar)) : ''}});background-size: cover;background-position: center;">
                                                    <label for="avatar-upload" id="avatar-label">Choose Avatar</label>
                                                    <input type="file" name="avatar" id="avatar-upload" />
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary submit-avatar-form">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="cover" role="tabpanel" aria-labelledby="cover-tab">
                                <div class="p-20">
                                    <form id="cover-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="cover">Default Profile Cover</label>
                                                <div id="cover-preview" style="width: 500px;height: 250px;object-fit: cover; background: url({{$defaults->cover != '' ? asset('uploads/cover/'.Auth::user()->id.'/'.rawurlencode($defaults->cover)) : ''}});background-size: cover;background-position: center;">
                                                    <label for="cover-upload" id="cover-label">Choose Cover</label>
                                                    <input type="file" name="cover" id="cover-upload" />
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary submit-cover-form">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="social-links" role="tabpanel" aria-labelledby="social-links-tab">
                    <div class="p-20">
                        <h5>Social Links <i class="ti-link"></i></h5>
                        <form id="social-links-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="facebook">Facebook</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">facebook.com/</div>
                                        </div>
                                        <input type="text" class="form-control" name="facebook_link" value="{{ json_decode($settings->social_media_links, true)['facebook'] != '' ? json_decode($settings->social_media_links, true)['facebook'] : ''}}">
                                        <div class="invalid-feedback" id="facebook_link"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="twitter">Twitter</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">twitter.com/</div>
                                        </div>
                                        <input type="text" class="form-control" name="twitter_link" value="{{ json_decode($settings->social_media_links, true)['twitter'] != '' ? json_decode($settings->social_media_links, true)['twitter'] : ''}}">
                                        <div class="invalid-feedback" id="twitter_link"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="instagram">Instagram</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">instagram.com/</div>
                                        </div>
                                        <input type="text" class="form-control" name="instagram_link" value="{{ json_decode($settings->social_media_links, true)['instagram'] != '' ? json_decode($settings->social_media_links, true)['instagram'] : ''}}">
                                        <div class="invalid-feedback" id="instagram_link"></div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="youtube">Youtube</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">youtube.com/</div>
                                        </div>
                                        <input type="text" class="form-control" name="youtube_link" value="{{ json_decode($settings->social_media_links, true)['youtube'] != '' ? json_decode($settings->social_media_links, true)['youtube'] : ''}}">
                                        <div class="invalid-feedback" id="youtube_link"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="googleplus">Googleplus</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">plus.google.com/</div>
                                        </div>
                                        <input type="text" class="form-control" name="googleplus_link" value="{{ json_decode($settings->social_media_links, true)['googleplus'] != '' ? json_decode($settings->social_media_links, true)['googleplus'] : ''}}">
                                        <div class="invalid-feedback" id="googleplus_link"></div>
                                    </div>
                                </div>
                            </div> --}}
                            <button type="button" class="btn btn-primary submit-social-links">Save Changes</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
                    <div class="p-20">
                        <h5>Paypal Credentials <i class="ti-settings"></i></h5>
                        <form id="paypal-credentials">
                            <div class="form-group">
                                <label for="userPaypal">Username</label>
                                <input type="text" class="form-control" name="userPaypal" placeholder="Username" value="{{$settings->paypal_username}}">
                            </div>
                            <div class="form-group">
                                <label for="passPaypal">Password</label>
                                <input type="text" class="form-control" name="passPaypal" placeholder="Password" value="{{$settings->paypal_password}}">
                            </div>
                            <div class="form-group">
                                <label for="secretPaypal">Secret Key</label>
                                <input type="text" class="form-control" name="secretPaypal" placeholder="Secret" value="{{$settings->paypal_secret}}">
                            </div>
                            <button type="button" class="btn btn-primary submit-paypal">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
@stop
