<!-- start: Hamburger Menu -->
<div class="hamburger-area">
    <div class="hamburger_bg"></div>
    <div class="hamburger_wrapper">
        <div class="hamburger_top d-flex align-items-center justify-content-between">
            <div class="hamburger_logo">
                <a href="{{ route('home') }}">
                    <img src="{{ config('app.logo') }}" alt="LOGO">
                </a>
            </div>
            <div class="hamburger_close">
                <button class="hamburger_close_btn">
                    <i class="fa-thin fa-times"></i>
                </button>
            </div>
        </div>

        <div class="hamburger_search">
            <form action="#">
                <button type="submit"><i class="fal fa-search"></i></button>
                <label>
                    <input type="text" placeholder="Search here">
                </label>
            </form>
        </div>

        <div class="hamburger_menu d-none">
            <div class="mobile_menu"></div>
        </div>

        <div class="hamburger_bottom">

            <div class="contact_info">
                <ul class="info_list">
                    <li class="info_item">
                        <div class="item_inner  d-flex align-items-center gap-2">
                            <div class="icon">
                                <a href="{{ route('home') }}">
                                    <i class="fal fa-home"></i>
                                </a>
                            </div>
                            <div class="text">
                                <a href="{{ route('home') }}">
                                    Home
                                </a>
                            </div>
                        </div>
                    </li>

                    <li class="info_item">
                        <div class="item_inner  d-flex align-items-center gap-2">
                            <div class="icon">
                                <a href="{{ route('about') }}">
                                    <i class="fal fa-info-circle"></i>
                                </a>
                            </div>
                            <div class="text">
                                <a href="{{ route('about') }}">
                                    About
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="info_item">
                        <div class="item_inner  d-flex align-items-center gap-2">
                            <div class="icon">
                                <a href="{{ route('login') }}">
                                    <i class="fal fa-sign-in-alt"></i>
                                </a>
                            </div>
                            <div class="text">
                                <a href="{{ route('login') }}">
                                    Login
                                </a>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>

            <div class="contact_info">
                <h4 class="title">Contact Info</h4>
                <ul class="info_list">
                    <li class="info_item">
                        <div class="item_inner  d-flex align-items-center gap-2">
                            <div class="icon">
                                <a target="_blank"
                                   href="https://www.google.com/maps/place/Melbourne,+FL/@28.1176073,-80.7399564,12z/data=!3m1!4b1!4m6!3m5!1s0x88de0e2c4771994d:0x8bcdb254a90cd2a8!8m2!3d28.0836269!4d-80.6081089!16zL20vMHJocDY?entry=ttu">
                                    <i class="fal fa-map-marker-alt"></i>
                                </a>
                            </div>
                            <div class="text">
                                <a target="_blank"
                                   href="https://www.google.com/maps/place/Melbourne,+FL/@28.1176073,-80.7399564,12z/data=!3m1!4b1!4m6!3m5!1s0x88de0e2c4771994d:0x8bcdb254a90cd2a8!8m2!3d28.0836269!4d-80.6081089!16zL20vMHJocDY?entry=ttu">
                                    Melbourne, Florida
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="info_item">
                        <div class="item_inner d-flex align-items-center gap-2">
                            <div class="icon">
                                <a target="_blank" href="tel:+13212155175">
                                    <i class="fal fa-phone"></i>
                                </a>
                            </div>
                            <div class="text">
                                <a target="_blank" href="tel:+13212155175">
                                    (321) 215-5175
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="info_item">
                        <div class="item_inner d-flex align-items-center gap-2">
                            <div class="icon">
                                <a target="_blank" href="mailto:weatheredroofing@gmail.com">
                                    <i class="fal fa-envelope"></i>
                                </a>
                            </div>
                            <div class="text">
                                <a target="_blank" href="mailto:weatheredroofing@gmail.com">
                                    <small>
                                        weatheredroofing@gmail.com
                                    </small>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="socials">
                <ul>
                    <li>
                        <a target="_blank" href="https://www.facebook.com/RoofingBrevard">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.linkedin.com/">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.instagram.com/">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://twitter.com/">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
<!-- end: Hamburger Menu -->
