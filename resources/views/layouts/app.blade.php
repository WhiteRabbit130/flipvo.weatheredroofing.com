<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="/assets/img/logos/favicon.png">

    <!-- ===========  All Stylesheet ================= -->
    <!--  Bootstrap css plugins -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

    <!--  animate css plugins -->
    <link rel="stylesheet" href="/assets/css/animate.css">
    <!--  Icon css plugins -->
    <link rel="stylesheet" href="/assets/css/icons.css">
    <!-- mean menu css file -->
    <link rel="stylesheet" href="/assets/css/meanmenu.css">
    <!--  fancybox-popup css plugins -->
    <link rel="stylesheet" href="/assets/css/fancybox.min.css">
    <!-- mean menu css file -->
    <link rel="stylesheet" href="/assets/css/meanmenu.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <!-- swipe css file -->
    <link rel="stylesheet" href="/assets/css/swiper-bundle.css">
    <!-- Carousel css file -->
    <link rel="stylesheet" href="/assets/css/owl.carousel.css">
    <!--  main style css file -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <!-- responsive style css file -->
    <link rel="stylesheet" href="/assets/css/responsive.css">

    @push('css')
        <style>
            html, body {
                /*font-family: 'figtree', sans-serif;*/
            }

            .hamburger_menu .text > a {
                color: #fff !important;
            }
        </style>
    @endpush
    @stack('css')
</head>

<body class="font-sans antialiased bg-gray-100">
<div class="body-overlay"></div>

<!-- preloader -->
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_four"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_one"></div>
        </div>
        <button class="closeLoader tj-btn-primary"><span>Cancel Preloader</span></button>
    </div>
</div>
<!-- end: Preloader -->

@include('layouts.hamburger-menu')

<!-- header section start -->
<header class="header-1 is-sticky">
    <!-- header top -->
    <div class="header__top d-none d-md-block">
        <div class="container">
            <div class="header__top_widget">
                <div class="top-left">
                    <p>Your Trusted Roofing Company in Melbourne, Florida</p>
                </div>
                <div class="top-right">
                    <a target="_blank" href="https://www.facebook.com/RoofingBrevard"><i
                            class="fa-brands fa-facebook-f"></i></a>
                    <a target="_blank" href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a target="_blank" href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a target="_blank" href="#"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.navigation')

    <!-- Header bottom -->
    <div class="header-contact-widget d-none d-xl-block">
        <div class="container">
            <div class="header-contact">
                <div class="info_item">
                    <a href="https://www.google.com/maps/place/Melbourne,+FL/@28.1176073,-80.7399564,12z/data=!3m1!4b1!4m6!3m5!1s0x88de0e2c4771994d:0x8bcdb254a90cd2a8!8m2!3d28.0836269!4d-80.6081089!16zL20vMHJocDY?entry=ttu"
                       target="_blank">
                        <i class="flaticon-placeholder"></i>
                        <h6>Location:</h6>
                        <p>Melbourne, Florida</p>
                    </a>
                </div>
                <div class="info_item">
                    <a href="mailto:weatheredroofing@gmail.com">
                        <i class="flaticon-envelope"></i>
                        <h6>Email us:</h6>
                        <p>weatheredroofing@gmail.com</p>
                    </a>
                </div>
                <div class="info_item">
                    <a href="tel:+13212155175">
                        <i class="flaticon-telephone"></i>
                        <h6>Call us:</h6>
                        <p>(321) 215-5175</p>
                    </a>
                </div>
                {{--                <a class="tj-btn-primary" href="tel:+13212155175">WE FINANCE</a>--}}
            </div>
        </div>
    </div>
</header>
<!-- header section end -->

{{--Main--}}
<main class="">
    {{ $slot }}
</main>


@include('layouts.footer')

<!--  ALl JS Plugins ============================= -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/counterup.js"></script>
<script src="assets/js/meanmenu.js"></script>
<script src="assets/js/scrollUp.min.js"></script>
<script src="assets/js/swiper-bundle.js"></script>
<script src="assets/js/owl.carousel.js"></script>
<script src="assets/js/imagesloaded-pkgd.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/magnific-popup.min.js"></script>
<script src="assets/js/jquery.fancybox.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/validate.min.js"></script>
<script src="assets/js/active.js"></script>

@stack('js')
</body>
</html>
