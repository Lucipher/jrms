<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add Stock | JR-POP</title>

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
         $(document).ready(function()
            {
                $("#stock_edit_div").hide();
                $("#stock_display").hide();
                $("#hide_barcode").hide();
                $("#hide_product").hide();
                $("#add_stock_button").hide();
                $("#confirm").attr("disabled", "disabled");

                $('#notes').keyup(function()
                {
                  var len = this.value.length;
                  if (len >= 255)
                  {
                      $('#charLeft_notify').text("Only 255 Characters allowed");
                      this.value = this.value.substring(-1, 255);
                  }
                  $('#charLeft').text(255 - (len-1));

                });

                $( "#prod_name" ).change(function( event ) {

                        var prod_name=$('#prod_name').val();
                        var url1='demo';
                         $.ajax
                        ({
                        url: url1,
                        data: {prod_name:prod_name },
                        type: 'get',
                        success:function(data)
                        {
                            $.each(data, function(i, ItemSel){
                            $("#barcode").val(ItemSel.bnumber);
                            $("#product_id").val(ItemSel.id);
                            $("#qty").focus();
                             });
                        },

                     });
                     return false;
                });

                $( "#barcode" ).change(function( event ) {
                        var barcode=$('#barcode').val();
                        var url2='select_barcode';
                         $.ajax
                        ({
                        url: url2,
                        data: {barcode:barcode },
                        type: 'get',
                        success:function(data)
                        {
                            $.each(data, function(i, ItemSel)
                            {
                              $("#prod_name").val(ItemSel.itemname);
                              $("#product_id").val(ItemSel.id);
                              $("#qty").focus();
                            });
                        },

                     });
                     return false;
                });
                $( "#qty" ).keypress(function( event ) {
                    if ( event.which == 13 )
                    {
                        var supplier=$('#supplier').val();
                        var invoice_number=$('#invoice_number').val();
                        var billed_date=$('#billed_date').val();
                        var received_date=$('#received_date').val();
                        var prod_name=$('#prod_name').val();
                        var product_id=$('#product_id').val();
                        var barcode=$('#barcode').val();
                        var qty=$('#qty').val();

                        if(qty == '0')
                        {
                            alert("Quantity should not be zero!!!");
                            $("#qty").val('');
                        }
                        else if(prod_name == '')
                        {
                          alert("please fill the Product Name");
                          $("#prod_name").focus();
                        }
                        else if(barcode == '')
                        {
                          alert("please fill the Barcode");
                          $("#supplier").focus();
                        }
                        else if(invoice_number == '')
                        {
                          alert("please fill the invoice_number");
                          $("#invoice_number").focus();
                        }
                        else if(billed_date == '')
                        {
                          alert("please fill the billed_date");
                          $("#billed_date").focus();
                        }
                        else if(received_date == '')
                        {
                          alert("please fill the received_date");
                          $("#received_date").focus();
                        }
                        else
                        {
                            if (qty == '') {
                                $("#qty").focus();
                            }

                            else
                            {
                              // $('#display_table tbody').append('<tr><td><input type="hidden" value=' + ' ' + ' /></td><td><input type="text" style="border: none;" size="10" value='
                              // + supplier + ' /></td><td><input type="text" style="border: none;" size="10" value=' +
                              // invoice_number  + ' ></td><td><input type="text" style="border: none;" size="10" value='+ billed_date +
                              // ' ></td><td><input type="text" style="border: none;" size="10" value='+ received_date +
                              // ' ></td><td><input type="text" style="border: none;" size="10" value=' +
                              // prod_name  + ' ></td><td><input type="text" style="border: none;" size="10" value=' +
                              // product_id  + ' ></td><td><input type="text" style="border: none;" size="10" value=' +
                              // barcode  + ' ></td><td><input type="text" style="border: none;" size="10" value='+ qty +
                              // ' ></td><td><input type="button" class="ajaxdelete" id="ajaxdelete" value="Delete" /></td></tr>');

                              $('#display_table tbody').append("<tr><td>" + " " + "</td><td>" + supplier +"</td><td>" + invoice_number +"</td><td>" + billed_date +
                              "</td><td>"+ received_date +"</td><td>" + prod_name +   "</td><td>" + product_id +   "</td><td>"  + barcode + "</td><td>" + qty  + "</td><td><input type='button' class='ajaxdelete' id='ajaxdelete' value='Delete' /></td></tr>");

                                  $("#confirm").removeAttr('disabled');
                                  $("#prod_name").val('');
                                  $("#product_id").val('');
                                  $("#barcode").val('');
                                  $("#qty").val('');
                                  $("#prod_name").focus();
                            }
                         }

                    }

                 });
                 $( "#save" ).click(function() {
                      // alert("djhgkjfg");
                      var notes=$('#notes').val();
                      $("#display_table tr:gt(0)").each(function ()
                                  {

                                      var this_row = $(this);
                                      var supplier = $.trim(this_row.find('td:eq(1)').html());
                                      // alert(supplier);
                                      var invoice_number = $.trim(this_row.find('td:eq(2)').html());
                                      var billed_date = $.trim(this_row.find('td:eq(3)').html());
                                      var received_date = $.trim(this_row.find('td:eq(4)').html());
                                      var prod_name = $.trim(this_row.find('td:eq(5)').html());//td:eq(0) means first
                                          // alert(prod_name);
                                      var product_id = $.trim(this_row.find('td:eq(6)').html());
                                      var bcode = $.trim(this_row.find('td:eq(7)').html());
                                      // alert(bcode);
                                      var qty = $.trim(this_row.find('td:eq(8)').html());
                                      // alert(qty);
                                      var rows = $('tr:visible').length ;
                                      var row = rows -1;

                                      var url3='add_purchase_stock';
                                      $.ajax
                                      ({
                                          url: url3,
                                          data: {supplier:supplier,invoice_number:invoice_number,billed_date:billed_date,received_date:received_date,
                                              prod_name:prod_name,product_id:product_id,bcode:bcode,qty:qty,row:row,notes:notes},
                                          type: 'get',
                                          success:function(data)
                                          {
                                            // alert("hgkjhdfjg");
                                            alert(data);
                                          },
                                      });
                                   });
                          alert("Saved Successfully");
                          $('#smallModal').modal('hide');
                          location.reload();
                      });

                      $( "#add_product" ).click(function() {

                        var supplier=$('#supplier').val();
                        var invoice_number=$('#invoice_number').val();
                        var billed_date=$('#billed_date').val();
                        var received_date=$('#received_date').val();
                        var prod_name=$('#prod_name').val();
                        var product_id=$('#product_id').val();
                        var barcode=$('#barcode').val();
                        var qty=$('#qty').val();

                        if(qty == '0')
                        {
                            alert("Quantity should not be zero!!!");
                            $("#qty").val('');
                        }
                        else if(prod_name == '')
                        {
                          alert("please fill the Product Name");
                          $("#prod_name").focus();
                        }
                        else if(barcode == '')
                        {
                          alert("please fill the Barcode");
                          $("#supplier").focus();
                        }
                        else if(invoice_number == '')
                        {
                          alert("please fill the invoice_number");
                          $("#invoice_number").focus();
                        }
                        else if(billed_date == '')
                        {
                          alert("please fill the billed_date");
                          $("#billed_date").focus();
                        }
                        else if(received_date == '')
                        {
                          alert("please fill the received_date");
                          $("#received_date").focus();
                        }
                        else
                        {
                            if (qty == '') {
                                $("#qty").focus();
                            }

                            else
                            {
                              // $('#display_table tbody').append('<tr><td><input type="hidden" value=' + ' ' + ' /></td><td><input type="text" style="border: none;" size="10" value='
                              // + supplier + ' /></td><td><input type="text" style="border: none;" size="10" value=' +
                              // invoice_number  + ' ></td><td><input type="text" style="border: none;" size="10" value='+ billed_date +
                              // ' ></td><td><input type="text" style="border: none;" size="10" value='+ received_date +
                              // ' ></td><td><input type="text" style="border: none;" size="10" value=' +
                              // prod_name  + ' ></td><td><input type="text" style="border: none;" size="10" value=' +
                              // product_id  + ' ></td><td><input type="text" style="border: none;" size="10" value=' +
                              // barcode  + ' ></td><td><input type="text" style="border: none;" size="10" value='+ qty +
                              // ' ></td><td><input type="button" class="ajaxdelete" id="ajaxdelete" value="Delete" /></td></tr>');

                                $('#display_table tbody').append("<tr><td>" + " " + "</td><td>" + supplier +"</td><td>" + invoice_number +"</td><td>" + billed_date +
                                "</td><td>" + received_date +"</td><td>" + prod_name +   "</td><td>" + product_id +   "</td><td>"  + barcode + "</td><td>" + qty  + "</td><td><input type='button' class='ajaxdelete' id='ajaxdelete' value='Delete' /></td></tr>");

                                  $("#confirm").removeAttr('disabled');
                                  $("#prod_name").val('');
                                  $("#product_id").val('');
                                  $("#barcode").val('');
                                  $("#qty").val('');
                                  $("#prod_name").focus();
                            }
                         }
                    });
                    $( "#add_stock_button" ).click(function()
                      {
                            $("#stock_add_div").show();
                            $("#stock_edit_div").hide();
                            $("#modify_stock_button").show();
                            $("#add_stock_button").hide();

                      });
                      $( "#modify_stock_button" ).click(function()
                      {
                         $("#modify_stock_button").hide();
                         $("#add_stock_button").show();

                            $("#stock_add_div").hide();
                            $("#stock_edit_div").show();

                         $( "#search_supplier" ).click(function()
                         {
                             var supplier_details=$('#supplier_details').val();
                             var url4='purchase_stock_modify';
                             $.ajax
                             ({
                                url: url4,
                                data: {supplier_details:supplier_details },
                                type: 'get',
                                success:function(data)
                                {
                                   // // alert("Record Inserted");
                                   $.each(data, function(i, ItemSel){

                                   $('#stock_edit tbody').append('<tr><td><input type="text" style="border: none;" size="10" class="content_edit1" value='
                                   + ItemSel.product_name + ' /></td><td><input type="text" style="border: none;" class="content_edit1" size="10" value='
                                   + ItemSel.supplier + ' /></td><td><input type="text" style="border: none;" class="content_edit1" size="10" value='
                                   + ItemSel.invoice_number + ' /></td><td><input type="text" style="border: none;" size="10" class="content_edit1" value='
                                   + ItemSel.billed_date  + ' ></td><td><input type="text" style="border: none;" size="10" class="content_edit1" value='
                                   + ItemSel.received_date  + ' ></td><td><input type="text" style="border: none;" size="10" class="content_edit1" value='
                                   + ItemSel.location  + ' ></td><td><input type="number"  id="edit_quantity" class="content_edit"  onkeypress="return event.charCode >= 48" min="1" style="border: none;width:80px;" size="5" value='
                                   + ItemSel.quantity + ' ></td><td><input type="text"  id="edit_notes" class="content_edit"  style="border: none;" size="10" value='
                                    + ItemSel.notes + ' ></td><td><input type="button" class="ajaxedit" id="ajaxedit" value="Edit" /> <input type="button" class="ajaxsave" id="ajaxsave" value="Save" />' + '</td></tr>');


                                    $(".content_edit").attr("readonly", "false");
                                    $(".content_edit1").attr("readonly", "false");
                                 });
                                 // alert(data);
                               },
                            });
                          });

                         });
                  });
                  $(document).on('click', '.ajaxedit', function()
                  {

                      $(".content_edit").  removeAttr('readonly');
                      var product_name = $(this).closest("tr").find("td:eq(0) input[type='text']").val();
                      var supplier = $(this).closest("tr").find("td:eq(1) input[type='text']").val();
                      var invoice_number = $(this).closest("tr").find("td:eq(2) input[type='text']").val();
                      var billed_date = $(this).closest("tr").find("td:eq(3) input[type='text']").val();
                      var received_date = $(this).closest("tr").find("td:eq(4) input[type='text']").val();
                      var location = $(this).closest("tr").find("td:eq(5) input[type='text']").val();
                      var quantity = $(this).closest("tr").find("td:eq(6) input[type='number']").val();
                      var notes = $(this).closest("tr").find("td:eq(7) input[type='text']").val();
                      $("#stock_qty").val(quantity);
                      // alert(quantity);


                  });
                  $(document).on('click', '.ajaxdelete', function()
                  {
                      // alert("edit");

                     $(this).parents("tr").remove();

                  });



                  $(document).on('click', '.ajaxsave', function()
                  {

                    var stock_qty=$('#stock_qty').val();
                    // alert(stock_qty);

                    $(".content_edit").attr("readonly", "false");

                    var product_name = $(this).closest("tr").find("td:eq(0) input[type='text']").val();
                    var supplier = $(this).closest("tr").find("td:eq(1) input[type='text']").val();
                    var invoice_number = $(this).closest("tr").find("td:eq(2) input[type='text']").val();
                    var billed_date = $(this).closest("tr").find("td:eq(3) input[type='text']").val();
                    var received_date = $(this).closest("tr").find("td:eq(4) input[type='text']").val();
                    var location = $(this).closest("tr").find("td:eq(5) input[type='text']").val();
                    var quantity = $(this).closest("tr").find("td:eq(6) input[type='number']").val();
                    var notes = $(this).closest("tr").find("td:eq(7) input[type='text']").val();
                    var url5='purchase_stock_update';
                          $.ajax
                             ({
                                 url: url5,
                                 data: {product_name:product_name,location:location,supplier:supplier,invoice_number:invoice_number,
                                   billed_date:billed_date,received_date:received_date,quantity:quantity,notes:notes,stock_qty:stock_qty},
                                 type: 'get',
                                 success:function(data)
                                 {
                                  //  alert(data);
                                  },
                               });
                               alert("Modified successfully");
                               $('#supplier_details').val('');
                               $('#table_content').html('');
                            });


    </script>
    <style type="text/css">
        body
        {
            counter-reset: Serial;
        }

        #display_table
        {
            border-collapse: separate;
        }

        #display_table tr td:first-child:before
        {
            counter-increment: Serial;
            content: counter(Serial);
        }
    </style>


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
                     <li  class="active">
                         <a href="javascript:void(0);" class="menu-toggle">
                             <i class="material-icons">euro_symbol</i>
                             <span>Purchase</span>
                         </a>
                         <ul class="ml-menu">
                             <li  class="active">
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
      <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header bg-cyan">
                          <button type="button" data-color="cyan" class="btn bg-blue-grey waves-effect" id="add_stock_button"  > <i class="material-icons">local_grocery_store</i>
                          <span>Add Purchase-Stock</span></button>
                          <button type="button" data-color="cyan" class="btn bg-blue-grey waves-effect" id="modify_stock_button" > <i class="material-icons">redo</i>
                          <span>Modify Purchase-Stock</span></button>
                        </div>

                        <div class="card" id="stock_add_div" >
                          <div class="body" >
                              <div class="row clearfix">
                                <!-- <div class="col-md-2"></div> -->
                                <div class="col-md-3">
                                      <div class="input-group">
                                          <p>
                                              <b>Supplier</b>
                                          </p>
                                          <div class="form-line">
                                              <select class="form-control" id="supplier" name="supplier" data-placement="bottom" data-toggle="popover">
                                                     <option></option>
                                                     @foreach($data as $item)
                                                          <option> {{$item->supplier}}</option>
                                                     @endforeach
                                              </select>
                                          </div>

                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="input-group">
                                          <p>
                                              <b>Invoice Number</b>
                                          </p>
                                          <div class="form-line">
                                              <input type="text" class="form-control date" id="invoice_number" name="invoice_number" >
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="input-group">
                                          <p>
                                              <b>Billed Date</b>
                                          </p>
                                          <div class="form-line">
                                              <input type="date" class="form-control date" id="billed_date" name="billed_date" >
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="input-group">
                                          <p>
                                              <b>Received Date</b>
                                          </p>
                                          <div class="form-line">
                                              <input type="date" class="form-control date" id="received_date" name="received_date" >
                                          </div>
                                      </div>
                                  </div>
                                    <div class="col-md-1"></div>
                                  <div class="col-md-3">
                                      <div class="input-group">
                                          <p>
                                              <b>Product Name</b>
                                          </p>
                                          <div class="form-line">
                                                <select class="form-control" id="prod_name" name="prod_name" data-placement="bottom" data-toggle="popover">
                                                       <option></option>
                                                       @foreach($data1 as $item)
                                                            <option> {{$item->itemname}}</option>
                                                       @endforeach
                                                </select>
                                          </div>
                                        </div>
                                  </div>
                                  <!-- id="hide_barcode" -->
                                  <div class="col-md-3" >
                                      <div class="input-group">
                                          <p>
                                              <b>Barcode</b>
                                          </p>
                                          <div class="form-line">
                                              <input type="text" class="form-control date" id="barcode" name="barcode" >
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-2" id="hide_product">
                                    <!-- <div class="col-md-2" > -->
                                      <div class="input-group">
                                          <p>
                                              <b>Product Id</b>
                                          </p>
                                          <div class="form-line">
                                              <input type="text" class="form-control date" id="product_id" name="product_id" >
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="input-group">
                                          <p>
                                              <b>Quantity</b>
                                          </p>
                                          <div class="form-line">
                                                <input type="number" onkeypress="return event.charCode >= 48" min="1" class="form-control date" id="qty" name="qty" >
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-1">
                                      <p><b>&nbsp;</b></p>
                                      <button type="button" id="add_product" name="add_product" class="btn bg-cyan waves-effect" >
                                          <i class="material-icons">add_shopping_cart </i>
                                          <span>Add</span></button>
                                      </button>
                                  </div>

                              </div>

                              <div class="row-clearfix">
                                  <div class="table-responsive">

                                      <!--  <table class="table table-bordered table-striped table-hover js-basic-example dataTable"  id="data_table"> -->
                                      <table class="table table-striped" id="display_table" name="display_table">
                                          <thead>
                                              <tr>
                                                  <th>S.No</th>
                                                  <th>Supplier</th>
                                                  <th>Invoice Number</th>
                                                  <th>Billed Date</th>
                                                  <th>Received Date</th>
                                                  <th>Product Name</th>
                                                  <th>Product Id</th>
                                                  <th>Barcode</th>
                                                  <th>Quantity</th>
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>
                                      </table>
                                      <br>
                                  </div>
                              </div>


                          </div>

                            <div class="header bg-cyan" >

                                <div  class="button-demo js-modal-buttons" style="vertical-align: text-top;text-align: right;">
                                        <button type="button" data-color="blue-grey" class="btn bg-blue-grey waves-effect" data-toggle="modal" data-target="#smallModal" id="confirm" > <i class="material-icons">save</i>
                                        <span>Confirm</span></button>

                                        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content modal-col-cyan">
                                                <div class="modal-body" >
                                                    <p>
                                                        <b>Notes</b>
                                                    </p>
                                                    <div class="form-line">
                                                      <span id="charLeft"> </span>  Characters left
                                                      <br>
                                                      <span id="charLeft_notify"> </span>
                                                      <textarea rows="3" name="notes" id="notes" class="form-control no-resize" placeholder="Desciption"></textarea>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link waves-effect" id="save" >SAVE</button>
                                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
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
            <div class="row clearfix" id="stock_edit_div">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-12 col-md-12">
                      <div class="card">
                                    <div class="body">
                                        <div class="row clearfix">
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <p>
                                                    <b>Supplier </b>
                                                </p>
                                                <div class="form-line">

                                                    <select class="form-control" id="supplier_details" name="supplier_details" data-placement="bottom" data-toggle="popover">
                                                      <option></option>
                                                      @foreach($data as $item)
                                                           <option> {{$item->supplier}}</option>
                                                      @endforeach
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div id="shstk"> -->
                                           <div class="col-md-1" id="stock_display">
                                           <div class="input-group">
                                               <p>
                                                   <b>Stock</b>
                                               </p>
                                               <div class="form-line">
                                                   <input type="text" class="form-control date" id="stock_qty" name="stock_qty" >
                                               </div>
                                           </div>
                                           </div>
                                       <!-- </div> -->
                                        <div class="col-md-1">
                                            <p><b>&nbsp;</b></p>
                                            <button type="button" id="search_supplier" name="search_supplier" class="btn bg-cyan waves-effect" >
                                                <i class="material-icons">search</i>
                                                <span>Search</span></button>
                                            </button>
                                        </div>
                                      </div>
                                                    <div class="row-clearfix">
                                                        <div class="table-responsive">

                                                            <!--  <table class="table table-bordered table-striped table-hover js-basic-example dataTable"  id="data_table"> -->
                                                            <table class="table table-striped" id="stock_edit" name="stock_edit">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>S.No</th> -->
                                                                        <th>Product Name</th>
                                                                        <th>Supplier</th>
                                                                        <th>Invoice No.</th>
                                                                        <th>Billed Date</th>
                                                                        <th>Received Date</th>
                                                                        <th>Location</th>
                                                                        <th>Quantity</th>
                                                                        <th>Notes</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="table_content">

                                                                </tbody>
                                                            </table>
                                                            <br>
                                                        </div>
                                                    </div>

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
    <!-- <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

    <!-- Slimscroll Plugin Js -->
    <script src=" plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

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
    <script src="plugins/editable-table/mindmup-editabletable.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script src="js/pages/forms/advanced-form-elements.js"></script>
    <script src="js/pages/ui/dialogs.js"></script>
    <script src="js/pages/ui/modals.js"></script>
    <script src="js/pages/tables/editable-table.js"></script>
    <!-- Demo Js -->
    <script src="js/demo.js"></script>


</body>

</html>
