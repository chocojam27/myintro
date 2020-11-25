@extends('layouts.app1')
@section('title','Sign Up')
@section('css')
<style>
    .section-planspricing .heading p:not(:last-child) {
        margin-bottom: 20px;
    }
    
        .invalid-pl {
        padding-left: 35px;
    }
        .center-this > div,
    .center-this > div >div {
        margin:auto;
    }
    @media (max-width: 1650px) {
        .invalid-pl {
            padding-left: 26px;
        }
    }
</style>
@stop

@section('content')
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
                                            <img src="{{asset('images/user/signup.png')}}" class="img-fluid d-block mx-auto" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                                        <div class="login_page bg-white shadow rounded p-4">
                                            <div class="text-center">
                                                <h4 class="mb-4">Signup</h4>
                                            </div>
                                            <form id="register-form" class="login-form" method="POST" action="{{ route('signup') }}">
                                                    @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group position-relative">
                                                            <label>First name <span class="text-danger">*</span></label>
                                                            <i class="mdi mdi-account ml-3 icons"></i>
                                                            <input type="text" class="form-control pl-5 @error('name') is-invalid @enderror" placeholder="First Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                            @error('name')
                                                            <span class="invalid-feedback invalid-pl" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group position-relative">
                                                            <label>Last name <span class="text-danger">*</span></label>
                                                            <i class="mdi mdi-account ml-3 icons"></i>
                                                            <input type="text" class="form-control pl-5 @error('surname') is-invalid @enderror" placeholder="Last Name" name="surname" value="{{ old('surname') }}" required autocomplete="surname">
                                                            @error('surname')
                                                            <span class="invalid-feedback invalid-pl" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group position-relative">
                                                            <label>Your Email <span class="text-danger">*</span></label>
                                                            <i class="mdi mdi-account ml-3 icons"></i>
                                                            <input type="email" class="form-control pl-5 @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                            @error('email')
                                                            <span class="invalid-feedback invalid-pl" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <div class="form-group position-relative">
                                                            <label>Password <span class="text-danger">*</span></label>
                                                            <i class="mdi mdi-key ml-3 icons"></i>
                                                            <input type="password" class="form-control pl-5 @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                                                            @error('password')
                                                            <span class="invalid-feedback invalid-pl" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    
                                              
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="cbAgree">
                                                                <label class="custom-control-label" for="cbAgree">By clicking, you agree to <a href="{{Route('terms-and-conditions')}}" class="text-primary">Terms And Condition</a> and <a href="{{Route('privacy-policy')}}" class="text-primary">Privacy Policy</a>.</label>
                                                                <span id="termsAndPolicyError" class="invalid-feedback" role="alert" style="display:none">
                                                                        <strong>Please read and accept the terms and policies.</strong>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                <div class="col-lg-12 text-center center-this mb-2">
                                                    {!! NoCaptcha::display() !!}
                                                    @error('g-recaptcha-response')
                                                        <span class="invalid-feedback" role="alert" style="display:block;">
                                                            <strong>Please ensure that you are human.</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary w-100" type="submit">Register</button>
                                                    </div>
                                            
                                                    <div class="mx-auto">
                                                        <p class="mb-0 mt-3"><small class="text-dark mr-2">Already have an account ?</small> <a href="{{route('login')}}" class="text-dark font-weight-bold">Sign in</a></p>
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


                @stop

         @section('js')
<script type="text/javascript">
    $(function (){
        $("#register-form").on('submit', function (e){
            console.log(document.getElementById("cbAgree").checked);
            if (!document.getElementById("cbAgree").checked){
                e.preventDefault();
                $('#termsAndPolicyError').css('display', 'block');
            }else{
                $('#termsAndPolicyError').hide();
            }
        });
    });
</script>
@stop
