<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Admin Panel | JRPoP</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="plugins/node-waves/waves.css" rel="stylesheet" />
  <link href="plugins/animate-css/animate.css" rel="stylesheet" />
  <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-cyan" >

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
<div class="overlay"></div>
  @extends('partials.topheader')

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
                  <li class="active">
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
                  <li>
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
                &copy; 2017 <a href="">Jesus Redeems IT Dept.</a>
            </div>
            <div class="version">
                <b>Version: </b>Beta 0.1
            </div>
          </div>
          <!-- #Footer -->
      </aside>
    </section>

  @if(Auth::user()->role == "admin")
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h5>Registration</h5>
      </div>
      <div class="row clearfix">
        <div class="">
          <div class="card col-md-12">
            <div class="header">
              <h2>Enter User Details</h2>
            </div>
            <div class="body">
              <div class="row clearfix">
                <form method="post" action="{{url('/register')}}">
                {{ csrf_field() }}
                <!-- Staff ID -->
                <div class="col-md-4 form-control-label">
                  <label for="name">Staff ID</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="number" name="sid" id="sid" class="form-control" required autofocus min="1">
                    </div>
                  </div>
                </div>
                <!-- Username -->
                <div class="col-md-4 form-control-label">
                  <label for="name">Username</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="name" id="name" class="form-control" required autofocus>
                    </div>
                  </div>
                </div>
                <!-- Email -->
                <div class="col-md-4 form-control-label">
                  <label for="email">Email Address</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div>
                </div>
                <!-- Password -->
                <div class="col-md-4 form-control-label">
                  <label for="password">Password</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="password" name="password" id="password" minlength="8" class="form-control" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div>
                </div>
                <!-- Role -->
                <div class="col-md-4 form-control-label">
                  <label for="role">User Role</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="input-group">
                    <div class="form-line" data-placement="bottom" data-toggle="popover">
                      <select class="form-control input-sm" id="role" name="role" data-placement="bottom" data-toggle="popover">
                        <option value="admin">Admin</option>
                        <option value="superuser">Super User</option>
                        <option value="user">User</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- Address Line 1 -->
                <div class="col-md-4 form-control-label">
                  <label for="addr1">Address 1</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="addr1" id="addr1" class="form-control" required>
                    </div>
                  </div>
                </div>
                <!-- Address Line 2 -->
                <div class="col-md-4 form-control-label">
                  <label for="addr2">Address 2</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="addr2" id="addr2" class="form-control" required>
                    </div>
                  </div>
                </div>
                <!-- City -->
                <div class="col-md-4 form-control-label">
                  <label for="city">City</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="city" id="city" class="form-control" required>
                    </div>
                  </div>
                </div>
                <!-- Pin Code -->
                <div class="col-md-4 form-control-label">
                  <label for="pincode">Pincode</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="number" name="pincode" id="pincode" min="0" oninput="if(value.length>6)value=value.slice(0,6)" class="form-control" required>
                    </div>
                  </div>
                </div>
                <!-- Mobile -->
                <div class="col-md-4 form-control-label">
                  <label for="mobile">Mobile</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="number" name="mobile" id="mobile" class="form-control" min="0" oninput="if(value.length>10)value=value.slice(0,10)" required>
                    </div>
                  </div>
                </div>
                <!-- Branch -->
                <div class="col-md-4 form-control-label">
                  <label for="branch">Branch</label>
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <div class="form-group">
                    <div class="form-line">
                      <!-- <input type="text" name="branch" id="branch" class="form-control" required> -->
                      <!-- <input list="name1" class="form-control date" id="branch" name="branch" autofocus="true" value="Select" required> -->
                      <!-- <datalist id="name1"> -->
                      <select class="form-control input-sm" id="branch" name="branch">
                        @foreach($data as $item)
                          <option> {{$item->location}}</option>
                        @endforeach
                      </select>
                      <!-- </datalist> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-12 align-right">
                  <button type="submit" value="submit" class="btn btn-primary m-t-5 waves-effect">Insert User</button>
                  <!-- {{ Form::submit('Insert User',array('class'=>'btn btn-primary m-t-5 waves-effect'))}} -->
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
<!-- Jquery Core Js -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="plugins/bootstrap/js/bootstrap.js"></script>
<!-- Select Plugin Js -->
<!-- <script src="/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->
<!-- Slimscroll Plugin Js -->
<script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="plugins/node-waves/waves.js"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/pages/tables/jquery-datatable.js"></script>
<script src="js/pages/forms/advanced-form-elements.js"></script>
<!-- Demo Js -->
<script src="js/demo.js"></script>
<script src="script/sales.js"></script>
<!-- <script type="text/javascript">
    // document.getElementById('branch').addEventListener('input', function () {
    //   alert($(this).val().attr('id'));
    // });

    // $(document).ready(function() {
   $('#branch name1').change(function() {
     //Get the id of list items
       var ID = $(this).attr('id');
       alert(ID);
   }); -->
  // });
</script>
</body>
</html>
