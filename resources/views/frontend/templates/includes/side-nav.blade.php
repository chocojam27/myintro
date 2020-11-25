@if (!(Request::has("iframe") && Request::get("iframe") == "true"))
<div class="controls" id="mainCont">
    <div class="titleHolder">
        <h2>Customize</h2>
    </div>
    <div class="navHolder">
        <a class="sideA" data-name='c1'><i class="fa fa-picture-o" aria-hidden="true"></i> Profile Picture</a>
        <a class="sideA" data-name='c2'><i class="fa fa-columns" aria-hidden="true"></i> Design & Color</a>
        <a class="sideA" data-name='c3'><i class="fa fa-play" aria-hidden="true"></i> Video</a>
        <a class="sideA" data-name='c4'><i class="fa fa-file-text-o" aria-hidden="true"></i> Biography</a>
        <a class="sideA" data-name='c5'><i class="fa fa-link" aria-hidden="true"></i> Social Media Links</a>
    </div>
</div>
<div class="controls" id="c1" style="display:none">
    <div class="titleHolder">
        <h2><a class="backBtn"><i class="fa fa-angle-left"></i></a> Profile Picture</h2>
    </div>
    <form class="nav-form" method="POST">
        <input type="hidden" name="type" value="profile_picture">
        <div class="upload">
            <div class="image-upload-wrap" style="{{isset($user)?'display:none':''}}">
                <input class="file-upload-input" type='file' onchange="readURL(this);" name="image" accept="image/*" />
                <div class="drag-text">
                    <h3>Drag files to upload</h3>
                </div>
            </div>
            <div class="file-upload-content" style="{{isset($user)?'':'display:none'}}">
                <img style="object-fit: cover"class="file-upload-image" src="{{isset($user)?asset('uploads/avatar/'.$user->user_id.'/'.$user->image):'#'}}" alt="your image" />
                <div class="image-title-wrap">
                    <button type="button" onclick="changeOrRemoveUpload('remove')" class="remove-image optBtn">
                        <i class="fa fa-times"></i>
                    </button>
                    <button type="button" onclick="changeOrRemoveUpload('change')" class="change-image optBtn">
                        <i class="fa fa-pencil"></i>
                    </button>
                </div>
                <div class="uploadTitle">
                    <span class="image-title">Uploaded Image</span>
                </div>
            </div>
        </div>
        <div class="input">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="{{isset($user)?$user->title:''}}" class="form-control">
            </div>
            <div class="submit">
                <input type="submit" class="btn-pink" value="Submit">
            </div>
        </div>
    </form>
</div>
<div class="controls" id="c2" style="display:none">
    <div class="titleHolder">
        <h2><a class="backBtn"><i class="fa fa-angle-left"></i></a> Design & Color</h2>
    </div>
    <form class="nav-form mb-5" method="POST">
        <input type="hidden" name="type" value="theme">
        <input type="hidden" name="theme_color" value="{{!empty($user->theme)?$user->theme['theme_color']:''}}">
        <input type="hidden" name="theme_button" value="{{!empty($user->theme)?$user->theme['theme_button']:''}}">
        <input type="hidden" name="theme_border" value="{{!empty($user->theme)?$user->theme['theme_border']:''}}">
        <div class="colorPicker" id="color">
            <p class="label">Color Theme:</p>
            <ul class="list-unstyled list-inline colorList">
                <li class="list-inline-item colorItem colorItem-1" data-id="1"></li>
                <li class="list-inline-item colorItem colorItem-2" data-id="2"></li>
                <li class="list-inline-item colorItem colorItem-3 {{$user->theme?'':'selected'}}" data-id="3"></li>
                <li class="list-inline-item colorItem colorItem-4" data-id="4"></li>
                <li class="list-inline-item colorItem colorItem-5" data-id="5"></li>
                <li class="list-inline-item colorItem colorItem-6 cpTogle" id="cpColor"></li>
            </ul>
            <ul class="list-unstyled list-inline colorShade">
                <li class="list-inline-item colorShadeItem colorShadeItem-1 color3"></li>
                <li class="list-inline-item colorShadeItem colorShadeItem-2 color3"></li>
                <li class="list-inline-item colorShadeItem colorShadeItem-3 color3"></li>
                <li class="list-inline-item colorShadeItem colorShadeItem-4 color3 {{$user->theme?'':'selected'}}"></li>
                <li class="list-inline-item colorShadeItem colorShadeItem-5 color3"></li>
                <li class="list-inline-item colorShadeItem colorShadeItem-6 color3"></li>
            </ul>
            {{-- <div class="colorPplug">
                <input class="form-control" type="text" name="color">
            </div> --}}
        </div>
        <div class="colorPicker" id="button">
            <p class="label">Button Theme:</p>
            <ul class="list-unstyled list-inline colorList">
                <li class="list-inline-item colorItem colorItem-1" data-id="1"></li>
                <li class="list-inline-item colorItem colorItem-2 {{$user->theme?'':'selected'}}" data-id="2"></li>
                <li class="list-inline-item colorItem colorItem-3" data-id="3"></li>
                <li class="list-inline-item colorItem colorItem-4" data-id="4"></li>
                <li class="list-inline-item colorItem colorItem-5" data-id="5"></li>
                <li class="list-inline-item colorItem colorItem-6 cpTogle" id="cpButton"></li>
            </ul>
            <ul class="list-unstyled list-inline colorShade">
                <li class="list-inline-item colorShadeItem colorShadeItem-1 color2 {{$user->theme?'':'selected'}}"></li>
                <li class="list-inline-item colorShadeItem colorShadeItem-2 color2"></li>
                <li class="list-inline-item colorShadeItem colorShadeItem-3 color2"></li>
                <li class="list-inline-item colorShadeItem colorShadeItem-4 color2"></li>
                <li class="list-inline-item colorShadeItem colorShadeItem-5 color2"></li>
                <li class="list-inline-item colorShadeItem colorShadeItem-6 color2"></li>
            </ul>
            {{-- <div class="colorPplug">
                <input class="form-control" type="text" name="color">
            </div> --}}
        </div>
        <div class="templatePicker">
            <div class="templateBox">
                <div class="item-theme relative {{isset($user) && $user->template == 'free-1'?'active':''}}" style="height:100%">
                    <div style="position:absolute; height:100%; width:100%; top:0; left:0; z-index: 1">
                        <i class="fa fa-check center-div"></i>
                    </div>
                    <input type="radio" name="template" value="free-1" style="display:none">
                    <iframe src="{{route('load.template', 'free-1').'?iframe=true&url='.$user->url}}" height="100%" width="100%" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
            <div class="templateBox">
                <div class="item-theme relative {{isset($user) && $user->template == 'free-2'?'active':''}}" style="height:100%">
                    <div style="position:absolute; height:100%; width:100%; top:0; left:0; z-index: 1">
                        <i class="fa fa-check center-div"></i>
                    </div>
                    <input type="radio" name="template" value="free-2" style="display:none">
                    <iframe src="{{route('load.template', 'free-2').'?iframe=true&url='.$user->url}}" height="100%" width="100%" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
            <div class="templateBox">
                <div class="item-theme relative {{isset($user) && $user->template == 'free-3'?'active':''}}" style="height:100%">
                    <div style="position:absolute; height:100%; width:100%; top:0; left:0; z-index: 1">
                        <i class="fa fa-check center-div"></i>
                    </div>
                    <input type="radio" name="template" value="free-3" style="display:none">
                    <iframe src="{{route('load.template', 'free-3').'?iframe=true&url='.$user->url}}" height="100%" width="100%" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
        </div>
        <div class="submit" style="padding: 0 30px">
            <input type="submit" class="btn-pink" value="Submit">
        </div>
    </form>
</div>
<div class="controls" id="c3" style="display:none">
    <div class="titleHolder">
        <h2><a class="backBtn"><i class="fa fa-angle-left"></i></a> Video</h2>
    </div>
    <form class="nav-form" method="POST">
        <input type="hidden" name="type" value="videos">
        <div class="video">
            <p>Enter a link to your YouTube, Vimeo, or Facebook video. Your video will be added to your page.</p>
            <div class="form-group text-left">
                <label for="video_url_1" >Video Link #1:</label>
                <input class="form-control" name="video_url_1" type="text" placeholder="<iframe src='https://www.youtube.com/watch?v=KWTljtacyz'></iframe> " value="{{json_decode($user->videos)->video_url_1??''}}">
            </div>
            <div class="form-group text-left">
                <label for="video_url_1" >Video Link #2:</label>
                <input class="form-control" name="video_url_2" type="text" placeholder="<iframe src='https://www.youtube.com/watch?v=KWTljtacyz'></iframe> "  value="{{json_decode($user->videos)->video_url_2??''}}">
            </div>
            <div class="form-group text-left">
                <label for="video_url_1" >Video Link #3:</label>
                <input class="form-control" name="video_url_3" type="text" placeholder="<iframe src='https://www.youtube.com/watch?v=KWTljtacyz'></iframe>  "  value="{{json_decode($user->videos)->video_url_3??''}}">
            </div>
            <div class="submit">
                <input type="submit" class="btn-pink" value="Submit">
            </div>
        </div>
    </form>
    <div class="floatingNote" {{$subscription->subscription_type?'hidden':''}}>
        <p class="title">This is a pro feature!</p>
        <p>Upgrade now to pro to use all features!!</p>
        <a class="btn-pink" target="_blank" href="{{route('paypal.express-checkout', ['recurring' => true])}}">Go Pro</a>
    </div>
</div>
<div class="controls" id="c4" style="display:none">
    <div class="titleHolder">
        <h2><a class="backBtn"><i class="fa fa-angle-left"></i></a> Biography</h2>
    </div>
    <form class="nav-form" method="POST">
    <input type="hidden" name="type" value="bio">
        <div class="input">
            <div class="form-group">
                <label>Bio</label>
                <textarea class="form-control" name="bio" cols="30" rows="10">{{isset($user)?$user->bio:''}}</textarea>
            </div>
            <div class="submit">
                <input type="submit" class="btn-pink" value="Submit">
            </div>
        </div>
    </form>
</div>
<div class="controls" id="c5" style="display:none">
    <div class="titleHolder">
        <h2><a class="backBtn"><i class="fa fa-angle-left"></i></a> Social Media Links</h2>
    </div>
    <form class="Icons nav-form mb-5" method="POST">
        <input type="hidden" name="type" value="social_media_links">
        <div class="texts">
            <p>Your Social Links</p>
        </div>
        <div class="socialIconHolder">
            <ul class="list-inline socialList">
                @php
                    if($subscription->subscription_type){
                        $socialArray = ['Facebook','Twitter','Instagram','LinkedIn','YouTube'];
                    }else{
                        $socialArray = ['Facebook'];
                    }
                @endphp
                @foreach ($socialArray as $item)
                @if (isset($user) && (array_search($item, $user->social_provider) !== false))
                <li class="list-inline-item socialItem selected" data-provider="{{$item}}"><i class="fa fa-{{strtolower($item)}}"></i></li>
                @else
                <li class="list-inline-item socialItem" data-provider="{{$item}}"><i class="fa fa-{{strtolower($item)}}"></i></li>
                @endif
                @endforeach
            </ul>
        </div>
        <div class="inputs" id="appendSocial">
            @if (isset($user))
                @foreach ($user->social_url as $key => $url)
                <div class="form-group" id="{{$user->social_provider[$key]}}">
                    <label>{{$user->social_provider[$key]}} Link:</label>
                    <input type="hidden" name="social_provider[]" value="{{$user->social_provider[$key]}}">
                    <input type="text" class="form-control" name="social_url[]" value="{{$url}}">
                </div>
                @endforeach
            @endif
        </div>
        <div class="submit">
            <input type="submit" class="btn-pink" value="Submit">
        </div>
    </form>
</div>

@endif
