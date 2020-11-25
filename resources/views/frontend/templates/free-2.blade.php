@extends('frontend.templates.layouts.default')
@section('content')
<div class="templateView bg-bluee t2">
    <div class="d-flex">
        <div class="profile-image">
            <div class="imageHolder">
                <img src="{{isset($user)?asset('uploads/avatar/'.$user->user_id.'/'.$user->image):asset('frontend/img/templates/jhon.jpg')}}">
            </div>
            <div class="textContents">
                <h2 class="name">{{isset($user)?$user->fullname:'John Doe'}}</h2>
                <p class="desc">{{isset($user)?$user->title:'creative director'}}</p>
                <div class="socilaHolder">
                    <ul class="list-inline">
                        @if (isset($user))
                            @foreach ($user->social_url as $key => $url)
                            <li class="list-inline-item"><a href="{{Str::contains($url, 'http')?$url:'https://'.$url}}" title="{{$user->social_provider[$key]}}" target="_blank"> <i class="fa fa-{{strtolower($user->social_provider[$key])}}"></i> </a></li>
                            @endforeach
                        @else
                        <li class="list-inline-item"><a href="#" title="" > <i class="fa fa-twitter"></i> </a></li>
                        <li class="list-inline-item"><a href="#" title=""> <i  class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" title="" ><i class="fa fa-linkedin"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="btnHolder">
                <a href="" class="btn-pink btnColor">Contact Me</a>
            </div>
        </div>
        <div class="profile-about">
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
    </div>
    @if (Request::route()->getName() == 'profile.page' && (isset($user) && $user->user->pro == 1) || Request::route()->getName() == 'load.template')
    <ul class="list-inline videoHolder">
        <li class="list-inline-item videos">
            @if (isset($user) && $user->user->pro == 1)
            <iframe src="https://player.vimeo.com/video/294281154?title=0&byline=0&portrait=0&transparent=0" frameborder="0" allow="autoplay; encrypted-media" webkitallowfullscreen mozallowfullscreen allowfullscreen data-ready="true"></iframe>
            @else
            <img src="{{asset('frontend/img/templates/video-thumbnail.png')}}" width="100%" alt="video placeholder">
            @endif
        </li>
        <li class="list-inline-item videos">
            @if (isset($user) && $user->user->pro == 1)
            <iframe src="https://www.youtube.com/embed/opUKr9J0_Rw?showinfo=0" frameborder="0" allow="autoplay; encrypted-media" webkitallowfullscreen mozallowfullscreen allowfullscreen data-ready="true"></iframe>
            @else
            <img src="{{asset('frontend/img/templates/video-thumbnail.png')}}" width="100%" alt="video placeholder">
            @endif
        </li>
        <li class="list-inline-item videos">
            @if (isset($user) && $user->user->pro == 1)
            <video controls >
                <source src="{{asset('frontend')}}/img/templates/movie.mp4" type="video/mp4">
                <source src="{{asset('frontend')}}/img/templates/movie.ogv" type="video/ogv">
                Your browser does not support the video tag.
            </video>
            @else
            <img src="{{asset('frontend/img/templates/video-thumbnail.png')}}" width="100%" alt="video placeholder">
            @endif
        </li>
        <li class="list-inline-item videos">
            @if (isset($user) && $user->user->pro == 1)
            <iframe src="https://www.youtube.com/embed/opUKr9J0_Rw?showinfo=0" frameborder="0" allow="autoplay; encrypted-media" webkitallowfullscreen mozallowfullscreen allowfullscreen data-ready="true"></iframe>
            @else
            <img src="{{asset('frontend/img/templates/video-thumbnail.png')}}" width="100%" alt="video placeholder">
            @endif
        </li>
    </ul>
    @endif
</div>
@endsection
