<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets') }}/img/favicon.png" rel="icon">
    <link href="{{ asset('assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
    @stack('style')

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center bg-primary">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{ asset('assets') }}/img/logo_disperdagin.png" alt="">
                <span class="d-none d-lg-block text-light">Arsipin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn text-light"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2 text-light">User</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>

                            <a href="{{ route('change_password_view') }}" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-shield-lock"></i>
                                <span>Ubah Password</span>
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    @include('layout.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title ?? 'Title' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    @if (isset($subtitle['subs']))
                        <li class="breadcrumb-item"><a
                                href="{{ route($subtitle['route']) }}">{{ $subtitle['subtitle'] }}</a></li>
                        <li class="breadcrumb-item active">{{ $subtitle['subs'] }}</li>
                    @else
                        <li class="breadcrumb-item active">{{ $subtitle['subtitle'] }}</li>
                    @endif
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @yield('content')

    </main><!-- End #main -->

    @include('layout.footer')

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets') }}/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/chart.js/chart.umd.js"></script>
    <script src="{{ asset('assets') }}/vendor/echarts/echarts.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/quill/quill.js"></script>
    <script src="{{ asset('assets') }}/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('assets') }}/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets') }}/js/main.js"></script>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @stack('scripts')

</body>

</html>
