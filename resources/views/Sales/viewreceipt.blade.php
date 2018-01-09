<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Jesus Redeems Management System</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link href='https://fonts.googleapis.com/css?family=Dynalight' rel='stylesheet'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <link href="plugins/nouislider/nouislider.min.css" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    <!-- Colorpicker Css -->
    <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="plugins/multi-select/css/multi-select.css" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style>
        #Tabletextbox {
            width: 100%;
            padding: 4px 10px;
            margin: -5px 0;
            box-sizing: border-box;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }
        #H1Margin {
            background-color: grey;
            margin-top: 100px;
            margin-bottom: 100px;
            margin-right: 150px;
            margin-left: 80px;
        }

        #spanbutton {
            width: 100px;
        }

        #thead_Items {
            text-align: center;
        }

        table#ItemTableview {
            counter-reset: rowNumber -1;
        }

        table#ItemTableview tr:nth-child(n+1) {
            counter-increment: rowNumber;
        }

        table#ItemTableview tr:nth-child(n+1) td:first-child::before {
            content: counter(rowNumber);
            min-width: 1em;
            margin-right: 0.5em;
            margin-top: 0.5em;
        }
    </style>
    <script type="text/javascript">
            $(document).keydown(function(e){
                if(e.keyCode == 120)
                {
                    ViewHeldSearch();
                }
            });
        </script>

</head>


<body class="theme-cyan">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->

    <!-- #END# Search Bar -->

    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @extends('partials.topheader')



    <!-- #Top Bar -->
    <!-- #Side Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" style="color:white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{{Auth::user()->name}}}</div>
                    <div class="email" style="color:white;">{{{Auth::user()->email}}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li> -->
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Sign Out</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
             <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li >
                        <a href="{{ url('/home') }}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    @if(Auth::user()->role == "admin" || Auth::user()->role == "superuser")
                    <li class="">
                        <a href="{{ url('/register') }}">
                            <i class="material-icons">assignment_ind</i>
                            <span>Registration</span>
                        </a>
                    </li>
                    <li >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">shopping_basket</i>
                            <span>Items</span>
                        </a>
                        <ul class="ml-menu">
                            <li >
                                <a href="{{ url('insertitem') }}">Add Item</a>
                            </li>
                            <li>
                                <a href="{{ url('modifyitem') }}">Update Item</a>
                            </li>
                            <li>
                                <a href="{{ url('supplier') }}">Supplier</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">euro_symbol</i>
                            <span>Purchase</span>
                        </a>
                        <ul class="ml-menu">
                            <li >
                                <a href="{{ url('purchase_stock') }}">Purchase-Stock</a>
                            </li>
                            <li>
                                <a href="{{ url('purchase_view') }}">Purchase- View</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    <li>
                         <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">line_style</i>
                            <span>Stock</span>
                        </a>
                        <ul class="ml-menu">
                      @if(Auth::user()->role == "admin" || Auth::user()->role == "superuser")
                            <li>
                                <a href="{!! url('/add'); !!}">Stock Add</a>
                            </li>
                      @endif
                            <li>
                                <a href="{!! url('/transfer'); !!}">Stock Transfer</a>
                            </li>
                            <li>
                                <a href="{!! url('/stockview'); !!}">Stock View</a>
                            </li>

                        </ul>
                    </li>
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                          <i class="material-icons">shopping_cart</i>
                          <span>Sales</span>
                        </a>
                        <ul class="ml-menu">
                          <li>
                              <a href="" onclick="InvoiceNum();">InVoice</a>
                          </li>
                            <li>
                                <a href="{!! url('/HeldInVoice'); !!}">Pick Held InVoice</a>
                            </li>
                            <li class="active">
                                <a href="{!! url('/View'); !!}">View</a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="">
                            <i class="material-icons">assignment</i>
                            <span>Report</span>
                        </a>
                    </li> -->

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
              <div class="copyright">
                  &copy; 2017 <a href="">Jesus Redeems IT Dept.</a>
              </div>
              <div class="version">
                  <b>Version: </b>Beta 0.1
              </div>
            </div>
            <!-- #Footer -->
        </aside>
      </section>


    <section class="content">
        <div class="container-fluid">

        <!-- #############################Content############################# -->

            <!-- Input -->

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">


                    <div class="header bg-cyan">
                        <div class="row clearfix">
                                <div class="col-md-1">
                                    <div class="align-right">
                                    <div class="content">
                                        <h1 vertical-align="middle"
                                        style="font-size: 250%; font-style: oblique; font-family: 'Times';">View</h1>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>



                    <div class="header bg-white">

                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="md_checkbox_2">Invoice Number</label>
                                            <input type="text" id="V_Inum" name="V_Inum" class="form-control" autofocus/>
                                        </div>
                                    </div>
                                </div>

                                 <div class="demo-masked-input">
                                    <div class="col-md-3">
                                    <p>
                                        <b>Invoice Date</b>
                                    </p>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="col-md-6">
                                                <div class="form-line">
                                                    <input id="V_fromdate" name="V_fromdate" type="text" class="form-control date" placeholder="31/12/2020">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-line">
                                                    <input id="V_todate" name="V_todate" type="text" class="form-control date" placeholder="31/12/2020">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="input-group">
                                    <p>
                                        <b>ItemName</b>
                                    </p>
                                        <div class="form-line">
                                            <input list="itname" class="form-control date" id="V_ItemsList" name="V_ItemsList">
                                            <datalist id="itname">
                                                @foreach ($Items as $Item)
                                                    <option>{{ $Item }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="input-group">
                                    <p><b>Generated By</b></p>
                                        <div class="form-line">
                                            <input list="generated" class="form-control date" id="V_Generated" name="V_Generated" >
                                            <datalist id="generated">
                                                @foreach ($userLists as $userList)
                                                    <option>{{ $userList }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="md_checkbox_2">Name</label>
                                            <input type="text" id="V_Name" name="V_Name" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="md_checkbox_2">Mobile</label>
                                            <input type="text" id="V_Mobile" name="V_Mobile" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="md_checkbox_2">Total Amount</label>
                                            <input type="text" id="V_TtlAmt" name="V_TtlAmt" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="md_checkbox_2">Pincode</label>
                                            <input type="text" id="V_Pincode" name="V_Pincode" class="form-control"/>
                                        </div>
                                    </div>
                                </div>



                                 <div class="col-md-3">
                                    <div class="input-group">
                                    <p>
                                        <b>Country</b>
                                    </p>
                                        <div class="form-line">
                                            <input list="countryname" class="form-control date" id="V_Country" name="V_Country">
                                            <datalist id="countryname">
                                                @foreach ($country as $country)
                                                    <option>{{ $country }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="input-group">
                                    <p>
                                        <b>State</b>
                                    </p>
                                        <div class="form-line">
                                            <input list="Statename" class="form-control date" id="V_State" name="V_State">
                                            <datalist id="Statename">
                                                @foreach ($state as $state)
                                                    <option>{{ $state }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="input-group">
                                    <p>
                                        <b>District</b>
                                    </p>
                                        <div class="form-line">
                                            <input list="Districtname" class="form-control date" id="V_District" name="V_District">
                                            <datalist id="Districtname">
                                                @foreach ($district as $district)
                                                    <option>{{ $district }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <p>
                                    <b>
                                      <input type='checkbox' id="ThermalPOS" class='filled-in' checked/><label for="ThermalPOS"> Thermal</label>
                                    </b>
                                    </p>
                                    <button type="button" id="View_Search" name="View_Search" class="btn bg-cyan waves-effect" onclick="ViewHeldSearch()">
                                        <i class="material-icons">search</i>
                                        <b><span>Search(F9)</span></b>
                                    </button>
                                </div>


                            </div>
                    </div>

                    <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table id="ItemTableview" name="ItemTableview" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead align="left">
                                                <tr>
                                                    <th id="thead_Items">SNo</th>
                                                    <th id="thead_Items">Invoice</th>
                                                    <th id="thead_Items">Name</th>
                                                    <th id="thead_Items">Mobile</th>
                                                    <th id="thead_Items">Date</th>
                                                    <th id="thead_Items">Product</th>
                                                    <th id="thead_Items">Quantity</th>
                                                    <th id="thead_Items">Amount</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <!-- ###########################End Content########################### -->

                </div>
            </div>
        </div>

        <!-- ###########################End Content########################### -->


        </div>
    </section>



    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.js"></script>
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="plugins/node-waves/waves.js"></script>
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="js/admin.js"></script>
    <script src="plugins/nouislider/nouislider.js"></script>
    <script src="plugins/multi-select/js/jquery.multi-select.js"></script>
    <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
    <script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="plugins/dropzone/dropzone.js"></script>
    <script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    <!-- Demo Js -->
    <script src="js/pages/forms/advanced-form-elements.js"></script>
    <script src="js/demo.js"></script>
    <script src="script/sales.js"></script>



</body>

</html>
