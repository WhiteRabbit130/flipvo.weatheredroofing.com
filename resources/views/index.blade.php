
@push('css')
    @vite('resources/css/home.css')
    <style>
        html, body {
            /*background: green !important;*/
        }
    </style>
@endpush

@push('js')
    <script>
    </script>
@endpush

<x-app-layout>

    <!-- Hero Section Start -->
    <section class="hero-wrapper hero-1">
        <div class="hero_slider swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="single-hero-slider bg-cover" data-bg-image="{{asset('/assets/img/slider-00001.jpg') }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="hero-content text-start">
                                        <h3 class="hero_sub_title text-white">WeatheredRoofing.com</h3>
                                        <h1 class="hero-title text-white">
                                            High Quality Roofing Services in the Melbourne, FL Area </h1>
                                        <div class="client">
                                            <img src="{{ asset('/assets/img/visa.jpg') }}" alt="credit card logo">
                                            <img src="{{ asset('/assets/img/mastercard.jpg') }}" alt="credit card logo">
                                            <img src="{{ asset('/assets/img/amex.jpg') }}" alt="credit card logo">
                                            <img src="{{ asset('/assets/img/discover.jpg') }}" alt="credit card logo">
                                            <p>Major Credit Cards Accepted</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="line-left"></div>
                        <div class="line-right"></div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="single-hero-slider bg-cover" data-bg-image="{{ asset('/assets/img/slider-00002.jpg') }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="hero-content text-start">
                                        <h3 class="hero_sub_title text-white">
                                            WeatheredRoofing.com Roof Services</h3>
                                        <h1 class="hero-title text-white">
                                            Roof Inspections for Shingle, Flat Roofs, or Metal Roofs</h1>
                                        <div class="client">
                                            <img src="{{ asset('/assets/img/visa.jpg') }}" alt="credit card logo">
                                            <img src="{{ asset('/assets/img/mastercard.jpg') }}" alt="credit card logo">
                                            <img src="{{ asset('/assets/img/amex.jpg') }}" alt="credit card logo">
                                            <img src="{{ asset('/assets/img/discover.jpg') }}" alt="credit card logo">
                                            <p>Major Credit Cards Accepted</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="line-left"></div>
                        <div class="line-right"></div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="single-hero-slider bg-cover" data-bg-image="{{ asset('assets/img/slider-00003.jpg') }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="hero-content text-start">
                                        <h3 class="hero_sub_title text-white">
                                            WeatheredRoofing.com Roof Services</h3>
                                        <h1 class="hero-title text-white">
                                            We Offer Financing Solutions and Take Most Insurances</h1>
                                        <div class="client">
                                            <img src="{{ asset('/assets/img/visa.jpg') }}" alt="credit card logo">
                                            <img src="{{ asset('/assets/img/mastercard.jpg') }}" alt="credit card logo">
                                            <img src="{{ asset('/assets/img/amex.jpg') }}" alt="credit card logo">
                                            <img src="{{ asset('/assets/img/discover.jpg') }}" alt="credit card logo">
                                            <p>Major Credit Cards Accepted</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="line-left"></div>
                        <div class="line-right"></div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="swiper-container hero_slider_thumb">
            <div class="swiper-wrapper swiper__inner">
                <div class="swiper-slide">
                    <img src="{{ asset('/assets/img/slider-tab-00001.jpg') }}" alt="small slider thumbnail roofing">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('/assets/img/slider-tab-00002.jpg') }}" alt="small slider thumbnail roofing">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('/assets/img/slider-tab-00003.jpg') }}" alt="small slider thumbnail roofing">
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->


    <!-- Feature section Start -->
    <section class="feature-wrapper feature-1">
        <div class="container">
            <div class="row ">
                <div class=" col-lg-4 col-md-6 col-sm-12">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".3s">
                        <div class="feture-icons">
                            <div class="icons">
                                <i class="flaticon-roof-4"></i>
                                <h4 class="tj-feature-title">Residential</h4>
                            </div>
                        </div>
                        <div class="content">
                            <p>Expert residential roofing services in Houston, Texas - We've got you covered!</p>
                            <a href="services.php" class="btn">Read More</a>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-4 col-md-6 col-sm-12">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                        <div class="feture-icons">
                            <div class="icons">
                                <i class="flaticon-building-1"></i>
                                <h4 class="tj-feature-title">Commercial</h4>
                            </div>
                        </div>
                        <div class="content">
                            <p>Quality commercial roofing in Houston - Protecting your business's roof.</p>
                            <a href="services.php" class="btn">Read More</a>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-4 col-md-6 col-sm-12">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".5s">
                        <div class="feture-icons">
                            <div class="icons">
                                <i class="flaticon-apartment"></i>
                                <h4 class="tj-feature-title">Extras</h4>
                            </div>
                        </div>
                        <div class="content">
                            <p>Beyond roofing: Gutters, Remodeling, Painting, and Commercial Fencing services.</p>
                            <a href="services.php" class="btn">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature section End -->

    <!-- About section start -->
    <section class="about-wrapper about-1 section-padding overflow-hidden">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-left overflow-hidden">
                        <div class="bg-img">
                            <img src="{{ asset('/assets/img/home-01.jpg') }}" alt="house">
                        </div>
                        <div class="funfact-home wow fadeInLeft " data-wow-delay="500ms">
                            <div class="icons">
                                <i class="flaticon-roof-5"></i>
                            </div>
                            <div class="funfact">
                                <h2 class="funfact_count"><span class="counter">1377</span>+</h2>
                                <h5 class="fun_dec">Residential Projects <br> Completed</h5>
                            </div>
                        </div>
                        <div class="shape-element">
                            <img src="{{ asset('/assets/img/svg/about-one-line.svg') }}" alt="about">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about_right_widget">
                        <div class="about-right">
                            <div class="about__content">
                                <div class="section__heading text-start wow fadeInUp " data-wow-delay="300ms">
                                    <h2 class="section_title">Profesional Roof Repair
                                        Services Since 2000</h2>
                                    <p>Providing expert roof repair services since 2000. Our skilled team uses quality
                                        materials for durable, reliable solutions, ensuring your peace of mind with
                                        every
                                        project we undertake.</p>
                                </div>
                                <div class="about__feature">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="single-element wow fadeInUp " data-wow-delay="500ms">
                                                <div class="icons">
                                                    <i class="flaticon-roof-2"></i>
                                                </div>
                                                <div class="content">
                                                    <h5>Solutions for Residential Roofing</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="single-element wow fadeInUp " data-wow-delay="500ms">
                                                <div class="icons">
                                                    <i class="flaticon-building"></i>
                                                </div>
                                                <div class="content">
                                                    <h5>Solutions for Commercial Roofing</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="wow fadeInUp " data-wow-delay="300ms">‘’Our Mission is: Delivering superior
                                    roofing solutions with integrity and professionalism, ensuring customer satisfaction
                                    and
                                    safety in every home and business we serve.’’</p>
                            </div>
                            <div class="author-content wow fadeInUp " data-wow-delay="500ms">
                                <div class="autoe">
                                    <div class="autor-img">
                                        <img src="{{ asset('/assets/img/owner.jpg') }}" alt="owner image">
                                    </div>
                                    <div class="autor-name">
                                        <h6>Anibal L. Fuentes</h6>
                                        <span>Owner</span>
                                    </div>
                                </div>
                                <div class="signature">
                                    <img src="{{ asset('/assets/img/svg/sig.svg') }}" alt="owner signature">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="about-shape">
            <img src="{{ asset('/assets/img/svg/about-1.svg') }}" alt="owner signature">
        </div>
    </section>
    <!-- About section end -->

    <div class="div">
        <hr/>
    </div>

    <!-- Why Choose Us section start -->
    <section class="chose_us-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3">
                    <div class="section__heading text-center wow fadeInUp " data-wow-delay="300ms">
                        <h2 class="section_title">Why Choose Us</h2>
                        <div class="sec_dec">
                            <p>Select us for unparalleled roofing expertise, exceptional workmanship, and unwavering
                                commitment to customer satisfaction. We ensure durable, high-quality roofing solutions,
                                tailored to your specific needs.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-block d-lg-flex align-items-center gap-3">
                <div class="chose-us-left wow fadeInLeft " data-wow-delay="300ms">
                    <div class="chose_us-content">
                        <div class="icons">
                            <i class="flaticon-roof-3"></i>
                        </div>
                        <h3 class="chose_us_item_title">Expert Craftsmanship</h3>
                        <p>Superior workmanship ensuring robust, durable, and expertly fitted roofs for each project we
                            take
                            on.</p>
                    </div>
                    <div class="chose_us-content">
                        <div class="icons">

                            <i class="flaticon-roof-1"></i>
                        </div>
                        <h3 class="chose_us_item_title">Tailored Solutions</h3>
                        <p>We provide customized roofing options designed specifically for your unique roofing
                            requirements.</p>
                    </div>
                </div>
                <div class="chose-us-middle wow fadeInUp " data-wow-delay="300ms">
                    <div class="chose_us-img">
                        <img src="{{ asset('/assets/img/choose-us/home.png') }}" alt="">
                    </div>
                </div>
                <div class="chose-us-right wow fadeInRight " data-wow-delay="300ms">
                    <div class="chose_us-content">
                        <div class="icons">
                            <i class="flaticon-roof-2"></i>
                        </div>
                        <h3 class="chose_us_item_title">Customer Commitment</h3>
                        <p>Our company is committed to excellence, delivering satisfaction and quality in every roof
                            project. </p>
                    </div>
                    <div class="chose_us-content">
                        <div class="icons">
                            <i class="flaticon-roof-3"></i>
                        </div>
                        <h3 class="chose_us_item_title">Quality Materials</h3>
                        <p>Only top-quality, high-grade materials are used to ensure lasting roof integrity and
                            strength.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose Us section end -->

    <!-- Testimonial section Start -->
    <section class="testimonial-wrapper section-padding bg-cover" data-bg-image="{{ asset('/assets/img/svg/vactoe-2.svg">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3">
                    <div class="section__heading text-center wow fadeInUp " data-wow-delay="300ms">
                        <h2 class="section_title">What Our Clients Say</h2>
                        <div class="sec_dec">
                            <p>Our clients consistently praise our efficiency and craftsmanship. They value our
                                dedication
                                to delivering durable, high-quality roofing solutions.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-say-widget owl-carousel client_say wow fadeInUp " data-wow-delay="300ms">
                <div class="single-client">
                    <div class="client-say-content">
                        <div class="client-say">
                            <div class="client-img bg-cover" data-bg-image="{{ asset('/assets/img/testimonial/testi-1.jpg">
                                <div class="quite">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                            </div>

                        </div>
                        <div class="client-content">
                            <p>We recently hired Jireh Roof Services for our home roofing project. Their
                                professionalism,
                                attention to detail, and use of high-quality materials impressed us greatly. Our new
                                roof
                                looks fantastic and feels incredibly durable.</p>
                        </div>
                        <div class="client-name position-relative">
                            <div class="client-thumb">
                                <h3 class="author__name">Larry Straus</h3>
                                <p>Houston, Texas</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-client">
                    <div class="client-say-content">
                        <div class="client-say">
                            <div class="client-img bg-cover" data-bg-image="{{ asset('/assets/img/testimonial/testi-2.jpg">
                                <div class="quite">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                            </div>

                        </div>
                        <div class="client-content">
                            <p>After experiencing a severe leak, we turned to Jireh Roof Services. They were quick to
                                respond, thorough in their work, and the end result was outstanding. Truly a reliable
                                and
                                skilled team we'd recommend to anyone.</p>
                        </div>
                        <div class="client-name position-relative">
                            <div class="client-thumb">
                                <h3 class="author__name">Betty Francis</h3>
                                <p>Houston, Texas</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-client">
                    <div class="client-say-content">
                        <div class="client-say">
                            <div class="client-img bg-cover" data-bg-image="{{ asset('/assets/img/testimonial/testi-3.jpg') }}">
                                <div class="quite">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                            </div>

                        </div>
                        <div class="client-content">
                            <p>Jireh Roof Services exceeded our expectations. Their team was punctual, courteous, and
                                highly
                                skilled. The roofing job was completed flawlessly and on schedule, enhancing both the
                                appearance and value of our property.</p>
                        </div>
                        <div class="client-name position-relative">
                            <div class="client-thumb">
                                <h3 class="author__name">Amanda Floreani</h3>
                                <p>Katy, Texas</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-client">
                    <div class="client-say-content">
                        <div class="client-say">
                            <div class="client-img bg-cover" data-bg-image="{{ asset('/assets/img/testimonial/testi-4.jpg">
                                <div class="quite">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                            </div>

                        </div>
                        <div class="client-content">
                            <p>Jireh Roof Services exceeded our expectations. Their team was punctual, courteous, and
                                highly
                                skilled. The roofing job was completed flawlessly and on schedule, enhancing both the
                                appearance and value of our property.</p>
                        </div>
                        <div class="client-name position-relative">
                            <div class="client-thumb">
                                <h3 class="author__name">Julio Santos</h3>
                                <p>Navasota, Texas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial section End -->

</x-app-layout>
