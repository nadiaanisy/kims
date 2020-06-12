<!DOCTYPE html>
<html dir="ltr" lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>KIMS | Staff Module</title>

        <link href="../dist/css/style.min.css" rel="stylesheet">
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
                            <h4 class="page-title">Module</h4>
                            <div class="ml-auto text-right">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('staff.dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Module</li>
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
                                    <h4 class="card-title">Assigned Module Section</h4>
                                    <br>
                                    <hr>
                                    @if(!empty($data))
                                    <div class="table-responsive">   
                                        <table class="table" id="tableModule">
                                            <thead>
                                                <tr class="info">
                                                    <th scope="col">#</th>
                                                    <th scope="col">Module Name</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Date</th>
                                                    <!--<th scope="col">Session</th>-->
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="attendance-list" name="attendance-list">
                                                 @foreach($data as $value)
                                            <tr id="data{{$value->modid}}">
                                                <td class="counterCell"></td>
                                                <td>{{ $value->modname }}</td>
                                                <td>{{ $value->modtime }}</td>
                                                <td>{{ $value->msdate }}</td>
                                                
                                                <td>
                                                    <button class="btn btn-info btn-detail open_modal" value="{{ $value->msgroup }}"><i class="mdi mdi-loupe"></i></button>
                                                </td>  
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <!--<tfoot>
                                                <tr class="info">
                                                    <th scope="col">#</th>
                                                    <th scope="col">Module Name</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Session</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </tfoot>-->
                                        </table>
                                    </div>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                          <p>You are not being assigned to any module related to this program. Please come again to check for the latest update from the admin. If you have any inquiries, do not hesitate to contact the admin regarding the problem or any inconvenience.</p>
                                          <hr>
                                          <p class="mb-0">Whenever you need to, be sure to multi check the connection!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <!-- Passing BASE URL to AJAX -->
                <input id="url" type="hidden" value="{{ \Request::url() }}">

                <!--MODAL SECTION-->
                <div class="modal fade" id="viewModule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="fa fa-search"></i> View Module</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form data-toggle="validator" class="form-horizontal" id="viewModuleForm" name="viewModuleForm">
                                    <div class="form-group">
                                        <label class="control-label" for="modname">Module Name:</label>
                                        <input type="text" name="modname" id="modname" class="form-control" disabled/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="moddesc">Module Description:</label>
                                        <input type="text" name="moddesc" id="moddesc" class="form-control" disabled/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="modplace">Module Place:</label>
                                        <input type="text" name="modplace" id="modplace" class="form-control" disabled />
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="hidden" id="module_group" name="module_group">
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer text-center">
                    All Rights Reserved by UITMJ. Designed and Developed by NNI</a>.
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
        <!-- This Page JS -->
        <script src="../js/dataTables/datatables.min.js"></script>
        <script type="text/javascript">
            $(document).ready( function () {
                $('#tableModule').DataTable();
            }); 
        </script>
        <script type="text/javascript">
            $(document).ready( function() {
                //get base URL *********************
                var url = $('#url').val();

                //display detail in modal
                $(document).on('click','.open_modal',function(){
                    var module_group = $(this).val();

                    // Populate Data in Edit Modal Form
                    $.ajax
                    ({
                         headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "GET",
                        url: url + '_group=' + module_group,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": module_group
                        },
                        cache: false,
                        contentType: 'application/json; charset=utf-8',
                        success: function (data) {
                            console.log(data);
                            if(data)
                            {
                                $('#module_id').val(data[0].modid);
                                $('#modname').val(data[0].modname);
                                $('#moddesc').val(data[0].moddesc);
                                $('#modplace').val(data[0].nama_tempat);
                                $("#viewModule").modal('show');
                            }

                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });
        </script>
    </body>
</html>    