@extends('layouts.app1')
@section('title','Reset Password')
@section('css')
<style>
    .invalid-pl {
        padding-left: 70px;
    }
    .center-this > div,
    .center-this > div >div {
        margin:auto;
    }
    @media (max-width: 1650px) {
        .invalid-pl {
            padding-left: 54px;
        }
    }
</style>
@stop

@section('content')
<main role="main" class="contents contact-page">

<div class="back-to-home rounded d-none d-sm-block">
        <a href="{{Route('home')}}" class="text-white rounded d-inline-block text-center"><i class="mdi mdi-home"></i></a>
            </div>

            <!-- Hero Start -->
            <section class="bg-home">
                <div class="home-center">
                    <div class="home-desc-center">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6">
                                    <div class="mr-lg-5">
                                        <img src="{{asset('frontend/images/user/recovery.png')}}" class="img-fluid d-block mx-auto" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                                    <div class="login_page bg-white shadow rounded p-4">
                                        <div class="text-center">
                                            <h4 class="mb-4">Recover Account</h4>
                                        </div>
                                        <form  class="login-form" method="POST" action="{{ route('password.update') }}">
                                                @csrf
                                                
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p class="text-muted">Please enter your email address. You will receive a link to create a new password via email.</p>
                                                    <div class="form-group position-relative">
                                                        <label>Email address <span class="text-danger">*</span></label>
                                                        <i class="mdi mdi-account ml-3 icons"></i>
                                                        <input type="email" id="email" class="form-control pl-5 @error('email') is-invalid @enderror" placeholder="Enter Your Email Address" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback text-center" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 text-center center-this">
                                                    {!! NoCaptcha::display() !!}
                                                    @error('g-recaptcha-response')
                                                        <span class="invalid-feedback" role="alert" style="display:block;">
                                                            <strong>Please ensure that you are human.</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12 mt-2">
                                                    <button class="btn btn-primary w-100">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!--end col-->
                            </div><!--end row-->
                        </div> <!--end container-->
                    </div>
                </div>
            </section><!--end section-->
            <!-- Hero End -->
</main>
@endsection



