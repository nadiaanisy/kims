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

    <title>KIMS | Student Password Editor</title>

    <link href="css/studbootstrap.css" rel="stylesheet" />
    <link href="css/fontAwesome.css" rel="stylesheet" />
    <link href="js/morris/morris-0.4.3.min.css" rel="stylesheet" />
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
                        <a href="{{ route('student.dashboard') }}"><i class="icon-bar fa fa-dashboard fa-lg"></i> Dashboard</a>
                    </li>
                    <li>
                        <a class="active-menu"><i class="fa fa-user fa-lg"></i> Account <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('stprofile') }}">View Profile</a>
                            </li>
                            <li>
                                <a class="active-menu" href="{{ route('passchange') }}">Update Password</a>
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
                        <h2>Profile</h2>   
                    </div>
                </div>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Password</li>
                  </ol>
                </nav>
                <hr /> <!--row-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Password Editor
                    </div>
                    <div class="panel-body">
                        <br />
                        <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for="current-password" class="col-md-4 control-label">Current Password</label>

                                <div class="col-md-6">
                                    <input id="current-password" type="password" class="form-control" name="current-password" required>

                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control" name="new-password" required>

                                    @if ($errors->has('new-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                                <div class="col-md-6">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>               
                </div>
            </div> 
        </div>
        <footer class="footer text-center">
                All Rights Reserved by UITMJ. Designed and Developed by NNI.
            </footer>
    </div>
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <script src="js/studjquery-1.10.2.js"></script><!-- JQUERY SCRIPTS -->
    <script src="js/studbootstrap.min.js"></script><!-- BOOTSTRAP SCRIPTS -->
    <script src="js/studjquery.metisMenu.js"></script><!-- METISMENU SCRIPTS -->
     <!-- MORRIS CHART SCRIPTS -->
    <script src="js/morris/raphael-2.1.0.min.js"></script>
    <script src="js/morris/morris.js"></script>
    <script src="js/studcustom.js"></script><!-- CUSTOM SCRIPTS -->  
</body>
</html>
