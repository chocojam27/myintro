<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('frontend/images/favicon.ico')}}">
    
    <title>@yield('title'){{' ~ '.config('app.name').' Admin'}}</title>
    @php
        $configuration = \App\Models\Configuration::find(1);
        $default_settings = \App\Models\DefaultSetting::find(1);
    @endphp
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <style>
        .bgOpacity {
            background-color: #fff;
            background-image: url("{{asset('uploads/cover/1/'.$default_settings->cover)}}");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: bottom;
        }
    </style>
</head>

<body class="app">
    @include('admin.partials.spinner')
    <div class="peers ai-s fxw-nw h-100vh">
        <div class="bgOpacity d-n@sm- peer peer-greed h-100 pos-r">
            <div class="pos-a centerXY" style="z-index: 1000">
                <div class="pos-r" style='width: 50vw;height: 50vh;'>
                    <img class="pos-a centerXY" src="{{asset('uploads/logo/'.$configuration->logo)}}" alt="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
            @yield('content')
        </div>
    </div>
    @if(Request::segment(2) == 'content-management')
    <script src="{{ mix('/backend/js/app.js') }}"></script>
    @yield('js')
    @endif
</body>

</html>
