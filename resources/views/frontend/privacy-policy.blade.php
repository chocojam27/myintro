@extends('layouts.default')
@section('title','Privacy Policy')
@section('css')
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
                                        <h4 class="title"> {{ $content->section_first[0]->content }} </h4>
                                        <ul class="list-unstyled mt-4">
                                            <li class="list-inline-item h6 date text-muted"> <span class="text-dark">{{ $content->section_first[3]->content }}</span> {{ $content->section_first[1]->content }}</li>
                                        </ul>
                                        <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                                            <li><a href="{{Route('home')}}" class="text-uppercase font-weight-bold text-dark">Home</a></li>
                                            <li>
                                                <span class="text-uppercase text-primary font-weight-bold">{{ $content->section_first[0]->content }}</span>
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

            <!-- Start Privacy -->
            <section class="section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="p-4 shadow rounded border">
                                <h5>{{ $content->section_first[4]->content }}</h5>
                                <p class="text-muted">{!! $content->section_first[2]->content !!}</p>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container-->

                <div class="container-fluid">
                    <div class="row">
                        <div class="home-shape-bottom">
                            <img src="images/shapes/shape-light.png" alt="" class="img-fluid mx-auto d-block">
                        </div>
                    </div><!--end row-->
                </div> <!-- END CONTAINER -->
            </section><!--end section-->
            <!-- End Privacy -->
</main>
@stop
@section('js')
@stop







