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
                                        {{ Auth::user()->petugas->jabatan }}
                                        <img class="img-xs rounded-circle ms-3" src="/assets/images/faces/face8.jpg"
                                            alt="" alt="Profile image"> </a>
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                        aria-labelledby="UserDropdown">
                                        <div class="dropdown-header text-center">
                                            <img class="img-md rounded-circle" src="/assets/images/faces/face8.jpg"
                                                alt="" alt="Menu profile image">
                                            <p class="mb-1 mt-3 fw-semibold">{{ Auth::user()->petugas->nama_petugas }}</p>
                                            <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                                        </div>
                                        <a class="dropdown-item border-0" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            <i
                                                class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>{{ __('Sign out') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
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
                                <li
                                    class="nav-item {{ Str::startsWith(url()->current(), route('dashboard')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard') }}">
                                        <i class="mdi mdi-grid-large menu-icon"></i>
                                        <span class="menu-title">Dashboard</span>
                                    </a>
                                </li>

                                @if (auth()->user()->isManager || auth()->user()->isPetugasGudangHasil)
                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('finished-goods.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('finished-goods.index') }}">
                                            <i class="mdi mdi-clipboard-check menu-icon"></i>
                                            <span class="menu-title">Finished Goods</span>
                                        </a>
                                    </li>
                                @endif

                                @if (auth()->user()->isManager || auth()->user()->isPetugasGudangRetur)
                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('retur.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('retur.index') }}">
                                            <i class="mdi mdi-truck-trailer menu-icon"></i>
                                            <span class="menu-title">Retur</span>
                                        </a>
                                    </li>
                                @endif

                                <li
                                    class="nav-item {{ Str::startsWith(url()->current(), route('surat-jalan.index')) || Str::startsWith(url()->current(), route('nota-perbaikan.index')) || Str::startsWith(url()->current(), route('spk.index')) ? 'active' : '' }}">
                                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                                        aria-controls="ui-basic">
                                        <i class="menu-icon mdi mdi-book-open"></i>
                                        <span class="menu-title">Documents</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="collapse  {{ Str::startsWith(url()->current(), route('surat-jalan.index')) || Str::startsWith(url()->current(), route('nota-perbaikan.index')) || Str::startsWith(url()->current(), route('spk.index')) ? 'show' : '' }}"
                                        id="ui-basic">
                                        <ul class="nav flex-column sub-menu">

                                            @if (auth()->user()->isManager || auth()->user()->isPetugasGudangHasil)
                                                <li
                                                    class="nav-item {{ Str::startsWith(url()->current(), route('spk.index')) ? 'active' : '' }}">
                                                    <a class="nav-link" href="{{ route('spk.index') }}">SPK</a>
                                                </li>
                                                <li
                                                    class="nav-item {{ Str::startsWith(url()->current(), route('surat-jalan.index')) ? 'active' : '' }}">
                                                    <a class="nav-link" href="{{ route('surat-jalan.index') }}">Surat
                                                        Jalan</a>
                                                </li>
                                            @endif

                                            @if (auth()->user()->isManager || auth()->user()->isPetugasGudangRetur)
                                                <li
                                                    class="nav-item {{ Str::startsWith(url()->current(), route('nota-perbaikan.index')) ? 'active' : '' }}">
                                                    <a class="nav-link" href="{{ route('nota-perbaikan.index') }}">Nota
                                                        Perbaikan</a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>

                                <li
                                    class="nav-item {{ Str::startsWith(url()->current(), route('inventory-hasil.index')) || Str::startsWith(url()->current(), route('inventory-retur.index')) ? 'active' : '' }}">
                                    <a class="nav-link" data-bs-toggle="collapse" href="#inventory-dd"
                                        aria-expanded="false" aria-controls="inventory-dd">
                                        <i class="menu-icon mdi mdi-package"></i>
                                        <span class="menu-title">Inventories</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="collapse  {{ Str::startsWith(url()->current(), route('inventory-hasil.index')) || Str::startsWith(url()->current(), route('inventory-retur.index')) ? 'show' : '' }}"
                                        id="inventory-dd">
                                        <ul class="nav flex-column sub-menu">

                                            @if (auth()->user()->isManager || auth()->user()->isPetugasGudangHasil)
                                                <li
                                                    class="nav-item {{ Str::startsWith(url()->current(), route('inventory-hasil.index')) ? 'active' : '' }}">
                                                    <a class="nav-link"
                                                        href="{{ route('inventory-hasil.index') }}">Gudang
                                                        Hasil</a>
                                                </li>
                                            @endif

                                            @if (auth()->user()->isManager || auth()->user()->isPetugasGudangRetur)
                                                <li
                                                    class="nav-item {{ Str::startsWith(url()->current(), route('inventory-retur.index')) ? 'active' : '' }}">
                                                    <a class="nav-link"
                                                        href="{{ route('inventory-retur.index') }}">Gudang
                                                        Retur</a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>

                                @if (!auth()->user()->isPetugasGudangRetur)
                                    <li class="nav-item nav-category">Master Data</li>
                                @endif

                                @if (auth()->user()->isManager)
                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('users.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('users.index') }}">
                                            <i class="mdi mdi-account menu-icon"></i>
                                            <span class="menu-title">User</span>
                                        </a>
                                    </li>
                                @endif

                                @if (auth()->user()->isPetugasGudangHasil)
                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('penerbit.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('penerbit.index') }}">
                                            <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                                            <span class="menu-title">Penerbit</span>
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('buku.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('buku.index') }}">
                                            <i class="mdi mdi-book menu-icon"></i>
                                            <span class="menu-title">Buku</span>
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('distributor.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('distributor.index') }}">
                                            <i class="mdi mdi-store menu-icon"></i>
                                            <span class="menu-title">Distributor</span>
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('ukuran-buku.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('ukuran-buku.index') }}">
                                            <i class="mdi mdi-ruler menu-icon"></i>
                                            <span class="menu-title">Ukuran Buku</span>
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('grammatur.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('grammatur.index') }}">
                                            <i class="mdi mdi-decagram menu-icon"></i>
                                            <span class="menu-title">Grammatur</span>
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('cetak-isi.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('cetak-isi.index') }}">
                                            <i class="mdi mdi-image-filter-black-white menu-icon"></i>
                                            <span class="menu-title">Cetak Isi</span>
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('kertas-isi.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('kertas-isi.index') }}">
                                            <i class="mdi mdi-newspaper menu-icon"></i>
                                            <span class="menu-title">Kertas Isi</span>
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('finishing.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('finishing.index') }}">
                                            <i class="mdi mdi-format-color-fill menu-icon"></i>
                                            <span class="menu-title">Finishing</span>
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item {{ Str::startsWith(url()->current(), route('ukuran-kertas.index')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('ukuran-kertas.index') }}">
                                            <i class="mdi mdi-format-size menu-icon"></i>
                                            <span class="menu-title">Ukuran Kertas</span>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                        <!-- end sidebar -->
                    @endauth

                    <div class="main-panel">
                        <div class="content-wrapper py-4">
                            @yield('content')
                        </div>

                        <!-- footer -->
                        <footer class="footer">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                                        href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin
                                        template</a>
                                    from BootstrapDash.</span>
                                <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright ©
                                    2023.
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
