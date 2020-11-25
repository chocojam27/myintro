@extends('layouts.default')
@section('title','Features')
@section('css')
<style>
    .dashed-line.last:after {
        display: none;
    }
</style>
@stop
@section('content')
<main role="main" class="contents">

        <!-- Hero Start -->
        <section class="bg-half bg-light">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 text-center">
                                <div class="page-next-level">
                                    <h4 class="title"> Features </h4>
                                    <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                                        <li><a href="{{Route('home')}}" class="text-uppercase font-weight-bold text-dark">Home</a></li>
                                        <li>
                                            <span class="text-uppercase text-primary font-weight-bold">Features</span>
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

        <!-- Hero Start -->
        <section class="bg-half-170 border-bottom" id="home">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-5 order-md-2">
                                <img src="images/saas/1.png"  class="img-fluid mx-auto d-block" alt="">
                            </div><!--end col-->

                            <div class="col-lg-7 col-md-7 mt-4 pt-2 mt-sm-0 pt-sm-0 order-md-1">
                                <div class="title-heading mt-4">


                                    <h1 class="heading mb-3">{{ $content->section_first[0]->content }} <span class="text-primary">Features</span> </h1>
                                    <p class="para-desc text-muted">{!! $content->section_first[1]->content !!}</p>
                                    <div class="mt-4 pt-2">
                                        <a href="{{route('signup')}}" class="btn btn-primary mt-2">{{ $content->section_first[2]->content }}<i class="mdi mdi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end container-->
                </div><!--end home desc center-->
            </div><!--end home center-->
        </section><!--end section-->
        <!-- Hero End -->

        <!-- About Start -->
        <section class="section">


            <div class="container">
                    @foreach (unserialize(base64_decode($content->section_second[0]->content)) as $key => $item)
                    @if ($key == 0)
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0">
                        <div class="position-relative">
                            <img src="images/illustrator/app_development_SVG.svg" class="rounded img-fluid mx-auto d-block" alt="">
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-8 col-md-8 mt-4 pt-2 mt-sm-0 pt-sm-0">
                        <div class="section-title ml-lg-4">
                            <h4 class="title mb-4">{{ $item[0]['field_value'] }}</h4>
                            <p class="text-muted">{!! $item[1]['field_value'] !!}</p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->



                @elseif($key == 1)

                <div class="row align-items-center mt-5">
                        <div class="col-lg-4 col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0 order-md-2">
            <div class="position-relative">
                <img src="images/new/coding.svg" class="rounded img-fluid mx-auto d-block" alt="">
            </div>
        </div><!--end col-->

                    <div class="col-lg-8 col-md-8 mt-4 pt-2 mt-sm-0 pt-sm-0 order-md-1">
                        <div class="section-title ml-lg-4">
                            <h4 class="title mb-4">{{ $item[0]['field_value'] }}</h4>
                            <p class="text-muted">{!! $item[1]['field_value'] !!}</p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
                
                @else
                      <div class="row align-items-center mt-5">
                        <div class="col-lg-4 col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0">
                                <div class="position-relative">
                                    <img src="images/new/delivery_app.svg" class="rounded img-fluid mx-auto d-block" alt="">
                                </div>
                            </div><!--end col-->

                    <div class="col-lg-8 col-md-8 mt-4 pt-2 mt-sm-0 pt-sm-0 order-md-1">
                        <div class="section-title ml-lg-4">
                            <h4 class="title mb-4">{{ $item[0]['field_value'] }}</h4>
                            <p class="text-muted">{!! $item[1]['field_value'] !!}</p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                @endif
                @endforeach
            </div><!--end container-->

        </section><!--end section-->
        <!-- About End -->


</main>
@stop
@section('js')
@stop
