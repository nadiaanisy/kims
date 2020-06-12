<!DOCTYPE html>

<html dir="ltr" lang="en">



<head>

    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <title>KIMS | Admin Attendance Record</title>

    <link rel="stylesheet" type="text/css" href="../assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <link href="../dist/css/style.min.css" rel="stylesheet">

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

        .table {

                counter-reset: tableCount;     

            }

            .counterCell:before {              

                content: counter(tableCount); 

                counter-increment: tableCount; 

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

        .form-group > label:first-child {display: block}

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

                                <a class="dropdown-item" href="{{ route('ad.profile') }}"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>

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

                        <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Profile </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

                                <li class="sidebar-item"><a href="{{ route('ad.profile') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> View Profile </span></a></li>

                                <li class="sidebar-item"><a href="{{ route('ad.edit.pass') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Password Editor </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('ad.gallery') }}" aria-expanded="false"><i class="mdi mdi-image"></i><span class="hide-menu">Gallery</span></a></li>

                        <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('ad.attendance') }}" aria-expanded="false"><i class="mdi mdi-checkbox-multiple-blank-outline"></i><span class="hide-menu">Attendance Record</span></a></li>

                        <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('ad.module') }}" aria-expanded="false"><i class="mdi mdi-clipboard-outline"></i><span class="hide-menu">Module</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment-text-outline"></i><span class="hide-menu">Survey Manager</span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

                                <li class="sidebar-item"><a href="{{ route('ad.questions') }}" class="sidebar-link"><i class="mdi mdi-comment-question-outline"></i><span class="hide-menu"> Questions </span></a></li>

                                <li class="sidebar-item"><a href="{{ route('ad.surveys') }}" class="sidebar-link"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu"> Surveys </span></a></li>

                                <li class="sidebar-item"><a href="{{ route('ad.responses') }}" class="sidebar-link"><i class="mdi mdi-grease-pencil"></i><span class="hide-menu"> Responses </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('ad.report') }}" aria-expanded="false"><i class="mdi mdi-notification-clear-all"></i><span class="hide-menu">Report</span></a></li>

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

                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>

                                     <li class="breadcrumb-item"><a href="{{route('ad.attendance')}}">Attendance Options</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Assign Student</li>

                                </ol>

                            </nav>

                        </div>

                    </div>

                </div>

            </div>

            <div class="container-fluid">

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">KI ASSIGNER</h4>

                        <h6 class="card-subtitle">Assigning Students</h6>

                        <form action="{{route('todoo')}}" method="POST">

                            @csrf

                            <h4><u>KI DETAIL</u></h4>

                            <div align="right">

                                <a href="{{route('list.stud')}}" data-toggle="tooltip" title="Manually Assign" "><i class="fas fa-pencil-alt" style="font-size: 20px; color: black;"></i></a>

                            </div>

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

                            <div class="row">

                                <div class="col-sm-3">

                                    <label for="module">Choose Module (status: OPEN)</label>

                                    <select class="select2 form-control custom-select" name="module" id="module" style="width: 100%; height:36px;" required>

                                        <option disabled="">MODULE</option>

                                        @if(!empty($mod))

                                            @foreach($mod as $mods)

                                                <option value="{{$mods->id}}">{{$mods->modname}}</option>

                                            @endforeach

                                        @endif

                                    </select><br>

                                </div>

                                <div class="col-sm-3">

                                    <label for="group">How Many Group(s)</label>

                                    <input id="group" name="group" type="number" min="1" class="required form-control" style="width: 100%; height:36px;" required><br>

                                </div>

                                <div class="col-sm-2" style="margin-top: 30px;">

                                    <button type="submit" class="btn btn-md btn-info" style="height:36px;">Submit</button>

                                </div>

                            </div>

                        </form>

                        <hr>

                        <form action="{{route('saving')}}" method="post">

                            @csrf

                            @if(!empty($m))

                            <h5><i>DETAIL SELECTED</i></h5>

                                @foreach($m as $n)

                                    <p>MODULE: <input type="hidden" name="modid" value="{{$n->id}}" ><b>{{$n->modname}}</b></p>

                                @endforeach

                            @endif

                            @if(!empty($group))

                                <p>NO. OF GROUP(s): <input type="hidden" name="nogroup" value="{{$group}}"/><b>{{$group}}</b></p>

                            @endif

                            @if(!empty($counter))

                                <p><input type="hidden" name="counter" value="Jumlah pelajar: {{$counter}} orang"/></p>

                            @endif

                            @if(!empty($each))

                                <p><input type='hidden' name='each' value=" {{$each}}"></p>

                            @endif

                            <hr>

                            <?php

                                $senaraiid = array();

                                $senarainama = array();

                                $subsenarai = array();

                                if(!empty($finalresult))

                                {

                                    foreach($finalresult as $r) 

                                    {

                                        $senaraiid[] = $r->id;

                                        $senarainama[] = $r->name;

                                    }



                                    $j = 0;

                                    for($i=1; $i<=$group; $i++)

                                    {

                                        echo "<br><b>Group ".$i."</b><br>";

                                        

                                        $org = 1;

                                        while($org <= $each)

                                        {

                                            $subsenarai[] = $senaraiid[$j];

                                            echo $senarainama[$j] . "<br>";

                                            if($org == $each) {

                                                echo "<input type='text' name='input_name".$i."' value='".htmlentities(serialize($subsenarai))."' hidden/>";

                                                unset($subsenarai);

                                            }

                                            $j++;

                                            $org++;

                                        }

                                    }

                                ?>

                                <div style="margin-top: 30px;">

                                <button type="submit" id="abc" class="btn btn-md btn-info" style="height:36px;">Save</button>

                            </div>

                            <?php

                                }

                            ?>

                            

                        </form>

                    </div>

                </div>

                <footer class="footer text-center">

                    All Rights Reserved by UITMJ. Designed and Developed by NNI.

                </footer>

            </div>

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

    <script src="../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script>

        /*datwpicker*/

        jQuery('.mydatepicker').datepicker();

        jQuery('#datepicker-autoclose').datepicker({

            autoclose: true,

            todayHighlight: true

        });

    </script>

    <script type="text/javascript">

         //$('#abc').hide();

    </script>

</body>



</html>