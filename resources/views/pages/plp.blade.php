@extends('layouts.app-public')
@section('title', 'Shop')
@section('content')
<div class="site-wrapper-reveal">
    
    <!-- Product Area Start -->
    <div class="product-wrapper section-space--ptb_90 border-bottom pb-5 mb-5">
        <div class="container">
            <div class="row">

    <!-- SIDEBAR -->
    <div class="col-lg-3 col-md-3 order-md-1 order-2 small-mt__40">
        <div class="shop-widget widget-shop-categories mt-3">
            <div class="product-filter">
                <h6 class="mb-20">Categories</h6>
                <select class="_filter form-select form-select-sm" name="_type" onchange="getData()">
                    <option value="" selected>All</option>
                    <option value="men_shoes">Men's shoes</option>
                    <option value="woman_shoes">Woman's shoes</option>
                    <option value="men_bags">Men's bags</option>
                    <option value="woman_bags">Woman's bags</option>
                    <option value="men_jackets">Men's jackets</option>
                    <option value="woman_jackets">Woman's jackets</option>
                    <option value="men_pants">Men's pants</option>
                    <option value="woman_pants">Woman's pants</option>
                    <option value="men_shirts">Men's shirts</option>
                    <option value="woman_shirts">Woman's shirts</option>
                </select>
            </div>
        </div>

        
        <div class="shop-widget">
            <div class="product-filter">
                <h6 class="mb-20">Tags</h6>
                <div class="blog-tagcloud">
                    <a href="#" class="selected">Shoes</a>
                    <a href="#">Jacket</a>
                    <a href="#">Best Seller</a>
                    <a href="#">pants</a>
                    <a href="#">bag</a>
                </div>
            </div>
        </div>

        <div class="shop-widget">
            <div class="product-filter widget-price">
                <h6 class="mb-20">Price</h6>
                <ul class="widget-nav-list">
                    <li><a href="#">Under IDR 100K</a></li>
                    <li><a href="#">IDR 100-500K</a></li>
                    <li><a href="#">IDR 501-1000K</a></li>
                    <li><a href="#">Above IDR 1000K</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- PRODUK -->
    <div class="col-lg-9 col-md-9 order-md-2 order-1">
        <div class="row mb-5">
            <div class="col-lg-6 col-md-8">
                <div class="shop-toolbar__items shop-toolbar__item--left">
                    <div class="shop-toolbar__item ">
                        <select class="_filter form-select form-select-sm" name="_sort_by" onchange="getData()">
                            <option value="title_asc">Sort by A-Z</option>
                            <option value="title_desc">Sort by Z-A</option>
                            <option value="latest_publication">Sort by latest</option>
                            <option value="latest_added">Sort by time added</option>
                            <option value="price_asc">Sort by price: low to high</option>
                            <option value="price_desc">Sort by price: high to low</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-4">
                <div class="header-right-search">
                    <div class="header-search-box">
                        <input class="_filter search-field" name="_search" type="text" onkeypress="getDataOnEnter(event)"
                            placeholder="Search items...">
                        <button class="search-icon"><i class="icon-magnifier"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- LIST PRODUK -->
        <div class="row" id="product-list"></div>

        <!-- PAGINATION -->
        <div class="row">
            <div class="col-12">
                <ul class="page-pagination text-center mt-40" id="product-list-pagination"></ul>
            </div>
        </div>
    </div>
</div>
    <div>
        <div class="row" id="product-list"></div>
        <div class="row">
            <div class="col-12">
                <ul class="page-pagination text-center mt-40"
                    id="product-list-pagination"></ul>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End -->

</div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
<script src="{{asset('pages/js/plp.js')}}"></script>
@endsection
