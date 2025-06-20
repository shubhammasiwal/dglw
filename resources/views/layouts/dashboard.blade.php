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
        @stack('styles')

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

                @role(['portal_admin', 'admin', 'welfare_commissioner', 'data_operator'])
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
                                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                {{-- Check for active menu for Worker --}}
                                @php
                                    $worker_active = request()->routeIs('register-worker');
                                @endphp
                                <li class="nav-item {{ $worker_active ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ $worker_active ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>
                                            Worker's Menu
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('register-worker') }}" class="nav-link {{ request()->routeIs('register-worker') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Register Worker</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Registered Workers</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Generate ID Card</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Add Family Member</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Add Benefit</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>View Benefits</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @unlessrole('data_operator')
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
                                                <a href=#" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Report 1</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Report 2</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    {{-- Check for active menu for Directory Code --}}
                                    @php
                                        $directory_code_active = request()->routeIs('code-directory.index') || request()->routeIs('marital-status.index') || request()->routeIs('social-category.index') || request()->routeIs('gender.index') || request()->routeIs('worker-relationship.index') || request()->routeIs('worker-type.index') || request()->routeIs('disability.index') || request()->routeIs('education.index') || request()->routeIs('migration-reason.index') || request()->routeIs('address-type.index');
                                    @endphp
                                    <li class="nav-item {{ $directory_code_active ? 'menu-open' : '' }}">
                                        <a href="#" class="nav-link {{ $directory_code_active ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-folder-open"></i>
                                            <p>
                                                Directory Code
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ route('code-directory.index') }}" class="nav-link {{ request()->routeIs('code-directory.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>All Codes</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('marital-status.index') }}" class="nav-link {{ request()->routeIs('marital-status.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Marital Status</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('social-category.index') }}" class="nav-link {{ request()->routeIs('social-category.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Social Category</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('gender.index') }}" class="nav-link {{ request()->routeIs('gender.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Gender</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('worker-relationship.index') }}" class="nav-link {{ request()->routeIs('worker-relationship.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Worker Relationship</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('worker-type.index') }}" class="nav-link {{ request()->routeIs('worker-type.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Worker Type</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('disability.index') }}" class="nav-link {{ request()->routeIs('disability.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Disability</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('education.index') }}" class="nav-link {{ request()->routeIs('education.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Education</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('migration-reason.index') }}" class="nav-link {{ request()->routeIs('migration-reason.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Migration Reason</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('address-type.index') }}" class="nav-link {{ request()->routeIs('address-type.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Address Type</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    {{-- Check for active menu for LGD Code --}}
                                    @php
                                        $lgd_code_active = request()->routeIs('l-g-d-state.index') || request()->routeIs('l-g-d-district.index');
                                    @endphp
                                    <li class="nav-item {{ $lgd_code_active ? 'menu-open' : '' }}">
                                        <a href="#" class="nav-link {{ $lgd_code_active ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-folder-open"></i>
                                            <p>
                                                LGD Code
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ route('l-g-d-state.index') }}" class="nav-link {{ request()->routeIs('l-g-d-state.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>LGD State</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('l-g-d-district.index') }}" class="nav-link {{ request()->routeIs('l-g-d-district.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>LGD DIstrict</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endunlessrole
                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                @endrole
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
        <!-- Summernote -->
        <script src="{{ asset('vendor/summernote/js/summernote-bs4.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('vendor/overlayScrollbars/js/OverlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.js') }}"></script>
        @stack('scripts')
    </body>

</html>
