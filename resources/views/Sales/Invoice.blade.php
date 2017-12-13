<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Invoice | JR-POP</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Dynalight' rel='stylesheet'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Sweetalert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->

    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />
    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

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

        table#ItemTable {
            counter-reset: rowNumber -1;
        }

        table#ItemTable tr:nth-child(n+1) {
            counter-increment: rowNumber;
        }

        table#ItemTable tr:nth-child(n+1) td:first-child::before {
            content: counter(rowNumber);
            min-width: 1em;
            margin-right: 0.5em;
            margin-top: 0.5em;
        }
    </style>
    <!-- <script>
    $(document).ready(function(){
      $("#Country").change(function(){
          var country=$('#Country').val();
          // alert(country);
          $.ajax
          ({
             url: '/state',
             data: {country:country },
             type: 'get',
             success:function(data)
             {
               alert(data.length);
               alert(data);
               var temp5 = data.split(",");
               var n = temp5.length;
               for(var i=0;i<n-1;i++)
               {
                 $('#state').append($('<option></option>').html(temp5[i]));
               }


             },
          });
      });
    });
    </script> -->
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
    <!-- Top Bar -->
    @extends('partials.topheader')

    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />

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
                            <i class="material-icons">home</i>
                            <span>Registration</span>
                        </a>
                    </li>
                    <li >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">dns</i>
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
                    @endif
                    <li>
                         <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">reorder</i>
                            <span>Stock</span>
                        </a>
                        <ul class="ml-menu">
                      @if(Auth::user()->role == "admin" || Auth::user()->role == "superuser")
                            <li>
                                <a href="{!! url('/add'); !!}">Stock List</a>
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
                          <i class="material-icons">reorder</i>
                          <span>Sales</span>
                        </a>
                        <ul class="ml-menu">
                          <li class="active">
                              <a href="" onclick="InvoiceNum();">InVoice</a>
                          </li>
                            <li >
                                <a href="{!! url('/HeldInVoice'); !!}">Pick Held InVoice</a>
                            </li>
                            <li>
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
                    &copy; 2016 - 2017 <a href="">Jesus Redeems IT Dept.</a>
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
      </section>

    <script src="../script/sales.js"></script>



    <!-- #Side Bar -->


    <section class="content">
        <div class="container-fluid">

        <!-- #############################Content############################# -->

        {!! Form::open(array('route' => 'sales.store')) !!}

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
                                        style="font-size: 250%; font-style: oblique; font-family: 'Times';">Invoice</h1>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="align-center">
                                        <div class="align-left">
                                            <span class="pull-right">
                                                <h4>Invoice Number</h4>
                                                <div name="InvoiceNo" id="InvoiceNo" class="font-15">
                                                    {{ $INumber }}
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="align-center">
                                        <div class="align-left">
                                            <span class="pull-right">
                                                <h4>Date of Issue</h4>
                                                <div name="InvoiceDate" id="InvoiceDate" class="font-15">
                                                    {{ $InvoiceDate }}
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="align-center">
                                        <div class="align-left">
                                            <span class="pull-right">
                                                <h4>Total Product</h4>
                                                <div name="Ttl_Product" id="Ttl_Product" class="font-15">0</div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="align-center">
                                        <div class="align-left">
                                            <span class="pull-right">
                                                <h4>Total Quantity</h4>
                                                <div name="Ttl_Quantity" id="Ttl_Quantity" class="font-15">
                                                    {{ $TotalQty }}</div>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="align-right">
                                        <div class="align-center">
                                            <div name="Ttl_Amount" id="Ttl_Amount" class="font-45">
                                                    ₹ {{ $Totalamt }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>


                    <div class="body">


                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="md_checkbox_2">Barcode</label>
                                            <input type="text" id="Barcodetxt" name="Barcodetxt" onkeydown="return salesKeyDown(event,id);" class="form-control" autofocus/>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="input-group">
                                    <p>
                                        <b>ItemName</b>
                                    </p>
                                        <div class="form-line">
                                            <input list="name" class="form-control date" id="ItemsList" name="ItemsList" onkeydown="return salesKeyDown(event,id);" >
                                            <datalist id="name">
                                                @foreach ($Items as $Item)
                                                    <option>{{ $Item }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="md_checkbox_2">Quantity</label>
                                            <input type="number" id="Quantity"  min="0"  onkeydown="return salesKeyDownQuantity(event);" onkeyup="return salesKeyupQuantity(event);" onkeypress="return salesKeyPressQuantity(event);" class="form-control" disabled />
                                            <input type="text" id="Ttl_AmountFinal" name="Ttl_AmountFinal" value="{{ $Totalamt }}" style="border:0;" hidden/>
                                            <input type="text" id="Final_Count" name="Final_Count" style="border:0;" hidden/>
                                        </div>
                                    </div>
                                </div>
                                <!--  <div class="col-md-2">
                                    <div class="input-group">
                                    <p>
                                        <b>Location</b>
                                    </p>
                                        <div class="form-line">
                                            <input list="lname" class="form-control date" id="ULocation" name="ULocation" onkeydown="return salesKeyDown(event,id);" onkeypress="return salesKeyPress(event,id);"  >
                                            <datalist id="lname">
                                                @foreach ($Locations as $Location)
                                                    <option>{{ $Location->location }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>  -->
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table id="ItemTable" name="ItemTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead align="left">
                                                <tr>
                                                  <th id="thead_Items">SNo</th>
                                                  <th id="thead_Items">Product</th>
                                                  <th id="thead_Items">Price/Unit</th>
                                                  <th id="thead_Items">Amount</th>
                                                  <th id="thead_Items">Product Discount</th>
                                                  <th id="thead_Items">Spot Discount</th>
                                                  <th id="thead_Items">Quantity</th>
                                                  <th id="thead_Items">Delete</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>


                    </div>


                    <div class="header bg-cyan">
                        <div class="row clearfix">

                                <div class="col-md-5">
                                    <label><h4>Spot Discount&nbsp;&nbsp;</h4></label>

                                    <input name="sd_Radiobutton" type="radio" id="sd_Radiobutton1" onclick="return SpotDiscounttxtKeyup_Overall();" class="with-gap radio-col-white" value="fixed" checked />
                                    <label for="sd_Radiobutton1">₹&nbsp;&nbsp;</label>

                                    <input name="sd_Radiobutton" type="radio" id="sd_Radiobutton2" onclick="return SpotDiscounttxtKeyup_Overall();" class="with-gap radio-col-white" value="true" />
                                    <label for="sd_Radiobutton2">%&nbsp;&nbsp;</label>
                                    <label><input type="number" min="0" id="sd_Txt" onkeypress="return SpotDiscounttxtKeypress(event);" onkeyup="return SpotDiscounttxtKeyup_Overall();" class="form-control" size="15"></label>
                                </div>


                                <div class="col-md-7">
                                    <div class="icon-and-text-button-demo">
                                        <button type="button" name="btn_save" id="btn_save"  onclick="SaveInVoice()"
                                        class="btn bg-cyan lighten-5 waves-effect">
                                            <i class="material-icons">save</i>
                                            <span>Print(F8)</span>
                                        </button>
                                        <button type="button" name="btn_Hold" id="btn_Hold"  onclick="HoldInVoice()"
                                        class="btn bg-cyan lighten-5 waves-effect">
                                            <i class="material-icons">pause</i>
                                            <span>Hold(F6)</span>
                                        </button>
                                        <button type="button" name="btn_Cancel" id="btn_Cancel" onclick="CancelInVoice()" class="btn bg-cyan lighten-5 waves-effect">
                                            <i class="material-icons">delete_forever</i>
                                            <span>Cancel(F4)</span>
                                        </button>
                                        <span class="pull-right">
                                            <h4 style="font-size: 110%; font-style: oblique; font-family: 'Times';">
                                                Generated By - {{{ucfirst(Auth::user()->name)}}}
                                                &nbsp;&nbsp;Total -
                                            <label name="UserTotal" id="UserTotal">0</label>
                                            (<label name="UserAmt" id="UserAmt">0</label>)
                                            </h4>
                                        </span>
                                    </div>
                                </div>


                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">

                                        <div class="header">
                                            <label><h4 style="font-size: 120%; font-style: oblique; font-family: 'Times'; color:grey;">Address Details</h4></label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>
                                                <div class="form-group">
                                                    <div class="form-line"><label>Mobile Number</label>
                                                        <input type="text"   onkeypress="return IsNumeric(event);"   min="1" class="form-control" id="Mobile" name="Mobile" maxlength="10">
                                                        <input type="text" id="UUID" name="UUID" style="border:0;" hidden />
                                                    </div>
                                                </div>
                                            </label>
                                        </div>




                                        <div class="body">
                                            <div class="row clearfix">

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" name="UName" id="UName"  style='text-transform:uppercase' maxlength="23" required>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line"><label>Door Number</label>
                                                            <input type="text" class="form-control" name="Address1" id="Address1"  style='text-transform:uppercase' maxlength="26">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line"><label>Street Name</label>
                                                            <input type="text" class="form-control" name="Address2" id="Address2"  style='text-transform:uppercase' maxlength="26">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line"> <label>Area</label>
                                                            <input type="text" class="form-control" name="Address3" id="Address3" style='text-transform:uppercase' maxlength="26">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"><label>City</label>
                                                            <input type="text" class="form-control" name="Address4" id="Address4" style='text-transform:uppercase' maxlength="26">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"><label>PinCode</label>
                                                            <input type="text" class="form-control" name="PinCode" id="PinCode" maxlength="6" required>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"> <label>Country</label>
                                                          <!-- <input type="text" class="form-control" name="Country" id="Country" style='text-transform:uppercase'> -->
                                                          <!-- <input list="countryname" class="form-control date" id="Country" name="Country">
                                                          <datalist id="countryname">
                                                            @foreach($country as $ctry)
                                                                @if($ctry == "INDIA")
                                                                 <option selected>{{ $ctry }}</option>
                                                                @else
                                                                <option> {{$ctry}}</option>
                                                                @endif
                                                            @endforeach
                                                          </datalist><option value="{{$ctry}}">{{$ctry}}</option> -->
                                                            <select class="form-control" id="Country" name="Country" data-placement="bottom" data-toggle="popover">
                                                                @foreach($country as $ctry)
                                                                    @if($ctry == "INDIA")
                                                                     <option value="{{$ctry}}" selected>{{$ctry}}</option>
                                                                    @else
                                                                    <option value="{{$ctry}}">{{$ctry}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                      <div class="form-line"><label>State</label>
                                                              <select class="form-control" id="State" name="State" data-placement="bottom" data-toggle="popover">

                                                              </select>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                      <div class="form-line"><label>District</label>
                                                            <select class="form-control" id="District" name="District" data-placement="bottom" data-toggle="popover">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"><label>Mobile</label>
                                                            <input type="text"  onkeypress="return IsNumeric(event);"  class="form-control" name="Mob1" id="Mob1" maxlength="10">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-line"><label>Email</label>
                                                            <input type="email" name="EMail" id="EMail" class="form-control"  onfocusout='EmailValidation(id);' >

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ###########################End Content########################### -->
                </div>
            </div>
        </div>

            <!-- #END# Input -->

        {!! Form::close() !!}

        <!-- ###########################End Content########################### -->


        </div>
    </section>



    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>


    <!-- Bootstrap Core Js -->
    <!-- <script src="../plugins/bootstrap/js/bootstrap.js"></script> -->

    <!-- Select Plugin Js -->
    <!-- <script src="/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="../plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <!-- <script src="../plugins/bootstrap-notify/bootstrap-notify.js"></script> -->

    <!-- SweetAlert Plugin Js -->
    <!-- <script src="../plugins/sweetalert/sweetalert.min.js"></script> -->
    <!-- Morris Plugin Js -->
    <!-- <script src="../plugins/raphael/raphael.min.js"></script> -->
    <!-- <script src="../plugins/morrisjs/morris.js"></script> -->

    <!-- ChartJs .-->
    <!-- <script src="../plugins/chartjs/Chart.bundle.js"></script> -->

    <!-- Flot Charts Plugin Js -->
    <!-- <script src="../plugins/flot-charts/jquery.flot.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.time.js"></script> -->

    <!-- Sparkline Chart Plugin Js -->
    <!-- <script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script> -->

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/index.js"></script>
    <script src="../js/pages/ui/dialogs.js"></script>
    <script src="../js/pages/forms/form-validation.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>

</body>

</html>
