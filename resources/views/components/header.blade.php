<!--============ header area start ==============-->
<div class="header-area header-area--default bg-white">
    <!-- Header Bottom Wrap Start -->
    <header class="header-area header-sticky">
        <div class="container-fluid container-fluid--cp-100">
            <div class="row">
                <div class="col-lg-2 d-none d-md-block">
                    <div class="top-logo-area">
                        <div class="logo text-md-center">
                            <a href="{{route('home')}}"><img src="{{asset('assets/images/logo/logo.png')}}" 
                            alt="logo" style="width: 40%"></a>
                        </div>
                    </div>
                </div>
            </div>      
            <div class="row align-items-center">
                <div class="col-lg-3 col-lg-3 col-6">
                    <div class="header-right-items content_hidden d-none d-md-block">
                        <span class="phone-number font-lg-p" title="Call us for fast delivery">
                            <a href="#cfd"><i class="icon-telephone"></i>&nbsp;&nbsp;<small class="text-color-primary">
                            <b>+(62) 82217932818</b></small></a>
                        </span>
                    </div>
                </div>
                <div class="col-lg-6 col-6 d-none d-lg-block">
                    <div class="header__navigation d-none d-lg-block">
                        <nav class="navigation-menu">
                            <ul class="justify-content-center">
                                <li>
                                    <a href="{{route('home')}}"><span>Home</span></a>
                                </li>
                                <li>
                                    <a href="{{route('plp')}}"><span>Products</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!--   Wishlist, Minicart, Profile   -->
                <div class="col-lg-3 col-lgl3 col-6">
                    <div class="header-right-side text-end">
                        <div class="header-right-items d-none d-md-block">
                            <a href="{{ route('wishlist') }}" class="header-cart">
                                <i class="icon-heart"></i>
                                <span class="item-counter">1</span>
                            </a>
                        </div>
                        <div class="header-right-items">
                            <a href="{{ route('minicart') }}" class="header-cart">
                                <i class="icon-bag2"></i>
                                <span class="item-counter">4</span>
                            </a>
                        </div>

                        <div class="header-right-items d-none d-md-block">
                            @if(@$_COOKIE['ut'])
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    Hello, {{ ucwords(substr($_COOKIE['ue'], 0, 3))}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('my-profile') }}"><span>My Profile</span></a></li>
                                    <li><a href="#" id="logout-btn"><span>Logout</span></a></li>
                                </ul>
                            </div>
                            @else
                            <a href="#" data-bs-toggle="modal" data-bs-target="#authModal">
                                <i class="icon-user"></i>
                            </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
<!--======================= End of header area =====================-->  

<div class="header-login-register-wrapper modal fade" id="authModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-box-wrapper">
                <div class="tab-content content-modal-box">
                    <div class="tab-pane fade show active" id="tab_list_06" role="tabpanel">
                        <form class="account-form-box" id="form-login">
                            <h6 class="mb-3">Login your account</h6>
                            <b id="form-login-error" class="text-red"></b>
                            <div class="single-input">
                                <input name="email" type="text" placeholder="Email" required>
                            </div>
                            <div class="single-input">
                                <input name="password" type="password" placeholder="Password" required>
                            </div>
                            <div class="checkbox-wrap mt-10">
                                <label class="label-for-checkbox inline mt-15">
                                    <input class="input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever">
                                    <span>Remember me</span>
                                </label>
                                <a href="#" clas="mt-10">Lost your password?</a>
                            </div>
                            <div class="button-box mt-25">
                                <a href="#" class="btn btn--full btn--black" id="form-login-btn">Login</a>
                            </div>
                        </form>
                        <div class="form-login-loading" style="text-align:center;display:none">
                            <img src="{{asset('assets/images/bd/loading.gif')}}" style="width: 300px;">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_list_07" role="tabpanel">
                        <form class="account-form-box" id="form-register">
                            <h6 class="mb-6">Register an account</h6>
                            <b id="form-register-error" class="text-red"></b>
                            <div class="single-input">
                                <input name="name" type="text" placeholder="Name" required>
                            </div>
                            <div class="single-input">
                                <input name="email" type="text" placeholder="Email Address" required>
                            </div>
                            <div class="single-input">
                                <input name="password" type="password" placeholder="Password" required>
                            </div>
                            <div class="single-input">
                                <input name="password_confirmation" type="password" placeholder="Confirm Password" required>
                            </div>
                            <p class="mt-15">
                                Your personal data will be used to support your experience throughout this website,
                                to manage access to your account, and for other purposes described in our
                                <a href="#" class="text-color-primary" target="_blank">privacy policy</a>.
                            </p>
                            <div class="button-box mt-25">
                                <a href="#" class="btn btn--full btn--black" id="form-register-btn">Log in</a>
                            </div>
                        </form>
                        <div class="form-register-loading" style="text-align:center;display:none">
                            <img src="{{asset('assets/images/bd/loading.gif')}}" style="width: 300px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>
