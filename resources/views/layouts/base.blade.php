<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.jpg')}}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/flexslider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/chosen.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/color-01.css')}}">
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/semantic.min.css')}}">--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/12.0.0/nouislider.min.css" integrity="sha512-kSH0IqtUh1LRE0tlO8dWN7rbmdy5cqApopY6ABJ4U99HeKulW6iKG5KgrVfofEXQOYtdQGFjj2N/DUBnj3CNmQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @livewireStyles
</head>
<body class="home-page home-01 ">

<!-- mobile menu -->
<div class="mercado-clone-wrap">
    <div class="mercado-panels-actions-wrap">
        <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
    </div>
    <div class="mercado-panels"></div>
</div>

<!--header-->
<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                <div class="container">
                    <div class="topbar-menu left-menu">

                    </div>
                    <div class="topbar-menu right-menu">
                        <ul>


                            @if(\Illuminate\Support\Facades\Route::has("login"))
                                @auth
                                    @if(\Illuminate\Support\Facades\Auth::user()->utype === "ADM")
                                        {{--                                    Admin link--}}
                                        <li class="menu-item menu-item-has-children parent" >
                                            <a title="My Account" href="#">My Account ({{\Illuminate\Support\Facades\Auth::user()->name}})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <ul class="submenu account" >
                                                <li class="menu-item" >
                                                    <a title="Dashboard" href="{{ route('admin.profile') }}">Profile</a>
                                                </li>
                                                <li class="menu-item" >
                                                    <a href="{{ route('admin.categories') }}">Categories</a>
                                                </li>
                                                <li class="menu-item">
                                                    <a title="Product" href="{{route('admin.products')}}">products</a>
                                                </li>

                                                <li class="menu-item">
                                                    <a title="Sale" href="{{route('admin.orders')}}">Manage Orders</a>
                                                </li>


                                                <li class="menu-item">
                                                    <a title="Home Slider" href="{{route('admin.homeSlider')}}">Manage Home Slider</a>
                                                </li>

                                                <li class="menu-item">
                                                    <a title="Home Slider" href="{{route('admin.headers')}}">Manage Headers</a>
                                                </li>

                                                <li class="menu-item">
                                                    <a title="Home Categories" href="{{route('admin.homeCategories')}}">Manage Home Categories</a>
                                                </li>

                                                <li class="menu-item">
                                                    <a title="contact" href="{{route('admin.contact')}}">View Contacts</a>
                                                </li>

                                                <li class="menu-item">
                                                    <a title="users" href="{{route('admin.users')}}">Manage Users</a>
                                                </li>


                                                <li class="menu-item">
                                                    <a title="about" href="{{route('admin.about')}}">Edit about us page</a>
                                                </li>
                                                <li class="menu-item">
                                                    <a title="about" href="{{route('admin.team')}}">view team</a>
                                                </li>


                                                <li class="menu-item">
                                                    <a title="Sale" href="{{route('admin.sale')}}">Sale Settings</a>
                                                </li>

                                                <li class="menu-item">
                                                    <a title="Password" href="{{route('admin.changePassword')}}">Change Password</a>
                                                </li>



{{--                                                <li class="menu-item">--}}
{{--                                                    <a title="Coupons" href="{{route('admin.coupon')}}">All Coupons</a>--}}
{{--                                                </li>--}}

                                                <li class="menu-item" >
                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                </li>

                                                <form id="logout-form" method="POST" action="{{route('logout')}}">
                                                    @csrf

                                                </form>
                                            </ul>
                                        </li>
                                    @else
                                        {{--                                    User link--}}
                                        <li class="menu-item menu-item-has-children parent" >
                                            <a title="My Account" href="#">My Account ({{\Illuminate\Support\Facades\Auth::user()->name}})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <ul class="submenu account" >
                                                <li class="menu-item" >
                                                    <a title="Dashboard" href="{{ route('user.profile') }}">Profile</a>
                                                </li>

                                                <li class="menu-item" >
                                                    <a title="Orders" href="{{ route('user.orders') }}">Manage Orders</a>
                                                </li>

                                                <li class="menu-item" >
                                                    <a title="changePassword" href="{{ route('user.changePassword') }}">Change Password</a>
                                                </li>


                                                <li class="menu-item" >
                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                </li>
                                                <form id="logout-form" method="POST" action="{{route('logout')}}">
                                                    @csrf

                                                </form>
                                            </ul>
                                    @endif
                                @else
                                    <li class="menu-item" ><a title="Register or Login" href="{{route('login')}}">Login</a></li>
                                    <li class="menu-item" ><a title="Register or Login" href="{{route('register')}}">Register</a></li>
                                @endif
                            @endif
                        </ul>


                    </div>
                </div>
            </div>

            <style>
                .fill-heart {
                    color: #ff2b60 !important;
                }
                .fill-Basket{
                    color:#ff6524 !important;
                }
            </style>



            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        <a href="/" class="link-to-home"><img src="{{asset('assets/images/logo.png')}}" style="width: 250px;height: 80px" alt="mercado"></a>
                    </div>

                    @livewire('header-search-component')

                    <div class="wrap-icon right-section">

                        @livewire('wish-list-count-component')

                        @livewire('cart-count-component')

                        <div class="wrap-icon-section show-up-after-1024">
                            <a href="#" class="mobile-navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>



            <div class="nav-section header-sticky">


                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                            <li class="menu-item home-icon">
                                <a href="/" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                            <li class="menu-item">
                                <a href="/about-us" class="link-term mercado-item-title">About Us</a>
                            </li>
                            <li class="menu-item">
                                <a href="/shop" class="link-term mercado-item-title">Shop</a>
                            </li>
                            <li class="menu-item">
                                <a href="/cart" class="link-term mercado-item-title">Cart</a>
                            </li>
                            <li class="menu-item">
                                <a href="/checkout" class="link-term mercado-item-title">Checkout</a>
                            </li>
                            <li class="menu-item">
                                <a href="/contact-us" class="link-term mercado-item-title">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{$slot}}

<footer  id="footer">
    <div class=" wrap-footer-content footer-style-1" style="
    position: relative;
            padding: 0px 0px 0px 0px;
            bottom: 30px;
            width: 100%;
            height: 40px;
            ">

        <div class="wrap-function-info">
            <div class="container">

            </div>
        </div>
        <!--End function info-->

        <div class="main-footer-content">



        </div>

        <div class="coppy-right-box">
            <div class="container">

                <div class="coppy-right-item item-right">
                    <div class="wrap-nav horizontal-nav">
                        <ul>
                            <li class="menu-item"><a href="/about-us" class="link-term">About us</a></li>
                            <li class="menu-item"><a href="/contact-us" class="link-term">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
<script src="{{asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.flexslider.js') }}"></script>
{{--<script src="{{asset('assets/js/chosen.jquery.min.js') }}"></script>--}}
<script src="{{asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.sticky.js') }}"></script>
<script src="{{asset('assets/js/functions.js') }}"></script>
{{--<script src="{{asset('js/semantic.min.js') }}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/12.0.0/nouislider.min.js" integrity="sha512-6vo59lZMHB6GgEySnojEnfhnugP7LR4qm6akxptNOw/KW+i9o9MK4Gaia8f/eJATjAzCkgN3CWlIHWbVi2twpg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
@livewireScripts
@stack('scripts')
{{--@stack('js')--}}

</body>
</html>
