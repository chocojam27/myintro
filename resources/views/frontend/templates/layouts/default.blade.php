<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Jon Limuel M. Humirang">
    <title>{{isset($user)?$user->url:'Free Template'}} | My Intro Page</title>
    <!-- Favicon  -->
    <link rel="shortcut icon" href="{{asset('frontend/images/favicon.ico')}}">


    <!-- Bootstrap -->
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="{{asset('frontend/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Slider -->
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.default.min.css')}}"/>
    <!-- Styles -->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css" />
    @include('frontend.includes.css')
     @include('frontend.includes.css1')
    @include('frontend.templates.includes.css')
    @if ((Auth::check() && isset($user)) && ($user->user_id == Auth::user()->id))
    @include('cookieConsent::index')
    @endif
</head>

<body>
    @if (!Request::has("iframe") && Auth::check() && ($user->user_id == Auth::user()->id))
      <!-- Loader -->
  <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- Loader -->
    @endif
    @include('frontend.includes.header')
    <section class="templateSec">
        <div class="row">
            @yield('content')
            @if ((Auth::check() && isset($user)) && ($user->user_id == Auth::user()->id)  && (!($innerPage??'')))
            @include('frontend.templates.includes.side-nav')
            @endif
        </div>
        @if (!Request::has("iframe") && Auth::check() && ($user->user_id == Auth::user()->id))
            @if($innerPage ?? '')
            @else
                <div class="floatingButton">
                    <a href="#" class="btn-pink toggleSide"><i class="fa fa-cogs"></i></a>
                </div>
            @endif
        @endif
    </section>
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" > --}}
    </button>
    <!-- Modal -->
    @if(isset($user))
        <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contact Me</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('send.mail',encrypt($user->user_id))}}" method="POST">
                        @csrf
                        <label for="fname">Full Name:</label>
                        <input type="text" class="form-control" name="fname">
                        <label for="email">Your Email:</label>
                        <input type="email" class="form-control" name="email">
                        <label for="subject">Subject:</label>
                        <input type="text" class="form-control" name="subject">
                        <label for="message">Message:</label>
                        <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                        {{-- <input type="submit" name="contactSubmit" value="Send"> --}}
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    @endif
    @include('frontend.includes.js')
     @include('frontend.includes.js1')
    @if (!Request::has("iframe") && Auth::check() && ($user->user_id == Auth::user()->id))
    @include('frontend.templates.includes.js')
        
    @endif
    @if (!Request::has("iframe"))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#loadingDiv').fadeOut('fast');
                $('.templateSec .templateView, .controls').css('min-height', `calc(100vh - ${$('header').outerHeight()}px)`);
                $('.controls').css('height', `calc(100vh - ${$('header').outerHeight()}px)`);
                viewed();
            });
            $(document).on('click','.clicked',function(){
                type = $(this).data('type');
                clicked(type);
            });
            function viewed(){
                $pageid = {!! json_encode($genPage->id ?? '') !!};
                $profileid = {!! json_encode($user->id?? '') !!};
                $.ajax({
                    type: "post",
                    url: "{{route('page.createView')}}",
                    data: {page_id : $pageid,profile_id : $profileid},
                    success: function (data) {
                        if(data.result == 'success'){
                        }else{
                        }
                    },
                });
            };
            function clicked(type){
                $pageid = {!! json_encode($innerPage->id ?? '') !!};
                $profileid = {!! json_encode($user->id?? '') !!};
                $type = type;
                $.ajax({
                    type: "post",
                    url: "{{route('page.createClick')}}",
                    data: {page_id : $pageid , profile_id : $profileid , type : $type },
                    success: function (data) {
                        if(data.result == 'success'){
                        }else{
                        }
                    },
                });
            };
        </script>
    @endif
</body>
</html>
