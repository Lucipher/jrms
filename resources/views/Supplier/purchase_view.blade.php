<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Purchase-Stock View | JR-POP</title>

  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <!-- Bootstrap Core Css -->
  <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Bootstrap Select Css -->
  <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

  <!-- Waves Effect Css -->
  <link href="plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- JQuery DataTable Css -->
  <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  <!-- Custom Css -->
  <link href="css/style.css" rel="stylesheet">

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="css/themes/all-themes.css" rel="stylesheet" />

  <script src="plugins/jquery/jquery.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <script src="jquery-ui.js"></script>


  <script type="text/javascript">
  // function show(param_div_id)
  // {
  //   document.getElementById('mainpage').innerHTML = document.getElementById(param_div_id).innerHTML;
  // }
  $(document).ready(function()
     {


      //  $( "#stock" ).click(function()
      //  {
      //     $("#transferview").hide();
      //     $("#supplierview").hide();
      //     $("#stockview").show();
      //  });
      //  $( "#transfer" ).click(function()
      //  {
      //     $("#transferview").show();
      //     $("#supplierview").hide();
      //     $("#stockview").hide();
      // });
      // $( "#supplier" ).click(function()
      //  {
      //       $("#transferview").hide();
      //       $("#supplierview").show();
      //       $("#stockview").hide();
      // });
     });
  </script>
  <style type="text/css">
      body
      {
          counter-reset: Serial;
      }

      #data_table3
      {
          border-collapse: separate;
      }

      #data_table3 tr td:first-child:before
      {
          counter-increment: Serial;
          content: counter(Serial);
      }
  </style>
</head>

<body class="theme-cyan" >
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
  <!-- #END# Overlay For Sidebars

  @extends('partials.topheader')
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
                   <li class="active">
                       <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">euro_symbol</i>
                           <span>Purchase</span>
                       </a>
                       <ul class="ml-menu">
                           <li >
                               <a href="{{ url('purchase_stock') }}">Purchase-Stock</a>
                           </li>
                           <li class="active">
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

                           <li >
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
                   &copy; 2016 - 2017 <a href="">Jesus Redeems IT Dept.</a>
               </div>
               <div class="version">
                   <b>Version: </b> 1.0.0
               </div>
           </div>
           <!-- #Footer -->
       </aside>
     </section>

  <section class="content">

    <div class="card">
      <div class="header bg-cyan">
          <!-- <h2>Stock</h2> -->
          <!-- <button type="button" data-color="cyan" class="btn bg-blue-grey waves-effect" id="stock"  > <i class="material-icons">local_grocery_store</i>
          <span>Stock</span></button>
          <button type="button" data-color="cyan" class="btn bg-blue-grey waves-effect" id="transfer" > <i class="material-icons">redo</i>
          <span>Stock Transfer</span></button>
          <button type="button" data-color="cyan" class="btn bg-blue-grey waves-effect" id="supplier" > <i class="material-icons">undo</i>
          <span>Suppliers</span></button> -->
          <p>
              <h3>Purchase View</h3>
          </p>
      </div>
      <div class="body">

      <div id="stockview">
      <div class="row-clearfix">
        <div class="table-responsive">
          <!-- <table class="table table-bordered table-striped table-hover js-basic-example dataTable"  id="data_table1"> -->
            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="data_table1">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Barcode</th>
                <th>Supplier</th>
                <th>Invoice No.</th>
                <th>Billed Date</th>
                <th>Received Date</th>
                <th>Location</th>
                <th>Quantity</th>
                <th>Notes</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $item)
              <tr class="item{{$item->id}}">
                <td>{{$item->product_name}}</td>
                <td>{{$item->barcode}}</td>
                <td>{{$item->supplier}}</td>
                <td>{{$item->invoice_number}}</td>
                <td>{{$item->billed_date}}</td>
                <td>{{$item->received_date}}</td>
                <td>{{$item->location}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->notes}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <br />
        </div>
      </div>
    </div>



  </div>
  </section>
  <script src="script/sales.js"></script>
  <!-- Jquery Core Js -->
  <script src="plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core Js -->
  <script src="plugins/bootstrap/js/bootstrap.js"></script>

  <!-- Select Plugin Js -->
  <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

  <!-- noUISlider Plugin Js -->
  <script src="plugins/nouislider/nouislider.js"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="plugins/node-waves/waves.js"></script>

  <!-- Bootstrap Notify Plugin Js -->
  <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="plugins/node-waves/waves.js"></script>



  <!-- Jquery DataTable Plugin Js -->
  <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
  <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
  <script src="/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
  <script src="/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
  <script src="/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
  <script src="/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
  <script src="/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
  <script src="/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
  <script src="/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

  <!-- Custom Js -->
  <script src="js/admin.js"></script>
  <script src="js/pages/tables/jquery-datatable.js"></script>
  <script src="js/pages/forms/advanced-form-elements.js"></script>
  <script src="js/pages/ui/dialogs.js"></script>
  <script src="js/pages/ui/modals.js"></script>

  <!-- Demo Js -->
  <script src="js/demo.js"></script>

</body>

</html>
