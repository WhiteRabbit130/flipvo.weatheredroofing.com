<!-- main header -->
<div class="main__header py-2">
    <div class="container">
        <div class="row  align-items-center">
            <div class="col-lg-3 col-md-4 col-5">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ config('app.logo') }}" alt="logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-7 text-end">
                <div class="d-flex align-items-center justify-content-end">
                    <nav class="main-menu" id="mobile-menu">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <ul class=" d-none d-lg-block">
                                <li class="">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>

                                <li class="">
                                    <a href="{{ route('about') }}">About</a>
                                </li>

                                <li class="">
                                    <a href="{{ route('services') }}">Services</a>
                                </li>

                                <li class="">
                                    <a href="{{ route('gallery') }}">Gallery</a>
                                </li>

                                <li class="">
                                    <a href="{{ route('contact') }}">Contact</a>
                                </li>

                                {{--If not authed--}}
                                @guest
                                    <li class="">
                                        <a href="{{ route('login') }}">
                                            Login
                                            {{--<i class="fas fa-sign-in"></i>--}}
                                        </a>
                                    </li>
                                    <li class="d-none">
                                        <a href="{{ route('register') }}">Register</a>
                                    </li>
                                @endguest

                                {{--If authed--}}
                                @auth
                                    <li class="">
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                            <i class="fas fa-sign-out-alt"></i>
                                            {{ __('Log Out') }}
                                        </a>
                                    </li>

                                    <li class="d-none">
                                        <a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                @endauth

                            </ul>
                        </form>
                    </nav>

                    <div
                        class="header-contact d-lg-none d-flex flex-row gap-4 justify-content-end align-items-center">
                        <a class="tj-btn-primary style-1 d-none  d-sm-block"
                           href="{{ route('home') }}">
                            Discover More
                        </a>

                        <div class="header-contact__icon">
                            <a target="_blank" href="tel:+13212155175">
                                <i class="fa fa-phone"></i>
                            </a>
                        </div>

                        <div id="hamburger">
                            <i class="fa fa-bars-sort"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
