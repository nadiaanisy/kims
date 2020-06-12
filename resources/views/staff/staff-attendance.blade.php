<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>KIMS | Staff Attendance Record</title>
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link href="../css/qrstyle.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="../css/datatables.min.css" rel="stylesheet">
    <style type="text/css">
        .img {
            border-radius: 100%;
            max-width: 100%
        }
        .img2 {
            border-radius: 200%;
            max-width:200px;
        }
        .table {
            counter-reset: tableCount;     
        }
        .counterCell:before {              
            content: counter(tableCount); 
            counter-increment: tableCount; 
        } 
        .img3 {
            width: 50px;
            height: 50px;
        }
        .dropdown-menu-action {left:-130%;}
        .btn-group-action .btn-action {cursor: default}
        #box-header-module {box-shadow:10px 10px 10px #dddddd;}
        .sub-module-tab li {background: #F9F9F9;cursor:pointer;}
        .sub-module-tab li.active {background: #ffffff;box-shadow: 0px -5px 10px #cccccc}
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {border:none;}
        .nav-tabs>li>a {border:none;}                
        .breadcrumb {
            margin:0 0 0 0;
            padding:0 0 0 0;
        }
        .option {
          margin: 0.5em;
        }
        .form-group > label:first-child {display: block}
         .unwanted {
                display: none;
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
                        <!--Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--<img src="{{ url('img/UiTM.png') }}" class="light-logo logo" height="50" width="50"/>-->
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
                        <h4 class="page-title">Attendance Record</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('staff.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Attendance Record</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active mdi mdi-account-search" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"></a>
                                        <a class="nav-item nav-link mdi mdi-qrcode-scan" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"></a>
                                        <a class="nav-item nav-link fa fa-hourglass" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"></a>
                                        <!-- <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">About</a> -->
                                    </div>
                                </nav>
                                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <h5 class="card-title">List of Students</h5>
                                        @if(!empty($v3))
                                            <div class="table-responsive">
                                                <table class="table" id="tableAttendance">
                                                    <thead>
                                                        <tr class="info">
                                                            <th scope="col">#</th>
                                                            <th scope="col">Matric No</th>
                                                            <th scope="col" width="20%">Name</th>
                                                            <th scope="col">Course Code</th>
                                                            <th scope="col">Part</th>
                                                            <th scope="col">Group</th>
                                                            <th scope="col">Session</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="attendance-list" name="attendance-list">
                                                    @foreach ($v3 as $v)
                                                    <tr id="student{{$v->id}}">
                                                        <td class="counterCell"></td>
                                                        <td>{{ $v->studentid }}</td>
                                                        <td>{{ $v->name }}</td>
                                                        <td>{{ $v->cprog }}</td>
                                                        <td>{{ $v->part }}</td>
                                                        <td>{{ $v->smgroup }}</td>
                                                        <td>{{ $v->smsession }}</td>
                                                        @if($v->status == '')
                                                            <td><font color="yellow"><b>DID NOT ATTEND</b></td>
                                                        @elseif($v->status == 'ATTENDED')
                                                            <td><font color="green"><b>{{ $v->status }}</b></td>
                                                        @else
                                                            <td><font color="red"><b>{{$v->status}}</b></td>
                                                        @endif
                                                        <td>
                                                            <button class="btn btn-warning btn-detail open_modal" value="{{ $v->id }}"><i class="mdi mdi-account-search"></i></button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="alert alert-danger" role="alert">
                                          <p>You are not being assigned to any students related to this program. Please come again to check for the latest update from the admin. If you have any inquiries, do not hesitate to contact the admin regarding the problem or any inconvenience.</p>
                                          <hr>
                                          <p class="mb-0">Whenever you need to, be sure to multi check the connection!</p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div id="scan">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Attendance Scanner</h4><br/><br/>
                                                    <div class="container" id="QR-Code"><br>
                                                        <div class="navbar-form navbar-right unwanted">
                                                            <select class="form-control" id="camera-select"></select>
                                                            <div class="form-group ">
                                                                <input id="image-url" type="text" class="form-control" placeholder="Image url">
                                                                <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-upload"></span></button>
                                                                <button title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-picture"></span></button>
                                                                <!--<button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-play"></span></button>
                                                                <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-pause"></span></button>
                                                                <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"></span></button>-->
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                                <div style="position: relative;display: inline-block;">
                                                                    <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
                                                                    <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                                                    <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                                                    <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                                                    <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                                                                </div><br />
                                                                <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip">SCAN</button>
                                                                <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip">PAUSE</button>
                                                                <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip">STOP</button>
                                                                <!--<button title="Submit" class="btn btn-primary btn-sm" type="button" data-toggle="tooltip">SUBMIT</button>-->
                                                            <br>
                                                                <div class="thumbnail" id="result">
                                                                    <div class="well unwanted">
                                                                        <img width="320" height="240" id="scanned-img" src="">
                                                                    </div>
                                                                    <div class="caption">
                                                                        <hr>
                                                                        <h5>Scanned result</h5>
                                                                        <!--<p id="scanned-QR" name="scanned">QR Code: 2016716981 QR Code: 2014484206</p>-->
                                                                        <p id="scanned-QR"> </p>
                                                                        <button title="Detail" onclick="details()" class='btn btn-md btn-default' type="button" data-toggle="tooltip">Detail</button>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div align="right">
                                                        <a href="#" data-toggle="tooltip" title="Manual" onclick="input(2)"><i class="fas fa-pencil-alt" style="font-size: 20px; color: black;"></i></a>
                                                    </div>
                                                    <div id='scannedresult'>
                                                        <h4>Scanned Result</h4>
                                                        <table class="table">
                                                            <tr>
                                                                <th>NAME</th>
                                                                <td id="name"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>MATRIC NO</th>
                                                                <td id="matricno"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>MODULE ID</th>
                                                                <td id="moduleid"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>MODULE NAME</th>
                                                                <td id="modulename"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>GROUP</th>
                                                                <td id="modulegroup"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>FACILITATOR</th>
                                                                <td id="modulefaci"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>PLACE</th>
                                                                <td id="moduleplace"></td>
                                                            </tr>
                                                        </table>
                                                        <p id="attendno" hidden></p>
                                                        <th>REMARK : </th><b id="test"></b>
                                                        <button onClick="attendbtn()" class='btn btn-md btn-primary' id="attendbtn" value='Attend' style="float:right;">ATTEND</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="manual">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="ids" class="col-sm-3 text-right control-label col-form-label">Matric No</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="ids" class="form-control" id="ids" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row offset-sm-4">
                                                        <div class="col-md-6 col-md-offset-1">
                                                            <button title="Detail" onclick="details()" class='btn btn-md btn-default' type="submit" data-toggle="tooltip">Detail</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div align="right">
                                                        <a href="#" data-toggle="tooltip" title="Scan QR-Code" onclick="input(1)"><i class="fas fa-qrcode" style="font-size: 20px; color: black;"></i></a>
                                                    </div>
                                                    <div id='scannedresult1'>
                                                        <h4>Scanned Result</h4>
                                                        <table class="table">
                                                            <tr>
                                                                <th>NAME</th>
                                                                <td id="name1"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>MATRIC NO</th>
                                                                <td id="matricno1"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>MODULE ID</th>
                                                                <td id="moduleid1"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>MODULE NAME</th>
                                                                <td id="modulename1"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>GROUP</th>
                                                                <td id="modulegroup1"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>FACILITATOR</th>
                                                                <td id="modulefaci1"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>PLACE</th>
                                                                <td id="moduleplace1"></td>
                                                            </tr>
                                                        </table>
                                                        <p id="attendno1" hidden></p>
                                                        <th>REMARK : </th><b id="test1"></b>
                                                        
                                                        <button onClick="attendbtn()" class='btn btn-md btn-primary' id="attendbtn1" value='Attend' style="float:right;">ATTEND</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>          
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <h5 class="card-title">End Of KI</h5>
                                        <h6 class="card-subtitle">Note that if you click to Update, no changes can be made after submitting.</h6>
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success alert-block">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @endif
                                        @if(!empty($end))
                                       <form method="POST" action="{{route('end.ki')}}">
                                        @csrf
                                           @foreach($end as $e)
                                        <div class="form-group row">
                                            <label for="module" class="col-sm-3 text-right control-label col-form-label">Module</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="module" name="module" value="{{$e->modname}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mgroup" class="col-sm-3 text-right control-label col-form-label">Group</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="mgroup" name="mgroup" value="{{$e->msgroup}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="day" class="col-sm-3 text-right control-label col-form-label">Date</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="day" name="day" value="{{$e->msdate}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="place" class="col-sm-3 text-right control-label col-form-label">Place</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="place" name="place" value="{{$e->nama_tempat}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="endki" class="col-sm-3 text-right control-label col-form-label">End KI?</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="endki" name="endki" value="YES" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="modid" name="modid" value="{{$e->modid}}" hidden>
                                            </div>
                                        </div>
                                        <div class="form-group row offset-sm-10">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-md btn-info"> Update
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                       </form>
                                       @else
                                    <div class="form-group row">
                                            <label for="module" class="col-sm-3 text-right control-label col-form-label">Module</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="module" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mgroup" class="col-sm-3 text-right control-label col-form-label">Group</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="mgroup" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="day" class="col-sm-3 text-right control-label col-form-label">Date</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="day" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="place" class="col-sm-3 text-right control-label col-form-label">Place</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="place" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="endki" class="col-sm-3 text-right control-label col-form-label">End KI?</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="endki" value="YES" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row offset-sm-10">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-md btn-info"> Update
                                                </button>
                                            </div>
                                        </div>
                                       @endif
                                    </div>
                                </div>
                                <!-- Passing BASE URL to AJAX -->
                                <input id="url" type="hidden" value="{{ \Request::url() }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--MODAL SECTION-->
            <div class="modal fade" id="viewStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Student Detail </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" class="form-horizontal" id="viewStudentForm" name="viewStudentForm">
                                <div class="form-group">
                                    <label class="control-label" for="studname">Student Name:</label>
                                    <input type="text" name="studname" id="studname" class="form-control" readonly />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="cno">Student Contact No:</label>
                                    <input type="text" name="cno" id="cno" class="form-control" readonly />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="moduleAttended">Module Attended:</label>
                                    <input type="text" name="moduleAttended" id="moduleAttended" class="form-control" readonly />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="hidden" id="student_id" name="student_id">
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
    <!-- this page js -->
    <script src="../js/dataTables/datatables.min.js"></script>
    <script>
       $(document).ready( function() {
            $('#tableAttendance').DataTable();
        });
    </script>
    <script type="text/javascript">
        $(document).ready( function() {
            $(document).on('click','.open_modal', function(){
                var url = $('#url').val();
                var smid = $(this).val();

                // Populate Data in Modal to view detail
                $.ajax
                ({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: url + '_id=' + smid,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "smID": smid
                    },
                    cache: false,
                    contentType: 'application/json; charset=utf-8',
                    success: function(response) //response tu variable
                    {
                        console.log(response);
                        if(response)
                        {
                            $("#studname").val(response[0].name);
                            $("#cno").val(response[0].contact);
                             $("#moduleAttended").val(response[0].modname + " - " + response[0].status);
                            /*if(response[0] == "HAVE MODULE")
                            {
                                $("#moduleAttended").val(response[2].modname + " - " + response[2].status);
                            }
                            else
                            {
                                $("#moduleAttended").val("Not assigned.");
                            }*/
                            $("#viewStudent").modal('show');
                            //if()
                        }
                    }
                });
            });
        });
    </script>
    <!-- QRCODE SCRIPTS -->
    <script type="text/javascript" src="../js/jsqr/filereader.js"></script>
    <!-- Using jquery version: -->
    <!--
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/qrcodelib.js"></script>
        <script type="text/javascript" src="js/webcodecamjquery.js"></script>
        <script type="text/javascript" src="js/mainjquery.js"></script>
        <script type="text/javascript" src="../js/jsqr/DecoderWorker.js"></script>
    -->
    <script type="text/javascript" src="../js/jsqr/qrcodelib.js"></script>
    <script type="text/javascript" src="../js/jsqr/webcodecamjs.js"></script>
    <script type="text/javascript" src="../js/jsqr/main.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
    <script type="text/javascript">
        $("#scannedresult").hide();
        $("#scannedresult1").hide();
        $("#attendbtn").hide();
        $("#attendbtn1").hide();
        $("#manual").hide();

        function details() {
            var para = document.getElementById('scanned-QR');
            var text = para.firstChild.nodeValue; // will give the first text node's value
            //var res = text.substring(9);
            var output = "";
            if(text !== "Scanning ..." && text !== "Paused" && text !== "Stopped")
            {
                if(text !== " ")  //scan ada, input xde   == guna text
                {
                    var res = text.substring(9);
                    output = 1;
                }
                else   //scan xde, input ada   == guna ids
                {
                    if($("#ids").val() == null || $("#ids").val() == "")
                    {
                        alert("Please enter the matric number!");
                    }
                    else if($("#ids").val() !== null || $("#ids").val() !== "")
                    {
                        var res = $("#ids").val();
                        output = 1;
                    }
                }
            }
            else  
            {
                alert("Please scan the QR-Code!");
            }

            if(output == 1)
            {
                $.ajax
                ({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: 'staff_scannedresult',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": res
                    },
                    cache: false,
                    contentType: 'application/json; charset=utf-8',
                    success: function(response) //response tu variable
                    {
                        console.log(response);
                        if(response)
                        {
                            var obj = JSON.parse(response);
                            var result = obj[0];
                            document.getElementById("name").innerText = document.getElementById("name1").innerText = 'No data found';
                            document.getElementById("matricno").innerText = document.getElementById("matricno1").innerText = 'No data found';
                            document.getElementById("moduleid").innerText = document.getElementById("moduleid1").innerText = 'No data found';
                            document.getElementById("modulename").innerText = document.getElementById("modulename1").innerText = 'No data found';
                            document.getElementById("modulegroup").innerText = document.getElementById("modulegroup1").innerText = 'No data found';
                            document.getElementById("modulefaci").innerText = document.getElementById("modulefaci1").innerText = 'No data found';
                            document.getElementById("moduleplace").innerText = document.getElementById("moduleplace1").innerText = 'No data found';

                            if(result.includes("Ada data"))        //ada data
                            {
                                //scan
                                document.getElementById("name").innerText = document.getElementById("name1").innerText = (obj[1].name);
                                document.getElementById("matricno").innerText = document.getElementById("matricno1").innerText = (obj[1].id);
                                $("#scannedresult").show();
                                $("#scannedresult1").show();
                            }
                            if(result.includes("Kena datang")) //ada data, kena dtg, tempat salah
                            {
                                document.getElementById("moduleid").innerText = document.getElementById("moduleid1").innerText = (obj[2].smmodid);
                                document.getElementById("modulename").innerText = document.getElementById("modulename1").innerText = (obj[2].smmodname);
                                document.getElementById("modulegroup").innerText = document.getElementById("modulegroup1").innerText = (obj[2].mssmgroup);
                                document.getElementById("modulefaci").innerText = document.getElementById("modulefaci1").innerText = (obj[2].staffname);
                                document.getElementById("moduleplace").innerText = document.getElementById("moduleplace1").innerText = (obj[2].place);
                                document.getElementById("test").innerText = document.getElementById("test1").innerText = "You are at the wrong place / No place assigned.";
                                $("#scannedresult").show();
                                $("#scannedresult1").show();
                                $("#attendbtn").hide();
                                $("#attendbtn1").hide();
                            }
                            if(result.includes("Tempat betul")) //ada data, kena dtg, tempat betul
                            {
                                document.getElementById("attendno").innerText = document.getElementById("attendno1").innerText = (obj[2].smno);
                                document.getElementById("modulefaci").innerText = document.getElementById("modulefaci1").innerText = (obj[2].mssmgroup);
                                document.getElementById("modulefaci").innerText = document.getElementById("modulefaci1").innerText = (obj[2].staffname);
                                document.getElementById("moduleplace").innerText = document.getElementById("moduleplace1").innerText = (obj[2].place);
                                document.getElementById("test").innerText = document.getElementById("test1").innerText = "You are at the right place";
                                alert("You are at the right place!");
                                $("#attendbtn").show();
                                $("#attendbtn1").show();
                                $("#scannedresult").show();
                                $("#scannedresult1").show();
                            }
                            if(result.includes("Tak kena datang"))
                            {
                                document.getElementById("modulegroup").innerText = document.getElementById("modulegroup1").innerText = "No data found";
                                document.getElementById("test").innerText = document.getElementById("test1").innerText = "You're not assigned to any group";
                                alert("You're not assigned to any group!");
                                $("#scannedresult").show();
                                $("#scannedresult1").show();
                                $("#attendbtn").hide();
                                $("#attendbtn1").hide();
                            }
                            if(result.includes("Takada data"))
                            {
                                alert("No data found/Matric No entered is not belongs to any student!");
                                $("#scannedresult").hide();
                                $("#scannedresult1").hide();
                            }
                        }
                    }

                });
            }
        }
    </script>
    <script type="text/javascript">
        function attendbtn()
        {
            var result = document.getElementById("matricno").innerText;
            var smno = document.getElementById("attendno").innerText;
            //alert(result);
            $.ajax
            ({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: 'staff_scannedresult_a',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "studID": result,
                    "smno": smno
                },
                cache: false,
                contentType: 'application/json; charset=utf-8',
                success: function(response) //response tu variable
                {
                    alert(response);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>
    <script>
        function input(num)
        {
            if(num == 1) 
            {
                $("#manual").hide();
                $("#scan").show();
            }
            else if(num == 2)
            {
                $("#manual").show();
                $("#scan").hide();
            }
        }
    </script>
</body>

</html>