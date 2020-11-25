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
    <title>@yield('title') | My Intro Page</title>
 <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('frontend/images/favicon.ico')}}">

{{-- added header links --}}


    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="{{asset('css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Slider -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}"/>
    <!-- Styles -->
    @include('frontend.includes.css1')
     @include('frontend.includes.css')
    {!! NoCaptcha::renderJs() !!}
    @include('cookieConsent::index')
    <style>
        #loadingDiv {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 99999999;
            background: #fff;
            background-image: url("{{asset('frontend/img/dash-loader-large.gif')}}");
            background-position: center;
            background-repeat: no-repeat;
            opacity: 1;
        }
        .cookie-consent {
            position: fixed;
            z-index: 9999;
            bottom: 0;
            background: #2f55d4;
            width: 100%;
            text-align: center;
            padding: 10px 15px;
            color: #fff;
            font-family: Montserrat-Medium;
        }
        .cookie-consent button {
            border: none;
            border-radius: 4px;
            color: #2f55d4;
            background: #fff;
            line-height: 1;
            padding: 12px 18px;
            font-size: 14px;
            font-family: Montserrat-Bold;
        }
        span.invalid-feedback {
            font-family: Montserrat-Medium;
            font-size: 15px
        }
    </style>
</head>

<body>
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
    @include('frontend.includes.header')
    @yield('content')
    @include('frontend.includes.footer1')
    @include('frontend.includes.js1')
    @include('frontend.includes.js')
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#loadingDiv').fadeOut('fast');
        });
    </script>
    {{-- <script type="text/javascript">
        DeBounce_APIKEY = 'public_ditYbmUzQlZQM1BpazFsWlJhelh2QT09';
        DeBounce_BlockFreeEmails = 'false'; //Set this value true to block free emails like Gmail.
    </script>
    <script async type="text/javascript" src="https://cdn.debounce.io/widget/DeBounce.js"></script> --}}
</body>

</html>
