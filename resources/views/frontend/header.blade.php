<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Mobhil Car Dealer HTML Template" />
    <meta property="og:title" content="Mobhil Car Dealer HTML Template" />
    <meta property="og:description" content="Mobhil Car Dealer HTML Template" />
    <meta property="og:image" content="https://mobhil.dexignlab.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>ตลาดเทศบาล 2 นครเชียงราย</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('public/frontend/vendor/lightgallery/css/lightgallery.min.css') }}">
    <link href="{{ asset('public/frontend/vendor/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/frontend/vendor/splitting/dist/splitting.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/vendor/aos/aos.css') }}" rel="stylesheet">

    <!-- Revolution Slider Css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/vendor/revolution/v5.4.3/css/settings.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/vendor/revolution/v5.4.3/css/layers.css') }}">
    <!-- Revolution Navigation Style -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/vendor/revolution/v5.4.3/css/navigation.css') }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('public/frontend/vendor/rangeslider/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}">
    <link rel="stylesheet" class="skin" href="{{ asset('public/frontend/css/skin/skin-1.css') }}">

    @yield('style')
</head>

<body id="bg">
    <div id="loading-area" class="loading-page-3"></div>
    <div class="page-wraper">

        <header class="site-header mo-left header style-1">
            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar clearfix ">
                    <div class="container clearfix">
                        <!-- Website Logo -->
                        <div class="logo-header mostion logo-dark">
                            <a href="index.html">
                                <img src="{{ asset('public/frontend/images/logo.jpg') }}" alt="" width="140"
                                    height="70">
                            </a>
                        </div>
                        <!-- Nav Toggle Button -->
                        <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <!-- Extra Nav -->
                        <div class="extra-nav">
                            <div class="extra-cell">
                                <a href="tel:080-583-8888" class="btn btn-primary light phone-no shadow-none effect-1">
                                    <span><i class="fas fa-phone-volume shake"></i>080-583-8888</span>
                                </a>
                            </div>
                        </div>
                        <!-- Extra Nav -->
                        <div class="header-nav navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
                            <div class="logo-header">
                                <a href="index.html"><img src="{{ asset('public/frontend/images/logo.jpg') }}"
                                        alt="" width="95" height="95"></a>
                            </div>
                            <ul class="nav navbar-nav navbar">
                                <li class="{{ Request:: routeIs('home') ? 'active' : '' }}" ><a href="{{ route('home') }}">หน้าแรก</a></li>
                                <li class="{{ Request:: routeIs('about') ? 'active' : '' }}"><a href="{{ route('about') }}">เกี่ยวกับ</a></li>
                                <li class="{{ Request:: routeIs('store') || Request:: routeIs('store.detail') ? 'active' : '' }}"><a href="{{ route('store') }}">ร้านค้า</a></li>
                                <li class="{{ Request:: routeIs('new') || Request:: routeIs('new.detail') ? 'active' : '' }}"><a href="{{ route('new') }}">ข่าวสารและกิจกรรม</a></li>
                            </ul>
                            <div class="dlab-social-icon">
                                <ul>
                                    <li><a class="fab fa-facebook-f" href="javascript:void(0);"></a></li>
                                    <li><a class="fab fa-twitter" href="javascript:void(0);"></a></li>
                                    <li><a class="fab fa-linkedin-in" href="javascript:void(0);"></a></li>
                                    <li><a class="fab fa-instagram" href="javascript:void(0);"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="site-footer style-1" id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row ">
                        <div class="col-lg-4 col-md-6 col-sm-12 ">
                            <div class="widget widget_about">
                                <div class="footer-logo">
                                    {{-- <img src="images/logo.png" alt=""> --}}
                                    <img src="{{ asset('public/frontend/images/logo.jpg') }}" alt=""
                                        width="115" height="115">
                                </div>
                                <h5 class="m-b20" style="font-size: 22px; font-weight: 600;">ตลาดเทศบาล 2 นครเชียงราย</h5>
                                <p style="font-size: 16px; font-weight: 400;">
                                มาเติมเต็มรสชาติชีวิต กิน เที่ยว สนุก 
                                <br>
                                กับตลาดตลาดเทศบาล 2 นครเชียงราย</p>
                                <ul class="social-list style-1">
                                    <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://www.youtube.com/"><i class="fab fa-line"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://twitter.com/"><i class="fab fa-tiktok"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="widget widget_categories p-l50">
                                <div class="widget-title">
                                    <h5 class="title" style="font-size: 22px; font-weight: 600;">ตลาดเทศบาล 2 นครเชียงราย</h5>
                                </div>
                                <ul>
                                    <li class="cat-item"><a href="about-us.html">หน้าแรก</a></li>
                                    <li class="cat-item"><a href="contact-us.html">เกี่ยวกับ</a></li>
                                    <li class="cat-item"><a href="car-listing.html">ร้านค้า</a></li>
                                    <li class="cat-item"><a href="car-listing.html">ข่าวสารและกิจกรรม</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="widget">
                                <div class="widget-title">
                                    <h5 class="title" style="font-size: 22px; font-weight: 600;">ติดต่อเรา</h5>
                                </div>
                                <div class="icon-bx-wraper style-2 m-b20">
                                    <div class="icon-bx-sm radius">
                                        <span class="icon-cell">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                                        </span>
                                    </div>
                                    <div class="icon-content">
                                        <p>ถนนประสพสุข ต.เวียง อ.เมืองเชียงราย จ.เชียงราย 57000</p>
                                    </div>
                                </div>
                                <div class="icon-bx-wraper style-2">
                                    <div class="icon-bx-sm radius">
                                        <span class="icon-cell">
                                            <svg width="22" height="24" viewBox="0 0 22 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21.3722 16.9589L16.5597 14.7089C16.3541 14.6134 16.1257 14.5932 15.9087 14.6515C15.6917 14.7099 15.4979 14.8435 15.3566 15.0324L13.2254 17.873C9.88055 16.1526 7.18876 13.2161 5.61172 9.56722L8.21562 7.24222C8.38908 7.08832 8.51185 6.87696 8.56535 6.64014C8.61884 6.40331 8.60015 6.15392 8.51211 5.92972L6.44961 0.67973C6.35298 0.438047 6.18207 0.240721 5.96636 0.121777C5.75065 0.00283366 5.50366 -0.0302721 5.26797 0.0281687L0.799219 1.15317C0.571987 1.21041 0.36925 1.34999 0.224097 1.54911C0.0789444 1.74824 -5.2345e-05 1.99516 2.60228e-08 2.24957C2.60228e-08 14.273 8.9332 23.9995 19.9375 23.9995C20.1708 23.9997 20.3972 23.9136 20.5799 23.7552C20.7625 23.5969 20.8905 23.3756 20.943 23.1277L21.9742 18.2527C22.0274 17.9943 21.9965 17.7238 21.8866 17.4877C21.7767 17.2515 21.5948 17.0646 21.3722 16.9589Z"
                                                    fill="white"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="icon-content">
                                        <p>053-711-333</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center fb-inner spno">
                        <div class="col-12 text-center">
                            <span class="copyright-text">Copyright © 2021 <a href="https://dexignlab.com/"
                                    class="text-primary" target="_blank">ตลาดเทศบาล 2 นครเชียงราย</a> All rights
                                reserved.</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <button class="scroltop icon-up" type="button"><i class="fas fa-arrow-up"></i></button>
    </div>

    <!-- JAVASCRIPT FILES ========================================= -->
        <script src="{{ asset('public/frontend/js/jquery.min.js') }}"></script><!-- JQUERY.MIN JS -->
        <script src="{{ asset('public/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
        <script src="{{ asset('public/frontend/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
        <script src="{{ asset('public/frontend/vendor/rangeslider/rangeslider.js') }}"></script><!-- RANGESLIDER -->
        <script src="{{ asset('public/frontend/vendor/magnific-popup/magnific-popup.js') }}"></script><!-- MAGNIFIC POPUP JS -->
        <script src="{{ asset('public/frontend/vendor/lightgallery/js/lightgallery-all.min.js') }}"></script><!-- LIGHTGALLERY -->
        <script src="{{ asset('public/frontend/vendor/splitting/dist/splitting.min.js') }}"></script><!-- Splitting -->
        <script src="{{ asset('public/frontend/vendor/counter/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
        <script src="{{ asset('public/frontend/vendor/counter/counterup.min.js') }}"></script><!-- COUNTERUP JS -->
        <script src="{{ asset('public/frontend/vendor/swiper/swiper-bundle.min.js') }}"></script><!-- OWL-CAROUSEL -->
        <script src="{{ asset('public/frontend/vendor/aos/aos.js') }}"></script><!-- AOS -->
    <!-- revolution JS FILES -->
        <script src="{{ asset('public/frontend/vendor/revolution/v5.4.3/js/jquery.themepunch.tools.min.js') }}"></script>
        <script src="{{ asset('public/frontend/vendor/revolution/v5.4.3/js/jquery.themepunch.revolution.min.js') }}"></script>
    <!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
        <script
            src="{{ asset('public/frontend/vendor/revolution/v5.4.3/js/extensions/revolution.extension.actions.min.js') }}">
        </script>
        <script
            src="{{ asset('public/frontend/vendor/revolution/v5.4.3/js/extensions/revolution.extension.carousel.min.js') }}">
        </script>
        <script
            src="{{ asset('public/frontend/vendor/revolution/v5.4.3/js/extensions/revolution.extension.kenburn.min.js') }}">
        </script>
        <script
            src="{{ asset('public/frontend/vendor/revolution/v5.4.3/js/extensions/revolution.extension.layeranimation.min.js') }}">
        </script>
        <script
            src="{{ asset('public/frontend/vendor/revolution/v5.4.3/js/extensions/revolution.extension.migration.min.js') }}">
        </script>
        <script
            src="{{ asset('public/frontend/vendor/revolution/v5.4.3/js/extensions/revolution.extension.parallax.min.js') }}">
        </script>
        <script src="{{ asset('public/frontend/vendor/revolution/v5.4.3/js/extensions/revolution.extension.video.min.js') }}">
        </script>
        <script
            src="{{ asset('public/frontend/vendor/revolution/v5.4.3/js/extensions/revolution.extension.slideanims.min.js') }}">
        </script>
        <script src="{{ asset('public/frontend/js/rev.slider.js') }}"></script>
    {{--  --}}

    <script src="{{ asset('public/frontend/js/dlab.carousel.js') }}"></script><!-- OWL-CAROUSEL -->
    <script src="{{ asset('public/frontend/js/dlab.ajax.js') }}"></script><!-- AJAX -->
    <script src="{{ asset('public/frontend/js/custom.js') }}"></script><!-- CUSTOM JS -->
    <script>
        jQuery(document).ready(function() {
            'use strict';
            dz_rev_slider_4();
        }); /*ready*/
    </script>
    @yield('script')
</body>

</html>
