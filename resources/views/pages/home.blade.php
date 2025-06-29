@extends('layouts.app-public')
@section('title', 'Home')
@section('content')
    <div class="site-wrapper-reveal">
        <div class="hero-box-area">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="hero-area" id="product-preview"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="about-us-area section-space--ptb_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-us-content_6 text-center">
                            <h1 class="mt-5">Push Limits <br> 
                                <span class="text-color-primary">Perform Better</span>
                            </h1>       
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner Video Area Start -->
        <div class="banner-video-box position-relative text-center">
            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                <iframe 
                    src="https://www.youtube.com/embed/dHYTo6Da2aA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;">
                </iframe>
            </div>
        </div>
        <!-- Banner Video Area End -->

        <!-- Our Brand Area Star -->
        <div class="our-brand-area section-space--pb_90">
            <div class="container">
                <div class="brand-slider-active">
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="https://www.nike.com/id/" target="_blank"><img src="assets/images/brand/partnerb1.png" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="https://www.adidas.co.id/" target="_blank"><img src="assets/images/brand/partnerb2.png" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="https://airwalk.com/" target="_blank"><img src="assets/images/brand/partnerb3.png" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="https://asics.co.id/" target="_blank"><img src="assets/images/brand/partnerb4.png" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="https://www.hoka.com/" target="_blank"><img src="assets/images/brand/partnerb5.png" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="https://www.newbalance.com/" target="_blank"><img src="assets/images/brand/partnerb6.png" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="https://sg.puma.com/sg/en/home" target="_blank"><img src="assets/images/brand/partnerb7.png" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="https://www.reebok.com/" target="_blank"><img src="assets/images/brand/partnerb8.png" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="https://www.skechers.id/" target="_blank"><img src="assets/images/brand/partnerb9.png" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Brand Area End -->

        <!-- Our Member Area Start -->
        <div class="our-member-area section-space--pb_120">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="member--box">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4">
                                    <div class="section-title small-mb__40 tablet-mb__40">
                                        <h4 class="section-title">Join the community!</h4>
                                        <p>Become one of the member and get discount 50% off</p>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-8">
                                    <div class="member-wrap">
                                        <form action="#" class="member--two">
                                            <input class="input-box" type="text" placeholder="Your email address">
                                            <button class="submit-btn"><i class="icon-arrow-right"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Member Area End -->
    
    </div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css">

    <script>
        $(document).ready(function () {
            $('.popup-youtube').magnificPopup({
                type: 'iframe',
                mainClass: 'mfp-fade',
                preloader: true
            });
        });
    </script>
    <script src="{{asset('pages/js/home.js')}}"></script>
@endsection