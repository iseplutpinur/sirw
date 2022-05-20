<?php
$page_attr = (object) [
    'title' => isset($page_attr['title']) ? $page_attr['title'] : '',
    'url' => isset($page_attr['url']) ? $page_attr['url'] : url(''),
    'type' => isset($page_attr['type']) ? $page_attr['type'] : 'website',
    'loader' => isset($page_attr['loader']) ? $page_attr['loader'] : true,
    'description' => isset($page_attr['description']) ? $page_attr['description'] : 'Karmapack - Keluarga Mahasiswa dan Pelajar Cianjur Kidul',
    'keywords' => isset($page_attr['keywords']) ? $page_attr['keywords'] : 'karmapack,orda,cianjur kidul',
    'author' => isset($page_attr['author']) ? $page_attr['author'] : 'Isep Lutpi Nur',
    'image' => isset($page_attr['image']) ? $page_attr['image'] : asset('assets/templates/admin/images/brand/logo-1.png'),
    'navigation' => isset($page_attr['navigation']) ? $page_attr['navigation'] : false,
    'breadcrumbs' => isset($page_attr['breadcrumbs']) ? (is_array($page_attr['breadcrumbs']) ? $page_attr['breadcrumbs'] : false) : false,
    'periode_id' => isset($page_attr['periode_id']) ? $page_attr['periode_id'] : false,
];
$page_attr_title = ($page_attr->title == '' ? '' : $page_attr->title . ' | ') . (env('APP_NAME') ?? '');
$search_master_key = isset($_GET['search']) ? $_GET['search'] : '';
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="theme-color" content="#0191D7">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/icon-144x144.png') }}">

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO -->
    <!-- Primary Meta Tags -->
    <title>{{ $page_attr_title }}</title>
    <meta name="description" content="{{ $page_attr->description }}">
    <meta name="author" content="{{ $page_attr->author }}">
    <meta name="keywords" content="{{ $page_attr->keywords }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:url" content="{{ $page_attr->url }}">
    <meta property="og:type" content="{{ $page_attr->type }}">
    <meta property="og:title" content="{{ $page_attr_title }}">
    <meta property="og:description" content="{{ $page_attr->description }}">
    <meta property="og:image" content="{{ $page_attr->image }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ $page_attr->url }}">
    <meta name="twitter:title" content="{{ $page_attr_title }}">
    <meta name="twitter:description" content="{{ $page_attr->description }}">
    <meta name="twitter:image" content="{{ $page_attr->image }}">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ $page_attr_title }}">
    <meta itemprop="description" content="{{ $page_attr->description }}">
    <meta itemprop="image" content="{{ $page_attr->image }}">

    <!-- STYLES -->
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/bootstrap.min.css') }}" type="text/css"
        media="all">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/all.min.css') }}" type="text/css"
        media="all">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/slick.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/simple-line-icons.css') }}" type="text/css"
        media="all">
    <link rel="stylesheet" href="{{ asset('assets/templates/frontend/css/style.css') }}" type="text/css" media="all">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #0092DF;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }

    </style>

    @yield('stylesheet')
</head>

<body>

    <!-- preloader -->
    <div id="preloader">
        <div class="book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>

    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>

        <!-- header -->
        <header class="header-personal light">
            <nav class="navbar navbar-expand-lg">
                <div class="container-xl py-4">
                    <!-- site logo -->
                    <a class="navbar-brand" href=""><img
                            src="{{ asset('assets/templates/frontend/images/logo.svg') }}" alt="logo" /></a>

                    <div class="collapse navbar-collapse">
                        <!-- menus -->
                        <ul class="navbar-nav mr-auto ms-lg-3">
                            <li class="nav-item active">
                                <a class="nav-link" href="">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="struktur-">Struktur Organisasi</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#">Data Warga</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="">Data Warga Per RT</a></li>
                                    <li><a class="dropdown-item" href="">Data Dasawisma</a></li>
                                    <li><a class="dropdown-item" href="">Data Posyandu</a></li>
                                    <li><a class="dropdown-item" href="">Data Posbindu</a></li>
                                    <li><a class="dropdown-item" href="">Data Pos KB</a></li>
                                    <li><a class="dropdown-item" href="">Laporan Kependudukan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Laporan Kegiatan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Daftar Inventaris</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <!--
       <li class="nav-item">
        <a class="nav-link" href="">Lifestyle</a>
       </li>
       <li class="nav-item">
        <a class="nav-link" href="">Inspiration</a>
       </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#">Pages</a>
        <ul class="dropdown-menu">
         <li><a class="dropdown-item" href="">Category</a></li>
         <li><a class="dropdown-item" href="blog-">Blog Single</a></li>
         <li><a class="dropdown-item" href="blog-single-">Blog Single Alt</a></li>
         <li><a class="dropdown-item" href="">About</a></li>
         <li><a class="dropdown-item" href="">Contact</a></li>
        </ul>
       </li>
       <li class="nav-item">
        <a class="nav-link" href="">Contact</a>
       </li> -->
                        </ul>
                    </div>

                    <!-- header right section -->
                    <div class="header-right">
                        <!-- header buttons -->
                        <div class="header-buttons">
                            <button class="search icon-button">
                                <i class="icon-magnifier"></i>
                            </button>
                            <button class="burger-menu icon-button">
                                <span class="burger-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- section hero -->
        <section class="hero data-bg-image d-flex align-items-center pb-5 my-0"
            data-bg-image="{{ asset('assets/templates/frontend/images/bg.jpg') }}"
            style="max-height: 120vh; background-position: center;">
            <div class="container-xl">
                <!-- call to action -->
                <div class="cta text-center p-0 m-0" style="max-width: none;">
                    <h2 class="mt-0 mb-4">Selamat datang</h2>
                    <p class="mt-0 mb-4">
                        Web resmi RW 13 kelurahan Pasirlayung Kecamatan Cibeunying Kidul Kota Bandung Jawa Barat
                        40192<br>
                        Sekretariat : Jl. Terusan Cimumcang Gg. Bp. Wiria RT 03 RW 13 Kelurahan pasir Layung Kecamatan
                        Cibeunying
                        Kidul Kota Bandung</p>
                </div>
            </div>
            <!-- animated mouse wheel -->
            <span class="mouse">
                <span class="wheel"></span>
            </span>
            <!-- wave svg -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 260">
                <path fill="#FFF" fill-opacity="1"
                    d="M0,256L60,245.3C120,235,240,213,360,218.7C480,224,600,256,720,245.3C840,235,960,181,1080,176C1200,171,1320,213,1380,234.7L1440,256L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
                </path>
            </svg>
        </section>

        <div class="spacer" data-height="30"></div>

        <!-- section main content -->
        <section class="main-content">
            <div class="container-xl">

                <div class="row gy-4">

                    <div class="col-lg-8">
                        <!-- kata sambutan -->
                        <section>
                            <figure>
                                <img src="{{ asset('assets/templates/frontend/images/nncwo.jpg') }}"
                                    class="rounded alignleft" alt="...">
                            </figure>
                            <section style="text-align: justify;">
                                <p>Assalamu’alaikum Wr. Wb.</p>
                                <p>Kemajuan IPTEK merupakan anugerah yang patut kita syukuri, karena dengan kemajuan
                                    teknologi ini telah
                                    membuka cakrawala baru keilmuan dalam berbagai bidang. E-Commerce, Elektronik
                                    Banking, Elektronik
                                    Bussiness,
                                    Electronic Education (teleconference), dll, bahkan dalam melaksanakan rutininas
                                    sehari-hari kita telah
                                    banyak dibantu dengan kehadiran teknologi ini.</p>
                                <p>Pemanfaatan TIK melalui web site ini, diharapkan dapat meningkatkan eksistensi dalam
                                    rangka
                                    mengoptimalisasikan peran dan fungsi perangkat RT/RW sebagai institusi pelayan
                                    masyarakat serta
                                    membantu
                                    mensosialisasikan Progam-progam Pemerintah kepada masyarakat. Pengembangan web site
                                    ini disamping
                                    untuk
                                    memenuhi kebutuhan internal pengurus RT/RW, juga ditujukan guna memenuhi harapan
                                    masyarakat yang
                                    membutuhkan
                                    informasi terkait dengan Data serta pelayanan yang diselenggarakan oleh perangkat
                                    RT/RW</p>
                                <p>Untuk memenuhi harapan tersebut tentunya tidak akan sempurna tanpa partisipasi aktif
                                    dari berbagai
                                    pihak
                                    terkait. Untuk itu kritik dan saran sangat kami harapkan, demikian juga kepada
                                    seluruh perangkat
                                    Kelurahan
                                    diharapkan dapat merespon dan berbagi masukan yang sekiranya bermanfaat bagi
                                    kemajuan RW.08 khususnya
                                    dan
                                    kemajuan Desa Pasirangin pada umumnya.</p>

                                <p>Akhirnya saya sampaikan Selamat dan Apresiasi atas penampilan terbaru Website RW. 08
                                    Semoga dengan
                                    penampilan Website baru ini informasi tentang lingkungan RW.08 serta aktifitas
                                    didalamnya dapat
                                    diketahui
                                    oleh masyarakat luas dengan cepat dan akuran.</p>
                                <p>Wassalamu’alaikum Wr. Wb.</p>
                            </section>

                        </section>

                        <!-- visi dan misi -->
                        <section>
                            <div class="spacer" data-height="50"></div>
                            <div class="section-header mb-2">
                                <h3 class="section-title">VISI MISI</h3>
                                <img src="{{ asset('assets/templates/frontend/images/wave.svg') }}"
                                    class="wave" alt="wave" />
                            </div>

                            <!-- visi -->
                            <h3 class="h5">VISI</h3>
                            <p>Terwujudnya RW 01 sebagai wilayah yang Religius, Aman, Kreatif , Sehat dan Indah yang
                                dilakukan secara
                                bersama</p>

                            <!-- misi -->
                            <h3 class="h5">MISI</h3>
                            <p>
                            <ol>
                                <li>Meningkatkan peran serta warga RW 01 dalam menciptakan kebersihan, keindahan
                                    lingkungan, dan
                                    wilayah bebas banjir</li>
                                <li>Meningkatkan kesadaran warga RW 01 tentang pentingnya kesehatan keluarga</li>
                                <li>Meningkatkan peran aktif warga RW 01 dalam menciptakan keamanan dan ketertiban
                                    lingkungan</li>
                                <li>Mendorong semangat kreatifitas warga untuk memajukan wilayahnya dari segala aspek
                                    sehingga menjadi
                                    RW yang maju dan terdepan</li>
                            </ol>
                            </p>

                            <!-- slogan -->
                            <h3 class="h5">SLOGAN</h3>
                            <p>RW 13 BERAKSI = <strong>Ber</strong>sama , <strong>R</strong>eligius,
                                <strong>A</strong>man ,
                                <strong>K</strong>reatif, <strong>S</strong>ehat , <strong>I</strong>ndah
                            </p>
                        </section>

                        <!-- berita -->
                        <section>
                            <div class="spacer" data-height="50"></div>
                            <!-- section header -->
                            <div class="section-header">
                                <h3 class="section-title">BERITA</h3>
                                <img src="{{ asset('assets/templates/frontend/images/wave.svg') }}"
                                    class="wave" alt="wave" />
                            </div>

                            <div class="padding-30 rounded bordered">

                                <div class="row">

                                    <div class="col-md-12 col-sm-6">
                                        <!-- post -->
                                        <div class="post post-list clearfix">
                                            <div class="thumb rounded">
                                                <span class="post-format-sm">
                                                    <i class="icon-picture"></i>
                                                </span>
                                                <a href="blog-">
                                                    <div class="inner">
                                                        <img src="{{ asset('assets/templates/frontend/images/posts/latest-sm-1.jpg') }}"
                                                            alt="post-title" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details">
                                                <ul class="meta list-inline mb-3">
                                                    <li class="list-inline-item"><a href="#"><img
                                                                src="{{ asset('assets/templates/frontend/images/other/author-sm.png') }}"
                                                                class="author" alt="author" />Katen Doe</a></li>
                                                    <li class="list-inline-item"><a href="#">Trending</a></li>
                                                    <li class="list-inline-item">29 March 2021</li>
                                                </ul>
                                                <h5 class="post-title"><a href="blog-">The Next 60 Things
                                                        To
                                                        Immediately Do About
                                                        Building</a></h5>
                                                <p class="excerpt mb-0">A wonderful serenity has taken possession of
                                                    my
                                                    entire soul, like these
                                                    sweet mornings</p>
                                                <div class="post-bottom clearfix d-flex align-items-center">
                                                    <div class="social-share me-auto">
                                                        <button class="toggle-button icon-share"></button>
                                                        <ul class="icons list-unstyled list-inline mb-0">
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-facebook-f"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-twitter"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-linkedin-in"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-pinterest"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-telegram-plane"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="far fa-envelope"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="more-button float-end">
                                                        <a href="blog-"><span class="icon-options"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-6">
                                        <!-- post -->
                                        <div class="post post-list clearfix">
                                            <div class="thumb rounded">
                                                <a href="blog-">
                                                    <div class="inner">
                                                        <img src="{{ asset('assets/templates/frontend/images/posts/latest-sm-2.jpg') }}"
                                                            alt="post-title" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details">
                                                <ul class="meta list-inline mb-3">
                                                    <li class="list-inline-item"><a href="#"><img
                                                                src="{{ asset('assets/templates/frontend/images/other/author-sm.png') }}"
                                                                class="author" alt="author" />Katen Doe</a>
                                                    </li>
                                                    <li class="list-inline-item"><a href="#">Lifestyle</a></li>
                                                    <li class="list-inline-item">29 March 2021</li>
                                                </ul>
                                                <h5 class="post-title"><a href="blog-">Master The Art Of
                                                        Nature With These 7 Tips</a>
                                                </h5>
                                                <p class="excerpt mb-0">A wonderful serenity has taken possession of
                                                    my
                                                    entire soul, like these
                                                    sweet mornings</p>
                                                <div class="post-bottom clearfix d-flex align-items-center">
                                                    <div class="social-share me-auto">
                                                        <button class="toggle-button icon-share"></button>
                                                        <ul class="icons list-unstyled list-inline mb-0">
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-facebook-f"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-twitter"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-linkedin-in"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-pinterest"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-telegram-plane"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="far fa-envelope"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="more-button float-end">
                                                        <a href="blog-"><span class="icon-options"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-6">
                                        <!-- post -->
                                        <div class="post post-list clearfix">
                                            <div class="thumb rounded">
                                                <span class="post-format-sm">
                                                    <i class="icon-camrecorder"></i>
                                                </span>
                                                <a href="blog-">
                                                    <div class="inner">
                                                        <img src="{{ asset('assets/templates/frontend/images/posts/latest-sm-3.jpg') }}"
                                                            alt="post-title" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details">
                                                <ul class="meta list-inline mb-3">
                                                    <li class="list-inline-item"><a href="#"><img
                                                                src="{{ asset('assets/templates/frontend/images/other/author-sm.png') }}"
                                                                class="author" alt="author" />Katen Doe</a>
                                                    </li>
                                                    <li class="list-inline-item"><a href="#">Fashion</a></li>
                                                    <li class="list-inline-item">29 March 2021</li>
                                                </ul>
                                                <h5 class="post-title"><a href="blog-">Facts About
                                                        Business
                                                        That Will Help You
                                                        Success</a></h5>
                                                <p class="excerpt mb-0">A wonderful serenity has taken possession of
                                                    my
                                                    entire soul, like these
                                                    sweet mornings</p>
                                                <div class="post-bottom clearfix d-flex align-items-center">
                                                    <div class="social-share me-auto">
                                                        <button class="toggle-button icon-share"></button>
                                                        <ul class="icons list-unstyled list-inline mb-0">
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-facebook-f"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-twitter"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-linkedin-in"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-pinterest"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-telegram-plane"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="far fa-envelope"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="more-button float-end">
                                                        <a href="blog-"><span class="icon-options"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-6">
                                        <!-- post -->
                                        <div class="post post-list clearfix">
                                            <div class="thumb rounded">
                                                <a href="blog-">
                                                    <div class="inner">
                                                        <img src="{{ asset('assets/templates/frontend/images/posts/latest-sm-4.jpg') }}"
                                                            alt="post-title" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details">
                                                <ul class="meta list-inline mb-3">
                                                    <li class="list-inline-item"><a href="#"><img
                                                                src="{{ asset('assets/templates/frontend/images/other/author-sm.png') }}"
                                                                class="author" alt="author" />Katen Doe</a>
                                                    </li>
                                                    <li class="list-inline-item"><a href="#">Politic</a></li>
                                                    <li class="list-inline-item">29 March 2021</li>
                                                </ul>
                                                <h5 class="post-title"><a href="blog-">Your Light Is
                                                        About To
                                                        Stop Being Relevant</a>
                                                </h5>
                                                <p class="excerpt mb-0">A wonderful serenity has taken possession of
                                                    my
                                                    entire soul, like these
                                                    sweet mornings</p>
                                                <div class="post-bottom clearfix d-flex align-items-center">
                                                    <div class="social-share me-auto">
                                                        <button class="toggle-button icon-share"></button>
                                                        <ul class="icons list-unstyled list-inline mb-0">
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-facebook-f"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-twitter"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-linkedin-in"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-pinterest"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fab fa-telegram-plane"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="far fa-envelope"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="more-button float-end">
                                                        <a href="blog-"><span class="icon-options"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- load more button -->
                                <div class="text-center">
                                    <button class="btn btn-simple">Load More</button>
                                </div>

                            </div>
                        </section>
                    </div>
                    <div class="col-lg-4">

                        <!-- sidebar -->
                        <div class="sidebar">
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">PELAYANAN</h3>
                                    <img src="{{ asset('assets/templates/frontend/images/wave.svg') }}"
                                        class="wave" alt="wave" />
                                </div>
                                <div class="widget-content">
                                    <!-- post -->
                                    <div class="post post-list-sm circle">
                                        <div class="thumb circle">
                                            <a href="blog-">
                                                <div class="inner">
                                                    <img src="{{ asset('assets/templates/frontend/images/posts/tabs-1.jpg') }}"
                                                        alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details clearfix">
                                            <h6 class="post-title my-0"><a href="blog-">Pelayanan E-KTP
                                                    Syarat dan ketentuan
                                                    pengurusan dokumen e-KTP</a>
                                            </h6>
                                        </div>
                                    </div>

                                    <!-- post -->
                                    <div class="post post-list-sm circle">
                                        <div class="thumb circle">
                                            <a href="blog-">
                                                <div class="inner">
                                                    <img src="{{ asset('assets/templates/frontend/images/posts/tabs-1.jpg') }}"
                                                        alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details clearfix">
                                            <h6 class="post-title my-0"><a href="blog-">Pelayanan Kartu
                                                    Keluarga Syarat dan
                                                    ketentuan pengurusan dokumen Kartu Keluarga</a>
                                            </h6>
                                        </div>
                                    </div>

                                    <!-- post -->
                                    <div class="post post-list-sm circle">
                                        <div class="thumb circle">
                                            <a href="blog-">
                                                <div class="inner">
                                                    <img src="{{ asset('assets/templates/frontend/images/posts/tabs-1.jpg') }}"
                                                        alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details clearfix">
                                            <h6 class="post-title my-0"><a href="blog-">Pelayanan Akta
                                                    Kelahiran Syarat dan
                                                    ketentuan pengurusan dokumen Akta Kelahiran</a>
                                            </h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- footer -->
        <footer>
            <div class="container-xl">
                <div class="footer-inner">
                    <div class="row d-flex align-items-center gy-4">
                        <!-- copyright text -->
                        <div class="col-md-6">
                            <span class="copyright">© 2021 Katen. Template by ThemeGer.</span>
                        </div>

                        <!-- go to top button -->
                        <div class="col-md-6">
                            <a href="#" id="return-to-top" class="float-md-end"><i class="icon-arrow-up"></i>Back
                                to
                                Top</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div><!-- end site wrapper -->

    <!-- search popup area -->
    <div class="search-popup">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>
        <!-- content -->
        <div class="search-content">
            <div class="text-center">
                <h3 class="mb-4 mt-0">Press ESC to close</h3>
            </div>
            <!-- form -->
            <form class="d-flex search-form">
                <input class="form-control me-2" type="search" placeholder="Search and press enter ..."
                    aria-label="Search">
                <button class="btn btn-default btn-lg" type="submit"><i class="icon-magnifier"></i></button>
            </form>
        </div>
    </div>

    <!-- canvas menu -->
    <div class="canvas-menu d-flex align-items-end flex-column">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>

        <!-- logo -->
        <div class="logo">
            <img src="{{ asset('assets/templates/frontend/images/logo.svg') }}" alt="Katen" />
        </div>

        <!-- menu -->
        <nav>
            <ul class="vertical-menu">
                <li class="active"> <a class="nav-link" href="">Home</a></li>
                <li><a class="nav-link" href="">Profil</a></li>
                <li><a class="nav-link" href="">Struktur Organisasi</a></li>

                <li>
                    <a class="nav-link dropdown-toggle" href="#">Data Warga</a>
                    <ul class="submenu">
                        <li><a href="">Data Warga Per RT</a></li>
                        <li><a href="">Data Dasawisma</a></li>
                        <li><a href="">Data Posyandu</a></li>
                        <li><a href="">Data Posbindu</a></li>
                        <li><a href="">Data Pos KB</a></li>
                        <li><a href="">Laporan Kependudukan</a></li>
                    </ul>
                </li>
                <li><a class="nav-link" href="">Laporan Kegiatan</a></li>
                <li><a class="nav-link" href="">Daftar Inventaris</a></li>
                <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            </ul>
        </nav>
    </div>

    <!-- JAVA SCRIPTS -->
    <script src="{{ asset('assets/templates/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/jquery.sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('assets/templates/frontend/js/custom.js') }}"></script>
    @yield('javascript')
</body>

</html>
