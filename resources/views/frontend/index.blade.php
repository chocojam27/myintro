@extends('layouts.app2')
@section('title','Home')
@section('css')
<style>
    .section-planspricing .heading p:not(:last-child) {
        margin-bottom: 20px;
    }
</style>
@stop

@section('content')

<!-- Hero Start -->
<section class="bg-home" style="background: url('images/saas/home-shape.png') center center; height: auto;" id="home">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center mt-0 mt-md-5 pt-0 pt-md-5">
                        <div class="title-heading margin-top-100">
                            <h1 class="heading mb-3">{{ $content->section_first[0]->content }}</h1>
                            <p class="para-desc mx-auto text-muted">{!! $content->section_first[1]->content !!}</p>
                            <div class="mt-4 pt-2">
                                <a href="{{route('signup')}}" class="btn btn-primary">Get Started <i class="mdi mdi-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="home-dashboard">
                            <img src="{{asset('images/saas/home.png')}}" alt="" class="img-fluid">
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </div><!--end home desc center-->
    </div><!--end home center-->
</section><!--end section-->
<!-- Hero End -->

<!-- Grow Your Audience Start -->
<section class="section border-bottom mt-0 mt-md-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-60">
                    <h4 class="title mb-4">{{ $content->section_second[0]->content }}</h4>
                    <p class="text-muted para-desc mb-0 mx-auto">{!! $content->section_second[1]->content !!}</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
              @foreach (unserialize(base64_decode($content->section_second[2]->content)) as $key => $item)
            <div class="col-md-4 col-12 mt-5">
                <div class="features text-center">
                  
                     @if($key == 0)
                    <div class="image position-relative d-inline-block">
                        <img src="images/icon/sand-clock.svg" alt="">
                    </div>
                    @elseif($key == 1)
                      <div class="image position-relative d-inline-block">
                    <img src="images/icon/computer.svg" alt="">
                </div>
                    
                   
                    @elseif($key == 2)
                       <div class="image position-relative d-inline-block">
                    <img src="images/icon/user.svg" alt="">
                </div>
                    
                    
                    
                   
                    @elseif($key == 3)
                    
                         <div class="image position-relative d-inline-block">
                    <img src="images/icon/chat.svg" alt="">
                </div>
                    
                    
                    
                    
                    @elseif($key == 4)
                    
                    <div class="image position-relative d-inline-block">
                    <img src="images/icon/camera.svg" alt="">
                </div>
                    
                  
                    @elseif($key == 5)
                       <div class="image position-relative d-inline-block">
                    <img src="images/icon/big.svg" alt="">
                </div>
               
                    @endif
                     
                  
                    <div class="content mt-4">
                        <h4 class="title-2">{{ $item[0]['field_value'] }}</h4>
                        <p class="text-muted mb-0"> {!! $item[1]['field_value'] !!}</p>
                    </div>
                  
                </div>
                 
            </div><!--end col-->

         @endforeach

        </div><!--end row-->

    </div><!--end container-->
</section><!--end section-->
<!-- Grow Your Audience End -->

<!-- Grow Your Audience Start -->
<section class="section bg-light border-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h4 class="title mb-4">{{ $content->section_third[0]->content }}</h4>
                    <p class="text-muted para-desc mb-0 mx-auto">{!! $content->section_third[1]->content !!}</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Grow Your Audience End -->

<!-- About Start -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-60">
                    <h4 class="title mb-4">{{ $content->section_fourth[0]->content }}</h4>
                    <p class="text-muted para-desc mb-0 mx-auto">{!! $content->section_fourth[1]->content !!}</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row align-items-center">
            <div class="col-lg-4 col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="position-relative">
                    <img src="images/new/web_design.svg" class="rounded img-fluid mx-auto d-block" alt="">
                </div>
            </div><!--end col-->

            <div class="col-lg-8 col-md-8 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="section-title ml-lg-4">
                    <h4 class="title mb-4">{{ $content->section_fourth[2]->content }}</h4>
                    <p class="text-muted"> {!! $content->section_fourth[3]->content !!}</p>
                    <a href="{{route('signup')}}" class="btn btn-primary mt-3">{{ $content->section_fourth[4]->content }} <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row align-items-center mt-5">
            <div class="col-lg-4 col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0 order-md-2">
                <div class="position-relative">
                    <img src="images/new/business.svg" class="rounded img-fluid mx-auto d-block" alt="">
                </div>
            </div><!--end col-->

            <div class="col-lg-8 col-md-8 mt-4 pt-2 mt-sm-0 pt-sm-0 order-md-1">
                <div class="section-title ml-lg-4">
                    <h4 class="title mb-4">{{ $content->section_fourth[5]->content }}</h4>
                    <p class="text-muted">{!! $content->section_fourth[6]->content !!}</p>
                    <a href="{{route('signup')}}" class="btn btn-primary mt-3">{{ $content->section_fourth[7]->content }} <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- About End -->

<!-- Pricing Start -->
<section class="section">
    <div class="container">
        <div class="row mt-lg-4 align-items-center">
            <div class="col-lg-5 col-md-12 text-center text-lg-left">
                <div class="section-title mb-60">
                    <h4 class="title mb-4">{{ $content->section_fifth[0]->content }}</h4>
                    <p class="text-muted para-desc mx-auto mb-0">{!! $content->section_fifth[1]->content !!}</p>
                </div>
            </div><!--end col-->

            <div class="col-lg-7 col-md-12">
                <div class="row align-items-center ml-lg-5">
                        @foreach (unserialize(base64_decode($subscription_content->section_first[0]->content)) as $key => $item)
                    <div class="col-md-6 col-12 pl-md-0 pr-md-0">

                        <div class="pricing-rates starter-plan shadow bg-white pt-5 pb-5 p-4 rounded text-center">

                            <h2 class="title text-uppercase text-primary mb-4">{{$item[0]['field_value']}}</h2>
                            <div class="d-flex justify-content-center mb-4">
                                <span class="h4 mb-0 mt-2"></span>
                                <span class="price h1 mb-0">${{$item[1]['field_value']?$item[1]['field_value']:'0.00'}}<span class="h4 align-self-end mb-1">/mo</span></span>
                            </div>
                            
                            <ul class="feature list-unstyled pl-0">
                                <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>{!! $item[4]['field_value'] !!}</li>
                            </ul>
                              @if ($loop->last)
                            <p class="discover">DISCOVER ALL PRO FEATURES</p>
                            @endif
                            <a href="{{$item[1]['field_value']?route('login'):route('signup')}}" class="btn btn-primary mt-4">{{$item[5]['field_value']}}</a>
                          

                        </div>

                    </div><!--end col-->
                    @endforeach
                    {{--                        temporarily commented                                          --}}
                    {{-- <div class="col-md-6 col-12 mt-4 pt-2 mt-sm-0 pt-sm-0 pl-md-0 pr-md-0">
                        <div class="pricing-rates bg-light pt-5 pb-5 p-4 rounded text-center">
                            <h2 class="title text-uppercase mb-4">Free</h2>
                            <div class="d-flex justify-content-center mb-4">
                                <span class="h4 mb-0 mt-2">$</span>
                                <span class="price h1 mb-0">0</span>
                            </div>

                            <ul class="feature list-unstyled pl-0">
                                <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>Lorem Ipsum</li>
                                <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>Lorem Ipsum Dolor</li>
                                <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>Lorem</li>
                                <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>Lorem Ipsum</li>
                            </ul>
                            <a href="javascript:void(0)" class="btn btn-primary mt-4">Try It Now</a>
                        </div>
                    </div><!--end col--> --}}

                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <div class="container-fluid">
        <div class="row">
            <div class="home-shape-bottom">
                <img src="{{asset('frontend/images/shapes/shape-light.png')}}" alt="" class="img-fluid mx-auto d-block">
            </div>
        </div><!--end row-->
    </div> <!-- END CONTAINER -->
</section><!--end section-->
<!-- Pricing End -->

<!-- FAQ n Contact Start -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h4 class="title mb-4">{{ $content->section_sixth[0]->content }}</h4>
                    <p class="text-muted para-desc mx-auto">{!! $content->section_sixth[1]->content !!}</p>
                    <a href="{{route('signup')}}" class="btn btn-primary mt-4">{{ $content->section_sixth[2]->content }}</a>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <div class="container-fluid">
        <div class="row">
            <div class="home-shape-bottom">
                <img src="{{asset('images/shapes/shape-dark.png')}}" alt="" class="img-fluid mx-auto d-block">
            </div>
        </div><!--end row-->
    </div> <!-- END CONTAINER -->
</section><!--end section-->
<!-- FAQ n Contact End -->


@stop

@section('js')
@stop











