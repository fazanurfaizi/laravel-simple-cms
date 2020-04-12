<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- JQUERY --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    {{-- Ionicons --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- Theme Style --}}
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/css/adminlte.min.css') }}">
    {{-- ICheck --}}
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
    {{-- Morris Chart --}}
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    {{-- jvectormap --}}
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    {{-- Date Picker --}}
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    {{-- Daterange picker --}}
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        {{-- Navbar --}}
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <ul class="navbar-nav">
                <li class="navbar-item">
                    <a href="" class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        {{-- Navbar --}}

        {{-- Sidebar --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/" class="brand-link">
                <img src="{{ asset('plugins/adminlte/img/AdminLTELogo.png') }}"
                    alt="{{ config('app.name', 'PN Painan') }}" class="brand-image img-circle elevation-3"
                    style="opacity: .8"
                >
                <span class="brand-text font-weight-light">{{ config('app.name', 'PN Painan') }}</span>
            </a>
            <div class="sidebar">
                {{-- User Panel --}}
                <div class="user-panel mt-e pb-3 mb-3 d-flex mt-3">
                    <div class="image">
                        <img src="{{ asset('plugins/adminlte/img/avatar5.png') }}"
                            alt="User" class="img-circle elevation-2"
                        >
                    </div>
                    <div class="info">
                        <p class="d-block text-light">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                {{-- User Panel --}}

                {{-- Sidebar Menu --}}
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @php
                            $segment = Request::segment(2);
                        @endphp
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/news/') }}"
                                class="nav-link @if($segment == 'news') active @endif"
                            >
                                <i class="nav-icon fa fa-newspaper-o"></i>
                                <p>Berita</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/features/') }}"
                                class="nav-link @if($segment == 'features') active @endif"
                            >
                                <i class="nav-icon fa fa-star"></i>
                                <p>Fitur</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/blogs/') }}"
                                class="nav-link @if($segment == 'blogs') active @endif"
                            >
                                <i class="nav-icon fa fa-book"></i>
                                <p>Blog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/layanan-hukum') }}"
                                class="nav-link @if($segment == 'layanan-hukum') active @endif"
                            >
                                <i class="nav-icon fa fa-gavel"></i>
                                <p>Layanan Hukum</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/layanan-publik') }}"
                                class="nav-link @if($segment == 'layanan-publik') active @endif"
                            >
                                <i class="nav-icon fa fa-building-o"></i>
                                <p>Layanan Publik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/information') }}"
                                class="nav-link @if($segment == 'information') active @endif"
                            >
                                <i class="nav-icon fa fa-info-circle"></i>
                                <p>Layanan Informasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/about') }}"
                                class="nav-link @if($segment == 'about') active @endif"
                            >
                                <i class="nav-icon fa fa-address-card"></i>
                                <p>About Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/filemanager') }}"
                                class="nav-link @if($segment == 'about') active @endif"
                            >
                                <i class="nav-icon fa fa-file"></i>
                                <p>Filemanager</p>
                            </a>
                        </li>
                        <li class="nav-header"></li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                            >
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                {{ __('Logout') }}
                            </a>
                            <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                {{-- Sidebar Menu --}}
            </div>
        </aside>
        {{-- Sidebar --}}

        {{-- Content --}}
        <div class="content-wrapper">
            @yield('content')
        </div>
        {{-- Content --}}

        {{-- Footer --}}
        <div class="container text-center">
            <footer class="main-footer">
                <strong>Copyright &copy; {{ date('Y') }}
                    <a href="{{ config('app.url') }}">{{ config('app.name', 'Portal Berita') }}</a>
                    All rights reserved.
                </strong>
            </footer>
        </div>
        {{-- Footer --}}

        {{-- Sidebar control --}}
        <aside class="control-sidebar control-sidebar-dark"></aside>

    </div>

    {{-- Script --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/js/adminlte.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.1/plugins/autoresize/plugin.min.js"></script>
    <script src="{{ asset('js/tinymce.js') }}"></script>
    {{-- Script --}}

</body>
</html>
