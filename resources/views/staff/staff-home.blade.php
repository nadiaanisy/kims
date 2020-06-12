<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>KIMS | Staff Home</title>
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"></script> -->
    <style type="text/css">
        .img {
            border-radius: 100%;
            max-width: 100%
        }
        .img2 {
            border-radius: 200%;
            max-width:200px;
        }
        .img3 {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <b class="logo-icon p-l-10"><!--Logo icon -->
                            <!--<img src="../assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                           -->
                        </b>
                        <span class="logo-text">
                            KIMS
                        </span>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                        <ul class="navbar-nav float-left mr-auto">
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav float-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if($profile->picture == null)
                                        <img src="../img/find_user.png" class="user-image img-responsive img3 rounded-circle"/>
                                    @else
                                        <img src="{{ url('images/'.$profile->picture) }}" alt="user" class="rounded-circle" width="31">
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="left-sidebar" data-sidebarbg="skin5">
                <div class="scroll-sidebar">
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav" class="p-t-30">
                            <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('staff.dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Profile </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="{{ route('profile') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> View Profile </span></a></li>
                                    <li class="sidebar-item"><a href="{{ route('staff.edit.pass') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Password Editor </span></a></li>
                                </ul>
                            </li>
                            <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('gallery') }}" aria-expanded="false"><i class="mdi mdi-image"></i><span class="hide-menu">Gallery</span></a></li>
                            <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('staff.attendance') }}" aria-expanded="false">
                            <i class="mdi mdi-checkbox-multiple-blank-outline"></i><span class="hide-menu">Attendance Record</span></a></li>
                            <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('staff.module') }}" aria-expanded="false"><i class="mdi mdi-clipboard-outline"></i><span class="hide-menu">Module</span></a></li>
                            <!--
                            <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="/adsurveys" aria-expanded="false"><i class="mdi mdi-comment-text-outline"></i><span class="hide-menu">Survey</span></a></li>
                            <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="/adreport" aria-expanded="false"><i class="mdi mdi-notification-clear-all"></i><span class="hide-menu">Report</span></a></li>-->
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="page-wrapper">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-12 d-flex no-block align-items-center">
                            <h4 class="page-title">Profile</h4>
                            <div class="ml-auto text-right">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Home
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container-fluid">
                   <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-6 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <a href="{{ route('staff.dashboard') }}">
                                    <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                    <h6 class="text-white">Dashboard</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-6 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <a href="{{ route('profile') }}">
                                    <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                    <h6 class="text-white">Profile</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <a href="{{ route('gallery') }}">
                                    <h1 class="font-light text-white"><i class="mdi mdi-image"></i></h1>
                                    <h6 class="text-white">Gallery</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <a href="{{ route('staff.attendance') }}">
                                    <h1 class="font-light text-white"><i class="mdi mdi-checkbox-multiple-blank-outline"></i></h1>
                                    <h6 class="text-white">Attendance Record</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <a href="{{ route('staff.module') }}">
                                    <h1 class="font-light text-white"><i class="mdi mdi-clipboard-outline"></i></h1>
                                    <h6 class="text-white">Module</h6>
                                </a
                                
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer text-center">
                    All Rights Reserved by UITMJ. Designed and Developed by NNI.
                </footer>
            </div>
        </div>
        
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
        <!--Wave Effects -->
        <script src="../dist/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="../dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="../dist/js/custom.min.js"></script>
    </body>
</html>    