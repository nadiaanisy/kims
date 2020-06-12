<!DOCTYPE html>

<html dir="ltr" lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <title>KIMS | Admin Reports</title>

    <link rel="stylesheet" type="text/css" href="../assets/libs/select2/dist/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/libs/jquery-minicolors/jquery.minicolors.css">

    <link rel="stylesheet" type="text/css" href="../assets/extra-libs/multicheck/multicheck.css">

    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <link href="../dist/css/style.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/libs/quill/dist/quill.snow.css">

    <link href="../css/qrstyle.css" rel="stylesheet" />

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

                            <!-- dark Logo text -->

                            <!--<img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" />-->

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

                        <!--<li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>

                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>

                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="#">Action</a>

                                <a class="dropdown-item" href="#">Another action</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#">Something else here</a>

                            </div>

                        </li>-->

                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>

                            <form class="app-search position-absolute" id="" method="" name="">

                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>

                            </form>

                        </li>

                    </ul>

                    <ul class="navbar-nav float-right">

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>

                            </a>

                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="#">Action</a>

                                <a class="dropdown-item" href="#">Another action</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#">Something else here</a>

                            </div>

                        </li>



                        <!-- ============================================================== -->

                        <!-- Messages -->

                        <!-- ============================================================== -->

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>

                            </a>

                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">

                                <ul class="list-style-none">

                                    <li>

                                        <div class="">

                                             <!-- Message -->

                                            <a href="javascript:void(0)" class="link border-top">

                                                <div class="d-flex no-block align-items-center p-10">

                                                    <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>

                                                    <div class="m-l-10">

                                                        <h5 class="m-b-0">Event today</h5> 

                                                        <span class="mail-desc">Just a reminder that event</span> 

                                                    </div>

                                                </div>

                                            </a>

                                            <!-- Message -->

                                            <a href="javascript:void(0)" class="link border-top">

                                                <div class="d-flex no-block align-items-center p-10">

                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>

                                                    <div class="m-l-10">

                                                        <h5 class="m-b-0">Settings</h5> 

                                                        <span class="mail-desc">You can customize this template</span> 

                                                    </div>

                                                </div>

                                            </a>

                                            <!-- Message -->

                                            <a href="javascript:void(0)" class="link border-top">

                                                <div class="d-flex no-block align-items-center p-10">

                                                    <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>

                                                    <div class="m-l-10">

                                                        <h5 class="m-b-0">Pavan kumar</h5> 

                                                        <span class="mail-desc">Just see the my admin!</span> 

                                                    </div>

                                                </div>

                                            </a>

                                            <!-- Message -->

                                            <a href="javascript:void(0)" class="link border-top">

                                                <div class="d-flex no-block align-items-center p-10">

                                                    <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>

                                                    <div class="m-l-10">

                                                        <h5 class="m-b-0">Luanch Admin</h5> 

                                                        <span class="mail-desc">Just see the my new admin!</span> 

                                                    </div>

                                                </div>

                                            </a>

                                        </div>

                                    </li>

                                </ul>

                            </div>

                        </li>

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

                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Admin Setting</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i>Facilitator Setting</a>

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

                        <h4 class="page-title">Report</h4>

                        <div class="ml-auto text-right">

                            <nav aria-label="breadcrumb">

                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Report</li>

                                </ol>

                            </nav>

                        </div>

                    </div>

                </div>

            </div>

            

            <div class="container-fluid">

                <div class="row">

                    <div class="col-md-12">

                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">Summarization Table OF KI ATTENDANCE</h4>

                                <br /><br />

                                <div class="row">

                                    <div class="col-md-12">

                                        <table class="table" id="tableModule">

                                            <thead>

                                                <tr class="info">

                                                    <th scope="col">#</th>

                                                    <th scope="col">Module</th>

                                                    <th scope="col">Year</th>

                                                    <th scope="col">Status</th>

                                                    <th scope="col">Attendees</th>

                                                </tr>

                                            </thead>

                                            <tbody id="modules-list" name="modules-list">
                                                 @foreach ($a as $value)

                                                <tr>

                                                    <td class="counterCell"></td>

                                                    <td>{{ $value->modname }}</td>
                                                    <td>{{ $value->smyear }} </td>

                                                    @if($value->status == NULL)

                                                        <td>NOT YET ATTEND</td>

                                                    @else

                                                        <td>{{$value->status}}</td>

                                                    @endif

                                                    <td>{{ $value->counter }}</td>

                                                </tr>

                                                @endforeach
                                            </tbody>

                                        </table>

                                        <br>

                                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer text-center">

                All Rights Reserved by UITMJ. Designed and Developed by NNI.

            </footer>

        </div>

    </div>

    <!-- All Jquery -->
    <script type="text/javascript">
    window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {

            animationEnabled: true,

            title: {

                text: "Summarization of Attendance"

            },

            subtitles: [{

                text: ""

            }],

            data: [{

                type: "pie",

                yValueFormatString: "#,##0.00\"%\"",

                indexLabel: "{label} ({y})",

                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>

            }]

        });

        chart.render();
    }

    </script>

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

    <script src="../assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

    <script src="../dist/js/pages/mask/mask.init.js"></script>

    <script src="../assets/libs/select2/dist/js/select2.full.min.js"></script>

    <script src="../assets/libs/select2/dist/js/select2.min.js"></script>

    <script src="../assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>

    <script src="../assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>

    <script src="../assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>

    <script src="../assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>

    <script src="../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script src="../assets/libs/quill/dist/quill.min.js"></script>

    <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>

    <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>

    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>

    <!-- QRCODE SCRIPTS -->

    <script type="text/javascript" src="../../js/jsqr/filereader.js"></script>

    <!-- Using jquery version: -->

    <!--

        <script type="text/javascript" src="js/jquery.js"></script>

        <script type="text/javascript" src="js/qrcodelib.js"></script>

        <script type="text/javascript" src="js/webcodecamjquery.js"></script>

        <script type="text/javascript" src="js/mainjquery.js"></script>

    -->

    <script type="text/javascript" src="../../js/jsqr/qrcodelib.js"></script>

    <script type="text/javascript" src="../../js/jsqr/webcodecamjs.js"></script>

    <script type="text/javascript" src="../../js/jsqr/main.js"></script>

    <script>

        /****************************************

         *       Basic Table                   *

         ****************************************/

        $('#zero_config').DataTable();

    </script>

   

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>



</html>