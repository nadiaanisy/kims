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



    <title>KIMS | Student Module</title>



    <link href="css/studbootstrap.css" rel="stylesheet" />

    <link href="css/fontAwesome.css" rel="stylesheet" />

    <link href="js/morris/morris-0.4.3.min.css" rel="stylesheet" />

    <link href="css/studcustom.css" rel="stylesheet" />



    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <style>

     .counterCell:before {              

            content: counter(tableCount); 

            counter-increment: tableCount; 

        }

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

                            <a class="active-menu" href="{{ route('module') }}"><i class="glyphicon glyphicon-calendar"></i> Module </a>

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

                            <h2>KI-Module</h2>   

                        </div>

                    </div>

                    <nav aria-label="breadcrumb">

                      <ol class="breadcrumb">

                        <li class="breadcrumb-item active" aria-current="page">Module</li>

                      </ol>

                    </nav>

                    <hr /> <!--row-->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            Modules

                        </div>

                        

                        <div class="panel-body">

                            @if(!empty($data))

                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>Module Name</th>

                                                <th>Status</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach($data as $value)

                                            <tr>

                                                <td class="counterCell"></td>

                                                <td>{{ $value->modname }}</td>

                                                <td>{{ $value->modstatus }}</td>

                                                <td>

                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#k1">View</button>

                                                    <div class="modal fade" id="k1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                                        <div class="modal-dialog">

                                                            <div class="modal-content">

                                                                <div class="modal-header">

                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                                                    <h4 class="modal-title" id="myModalLabel">{{ $value->modname }}</h4>

                                                                </div>

                                                                <div class="modal-body">

                                                                    <p><b>DESCRIPTION</b> : {{ $value->moddesc }}</p>

                                                                    <p><b>TIME</b> : {{ $value->modtime }}</p>

                                                                    <p><b>GROUP</b> : {{ $value->smgroup }} </p>

                                                                    <p><b>PLACE</b> : {{ $value->nama_tempat }} </p>

                                                                </div>

                                                                <div class="modal-footer">

                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </td>

                                            </tr>

                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                            @else

                                <div class="alert alert-danger" role="alert">

                                  <p>There are no module to be attend related to this program. Please come again to check for the latest update from the admin. If you have any inquiries, do not hesitate to contact the admin regarding the problem or any inconvenience.</p>

                                  <hr>

                                  <p class="mb-0">Whenever you need to, be sure to multi check the connection!</p>

                                </div>

                            @endif

                        </div>

                    </div>              

                </div>

                <footer class="footer text-center">

                All Rights Reserved by UITMJ. Designed and Developed by NNI.

            </footer>

            </div>

        </div><!-- /. WRAPPER  -->

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

