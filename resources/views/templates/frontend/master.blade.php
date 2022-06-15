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
    <title>Nerox - Agency & Portfolio Template</title>
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

        <!-- tppoletics-area start -->
        <div class="tppoletics-area p-relative">
            <div class="container-fluid p-0">
                <div class="row g-0 align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="tppoletics-content text-center">
                            <h2 class="tppoletics-title">HILEXA</h2>
                            <h3 class="tppoletics-sd-title mb-40">WILLIAM</h3>
                            <span class="tppoletics-text">I am a American politician</span>
                            <div class="tppoletics-button mt-65">
                                <a href="job-list.html" class="tp-solid-btn">Became a Volenteer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="tppoletics-hero">
                            <img src="{{ asset('assets/templates/frontend/img/hero/poletics-hero.jpg') }}"
                                alt="hero-img">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tpbs-scroll tpbs-scroll-3">
                <a href="#bio-wrapper" class="tpbs-scroll-btn animate"><i class="fa-light fa-arrow-down-long"></i></a>
                <span><a href="#bio-wrapper">Scrool Down</a></span>
            </div>
        </div>
        <!-- tppoletics-area end -->

        <!--  bio-wrapper start -->
        <div id="bio-wrapper" class="bio-wrapper grey-bg pt-190">
            <div class="container-fluid">
                <!-- biograpy-area start -->
                <div class="biograpy-area pt-80 pb-70 white-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="biograpy-image mb-60">
                                    <img src="{{ asset('assets/templates/frontend/img/about/biograpy-img-1.jpg') }}"
                                        alt="img">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="biograpy-image mb-60">
                                    <img src="{{ asset('assets/templates/frontend/img/about/biograpy-img-2.jpg') }}"
                                        alt="img">
                                </div>
                            </div>
                        </div>
                        <h4 class="biograpy-title mb-40">Biography</h4>
                        <p class="bio-text mb-35">Pork id swine, consequat quis drumstick commodo cupidatat short loin
                            magna
                            tempor tri-tip shoulder chicken bacon. Adipisicing strip steak jerky, swine shank eu aliqua
                            non
                            drumstick cow fatback. Veniam elit meatloaf t-bone in fatback turducken eiusmod ea. Quis
                            kielbasa
                            swine fatback, saola velit chuck ullamco. Frankfurter short ribs pastrami ribeye shoulder
                            occaecat
                            pancetta. Ipsum cupim landjaeger dolore, aliquip strip steak meatloaf nulla eiusmod.</p>
                        <div class="row mb-20">
                            <div class="col-xxl-7 col-xl-8">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="features__list mb-10">
                                            <ul>
                                                <li class="d-flex align-items-center">
                                                    <div class="features__list-icon mr-10">
                                                        <i class="far fa-check"></i>
                                                    </div>
                                                    <div class="features__list-text">
                                                        <p>Majored in Political Science</p>
                                                    </div>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <div class="features__list-icon mr-10">
                                                        <i class="far fa-check"></i>
                                                    </div>
                                                    <div class="features__list-text">
                                                        <p>Law School and Civil Rights Attorney</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="features__list mb-10">
                                            <ul>
                                                <li class="d-flex align-items-center">
                                                    <div class="features__list-icon mr-10">
                                                        <i class="far fa-check"></i>
                                                    </div>
                                                    <div class="features__list-text">
                                                        <p>Deputy Attorney General Media Project</p>
                                                    </div>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <div class="features__list-icon mr-10">
                                                        <i class="far fa-check"></i>
                                                    </div>
                                                    <div class="features__list-text">
                                                        <p>Director of the Developing Communities</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>Exercitation voluptate ribeye tongue, laborum picanha dolore flank in pastrami. In brisket
                            tail
                            pariatur in incididunt ham hock shankle bacon landjaeger short ribs deserunt beef. Elit
                            chicken
                            porchetta nostrud, nisi consequat occaecat. Bresaola pancetta occaecat chicken filet mignon
                            exercitation ribeye doner chuck ea pork ex beef andouille. Sunt consequat eu, velit venison
                            drumstick nulla short ribs sausage.
                        </p>
                    </div>
                </div>
                <!-- biograpy-area end -->

                <!-- vote-area start -->
                <div class="vote-area border-top white-bg pt-80 pb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="vote-content text-center">
                                    <div class="flag-img mb-35">
                                        <img src="{{ asset('assets/templates/frontend/img/about/flag-img.jpg') }}"
                                            alt="flag-img">
                                    </div>
                                    <h4 class="vote-title mb-35">Leadership.. Experience.. Values..</h4>
                                    <h5 class="vote-sm-title">VOTE FOR HILEXA WILLAM</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- vote-area end -->
            </div>
        </div>
        <!-- bio-wrapper end -->

        <!-- services-area start -->
        <div class="tppo-services-area grey-bg pt-135 pb-110">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tpbs-section-wrapper text-center mb-30">
                            <span class="tpbs-sub-title mb-15">My Services</span>
                            <h3 class="tpbs-title">Policy <span> positions</span></h3>
                        </div>
                    </div>
                </div>
                <div class="row mt-35">
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tppo-services-item text-center mb-30">
                            <div class="tppo-services-icon mb-50">
                                <i class="flaticon-support"></i>
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-1">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-1.png') }}"
                                    alt="shape">
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-2">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-2.png') }}"
                                    alt="shape">
                            </div>
                            <h5 class="tppo-services-title"><a href="project-details.html">Socail Services</a></h5>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tppo-services-item text-center mb-30">
                            <div class="tppo-services-icon mb-50">
                                <i class="flaticon-reading"></i>
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-1">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-1.png') }}"
                                    alt="shape">
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-2">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-2.png') }}"
                                    alt="shape">
                            </div>
                            <h5 class="tppo-services-title"><a href="project-details.html">Education</a></h5>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tppo-services-item text-center mb-30">
                            <div class="tppo-services-icon mb-50">
                                <i class="flaticon-business"></i>
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-1">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-1.png') }}"
                                    alt="shape">
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-2">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-2.png') }}"
                                    alt="shape">
                            </div>
                            <h5 class="tppo-services-title"><a href="project-details.html">Business</a></h5>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tppo-services-item text-center mb-30">
                            <div class="tppo-services-icon mb-50">
                                <i class="flaticon-route"></i>
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-1">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-1.png') }}"
                                    alt="shape">
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-2">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-2.png') }}"
                                    alt="shape">
                            </div>
                            <h5 class="tppo-services-title"><a href="project-details.html">Transprotation</a></h5>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tppo-services-item text-center mb-30">
                            <div class="tppo-services-icon mb-50">
                                <i class="flaticon-career"></i>
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-1">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-1.png') }}"
                                    alt="shape">
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-2">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-2.png') }}"
                                    alt="shape">
                            </div>
                            <h5 class="tppo-services-title"><a href="project-details.html">Development</a></h5>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tppo-services-item text-center mb-30">
                            <div class="tppo-services-icon mb-50">
                                <i class="flaticon-leaf"></i>
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-1">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-1.png') }}"
                                    alt="shape">
                            </div>
                            <div class="tppo-services-shape tppo-services-shape-2">
                                <img src="{{ asset('assets/templates/frontend/img/icon/po-ser-shape-2.png') }}"
                                    alt="shape">
                            </div>
                            <h5 class="tppo-services-title"><a href="project-details.html">Enviroment</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- services-area end -->

        <!-- tp-furniture-project start -->
        <div class="tp-political-project grey-bg pb-95 box-plr-155">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="tppg-project mb-30">
                                    <div class="tppg-project__thumb">
                                        <div class="tppg-project__thumb-image">
                                            <a href="project-details.html"><img
                                                    src="{{ asset('assets/templates/frontend/img/project/5/project-img-1.jpg') }}"
                                                    alt="project-img"></a>
                                        </div>
                                    </div>
                                    <div class="tppg-project__content">
                                        <span class="tppg-project-tag mb-10">LAW & COURT</span>
                                        <h4 class="tppg-project-title"><a href="project-details.html">Model &amp;
                                                Fashion
                                                Photography</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="tppg-project mb-30">
                                    <div class="tppg-project__thumb">
                                        <div class="tppg-project__thumb-image">
                                            <a href="project-details.html"><img
                                                    src="{{ asset('assets/templates/frontend/img/project/5/project-img-2.jpg') }}"
                                                    alt="project-img"></a>
                                        </div>
                                    </div>
                                    <div class="tppg-project__content">
                                        <span class="tppg-project-tag mb-10">LAW & COURT</span>
                                        <h4 class="tppg-project-title"><a href="project-details.html">Model &amp;
                                                Fashion
                                                Photography</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="tppg-project mb-30">
                                    <div class="tppg-project__thumb">
                                        <div class="tppg-project__thumb-image">
                                            <a href="project-details.html"><img
                                                    src="{{ asset('assets/templates/frontend/img/project/5/project-img-3.jpg') }}"
                                                    alt="project-img"></a>
                                        </div>
                                    </div>
                                    <div class="tppg-project__content">
                                        <span class="tppg-project-tag mb-10">LAW & COURT</span>
                                        <h4 class="tppg-project-title"><a href="project-details.html">Model &amp;
                                                Fashion
                                                Photography</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="tppg-project mb-30">
                                    <div class="tppg-project__thumb">
                                        <div class="tppg-project__thumb-image">
                                            <a href="project-details.html"><img
                                                    src="{{ asset('assets/templates/frontend/img/project/5/project-img-4.jpg') }}"
                                                    alt="project-img"></a>
                                        </div>
                                    </div>
                                    <div class="tppg-project__content">
                                        <span class="tppg-project-tag mb-10">LAW & COURT</span>
                                        <h4 class="tppg-project-title"><a href="project-details.html">Model &amp;
                                                Fashion
                                                Photography</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="tppg-project mb-35">
                            <div class="tppg-project__thumb">
                                <div class="tppg-project__thumb-image">
                                    <a href="project-details.html"><img
                                            src="{{ asset('assets/templates/frontend/img/project/5/project-img-5.jpg') }}"
                                            alt="project-img"></a>
                                </div>
                            </div>
                            <div class="tppg-project__content">
                                <span class="tppg-project-tag mb-10">LAW & COURT</span>
                                <h4 class="tppg-project-title"><a href="project-details.html">Model &amp; Fashion
                                        Photography</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tp-furniture-project end -->

        <!-- tpevent-area start -->
        <div class="tpevent-area grey-bg pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tpbs-section-wrapper text-center mb-30">
                            <span class="tpbs-sub-title mb-15">My Services</span>
                            <h3 class="tpbs-title">Policy <span> positions</span></h3>
                        </div>
                    </div>
                </div>
                <div class="row mt-35">
                    <div class="col-xl-12">
                        <div class="tpevent-item mb-40">
                            <div class="tpevent-image">
                                <img src="{{ asset('assets/templates/frontend/img/event/event-img-1.jpg') }}"
                                    alt="event-img">
                            </div>
                            <div class="tp-event-content">
                                <h4 class="tpevent-title mb-30"><a href="services-details.html">The Economy of the US:
                                        What are
                                        the <br> Weakest Spots?</a></h4>
                                <h6 class="tpevent-sm-title mb-30">Programme --- <span>April 3, 2022</span></h6>
                                <p>The United States' and China's relations will cast a pall over relations and the
                                    global. <br>
                                    During the early months, major</p>
                            </div>
                        </div>
                        <div class="tpevent-item mb-40">
                            <div class="tpevent-image">
                                <img src="{{ asset('assets/templates/frontend/img/event/event-img-2.jpg') }}"
                                    alt="event-img">
                            </div>
                            <div class="tp-event-content">
                                <h4 class="tpevent-title mb-30"><a href="services-details.html">The weakest spots new
                                        the
                                        Economy <br> of the us what are</a></h4>
                                <h6 class="tpevent-sm-title mb-30">Programme --- <span>April 3, 2022</span></h6>
                                <p>The United States' and China's relations will cast a pall over relations and the
                                    global. <br>
                                    During the early months, major</p>
                            </div>
                        </div>
                        <div class="tpevent-item mb-40">
                            <div class="tpevent-image">
                                <img src="{{ asset('assets/templates/frontend/img/event/event-img-3.jpg') }}"
                                    alt="event-img">
                            </div>
                            <div class="tp-event-content">
                                <h4 class="tpevent-title mb-30"><a href="services-details.html">Lets meet for
                                        protecting The
                                        Economy <br> of the canada: eco</a></h4>
                                <h6 class="tpevent-sm-title mb-30">Programme --- <span>April 3, 2022</span></h6>
                                <p>The United States' and China's relations will cast a pall over relations and the
                                    global. <br>
                                    During the early months, major</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tpevent-area end -->

        <!-- tppo-testimonial-area start -->
        <div class="tppo-testimonial-area grey-bg box-plr-155">
            <div class="container-fluid">
                <div class="tppo-testimonial-wrapper white-bg pt-135 pb-135">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tpbs-section-wrapper text-center mb-30">
                                <span class="tpbs-sub-title mb-15">Testimonial</span>
                                <h3 class="tpbs-title">Do Good <span> For Others</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <div class="tppotestimonial-slider tppotestimonial-slider-active">
                                <div class="tppotetsimonial-item text-center">
                                    <div class="tppotestimonial-icon mb-45">
                                        <i class="fa-brands fa-twitter"></i>
                                    </div>
                                    <p class="tppotestimonial-text mb-50">“ I appreciate your amazing services and
                                        professional
                                        staff for all your hard work and creative thinking! It was fun, and I hope to
                                        work with
                                        you again soon “</p>
                                    <span class="tpbs-client-name"><a href="#">Rasalina De Willmson (<span
                                                class="__cf_email__"
                                                data-cfemail="3271777d727d405b4a">[email&#160;protected]</span>)</a></span>
                                </div>
                                <div class="tppotetsimonial-item text-center">
                                    <div class="tppotestimonial-icon mb-45">
                                        <i class="fa-brands fa-twitter"></i>
                                    </div>
                                    <p class="tppotestimonial-text mb-50">“ It is a long established fact that a reader
                                        will be
                                        distracted by the readable content of a page when looking at its layout. The
                                        point of
                                        using Lorem Ipsum is that “</p>
                                    <span class="tpbs-client-name"><a href="#">Iqbal Hossain (<span
                                                class="__cf_email__"
                                                data-cfemail="9dded8d2dddafce7f4">[email&#160;protected]</span>)</a></span>
                                </div>
                                <div class="tppotetsimonial-item text-center">
                                    <div class="tppotestimonial-icon mb-45">
                                        <i class="fa-brands fa-twitter"></i>
                                    </div>
                                    <p class="tppotestimonial-text mb-50">“ If you are going to use a passage of Lorem
                                        Ipsum, you
                                        need to be sure there isn't anything embarrassing hidden in the middle of
                                        textprinting and
                                        typesetting industry “</p>
                                    <span class="tpbs-client-name"><a href="#">Angilna Macron(<span
                                                class="__cf_email__"
                                                data-cfemail="c586808a858ab7acbd">[email&#160;protected]</span>)</a></span>
                                </div>
                                <div class="tppotetsimonial-item text-center">
                                    <div class="tppotestimonial-icon mb-45">
                                        <i class="fa-brands fa-twitter"></i>
                                    </div>
                                    <p class="tppotestimonial-text mb-50">“ The point of using Lorem Ipsum is that it
                                        has a
                                        more-or-less normal distribution of letters, as opposed to using 'Content here,
                                        content
                                        here established “</p>
                                    <span class="tpbs-client-name"><a href="#">Josef Anderson (<span
                                                class="__cf_email__"
                                                data-cfemail="4d0e08020d023f2435">[email&#160;protected]</span>)</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tppo-testimonial-area end -->

        <!-- tpblog-area start -->
        <section class="tppoblog-area grey-bg pt-135 pb-130">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tpbs-section-wrapper text-center">
                            <span class="tpbs-sub-title mb-15">Blog & Article</span>
                            <h3 class="tpbs-title">Read <span> Blog & Article</span></h3>
                        </div>
                    </div>
                </div>
                <div class="row mt-60">
                    <div class="col-xl-12">
                        <div class="tpblog__slider tpblog__slider-active-2">
                            <div class="tpblog">
                                <div class="tpblog__thumb tpblog__thumb-ds">
                                    <a href="blog-details.html"><img
                                            src="{{ asset('assets/templates/frontend/img/blog/4/blog-1.jpg') }}"
                                            alt="blog"></a>
                                </div>
                                <div class="tpblog__content tpblog__content-2">
                                    <div class="tpblog__meta tpblog__meta-2 mb-25">
                                        <span class="tpblog__catagory">Business..</span>
                                        <span class="tpblog__date">23 January 2022</span>
                                    </div>
                                    <h5 class="tpblog__title"><a href="blog-details.html">What is the Main Challage
                                            for a
                                            Design.</a></h5>
                                </div>
                            </div>
                            <div class="tpblog">
                                <div class="tpblog__thumb tpblog__thumb-ds">
                                    <a href="blog-details.html"><img
                                            src="{{ asset('assets/templates/frontend/img/blog/4/blog-2.jpg') }}"
                                            alt="blog"></a>
                                </div>
                                <div class="tpblog__content tpblog__content-2">
                                    <div class="tpblog__meta tpblog__meta-2 mb-25">
                                        <span class="tpblog__catagory">Business..</span>
                                        <span class="tpblog__date">24 January 2022</span>
                                    </div>
                                    <h5 class="tpblog__title"><a href="blog-details.html">How to Handle Client to your
                                            Home
                                            Workshop</a></h5>
                                </div>
                            </div>
                            <div class="tpblog">
                                <div class="tpblog__thumb tpblog__thumb-ds">
                                    <a href="blog-details.html"><img
                                            src="{{ asset('assets/templates/frontend/img/blog/4/blog-3.jpg') }}"
                                            alt="blog"></a>
                                </div>
                                <div class="tpblog__content tpblog__content-2">
                                    <div class="tpblog__meta tpblog__meta-2 mb-25">
                                        <span class="tpblog__catagory">Business..</span>
                                        <span class="tpblog__date">25 January 2022</span>
                                    </div>
                                    <h5 class="tpblog__title"><a href="blog-details.html">Design is not just look like
                                            or fill
                                            like, It's done works.</a></h5>
                                </div>
                            </div>
                            <div class="tpblog">
                                <div class="tpblog__thumb tpblog__thumb-ds">
                                    <a href="blog-details.html"><img
                                            src="{{ asset('assets/templates/frontend/img/blog/4/blog-4.jpg') }}"
                                            alt="blog"></a>
                                </div>
                                <div class="tpblog__content tpblog__content-2">
                                    <div class="tpblog__meta tpblog__meta-2 mb-25">
                                        <span class="tpblog__catagory">Business..</span>
                                        <span class="tpblog__date">26 January 2022</span>
                                    </div>
                                    <h5 class="tpblog__title"><a href="blog-details.html">The world is growing so fast
                                            so you
                                            need to be</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- tpblog-area end -->

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
