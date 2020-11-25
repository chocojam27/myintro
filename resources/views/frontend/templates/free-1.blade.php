@extends('frontend.templates.layouts.default')
@section('content')
<div class="templateView">
    <div class="row">
        <div class="col-md-3 items profileContents">
            <div class="imageHolder">
                <img src="{{isset($user)?asset('uploads/avatar/'.$user->user_id.'/'.$user->image):asset('frontend/img/templates/jhon.jpg')}}">
            </div>
            <div class="textContents">
                <h2 class="name">{{isset($user)?$user->fullname:'John Doe'}}</h2>
                <p class="desc">creative director</p>
                <div class="socilaHolder">
                    <ul class="list-inline">
                        @if (isset($user))
                            @foreach ($user->social_url as $key => $url)
                            <li class="list-inline-item clicked" data-type='1'><a href="{{Str::contains($url, 'http')?$url:'https://'.$url}}" title="{{$user->social_provider[$key]}}" target="_blank"> <i class="fa fa-{{strtolower($user->social_provider[$key])}}"></i> </a></li>
                            @endforeach
                        @else
                        <li class="list-inline-item"><a href="#" title="" > <i class="fa fa-twitter"></i> </a></li>
                        <li class="list-inline-item"><a href="#" title=""> <i  class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" title="" ><i class="fa fa-linkedin"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
            @if ((isset($user) && $user->add_contact == true) || Request::route()->getName() == 'load.template')
                <div class="btnHolder">
                    <a href="" class="btn-pink btnColor clicked" data-type='2' data-toggle="modal" data-target="#contactModal">Contact Me</a>
                </div>
            @endif
        </div>
        @if ($innerPage ?? '')
            {{-- @dd($innerPage); --}}
            <div class="{{Request::route()->getName() == 'profile.page' && (isset($user) && $user->user->pro == 1) || Request::route()->getName() == 'load.template'?'col-md-6':'col-md-9'}} items bioContents">
                <div class="titleHolder">
                    <h2>{{$innerPage->content_title}}</h2>
                </div>
                <div class="bioContents">
                    @php
                        $pHolderIds = explode(',',$innerPage->placeholder_ids);
                        $pHolderVals = explode(',',$innerPage->placeholder_values);
                        $patterns = array();
                        $replacements = array();
                    @endphp
                    @foreach ($pHolderIds as $index => $placeHolder)
                        @php
                            $patterns[$index] = '/'.$placeholders->find($placeHolder)->format.'/';
                        @endphp
                    @endforeach
                    @foreach ($pHolderVals as $index => $pHolderValue)
                        @php
                            $replacements[$index] = $pHolderValue;
                        @endphp
                    @endforeach
                        @php
                            echo preg_replace($patterns, $replacements, $innerPage->main_content);
                        @endphp
                   {{-- {!!$innerPage->main_content!!} --}}
                </div>
            </div>
        @else
        {{-- @dd($user); --}}
            <div class="{{Request::route()->getName() == 'profile.page' && (isset($subscription) && $subscription->subscription_type == 1) && (isset($user) && $user->add_video == true) || Request::route()->getName() == 'load.template'?'col-md-6':'col-md-9'}} items bioContents">
                <div class="titleHolder">
                    <h2>About Me</h2>
                </div>
                <div class="bioContents">
                    @if (isset($user))
                    <p>{!! $user->bio !!}</p>
                    @else
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat inventore enim, et laudantium eos doloremque?
                        Unde aspernatur et ex libero laudantium! Perferendis fugiat,
                            consequatur dolorum nostrum sequi non libero officiis,
                        aliquid porro magnam reprehenderit eos molestias id qui repudiandae
                        hic. Maiores dignissimos enim ducimus eaque, repellat accusamus vel aperiam nesciunt.
                    </p>
                    <p>Atque vero earum enim, dolore quis quos repellat alias harum quas dolorem debitis rerum soluta ab,
                        animi illo veritatis optio fugit consequatur,
                        facere totam placeat. Cumque distinctio magni excepturi sed culpa hic qui repellat
                            vitae, laboriosam ullam accusamus ab illum quo earum quae eaque?
                        Excepturi quas possimus eos ad molestias.
                    </p>
                    @endif
                </div>
            </div>
        @endif
        @if (Request::route()->getName() == 'profile.page' && (isset($subscription) && $subscription->subscription_type == 1) && (isset($user) && $user->add_video == true) || Request::route()->getName() == 'load.template')
            <div class="col-md-3 items videos">
                @php
                    if(isset($user)){
                        $videos = json_decode($user->videos);
                    }else{
                        $videos = [];
                    }
                @endphp
                @forelse ($videos as $item)
                    <div class="videoHolder">
                        @if (isset($subscription) && $subscription->subscription_type == 1)
                            {!! $item !!}
                        @else
                        <img src="{{asset('frontend/img/templates/video-thumbnail.png')}}" width="100%" alt="video placeholder">
                        @endif
                    </div>
                @empty
                    @for ($empty = 1; $empty <= 3; $empty++)
                        <div class="videoHolder">
                            <img src="{{asset('frontend/img/templates/video-thumbnail.png')}}" width="100%" alt="video placeholder">
                        </div>
                    @endfor
                @endforelse

            </div>
        @endif
    </div>
</div>
@endsection
