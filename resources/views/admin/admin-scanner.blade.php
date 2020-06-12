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

    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <link href="../dist/css/style.min.css" rel="stylesheet">

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

                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>

                                    <li class="breadcrumb-item"><a href="{{ route('ad.attendance') }}">Attendance Options</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Scanner</li>

                                </ol>

                            </nav>

                        </div>

                    </div>

                </div>

            </div>

            <div class="container-fluid">

                <div class="card">

                    <div class="card-body">

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

                                                        <p>
                                                            p/s:
                                                            Sesi 1 = 08:00 - 13:00,
                                                            Sesi 2 = 14:00 - 17:00, 
                                                            else, consider Not Attended!
                                                        </p>
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

                                            <button title="Detail" onclick="details()" class='btn btn-md btn-default' type="button" data-toggle="tooltip">Detail</button>

                                        </div>
                                        <p>
                                            p/s:
                                            Sesi 1 = 08:00 - 13:00,
                                            Sesi 2 = 14:00 - 17:00, 
                                            else, consider Not Attended!
                                        </p>

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
                                        <button onClick="notattended()" class='btn btn-md btn-primary' id="notattended" value='Not Attended' style="float:right;">Not Attended</button>

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

    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>

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

        $("#notattended").hide();



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

                    url: 'admin_scannedresult',

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

                                $("#notattended").show();


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

                                $("#notattended").hide();

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

                                $("#notattended").hide();

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

                url: 'admin_scannedresult_a',

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