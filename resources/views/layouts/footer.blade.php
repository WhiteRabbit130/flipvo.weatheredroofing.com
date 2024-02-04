
@push('js')
    <script>
        console.log('footer.js')
    </script>
@endpush


<!-- footer section start -->
<footer class="footer-1 overflow-hidden">
    <div class="footer__top">
        <div class="container">
            <div class="footer__top-border">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="tj_subscrib mb-4 mb-lg-0">
                            <h2 class="subscribe__footer__title text-white">Subscribe To Our Newsletter</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="#">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Email Address">
                                <div class="input-group-prepend">
                                    <button type="submit" class="input-group-text tj-btn-primary style-3">Subscribe
                                        <i class="fa-light  fa-arrow-right-long"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__middle footer1_padding">
        <div class="container">
            <div class="row">
                <div class=" col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <div class="footer_info">
                            <a href="{{ route('home') }}" class="footer__logo_1">
                                <img src="{{ config('app.logo') }}" alt="logo">
                            </a>
                            <p>We are here to serve all your roofing needs from A to Z!</p>
                        </div>
                        <div class="footer__time">
                            <h3 class="time__title">Working Hours</h3>
                            <ul class="time_show">
                                <li>Monday: 10.00AM – 4.00PM</li>
                                <li>Tuesday: 10.00AM – 4.00PM</li>
                                <li>Friday: Close</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" col-xl-4 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget footer1_col_2">
                        <h3 class="widget__title">Latest Announcement</h3>
                        <div class="recent-post-list">

                            <div class="single-recent-post">
                                <div class="post__img">
                                    <div class="thumb">
                                        <img src="{{ asset('/assets/img/blog/blog-thumb-1.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="post-content ">
                                        <span class="date"><i class="fa-regular fa-calendar-days"></i>24th May
                                            2023</span>
                                    <h6 class="content"><a href="blog-details.html">This Place Really Place For
                                            Awesome</a></h6>
                                </div>
                            </div>

                            <div class="single-recent-post">
                                <div class="post__img">
                                    <div class="thumb">
                                        <img src="{{ asset('/assets/img/blog/blog-thumb-2.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="post-content">
                                        <span class="date"><i class="fa-regular fa-calendar-days"></i>24th May
                                            2023</span>
                                    <h6 class="content"><a href="blog-details.html">This Place Really Place For
                                            Awesome</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-xl-2 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h3 class="widget__title">Our Services</h3>
                        <ul class="footer-widget__explore-list">
                            <li><a href="service-details.html">Roof Renovation </a></li>
                            <li><a href="service-details.html">Roofing Layers</a></li>
                            <li><a href="service-details.html">Roof Installation</a></li>
                            <li><a href="service-details.html">Corner Fixing</a></li>
                            <li><a href="service-details.html">Damage Roof</a></li>
                            <li><a href="service-details.html">Roof Animation</a></li>
                        </ul>
                    </div>
                </div>
                <div class=" col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget footer_one_col_1">
                        <h3 class="widget__title">Photos</h3>
                        <div class="grid-content">
                            <a href="{{ asset('/assets/img/instagram/insta-big-1.jpg') }}" data-fancybox="gallery"
                               class="popup-gallery bg-cover" data-bg-image="{{ asset('/assets/img/instagram/insta-1.jpg') }}"></a>
                            <a href="{{ asset('/assets/img/instagram/insta-big-2.jpg') }}" data-fancybox="gallery"
                               class="popup-gallery bg-cover" data-bg-image="{{ asset('/assets/img/instagram/insta-2.jpg') }}"></a>
                            <a href="{{ asset('/assets/img/instagram/insta-big-3.jpg') }}" data-fancybox="gallery"
                               class="popup-gallery bg-cover" data-bg-image="{{ asset('/assets/img/instagram/insta-3.jpg') }}"></a>
                            <a href="{{ asset('/assets/img/instagram/insta-big-4.jpg') }}" data-fancybox="gallery"
                               class="popup-gallery bg-cover" data-bg-image="{{ asset('/assets/img/instagram/insta-4.jpg') }}"></a>
                            <a href="{{ asset('/assets/img/instagram/insta-big-5.jpg') }}" data-fancybox="gallery"
                               class="popup-gallery bg-cover" data-bg-image="{{ asset('/assets/img/instagram/insta-5.jpg') }}"></a>
                            <a href="{{ asset('/assets/img/instagram/insta-big-6.jpg') }}" data-fancybox="gallery"
                               class="popup-gallery bg-cover" data-bg-image="{{ asset('/assets/img/instagram/insta-6.jpg') }}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-home-left">
            <img src="{{ asset('/assets/img/footer/footer-1.png') }}" alt="">
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__copy_write">
                <div class="d-block">
                    <p class="copy__right">
                        <small>
                            WeatheredRoofing.com
                        </small>
                        <br>
                        <small>
                            Copyright © 2024
                        </small>
                        <br>
                        <small>All Rights Reserved.</small>
                    </p>
                </div>
                <div>
                    <div class="link">
                        <a href="{{ route('home') }}">Privacy Policy</a>
                        <a href="{{ route('home') }}">Terms & Conditions</a>
                    </div>
                </div>
                <div>
                    <small>
                        <a href="https://flipvo.com" target="_blank">Built by Flipvo, LLC</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-shape">
        <img src="{{ asset('/assets/img/svg/footer-2.svg') }}" alt="">
    </div>
    <div class="footer-right-shape">
        <img src="{{ asset('/assets/img/svg/site-footer-shape.svg') }}" alt="">
    </div>
</footer>
<!-- footer section end -->
