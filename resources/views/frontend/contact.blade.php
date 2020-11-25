@extends('layouts.app2')
@section('title','Home')
@section('css')
<style>
    .invalid-pl {
        padding-left: 70px;
    }
    .noicon-pl {
        padding-left: 35px;
    }
            .center-this > div,
    .center-this > div >div {
        margin:auto;
    }
    @media (max-width: 1650px) {
        .invalid-pl {
            padding-left: 54px;
        }
        .noicon-pl {
            padding-left: 26px;
        }
    }
</style>
@stop
@section('content')
<main role="main" class="contents contact-page">


        <!-- Hero Start -->
        <section class="bg-half bg-light">
                <div class="home-center">
                    <div class="home-desc-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 text-center">
                                    <div class="page-next-level">
                                        <h4 class="title"> Get In Touch </h4>
                                        <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                                            <li><a href="{{Route('home')}}" class="text-uppercase font-weight-bold text-dark">Home</a></li>
                                            <li>
                                                <span class="text-uppercase text-primary font-weight-bold">Get In Touch</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>  <!--end col-->
                            </div><!--end row-->
                        </div> <!--end container-->
                    </div>
                </div>
            </section><!--end section-->
            <!-- Hero End -->

            <!-- Shape Start -->
            <div class="position-relative">
                <div class="shape overflow-hidden text-white">
                    <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                    </svg>
                </div>
            </div>
            <!--Shape End-->





       <!-- Start Contact -->
       <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="pt-5 pb-5 p-4 bg-light shadow rounded">
                        <h4>Get In Touch !</h4>
                        <div class="custom-form mt-4">
                            <div id="message"></div>

                                <form method="POST" action="{{ route('contact') }}" name="contact-form" id="contact-form">
                                    @if(session()->has('message'))
                                    <div class="alert alert-success text-center">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                    @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Your Name <span class="text-danger">*</span></label>
                                            <i class="mdi mdi-account ml-3 icons"></i>
                                            <input  id="name" name="name" id="name" type="text" class="form-control pl-5 icon input-name @error('name') is-invalid @enderror"  value="{{ old('name') }}" placeholder="First Name :" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback invalid-pl" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!--end col-->


                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Your Email <span class="text-danger">*</span></label>
                                            <i class="mdi mdi-email ml-3 icons"></i>
                                            <input name="email" id="email" type="email" class="form-control pl-5 icon input-name @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Your email : " autocomplete="email" autofocus required>
                                            @error('email')
                                                <span class="invalid-feedback invalid-pl" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label>Comments</label>
                                            <i class="mdi mdi-comment-text-outline ml-3 icons"></i>
                                            <textarea name="message" id="comments" rows="4" class="form-control pl-5 @error('email') is-invalid @enderror" placeholder="Your Message :" required >{{ old('email') }}</textarea>
                                            @error('message')
                                                <span class="invalid-feedback noicon-pl" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                </div><!--end row-->
                                <div class="row">
                                
                                       <div class="col-lg-12 text-center center-this mb-2">
                                                    {!! NoCaptcha::display() !!}
                                                    @error('g-recaptcha-response')
                                                        <span class="invalid-feedback" role="alert" style="display:block;">
                                                            <strong>Please ensure that you are human.</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                        <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary btn-block" value="Send Message">
                                      
                                        <div id="simple-msg"></div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form><!--end form-->
                        </div><!--end custom-form-->
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->

        <div class="container-fluid">
            <div class="row">
                <div class="home-shape-bottom">
                    <img src="images/shapes/shape-dark.png" alt="" class="img-fluid mx-auto d-block">
                </div>
            </div><!--end row-->
        </div> <!-- END CONTAINER -->
    </section><!--end section-->
    <!-- End contact -->


</main>
@stop
@section('js')
@stop
