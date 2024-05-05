<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- plugins:css -->
    <link rel="stylesheet" href="/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="/assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('head')
</head>

<body @guest class="sidebar-hidden" @endguest>
    <div id="app">
        <main class="container-scroller">
            {{-- Navbar --}}
            <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row"
                aria-label="navbar">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                    <div class="me-3">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                            data-bs-toggle="minimize">
                            <span class="icon-menu"></span>
                        </button>
                    </div>
                    <div>
                        <a class="navbar-brand brand-logo" href="index.html">
                            <img src="/assets/images/logo.svg" alt="logo" />
                        </a>
                        <a class="navbar-brand brand-logo-mini" href="index.html">
                            <img src="/assets/images/logo-mini.svg" alt="logo" />
                        </a>
                    </div>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-top">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ Auth::user()->name }}
                                    <img class="img-xs rounded-circle ms-3" src="/assets/images/faces/face8.jpg"
                                        alt="Profile image"> </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="UserDropdown">
                                    <div class="dropdown-header text-center">
                                        <img class="img-md rounded-circle" src="/assets/images/faces/face8.jpg"
                                            alt="Menu profile image">
                                        <p class="mb-1 mt-3 fw-semibold">{{ Auth::user()->name }}</p>
                                        <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                                    </div>
                                    <a class="dropdown-item border-0" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        <i
                                            class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>{{ __('Sign out') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-bs-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            {{-- end navbar --}}

            <div class="container-fluid page-body-wrapper">

                @auth
                    <!-- sidebar -->
                    <nav class="sidebar sidebar-offcanvas py-3" id="sidebar" aria-label="sidebar">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    <i class="mdi mdi-grid-large menu-icon"></i>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('spk.index') }}">
                                    <i class="mdi mdi-file-document menu-icon"></i>
                                    <span class="menu-title">SPK</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('finished-goods.index') }}">
                                    <i class="mdi mdi-clipboard-check menu-icon"></i>
                                    <span class="menu-title">Finished Goods</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                                    aria-controls="ui-basic">
                                    <i class="menu-icon mdi mdi-floor-plan"></i>
                                    <span class="menu-title">Documents</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="ui-basic">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('surat-jalan.index') }}">Surat Jalan</a></li>
                                        <li class="nav-item"> <a class="nav-link"
                                                href="#">Nota Perbaikan</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item nav-category">Master Data</li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('penerbit.index') }}">
                                    <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                                    <span class="menu-title">Penerbit</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('buku.index') }}">
                                    <i class="mdi mdi-book menu-icon"></i>
                                    <span class="menu-title">Buku</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('distributor.index') }}">
                                    <i class="mdi mdi-store menu-icon"></i>
                                    <span class="menu-title">Distributor</span>
                                </a>
                            </li>

                        </ul>
                    </nav>
                    <!-- end sidebar -->
                @endauth

                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>

                    <!-- footer -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                                    href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a>
                                from BootstrapDash.</span>
                            <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2023.
                                All rights reserved.</span>
                        </div>
                    </footer>
                    <!-- end footer -->

                </div>
            </div>
        </main>
    </div>

    <!-- plugins:js -->
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/assets/vendors/chart.js/chart.umd.js"></script>
    <script src="/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/template.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    <script src="/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/assets/js/dashboard.js"></script>

    @yield('script')
</body>

</html>