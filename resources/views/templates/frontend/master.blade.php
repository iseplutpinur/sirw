<?php
// $page_attr = (object) [
//     'title' => isset($page_attr['title']) ? $page_attr['title'] : '',
//     'url' => isset($page_attr['url']) ? $page_attr['url'] : url(''),
//     'type' => isset($page_attr['type']) ? $page_attr['type'] : 'website',
//     'loader' => isset($page_attr['loader']) ? $page_attr['loader'] : true,
//     'description' => isset($page_attr['description']) ? $page_attr['description'] : 'Karmapack - Keluarga Mahasiswa dan Pelajar Cianjur Kidul',
//     'keywords' => isset($page_attr['keywords']) ? $page_attr['keywords'] : 'karmapack,orda,cianjur kidul',
//     'author' => isset($page_attr['author']) ? $page_attr['author'] : 'Isep Lutpi Nur',
//     'image' => isset($page_attr['image']) ? $page_attr['image'] : asset('assets/templates/admin/images/brand/logo-1.png'),
//     'navigation' => isset($page_attr['navigation']) ? $page_attr['navigation'] : false,
//     'breadcrumbs' => isset($page_attr['breadcrumbs']) ? (is_array($page_attr['breadcrumbs']) ? $page_attr['breadcrumbs'] : false) : false,
//     'periode_id' => isset($page_attr['periode_id']) ? $page_attr['periode_id'] : false,
// ];
// $page_attr_title = ($page_attr->title == '' ? '' : $page_attr->title . ' | ') . (env('APP_NAME') ?? '');
// $search_master_key = isset($_GET['search']) ? $_GET['search'] : '';

// $master_helper = new \App\Helpers\Frontend\Template\Master($page_attr->periode_id);
// $getSosmed_val = $master_helper->getSosmed();
// $menuBidang_val = $master_helper->menuBidang();
// $footerInstagram_val = $master_helper->footerInstagram();
?>

<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SIDAUNG</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/templates/frontend/img/favicon.png') }}">

    <!-- theme style switch -->
    <meta name="theme-style-mode" content="1">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/backtotop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/style.css') }}">
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->


    <!-- preloader start -->
    <div class="preloader">
        <div class="loader rubix-cube">
            <div class="layer layer-1"></div>
            <div class="layer layer-2"></div>
            <div class="layer layer-3 color-1"></div>
            <div class="layer layer-4"></div>
            <div class="layer layer-5"></div>
            <div class="layer layer-6"></div>
            <div class="layer layer-7"></div>
            <div class="layer layer-8"></div>
        </div>
    </div>
    <!-- preloader end -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

    <!-- header area start -->
    <header>
        <div class="tp-header-area">
            <div class="tp-header-area-inner inner-border" id="header-sticky">
                <div class="container">
                    <div class="mega-menu-wrapper">
                        <div class="row align-items-center">
                            <div class="col-xxl-3 col-xl-2 col-lg-2 col-md-6 col-6">
                                <div class="logo-dark">
                                    <a href="index.html">
                                        <img src="{{ asset('assets/templates/frontend/img/logo/logo.png') }}"
                                            alt="logo">
                                    </a>
                                </div>
                                <div class="logo-white">
                                    <a href="index.html">
                                        <img src="{{ asset('assets/templates/frontend/img/logo/logo-white.png') }}"
                                            alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-7 col-lg-7 d-none d-lg-block">
                                <div class="tpmenu">
                                    <nav id="mobile-menu">
                                        <ul>
                                            <li class="has-dropdown">
                                                <a href="index.html">Home</a>
                                                <ul class="submenu">
                                                    <li><a href="index.html">Home Designer</a></li>
                                                    <li><a href="index-2.html">Home Agency</a></li>
                                                    <li><a href="index-3.html">Home Freelancer</a></li>
                                                    <li><a href="index-4.html">Home Corporate</a></li>
                                                    <li><a href="index-5.html">Home Studio</a></li>
                                                    <li><a href="index-6.html">Home Creative</a></li>
                                                    <li><a href="index-7.html">Home Minimal</a></li>
                                                    <li><a href="index-8.html">Home Minimal Full</a></li>
                                                    <li><a href="index-9.html">Home Photographer</a></li>
                                                    <li><a href="index-10.html">Home Photographer 2</a></li>
                                                    <li><a href="index-11.html">Home Photographer 3</a></li>
                                                    <li><a href="index-12.html">Home Photographer 4</a></li>
                                                    <li><a href="index-13.html">Home Politician</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="about.html">About</a>
                                            </li>
                                            <li class="has-dropdown megamenu-full">
                                                <a href="#">Pages</a>
                                                <ul class="megamenu">
                                                    <li>
                                                        <a href="#" class="megamenu-title">Page Layout 1</a>

                                                        <ul>
                                                            <li><a href="about.html">About</a></li>
                                                            <li><a href="about-me.html">About Me</a></li>
                                                            <li><a href="contact.html">Contact</a></li>
                                                            <li><a href="faq.html">FAQ</a></li>
                                                            <li><a href="help-center.html">Help Center</a></li>
                                                            <li><a href="404.html">Error 404</a></li>
                                                            <li><a href="pricing-plan.html">Pricing Plan</a></li>
                                                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                                            <li><a href="coming-soon.html">Coming Soon</a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="megamenu-title">Page Layout 2</a>

                                                        <ul>
                                                            <li><a href="portfolio.html">Portfolio</a></li>
                                                            <li><a href="portfolio-2.html">Portfolio 2</a></li>
                                                            <li><a href="portfolio-3.html">Portfolio 3</a></li>
                                                            <li><a href="portfolio-4.html">Portfolio 4</a></li>
                                                            <li><a href="portfolio-5.html">Portfolio 5</a></li>
                                                            <li><a href="portfolio-6.html">Portfolio 6</a></li>
                                                            <li><a href="project-details.html">Portfolio Details</a>
                                                            </li>
                                                            <li><a href="job-list.html">Job List</a></li>
                                                            <li><a href="job-details.html">Job Details</a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="megamenu-title">Page Layout 3</a>
                                                        <ul>
                                                            <li><a href="services.html">Services</a></li>
                                                            <li><a href="services-2.html">Services 2</a></li>
                                                            <li><a href="services-3.html">Services 3</a></li>
                                                            <li><a href="services-4.html">Services 4</a></li>
                                                            <li><a href="services-details.html">Services Details</a>
                                                            </li>
                                                            <li><a href="team.html">Team</a></li>
                                                            <li><a href="team-2.html">Team 2</a></li>
                                                            <li><a href="about-me.html">Team Details</a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="megamenu-title">Page Layout 4</a>

                                                        <ul>
                                                            <li><a href="shop.html">Shop</a></li>
                                                            <li><a href="product-details.html">Product Details</a></li>
                                                            <li><a href="cart.html">Cart</a></li>
                                                            <li><a href="wishlist.html">Wishlist</a></li>
                                                            <li><a href="checkout.html">Checkout</a></li>
                                                            <li><a href="sign-in.html">Login</a></li>
                                                            <li><a href="sign-up.html">Register</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="has-dropdown">
                                                <a href="services.html">Services</a>
                                                <ul class="submenu">
                                                    <li><a href="services.html">Services Page</a></li>
                                                    <li><a href="services-details.html">Services Deatils</a></li>
                                                </ul>
                                            </li>
                                            <li class="has-dropdown">
                                                <a href="blog.html">Blog</a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">Blog Page</a></li>
                                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                                    <li><a href="blog-details.html">Blog Deatils</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="contact.html">Contact</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-6">
                                <div class="tp-header-action">
                                    <ul>
                                        <li class="d-none d-sm-inline-block">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" class="search"
                                                data-bs-target="#search-modal">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="info-toggle-btn sidebar-toggle-btn">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- dark mode button start -->
                                            <div class="mode-switch-wrapper my_switcher setting-option">
                                                <input type="checkbox" class="checkbox" id="chk">
                                                <label class="label" for="chk">
                                                    <i class="fas fa-sun tp-dark-icon setColor dark theme__switcher-btn"
                                                        data-theme="dark"></i>
                                                    <i class="fas fa-moon tp-light-icon setColor light theme__switcher-btn"
                                                        data-theme="light"></i>
                                                </label>
                                            </div>
                                            <!-- dark mode button end  -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->

    <!-- sidebar area start -->
    <div class="sidebar__area">
        <div class="sidebar__wrapper">
            <div class="sidebar__close">
                <button class="sidebar__close-btn" id="sidebar__close-btn">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="sidebar__content">
                <div class="sidebar__logo mb-40">
                    <a href="index.html">
                        <img src="{{ asset('assets/templates/frontend/img/logo/logo.png') }}" alt="logo">
                    </a>
                </div>
                <div class="sidebar__search mb-25">
                    <form action="#">
                        <input type="text" placeholder="What are you searching for?">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu fix"></div>
                <div class="sidebar__text d-none d-lg-block">
                    <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was
                        born
                        and will give you a complete account of the system and expound the actual teachings of the great
                        explore</p>
                </div>
                <div class="sidebar__img d-none d-lg-block mb-20">
                    <div class="row gx-2">
                        <div class="col-4">
                            <div class="sidebar__single-img w-img mb-10">
                                <a class="popup-image"
                                    href="{{ asset('assets/templates/frontend/img/project/sm/project-7.jpg') }}">
                                    <img src="{{ asset('assets/templates/frontend/img/project/sm/project-7.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="sidebar__single-img w-img mb-10">
                                <a class="popup-image"
                                    href="{{ asset('assets/templates/frontend/img/project/sm/project-8.jpg') }}">
                                    <img src="{{ asset('assets/templates/frontend/img/project/sm/project-8.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="sidebar__single-img w-img mb-10">
                                <a class="popup-image"
                                    href="{{ asset('assets/templates/frontend/img/project/sm/project-9.jpg') }}">
                                    <img src="{{ asset('assets/templates/frontend/img/project/sm/project-9.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="sidebar__single-img w-img mb-10">
                                <a class="popup-image"
                                    href="{{ asset('assets/templates/frontend/img/project/sm/project-10.jpg') }}">
                                    <img src="{{ asset('assets/templates/frontend/img/project/sm/project-10.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="sidebar__single-img w-img mb-10">
                                <a class="popup-image"
                                    href="{{ asset('assets/templates/frontend/img/project/sm/project-13.jpg') }}">
                                    <img src="{{ asset('assets/templates/frontend/img/project/sm/project-13.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="sidebar__single-img w-img mb-10">
                                <a class="popup-image"
                                    href="{{ asset('assets/templates/frontend/img/project/sm/project-12.jpg') }}">
                                    <img src="{{ asset('assets/templates/frontend/img/project/sm/project-12.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar__map d-none d-lg-block mb-15">
                    {{-- <iframe
                        src=""></iframe> --}}
                </div>
                <div class="sidebar__contact mt-30 mb-20">
                    <h4>Contact Info</h4>
                    <ul>
                        <li class="d-flex align-items-center">
                            <div class="sidebar__contact-icon mr-15">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="sidebar__contact-text">
                                <a target="_blank" href="">12/A,
                                    Mirnada City Tower, NYC</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="sidebar__contact-icon mr-15">
                                <i class="far fa-phone"></i>
                            </div>
                            <div class="sidebar__contact-text">
                                <a href="tel:+012-345-6789">+8801 094 0637</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="sidebar__contact-icon mr-15">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="sidebar__contact-text">
                                <a
                                    href="https://themepure.net/cdn-cgi/l/email-protection#added8ddddc2dfd9edcac0ccc4c183cec2c0"><span
                                        class="mailto:nerox@gmail.com"
                                        data-cfemail="0b787e7b7b64797f4b666a626725686466"><span class="__cf_email__"
                                            data-cfemail="432d26312c3b03242e222a2f6d202c2e">[email&#160;protected]</span></span></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="sidebar__social">
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar area end -->
    <div class="body-overlay"></div>
    <!-- sidebar area end -->

    <main>

        <!-- slider -->
        <section class="tpagency-area p-relative box-plr-85">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <div class="tpagency__slider tp-agency-slide-active">

                            <div class="tpagency__slider-item tpagency__slider-height text-center d-flex align-items-center"
                                data-background="{{ asset('assets/templates/frontend/new/slider/1.jpg') }}">
                                <div class="tp-agency-slider-inner">
                                    <h4 class="tpagency-title">Selamat Datang Di <br> Website Resmi RW 13</h4>
                                </div>
                            </div>

                            <div class="tpagency__slider-item tpagency__slider-height text-center d-flex align-items-center"
                                data-background="{{ asset('assets/templates/frontend/new/slider/2.jpg') }}">
                                <div class="tp-agency-slider-inner">
                                    <h2 class="tpagency-title">Introduce Our Creative <br> Digital Agency.</h2>
                                </div>
                            </div>

                            <div class="tpagency__slider-item tpagency__slider-height text-center d-flex align-items-center"
                                data-background="{{ asset('assets/templates/frontend/new/slider/3.jpg') }}">
                                <div class="tp-agency-slider-inner">
                                    <h2 class="tpagency-title">Introduce Our Creative <br> Digital Agency.</h2>
                                </div>
                            </div>

                            <div class="tpagency__slider-item tpagency__slider-height text-center d-flex align-items-center"
                                data-background="{{ asset('assets/templates/frontend/new/slider/4.jpg') }}">
                                <div class="tp-agency-slider-inner">
                                    <h2 class="tpagency-title">Introduce Our Creative <br> Digital Agency.</h2>
                                </div>
                            </div>

                            <div class="tpagency__slider-item tpagency__slider-height text-center d-flex align-items-center"
                                data-background="{{ asset('assets/templates/frontend/new/slider/5.jpg') }}">
                                <div class="tp-agency-slider-inner">
                                    <h2 class="tpagency-title">Introduce Our Creative <br> Digital Agency.</h2>
                                </div>
                            </div>


                        </div>
                        <div class="tpbs-scroll tpbs-scroll-3">
                            <a href="#bio-wrapper" class="tpbs-scroll-btn animate"><i
                                    class="fa-light fa-arrow-down-long"></i></a>
                            <span><a href="#bio-wrapper">Scrool Down</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tentang -->
        <div id="bio-wrapper" class="tpbs-blog-area pt-70 pb-120">
            <div class="container-fluid">
                <!-- biograpy-area start -->
                <div class="biograpy-area pt-80 pb-70   pt-190">
                    <div class="container">

                        <h5 class="vote-sm-title mb-10">Selayang Pandang</h5>
                        <p class="bio-text mb-35">
                            <img src="{{ asset('assets/templates/frontend/img/about/biograpy-img-1.jpg') }}"
                                alt="img"
                                style="float: left;  margin-right: 24px; max-width: 300px; border-radius: 8px; margin-top: 8px;">

                        <p><b>Assalamu’alaikum Wr. Wb.</b></p>

                        <p><b>Salam Sejahtera untuk kita semua</b></p>

                        <p style="text-align: justify;">Kemajuan IPTEK merupakan anugerah yang patut kita syukuri,
                            karena dengan
                            kemajuan teknologi
                            ini telah membuka cakrawala baru keilmuan dalam berbagai bidang. E-Commerce, Elektronik
                            Banking, Elektronik Bussiness, Electronic Education (teleconference), dll, bahkan dalam
                            melaksanakan rutininas sehari-hari kita telah banyak dibantu dengan kehadiran teknologi ini.
                        </p>

                        <p style="text-align: justify;">
                            Pemanfaatan TIK melalui web site ini, diharapkan dapat meningkatkan eksistensi dalam rangka
                            mengoptimalisasikan peran dan fungsi perangkat RW 13 sebagai institusi pelayan masyarakat
                            serta membantu mensosialisasikan Progam-progam Pemerintah kepada masyarakat. Pengembangan
                            web site ini disamping untuk memenuhi kebutuhan internal pengurus RW 13 juga ditujukan
                            guna memenuhi harapan masyarakat yang membutuhkan informasi terkait dengan Data serta
                            pelayanan yang diselenggarakan oleh perangkat RW 13
                        </p>
                        <p style="text-align: justify;">
                            Untuk memenuhi harapan tersebut tentunya tidak akan sempurna tanpa partisipasi aktif dari
                            berbagai pihak terkait. Untuk itu kritik dan saran sangat kami harapkan, demikian juga
                            kepada seluruh perangkat Kelurahan diharapkan dapat merespon dan berbagi masukan yang
                            sekiranya bermanfaat bagi kemajuan RW 13 khususnya dan kemajuan Desa Tanjakan pada
                            umumnya.
                        </p>
                        <p style="text-align: justify;"> Akhirnya saya sampaikan Selamat dan Apresiasi atas penampilan
                            terbaru
                            Website RW 13 Semoga
                            dengan penampilan Website baru ini informasi tentang lingkungan RW 13 serta aktifitas
                            didalamnya dapat diketahui oleh masyarakat luas dengan cepat dan akuran.
                        </p>
                        <p> Wassalamu’alaikum Wr. Wb. </p>
                        <p> Ketua RW 13 </p>
                        <p>Nama Ketua RW </p>
                    </div>
                </div>
                <!-- biograpy-area end -->
            </div>
        </div>

        <!-- pengurus -->
        <div class="team-area pt-120 pb-70 grey-bg">
            <div class="container">
                <div class="row  pb-70">
                    <div class="col-xl-12">
                        <div class="tp-section-title text-center">
                            <h2 class="tp-title">Pengurus RW 13</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tpteam text-center mb-60">
                            <div class="tpteam__img">
                                <img src="{{ asset('assets/templates/frontend/img/author/author8.jpg')}}" alt="">
                                <div class="tpteam__social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-behance"></i></a>
                                    <a href="#"><i class="fab fa-pinterest"></i></a>
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="tpteam__text">
                                <h3 class="tpteam-title"><a href="about-me.html">Rasalina Willamson</a></h3>
                                <span class="team-designation">#UI/UX DEISGNER</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tpteam text-center mb-60">
                            <div class="tpteam__img">
                                <img src="{{ asset('assets/templates/frontend/img/author/author9.jpg')}}" alt="">
                                <div class="tpteam__social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-behance"></i></a>
                                    <a href="#"><i class="fab fa-pinterest"></i></a>
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="tpteam__text">
                                <h3 class="tpteam-title"><a href="about-me.html">Leslie Alexander</a></h3>
                                <span class="team-designation">#WEB DEVELOPER</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tpteam text-center mb-60">
                            <div class="tpteam__img">
                                <img src="{{ asset('assets/templates/frontend/img/author/author10.jpg')}}" alt="">
                                <div class="tpteam__social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-behance"></i></a>
                                    <a href="#"><i class="fab fa-pinterest"></i></a>
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="tpteam__text">
                                <h3 class="tpteam-title"><a href="about-me.html">Savannah Nguyen</a></h3>
                                <span class="team-designation">#PRODUCT DESIGN</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tpteam text-center mb-60">
                            <div class="tpteam__img">
                                <img src="{{ asset('assets/templates/frontend/img/author/author11.jpg')}}" alt="">
                                <div class="tpteam__social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-behance"></i></a>
                                    <a href="#"><i class="fab fa-pinterest"></i></a>
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="tpteam__text">
                                <h3 class="tpteam-title"><a href="about-me.html">Iqbal Hossain</a></h3>
                                <span class="team-designation">#UI/UX DESIGNER</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tpteam text-center mb-60">
                            <div class="tpteam__img">
                                <img src="{{ asset('assets/templates/frontend/img/author/author12.jpg')}}" alt="">
                                <div class="tpteam__social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-behance"></i></a>
                                    <a href="#"><i class="fab fa-pinterest"></i></a>
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="tpteam__text">
                                <h3 class="tpteam-title"><a href="about-me.html">Darlene Robertson</a></h3>
                                <span class="team-designation">#UI/UX DEISGNER</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tpteam text-center mb-60">
                            <div class="tpteam__img">
                                <img src="{{ asset('assets/templates/frontend/img/author/author13.jpg')}}" alt="">
                                <div class="tpteam__social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-behance"></i></a>
                                    <a href="#"><i class="fab fa-pinterest"></i></a>
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="tpteam__text">
                                <h3 class="tpteam-title"><a href="about-me.html">Darrell Steward</a></h3>
                                <span class="team-designation">#UI/UX DEISGNER</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- tpbs-blog-area start -->
        <div class="tpbs-blog-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="tpbs-section-wrapper text-center mb-30">
                        <span class="tpbs-sub-title mb-15">Blog & Article</span>
                        <h3 class="tpbs-title">Read Our <span> Blog & Article</span></h3>
                    </div>
                </div>
                <div class="row mt-30">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="tpblog mb-30">
                            <div class="tpblog__thumb mb-30">
                                <a href="blog-details.html"><img src="{{ asset('assets/templates/frontend/img/blog/blog-1.jpg')}}" alt="blog"></a>
                            </div>
                            <div class="tpblog__content">
                                <div class="tpblog__meta mb-25">
                                    <span class="tpblog__catagory">Business..</span>
                                    <span class="tpblog__date">23 January 2022</span>
                                </div>
                                <h5 class="tpblog__title"><a href="blog-details.html">What is the Main Challage for a
                                        Design
                                        Agency.</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="tpblog mb-30">
                            <div class="tpblog__thumb mb-30">
                                <a href="blog-details.html"><img src="{{ asset('assets/templates/frontend/img/blog/blog-2.jpg')}}" alt="blog"></a>
                            </div>
                            <div class="tpblog__content">
                                <div class="tpblog__meta mb-25">
                                    <span class="tpblog__catagory">Business..</span>
                                    <span class="tpblog__date">24 January 2022</span>
                                </div>
                                <h5 class="tpblog__title"><a href="blog-details.html">How to Handle Client to your
                                        Home
                                        Workshop</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="tpblog mb-30">
                            <div class="tpblog__thumb mb-30">
                                <a href="blog-details.html"><img src="{{ asset('assets/templates/frontend/img/blog/blog-3.jpg')}}" alt="blog"></a>
                            </div>
                            <div class="tpblog__content">
                                <div class="tpblog__meta mb-25">
                                    <span class="tpblog__catagory">Business..</span>
                                    <span class="tpblog__date">16 January 2022</span>
                                </div>
                                <h5 class="tpblog__title"><a href="blog-details.html">Design is not just look like or
                                        fill like,
                                        It,s how it works.</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="tpbs-blog-button text-center mt-30">
                            <a href="blog.html" class="tp-solid-btn">View More Project</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tpbs-blog-area end -->

    </main>

    <!-- modal-search-start -->
    <div class="modal fade search-modal" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <input type="text" placeholder="Search here...">
                    <button>
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- modal-search-end -->

    <!-- footer start -->
    <footer>
        <div class="tpfooter-area black-bg pt-115 pb-40">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="footer__widget footer-col-1">
                            <div class="tp-section-title">
                                <span class="tp-sub-title mb-15">#Contact INfo</span>
                                <h2 class="tp-title tp-title-df mb-20">Any Question?</h2>
                                <p>Methods and techniques to taking raw data - mining for insights and years of
                                    experience.</p>
                            </div>
                            <div class="footer__lists mt-40">
                                <div class="footer__list-item mb-40">
                                    <div class="footer__list-icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="footer__list-text">
                                        <p><a href="https://goo.gl/maps/iAY7xEk5PGbqwBWf6" target="blank">Ta-134/A,
                                                Gulshan Badda
                                                Link Rd,
                                                Nya 10982 USA </a></p>
                                    </div>
                                </div>
                                <div class="footer__list-item mb-40">
                                    <div class="footer__list-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="footer__list-text">
                                        <p><a
                                                href="https://themepure.net/cdn-cgi/l/email-protection#097b687a68656067687e6065656864496e64686065276a6664"><span
                                                    class="__cf_email__"
                                                    data-cfemail="81f3e0f2e0ede8efe0f6e8edede0ecc1e6ece0e8edafe2eeec">[email&#160;protected]</span></a>
                                        </p>
                                        <p><a
                                                href="https://themepure.net/cdn-cgi/l/email-protection#fd94939b92bd9a909c9491d39e9290"><span
                                                    class="__cf_email__"
                                                    data-cfemail="b1d8dfd7def1d6dcd0d8dd9fd2dedc">[email&#160;protected]</span></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="footer__list-item mb-40">
                                    <div class="footer__list-icon">
                                        <i class="fa-solid fa-phone-flip"></i>
                                    </div>
                                    <div class="footer__list-text">
                                        <p><a href="tel:+08987878773345">+08 98787 8773 345</a></p>
                                        <p><a href="tel:+08987878773345">+08 98787 8773 345</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="footer__widget footer-col-2">
                            <div class="tp-section-title">
                                <span class="tp-sub-title mb-15">#Get In Touch</span>
                                <h2 class="tp-title tp-title-df mb-20">Let’s Say Hi</h2>
                            </div>
                            <form id="contact-form" action="https://themepure.net/html/nerox-main/nerox/mail.php"
                                method="POST">
                                <div class="contact-filed mb-20">
                                    <input type="text" name="name" placeholder="Enter Name">
                                </div>
                                <div class="contact-filed mb-30">
                                    <input type="email" name="email" placeholder="Enter Mail">
                                </div>
                                <div class="contact-filed mb-25">
                                    <textarea placeholder="Enter your Massage" name="message"></textarea>
                                </div>
                                <div class="form-submit">
                                    <button class="tp-solid-btn" type="submit">Send Massage</button>
                                </div>
                                <p class="ajax-response"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tpcopyright-area black-bg-dark">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-8 col-md-6 col-sm-6">
                        <p>© 2022 Nerox - Agency & Portfolio Design . All Rights Reserved.</p>
                    </div>
                    <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                        <div class="ft-social">
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-youtube"></i></a>
                            <a href="#"><i class="fa-brands fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- JS here -->
    <script src="{{ asset('assets/templates/frontend/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/vendor/waypoints.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/meanmenu.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/slick.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/parallax.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/backtotop.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/cookie.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/style-switcher.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/counterup.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/wow.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/cookie.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/main.js') }}"></script>
</body>


</html>
