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

    <title>KIMS | Student Attendance</title>

    <link href="css/studbootstrap.css" rel="stylesheet" />
    <link href="css/fontAwesome.css" rel="stylesheet" />
    <link href="js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="css/studcustom.css" rel="stylesheet" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <style type="text/css">
       .outline {
            background-color: transparent;
            color: inherit;
            transition: all .25s;
        }
        .btn-primary.outline {
            color: #428bca;
        }
        .btn-success.outline {
            color: #5cb85c;
        }
        .btn-info.outline {
            color: #5bc0de;
        }
        .btn-warning.outline {
            color: #f0ad4e;
        }
        .btn-danger.outline {
            color: #d9534f;
        }
        .btn-primary.outline:hover,
        .btn-success.outline:hover,
        .btn-info.outline:hover,
        .btn-warning.outline:hover,
        .btn-danger.outline:hover {
            color: #fff;
        }
        .table {
            counter-reset: tableCount;     
        }
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
                            <a class="active-menu"><i class="glyphicon glyphicon-ok-circle"></i> Attendance <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li>
                                    <a href="{{ route('qrcode') }}">QR Code</a>
                                </li>
                                <li>
                                    <a class="active-menu" href="{{ route('view.attendance') }}">View Attendance</a>
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
                            <h2>Attendance Section</h2>   
                        </div>
                    </div>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Attendance</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Attendance</li>
                      </ol>
                    </nav>
                    <hr /> <!--row-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   Attendance Details
                                </div>
                                <div class="panel-body">
                                    @if(!empty($data))
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">#</th>
                                                    <th rowspan="2">Module Name</th>
                                                    <th rowspan="2">Session</th>
                                                    <th colspan="3" style="text-align: center;">Completion Details</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center;">Date/Time</th>
                                                    <th rowspan="2">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $value)
                                                <tr>
                                                    <td class="counterCell"></td>
                                                    <td>{{ $value->modname }}</td>
                                                    <td>{{ $value->smsession }} </td>
                                                    <td class="center">{{ $value->time }}</td>
                                                    @if($value->status == NULL)
                                                        <td><font color="red">DID NOT ATTEND</td>
                                                    @else
                                                        <td><font color="blue">{{ $value->status }}</td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <div align="right">
                                        <a href="{{action('StudentController@downloadPDF', $profile->id)}}">
                                            <input type="submit" class="btn btn-primary" name="printAtt" onclick="detailA();" value="Print Attendance">
                                        </a>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                          <p>You are not being assigned to any module or attended any module related to this program. Please come again to check for the latest update from the admin. If you have any inquiries, do not hesitate to contact the admin regarding the problem or any inconvenience.</p>
                                          <hr>
                                          <p class="mb-0">Whenever you need to, be sure to multi check the connection!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
                    <!-- /. ROW  -->
                </div>  
            </div>
             <!-- /. PAGE INNER  -->
             <footer class="footer text-center">
                All Rights Reserved by UITMJ. Designed and Developed by NNI.
            </footer>
        </div><!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <script src="js/studjquery-1.10.2.js"></script>
        <script src="js/studjquery.min.js"></script><!-- JQUERY SCRIPTS -->
        <script src="js/studbootstrap.min.js"></script><!-- BOOTSTRAP SCRIPTS -->
        <script src="js/studjquery.metisMenu.js"></script><!-- METISMENU SCRIPTS -->
         <!-- MORRIS CHART SCRIPTS -->
        <script src="js/morris/raphael-2.1.0.min.js"></script>
        <script src="js/morris/morris.js"></script>
        <script src="js/studcustom.js"></script><!-- CUSTOM SCRIPTS -->  
        <script src="js/dataTables/jquery.dataTables.js"></script>
        <script src="js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
        </script>
        <script type="text/javascript">
         <!--
            function detailA() {
               alert ("You are about to print an attendance!");
               //document.write ("This is a warning message!");
            }
            function detailC() {
               alert ("You are about to print a certificate!");
               //document.write ("This is a warning message!");
            }
         //-->
      </script>
    </body>
</html>
