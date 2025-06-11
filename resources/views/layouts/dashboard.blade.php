<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME') }} | @yield('title', env('APP_NAME'))</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        {{-- <link rel="stylesheet" href="{{ asset('vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/css/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('vendor/daterangepicker/css/daterangepicker.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('vendor/summernote/css/summernote-bs4.min.css') }}">
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('images/arrow_clockwise.png') }}" alt="AdminLTELogo"
                    height="60" width="60">
            </div>

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('dashboard') }}" class="nav-link">DGLW</a>
                    </li>
                </ul>

                <!-- Right navbar links --> 
                <ul class="navbar-nav ml-auto">
                <!-- Profile Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="nav-icon fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">{{ Auth::user()->name }}</span>
                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <i class="nav-icon fas fa-lock mr-2"></i>
                                
                                <span class="text-muted text-sm">Change Password</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                            >
                                <i class="nav-icon fas fa-sign-out-alt mr-2"></i>
                                <span class="text-muted text-sm">Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ route('dashboard') }}" class="brand-link">
                    <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('images/profile_picture_101.jpg') }}" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Worker's Menu
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('register-worker') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Register Worker</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Registered Workers</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/layout/boxed.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Generate ID Card</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Family Member</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Benefit</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Benefits</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Reports
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/charts/chartjs.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Report 1</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/charts/flot.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Report 2</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-folder-open"></i>
                                    <p>
                                        Directory Code
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/UI/general.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>States</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/UI/icons.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Districts</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/UI/buttons.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Categories</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2025 <a href="#">NIC</a></strong>
                All rights reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('vendor/adminlte/dist/js/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('vendor/adminlte/dist/js/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('vendor/adminlte/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('vendor/chart.js/js/chart.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('vendor/sparklines/js/sparklines.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('vendor/jquery/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery/jquery.vmap.usa.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('vendor/jquery/jquery-knob.min.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('vendor/moment/js/moment.min.js') }}"></script>
        <script src="{{ asset('vendor/daterangepicker/js/daterangepicker.min.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        {{-- <script src="{{ asset('vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
        <!-- Summernote -->
        <script src="{{ asset('vendor/summernote/js/summernote-bs4.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('vendor/overlayScrollbars/js/OverlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('vendor/adminlte/dist/js/demo.js') }}"></script>
        {{-- <script defer src="{{ asset('vendor/cloudflare/beacon.min.js') }}"
            data-cf-beacon='{"rayId":"94d83f2398b3ad28","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.5.0","token":"2437d112162f4ec4b63c3ca0eb38fb20"}'
            crossorigin="anonymous"></script> --}}
    </body>

</html>
