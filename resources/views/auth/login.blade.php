@extends('layouts.app1')
@section('title','Login')
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
            <a href="{{url('/')}}" class="text-white rounded d-inline-block text-center"><i class="mdi mdi-home"></i></a>
        </div>

         <!-- Hero Start -->
         <section class="bg-home">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-md-6">
                                <div class="mr-lg-5">
                                    <img src="images/user/login.png" class="img-fluid d-block mx-auto" alt="">
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                                <div class="login-page bg-white shadow rounded p-4">
                                    <div class="text-center">
                                        <h4 class="mb-4">Login</h4>
                                    </div>
                             <form method="POST"  class="login-form" action="{{ route('login') }}">
                                        @csrf
                                        @if (session('message'))
                                        <div class="alert alert-danger">{{ session('message') }}</div>
                                    @endif
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group position-relative">
                                                    <label>Your Email <span class="text-danger">*</span></label>
                                                    <i class="mdi mdi-account ml-3 icons"></i>
                                                    <input type="email" id="email" class="form-control pl-5 icon input-name @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback invalid-pl" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group position-relative">
                                                    <label>Password <span class="text-danger">*</span></label>
                                                    <i class="mdi mdi-key ml-3 icons"></i>
                                                    <input type="password" id="password" class="form-control pl-5 icon input-email @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                                                      @error('password')
                                                        <span class="invalid-feedback invalid-pl" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                                </div>
                                            </div>

                                            <div class="col-lg-12">

                                                <p class="float-right forgot-pass"> @if (Route::has('password.request'))<a href="{{ route('password.request') }}" class="forgot-password text-dark font-weight-bold">Forgot password ?</a>   @endif</p>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"  id="customCheck1" {{ old('remember') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customCheck1">Remember me</label>
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
                                            <div class="col-lg-12 mb-0">
                                                <button class="btn btn-primary w-100">Sign in</button>
                                            </div>
                                         
                                            <div class="col-12 text-center">
                                                <p class="mb-0 mt-3"><small class="text-dark mr-2">Don't have an account ?</small> <a href="{{route('signup')}}" class="text-dark font-weight-bold">Sign Up</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div><!---->
                            </div> <!--end col-->
                        </div><!--end row-->
                    </div> <!--end container-->
                </div>
            </div>
        </section><!--end section-->
        <!-- Hero End -->

          <!-- javascript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <!-- Main Js -->
        <script src="js/app.js"></script>
    </body>
</html>
