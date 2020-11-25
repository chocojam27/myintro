@extends('layouts.default')
@section('title','Pricing')
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
                                        <h4 class="title"> Pricing </h4>
                                        <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                                            <li><a href="{{Route('home')}}" class="text-uppercase font-weight-bold text-dark">Home</a></li>
                                            <li>
                                                <span class="text-uppercase text-primary font-weight-bold">Pricing</span>
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

            <!-- Price Start -->
            <section class="section pb-0">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <div class="section-title mb-4 pb-2">
                                <h1 class="heading mb-4">{{ $content->section_first[0]->content }}</h1>
                                <p class="text-muted para-desc mb-0 mx-auto">{{ $content->section_first[1]->content }}</p>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->


                    <div class="row align-items-center justify-content-center">
                            @foreach (unserialize(base64_decode($subscription_content->section_first[0]->content)) as $key => $item)

                        <div class="col-md-4 col-12 mt-4 pt-2">
                            <div class="pricing-rates business-rate shadow bg-light pt-5 pb-5 p-4 rounded text-center">
                                <h2 class="title text-uppercase mb-4">{{$item[0]['field_value']}}</h2>
                                <div class="d-flex justify-content-center mb-4">
                                    <span class="h4 mb-0 mt-2">$</span>
                                    <span class="price h1 mb-0">{{$item[1]['field_value']?$item[1]['field_value']:'0.00'}}</span>
                                    <span class="h4 align-self-end mb-1">/mo</span>
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
                        {{-- <div class="col-md-4 col-12 mt-4 pt-2">
                            <div class="pricing-rates business-rate shadow bg-white pt-5 pb-5 p-4 rounded text-center">
                                <h2 class="title text-uppercase text-primary mb-4">Professional</h2>
                                <div class="d-flex justify-content-center mb-4">
                                    <span class="h4 mb-0 mt-2">$</span>
                                    <span class="price h1 mb-0">4.99</span>
                                    <span class="h4 align-self-end mb-1">/mo</span>
                                </div>

                                <ul class="feature list-unstyled pl-0">
                                    <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>Full Access</li>
                                    <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>Source Files</li>
                                    <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>Free Appointments</li>
                                    <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>Free Installment</li>
                                    <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>Enhanced Security</li>
                                </ul>
                                <a href="javascript:void(0)" class="btn btn-primary mt-4">Buy Now</a>
                            </div>
                        </div><!--end col--> --}}
                    </div><!--end row-->

                    <div class="row justify-content-center">
                        <div class="col-12 text-center mt-4 pt-2">
                            <div class="section-title mb-4 pb-2">
                                <p class="text-muted para-desc mb-0 mx-auto">{!! $content->section_first[2]->content !!}</p>
                            </div>
                        </div><!--end col-->
                    </div>
                </div><!--end container-->
            </section><!--end section-->
            <!-- Testi End -->

            <!-- About Start -->
            <section class="section pt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <div class="section-title mb-4 pb-2">
                                <h1 class="heading mb-4">Clear & simple pricing</h1>
                                <p class="text-muted para-desc mb-0 mx-auto">Start Free, Upgrade Anytime. If you have any questions, don't hesitate to contact us.</p>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row align-items-center">
                        <div class="col-12 mt-4 pt-2">
                            <div class="component-wrapper rounded shadow  bg-light">
                                <div class="p-4">
                                    <div class="table-responsive bg-white shadow rounded">
                                        <table class="table mb-0 table-center">
                                            <thead>
                                                <tr>
                                                    @foreach (unserialize(base64_decode($content->section_second[0]->content)) as $key => $item)
                                                   @if($key == 0)
                                                    <th scope="col"></th>
                                                   @else
                                                    <th scope="col">{{ $item[0]['field_value'] }}</th>
                                                    @endif
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (unserialize(base64_decode($content->section_second[1]->content)) as $item)
                                                <tr>
                                                    <th scope="row">{{ $item[0]['field_value'] }}</th>
                                                    <td>{!! $item[1]['field_value'] !!}</td>
                                                    <td>{!! $item[2]['field_value'] !!}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            <!-- About End -->

</main>
@stop
@section('js')
@stop

