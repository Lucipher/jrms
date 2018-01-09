<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Admin Panel | JRPoP</title>
  <!-- <link rel="stylesheet" href="{{ URL::asset('/plugins/bootstrap/css/bootstrap.css')}}"> -->
  <link rel="icon" type="image/x-icon" href="{{ URL::asset('/favicon.ico')}}">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/bootstrap/css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/node-waves/waves.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/animate-css/animate.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/css/themes/all-themes.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/css/style.css')}}">
  <!-- <link href="/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="/plugins/node-waves/waves.css" rel="stylesheet" />
  <link href="/plugins/animate-css/animate.css" rel="stylesheet" />
  <link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">-->
  <!-- <link href="/css/style.css" rel="stylesheet"> -->
  <!-- <link href="/css/themes/all-themes.css" rel="stylesheet" /> -->
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
                  <!-- <img src="{{ URL::asset('images/user.png')}}" width="48" height="48" alt="User" /> -->
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
                  <li class="active">
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
                  <li>
                      <a href="javascript:void(0);" class="menu-toggle">
                          <i class="material-icons">shopping_basket</i>
                          <span>Items</span>
                      </a>
                      <ul class="ml-menu">
                          <li>
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
                              <a href="{{ url('purchase_view') }}">Purchase-View</a>
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
                  &copy;2017 <a href="">Jesus Redeems.</a>
              </div>
              <div class="version">
                  <b>Version </b> Beta 0.1
              </div>
          </div>
          <!-- #Footer -->
      </aside>
    </section>

    @if(Auth::user()->role == "user")
    <?php
        $itemscount = DB::table('items')->count();//Product Count
        $count = DB::table('addstock')->sum('quantity');//Stock Count
        $userscount = DB::table('users')->count();//User Count
        $date = date("d/m/Y");
    ?>
    <section class="content">
      <div class="col-md-3">
        <div class="info-box bg-pink hover-zoom-effect">
          <div class="icon">
            <i class="material-icons">equalizer</i>
          </div>
            <div class="content">
              <div class="text">Total Items</div>
              <div class="number">{{$itemscount}}</div>
            </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="info-box bg-cyan hover-zoom-effect">
          <div class="icon">
            <i class="material-icons">view_module</i>
          </div>
          <div class="content">
            <div class="text">Total no. of Products</div>
            <div class="number">{{$branch_stock}}</div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="info-box bg-orange hover-zoom-effect">
          <div class="icon">
            <i class="material-icons">&#8377;</i>
          </div>

            <div class="content">
              <div class="text">Sale for the Day</div>
              <div class="number">{{$usertotal}}</div>
            </div>
        </div>
      </div>
    </section>
  @endif


  @if((Auth::user()->role == "user") || (Auth::user()->role == "superuser"))

    <section class="content">
      <div class="col-md-12">
        <div class="card">
          <div class="header">
            <h2>Stock Table</h2>
            <small>Stocks present in all branches</small>
          </div>
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                  <tr>
                    <th>Barcode</th>
                    <th>Product Name</th>
                    <th>Location</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($add_stock as $row)
                    <tr>
                      <td>{{$row->barcode}}</td>
                      <td>{{$row->product_name}}</td>
                      <td>{{$row->location}}</td>
                      <td>{{$row->quantity}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
        </div>
      </div>
    </section>
  @endif

  @if(Auth::user()->role == "admin")
  <section class="content">
    <div class="col-md-3">
      <div class="info-box bg-pink hover-zoom-effect">
        <div class="icon">
          <i class="material-icons">equalizer</i>
        </div>
        <?php
            $itemscount = DB::table('items')->count();//Product Count
            $count = DB::table('addstock')->sum('quantity');//Stock Count
            $userscount = DB::table('users')->count();//User Count
            $date = date("d/m/Y");
            // $todays_sales = DB::table('hdpos_receipt')->where('invoicedate',$date)->sum('totalamount');
            // $todays_sales = DB::table('hdpos_receipt')->where('invoicedate',$date)->where('id',23)->sum('id');
        ?>
          <div class="content">
            <div class="text">Total Items</div>
            <div class="number">{{$itemscount}}</div>
          </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="info-box bg-cyan hover-zoom-effect">
        <div class="icon">
          <i class="material-icons">view_module</i>
        </div>
        <div class="content">
          <div class="text">Total Products</div>
          <div class="number">{{$count}}</div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="info-box bg-orange hover-zoom-effect">
        <div class="icon">
          <i class="material-icons">&#8377;</i>
        </div>
        <div class="content">
          <div class="text">Sale of the Day</div>
          <div class="number">{{$selectTotal}}</div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="info-box bg-light-green hover-zoom-effect">
        <div class="icon">
          <i class="material-icons">person_add</i>
        </div>
        <div class="content">
          <div class="text">Total Users</div>
          <div class="number">{{$userscount}}</div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row clearfix">
        <div class="card col-md-12">
          <div class="header">
            <h2>Entry Management</h2>
          </div>
          <div class="body">

            <!-- @if(Auth::user()->role == "admin") -->
            <span class="col-md-6">
                    <div class="row clearfix">
                        <form action="{{url('/catadd')}}" method="post">
                          {{csrf_field()}}
                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                            <label for="newcat">Category</label>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                            <div class="form-group">
                              <div class="form-line">
                                  <input type="text" name="newcat" id="newcat" class="form-control" placeholder="Enter New Category" required>
                              </div>
                            </div>
                          </div>


                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-8">
                            <div class="form-group">
                              <input type="submit" name="cat" id="cat" value="Add Category" class="align-right btn btn-primary m-t-5 waves-effect"></input>
                            </div>
                          </div>

                          </form>


                          <form action="{{url('/subcatadd')}}" method="post">
                            {{csrf_field()}}
                            <div class="col-md-3 form-control-label">
                              <label for="categoryname">Select Category</label>
                            </div>

                            <div class="col-md-9">
                              <div class="col-md-8">
                                <div class="input-group">
                                  <div class="form-line" data-placement="bottom" data-toggle="popover">
                                    <select class="form-control input-sm" id="categoryname" name="categoryname" data-placement="bottom" data-toggle="popover">
                                      @foreach($category as $category)
                                        <option value="{{$category->category}}">{{$category->category}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                              <label for="subcat">Sub-Category</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
                              <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="subcat" id="subcat" class="form-control" placeholder="Enter New Sub-Category" required>
                                </div>
                                <!-- <! <input type="submit" name="cat" id="cat" value="Add Category" class="align-right btn btn-primary m-t-5 waves-effect"></input> -->
                              </div>
                            </div>

                            <input type="submit" name="catbutton" id="catbutton" value="Add Sub-Category" class="align-right btn btn-primary m-t-5 waves-effect"></input>
                          </form>
                        </div>

                      {{-- </div> --}}
                      </div>
                    </div>
                  </div>
                      <!-- @endif -->

                      <div class="card">
                        <div class="header">
                            <h2>Sales Table</h2>
                            <small>Sale of the day</small>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                          <th>Invoice Number</th>
                                          <th>Quantity</th>
                                          <th>Amount</th>
                                          <th>Discount</th>
                                          <th>Status</th>
                                          <th>Created By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($invoice_details as $row1)
                                          <tr>
                                            <td>{{$row1->invoicenumber}}</td>
                                            <td>{{$row1->totalquantity}}</td>
                                            <td>{{$row1->totalamount}}</td>
                                            <td>{{$row1->spotdiscountamount}}</td>
                                            <td>{{$row1->status}}</td>
                                            <td>{{$row1->createdby}}</td>
                                          </tr>
                                      @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>


                      <div class="card">
                        <div class="header">
                          <h2>Items Table</h2>
                          <small>Items present</small>
                        </div>
                        <div class="body">
                          <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                              <thead>
                                <tr>
                                  <th>Barcode</th>
                                  <th>Product Name</th>
                                  <th>Category</th>
                                  <th>Sub-category</th>
                                  <th>MRP</th>
                                  <th>Sales Price</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($items_list as $row4)
                                  <tr>
                                    <td>{{$row4->bnumber}}</td>
                                    <td>{{$row4->itemname}}</td>
                                    <td>{{$row4->categoryname}}</td>
                                    <td>{{$row4->subcategoryname}}</td>
                                    <td>{{$row4->mrp}}</td>
                                    <td>{{$row4->finalprice}}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>


                  <div class="card">
                    <div class="header">
                      <h2>Stock Table</h2>
                      <small>Stocks present in all branches</small>
                    </div>
                    <div class="body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                          <thead>
                            <tr>
                              <th>Barcode</th>
                              <th>Product Name</th>
                              <th>Location</th>
                              <th>Quantity</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($add_stock as $row)
                              <tr>
                                <td>{{$row->barcode}}</td>
                                <td>{{$row->product_name}}</td>
                                <td>{{$row->location}}</td>
                                <td>{{$row->quantity}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                                  <!-- @if(Auth::user()->role == "admin") -->


                                  <div class="card">
                                    <div class="header">
                                        <h2>User Table</h2>
                                        <small>Users registered with JRPoP</small>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Location</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($userslist as $row2)
                                                      <tr>
                                                        <td>{{$row2->name}}</td>
                                                        <td>{{$row2->email}}</td>
                                                        <td>{{$row2->role}}</td>
                                                        <td>{{$row2->branch}}</td>
                                                        <td><button type="submit" class="btn btn-primary btn-sm" onclick="change('{{$row2->email}}')">Reset Password</button></td>
                                                      </tr>
                                                    @endforeach
                                                  </tbody>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                          <script>
                                              function change(name){
                                                var useremail=name;
                                                var newpwd = prompt('Please Enter new Password for User: '+useremail);
                                                var len = newpwd.length;
                                                if(newpwd=="" || newpwd==null){
                                                  alert("Please Enter a Password to Continue.")
                                                }
                                                else if(len<8) {
                                                  alert("The Password must be at least 8 characters long")
                                                }
                                                  else {
                                                  var url1 = './changepassword';
                                                  $.ajax({
                                                    type: 'get',
                                                    url:url1,
                                                    data: {useremail:useremail, newpwd:newpwd},
                                                    success:function(data){

                                                    }
                                                  });
                                                }
                                              }
                                            </script>




                        <!-- @endif -->

          <!-- <div class="align-right">
             {{ Form::submit('Insert Item',array('class'=>'btn btn-primary m-t-5 waves-effect'))}}

          </div> -->
        </span>
          </div>

        </div>
      </div>
    </div>
  </section>
  @endif


  <script src="{{ URL::asset('/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{ URL::asset('/plugins/bootstrap/js/bootstrap.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
  <script src="{{ URL::asset('/plugins/node-waves/waves.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
  <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
  <script src="{{ URL::asset('/js/admin.js')}}"></script>
  <script src="{{ URL::asset('/js/pages/tables/jquery-datatable.js')}}"></script>
  <script src="{{ URL::asset('script/sales.js')}}"></script>
  <script src="{{ URL::asset('/js/demo.js')}}"></script>



  <!-- Jquery Core Js -->
  <!-- <script src="/script/sales.js"></script>
  <script src="/plugins/jquery/jquery.min.js"></script>-->

  <!-- Bootstrap Core Js -->
  <!-- <script src="/plugins/bootstrap/js/bootstrap.js"></script> -->
  <!-- Select Plugin Js -->
  <!-- <script src="/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->
  <!-- Slimscroll Plugin Js -->
  <!-- <script src="/plugins/jquery-slimscroll/jquery.slimscroll.js"></script> -->
  <!-- Waves Effect Plugin Js -->
  <!-- <script src="/plugins/node-waves/waves.js"></script> -->
  <!--Spark-->
  <!-- <script src="/plugins/jquery-sparkline/jquery.sparkline.js"></script> -->
  <!-- Jquery DataTable Plugin Js -->
  <!-- <script src="/plugins/jquery-datatable/jquery.dataTables.js"></script> -->
  <!-- <script src="/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script> -->
  <!-- <script src="/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script> -->
  <!-- <script src="/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script> -->
  <!-- <script src="/plugins/jquery-datatable/extensions/export/jszip.min.js"></script> -->
  <!-- <script src="/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script> -->
  <!-- <script src="/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script> -->
  <!-- <script src="/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script> -->
  <!-- <script src="/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script> -->
  <!-- Custom Js -->
  <!-- <script src="/js/admin.js"></script> -->
  <!-- <script src="/js/pages/tables/jquery-datatable.js"></script> -->
  <!-- Demo Js -->
  <!-- <script src="/js/demo.js"></script> -->
</body>

</html>
