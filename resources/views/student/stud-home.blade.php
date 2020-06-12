<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KIMS | Student Home</title>

    <link href="css/studbootstrap.css" rel="stylesheet" />
    <link href="css/fontAwesome.css" rel="stylesheet" />
    <link href="css/studcustom.css" rel="stylesheet" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style type="text/css">
        .img {
            border-radius: 100%;
            max-width: 100%
        }
        .img2 {
            border-radius: 200%;
            max-width:200px;
        }
    </style>
</head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        KIMS
                    </a>
                </div>
                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                    Welcome, {{ Auth::user()->name }} ! <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger square-btn-adjust"> {{ __('Logout') }} </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </nav> <!--NAV TOP-->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li class="text-center">
                            @if($profile->picture == null)
                                <img src="img/find_user.png" class="user-image img-responsive img"/>
                            @else
                                <img src="{{ url('images/'.$profile->picture) }}" class="user-image img-responsive img" alt="{{ $profile->name }}">
                            @endif
                        </li>
                        <li>
                            <a class="active-menu" href="{{ route('student.dashboard') }}"><i class="icon-bar fa fa-dashboard fa-lg"></i> Dashboard</a>
                        </li>
                        <li>
                            <a><i class="fa fa-user fa-lg"></i> Account <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('stprofile') }}">View Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('passchange') }}">Update Password</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a><i class="glyphicon glyphicon-ok-circle"></i> Attendance <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li>
                                    <a href="{{ route('qrcode') }}">QR Code</a>
                                </li>
                                <li>
                                    <a href="{{ route('view.attendance') }}">View Attendance</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('module') }}"><i class="glyphicon glyphicon-calendar"></i> Module </a>
                        </li>
                        <li>
                            <a href="{{ route('surveys') }}"><i class="glyphicon glyphicon-th-list"></i> Survey </a>
                        </li>
                    </ul>
                </div>
            </nav><!--side nav-->
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Dashboard</h2>
                        </div>
                    </div>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                      </ol>
                    </nav>
                    <hr /> <!--row-->
                    <div class="row">
                    <a href="{{ route('student.dashboard') }}">
                        <div class="col-md-6 col-md-12 col-md-6">           
                            <div class="panel panel-back noti-box">
                                <div class="text-box text-center">
                                    <p class="main-text">Dashboard</p>
                                </div>
                             </div>
                        </div>
                    </a>
                    <a href="{{ route('stprofile') }}">
                        <div class="col-md-6 col-md-12 col-md-6">           
                            <div class="panel panel-back noti-box">
                                <div class="text-box text-center" >
                                    <p class="main-text">Account</p>
                                </div>
                             </div>
                        </div>
                    </a>
                    <a href="{{ route('qrcode') }}">
                        <div class="col-md-6 col-sm-12 col-xs-6">           
                            <div class="panel panel-back noti-box">
                                <div class="text-box text-center" >
                                    <p class="main-text">Attendance</p>
                                </div>
                             </div>
                        </div>
                    </a>
                    <a href="{{ route('module') }}">
                        <div class="col-md-6 col-sm-12 col-xs-6">           
                            <div class="panel panel-back noti-box">
                                <div class="text-box text-center" >
                                    <p class="main-text">Module</p>
                                </div>
                             </div>
                        </div>
                    </a>
                    </div>
                    <div class="row">
                        <a href="{{ route('surveys') }}">
                        <div class="col-md-12 col-sm-12 col-xs-6">           
                            <div class="panel panel-back noti-box">
                                <div class="text-box text-center" >
                                    <p class="main-text">Survey</p>
                                </div>
                             </div>
                        </div>
                    </a>
                    </div>
                 <!-- /. ROW  -->

                </div><footer class="footer text-center">
                All Rights Reserved by UITMJ. Designed and Developed by NNI.
            </footer>
            </div>
        </div><!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <script src="js/studjquery-1.10.2.js"></script><!-- JQUERY SCRIPTS -->
        <script src="js/studbootstrap.min.js"></script><!-- BOOTSTRAP SCRIPTS -->
        <script src="js/studjquery.metisMenu.js"></script><!-- METISMENU SCRIPTS -->
        <script src="js/studcustom.js"></script><!-- CUSTOM SCRIPTS -->  
    </body>
</html>
