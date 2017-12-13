<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Stock Transfer| JR-POP</title>

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
              $("#transfer_modify").hide();
              $("#stock_location").focus();
              $("#edit_details").focus();
              $('#prod_name').blur();
              $("#showloc").hide();
              $("#shstk").hide();


              $("#stock_location").change(function(){
                  // var country=$('#Country').val();
                  var stock_location=$('#stock_location').val();
                   var url1='select_product_name';
                  $.ajax
                  ({
                     url: url1,
                     data: {stock_location:stock_location},
                     type: 'get',
                     success:function(data)
                     {

                       $('#prod_name').empty();
                       var n=data.length;
                       if(n == 0)
                       {
                         alert("Stock Unavailable for this location");
                           $("#stock_location").val('');
                       }
                       else
                       {

                         alert("Toggle Product name to do transfer");
                         $('#prod_name').focus();
                         $('#prod_name').append( "<option>" + "Select product" + "</option>");
                         for(var i=0;i<=n-1;i++)
                         {
                           $('#prod_name').append( "<option>" + data[i] + "</option>");
                            // alert(data[i]);
                         }
                       }
                    },
                  });
              });

              $(document).on('change','#prod_name',function(){
                      // alert("pressed");
                      var prod_name=$('#prod_name').val();
                      var stock_location=$('#stock_location').val();
                      var url2='transfer_select_product';
                       $.ajax
                      ({
                      url: url2,
                      data: {prod_name:prod_name,stock_location:stock_location },
                      type: 'get',
                      success:function(data)
                      {

                        // alert("Record Inserted");
                          $.each(data, function(i, ItemSel){
                          // alert(ItemSel.itemname);
                          // alert(ItemSel.bnumber);
                          $("#prod_name").val(ItemSel.product_name);
                          $("#barcode").val(ItemSel.barcode);
                          $("#product_id").val(ItemSel.product_id);
                          $("#stk").val(ItemSel.quantity);
                          // $("#qty").focus();

                            $("#product_id").attr("disabled", "disabled");
                            $("#barcode").attr("disabled", "disabled");
                            $("#stk").attr("disabled", "disabled");
                            $("#qty").focus();

                          });
                      },

                   });
                    return false;
                  // }
                });

                $( "#barcode" ).change(function( event ) {
                    // if ( event.which == 13 || event.which == 9 )
                    // {
                    //     // alert("pressed");
                        var barcode=$('#barcode').val();
                        var url3='select_barcode';
                         $.ajax
                        ({
                        url: url3,
                        data: {barcode:barcode },
                        type: 'get',
                        success:function(data)
                        {
                          // alert("Record Inserted");
                            $.each(data, function(i, ItemSel){
                            // alert(ItemSel.itemname);
                            // alert(ItemSel.bnumber);
                            $("#prod_name").val(ItemSel.itemname);
                            // $("#barcode").val(ItemSel.bnumber);
                            $("#product_id").val(ItemSel.id);
                            $("#qty").focus();
                             });
                        },

                     });
                     return false;
                    // }
                });


                  $( "#qty" ).keypress(function( event ) {
                  if ( event.which == 13 )
                  {
                    $("#stock_location").attr("disabled", "disabled");
                      var prod_name=$('#prod_name').val();
                      var product_id=$('#product_id ').val();
                      var barcode=$('#barcode').val();
                      var qty=$('#qty').val();
                      var stk=$('#stk').val();
                      var stock_location=$('#stock_location').val();
                      // alert(qty);
                      // alert(stk);

                      if(qty == '0')
                      {
                          alert("Quantity should not be zero!!!");
                          $("#qty").val('');
                      }
                      else
                      {
                        if (qty == '')
                        {
                            $("#qty").focus();
                        }
                        else if(prod_name == '')
                        {
                          alert("Please Fill The Product Name");
                          $("#prod_name").focus();
                        }
                        else if(barcode == '')
                        {
                          alert("Please Fill The Barode");
                          $("#barcode").focus();
                        }
                        else if(+qty > +stk)
                        {
                            alert("Stock is less to transfer!!!");
                            $("#prod_name").val('');
                            $("#product_id").val('');
                            $("#barcode").val('');
                            $("#qty").val('');
                            $("#stk").val('');
                            $("#stock_location").val('');
                            $("#prod_name").blur();
                        }
                        else
                        {
                            // alert("stock can transfer");
                            var myTable = document.getElementById("display_table");
                            var rowCount = myTable.rows.length;
                            // for (var x=rowCount-1; x>0; x--)
                            // {
                            //     myTable.deleteRow(x);
                            // }

                            $('#display_table tbody').append("<tr><td>" + " " + "</td><td>" + prod_name + "</td><td>" + product_id + "</td><td>" + barcode    + "</td><td>" +  stock_location   + "</td><td>" + qty  + "</td></tr>");

                                // $("#product_id").attr("disabled", "disabled");
                                $("#prod_name").val('');
                                $("#product_id").val('');
                                $("#barcode").val('');
                                $("#qty").val('');
                                $("#stk").val('');
                                $("#prod_name").focus();
                        }
                      }

                  }
                  });

                  $( "#transfer_product" ).click(function() {

                    $("#stock_location").attr("disabled", "disabled");
                      var prod_name=$('#prod_name').val();
                      var product_id=$('#product_id ').val();
                      var barcode=$('#barcode').val();
                      var qty=$('#qty').val();
                      var stk=$('#stk').val();
                      var stock_location=$('#stock_location').val();
                      // alert(qty);
                      // alert(stk);

                      if(qty == '0')
                      {
                          alert("Quantity should not be zero!!!");
                          $("#qty").val('');
                      }
                      else
                      {
                        if (qty == '')
                        {
                            $("#qty").focus();
                        }
                        else if(prod_name == '')
                        {
                          alert("Please Fill The Product Name");
                          $("#prod_name").focus();
                        }
                        else if(barcode == '')
                        {
                          alert("Please Fill The Barode");
                          $("#barcode").focus();
                        }
                        else if(+qty > +stk)
                        {
                            alert("Stock is less to transfer!!!");
                            $("#prod_name").val('');
                            $("#product_id").val('');
                            $("#barcode").val('');
                            $("#qty").val('');
                            $("#stk").val('');
                            $("#stock_location").val('');
                            $("#prod_name").blur();
                        }
                        else
                        {
                            // alert("stock can transfer");
                            var myTable = document.getElementById("display_table");
                            var rowCount = myTable.rows.length;
                            // for (var x=rowCount-1; x>0; x--)
                            // {
                            //     myTable.deleteRow(x);
                            // }

                            $('#display_table tbody').append("<tr><td>" + " " + "</td><td>" + prod_name + "</td><td>" + product_id + "</td><td>" + barcode    + "</td><td>" +  stock_location   + "</td><td>" + qty  + "</td></tr>");

                                // $("#product_id").attr("disabled", "disabled");
                                $("#prod_name").val('');
                                $("#product_id").val('');
                                $("#barcode").val('');
                                $("#qty").val('');
                                $("#stk").val('');
                                $("#prod_name").focus();
                        }
                      }


                  });

                  $( "#save" ).keypress(function( event ) {
                  if ( event.which == 13 )
                      {

                        var loc1=$('#loc1').val();
                        var myTable = document.getElementById("display_table");
                        var rowCount = myTable.rows.length;


                      $("#display_table tr:gt(0)").each(function ()
                              {
                                  var this_row = $(this);
                                  var prod_name = $.trim(this_row.find('td:eq(1)').html());//td:eq(0) means first
                                      // alert(prod_name);
                                  var product_id = $.trim(this_row.find('td:eq(2)').html());
                                  var bcode = $.trim(this_row.find('td:eq(3)').html());
                                  // alert(bcode);
                                  var loc = $.trim(this_row.find('td:eq(4)').html());
                                  var qty = $.trim(this_row.find('td:eq(5)').html());
                                  // alert(qty);

                                  var rows = $('tr:visible').length ;
                                  var row = rows -1;
                                  var url4='stocktransfercheck';
                                  $.ajax
                                  ({
                                      url: url4,
                                      data: {prod_name:prod_name,product_id:product_id,bcode:bcode,qty:qty,loc:loc,loc1:loc1,row:row},
                                      type: 'get',
                                      success:function(data)
                                      {
                                          // alert("fgfdsga");
                                          // var i=0;
                                          // if(i == 0)
                                          // {
                                          //   i=1;
                                          //   alert("Saved Successfully");
                                          //   i++;
                                          // }
                                        alert(data);
                                      },

                                  });


                              });

                      $('#smallModal').modal('hide');
                      location.reload();
                    }
                  });
                  $( "#save" ).click(function()
                  {
                        var loc1=$('#loc1').val();
                        var notes=$('#notes').val();
                        var myTable = document.getElementById("display_table");
                        var rowCount = myTable.rows.length;

                      $("#display_table tr:gt(0)").each(function ()
                              {
                                  var this_row = $(this);
                                  var prod_name = $.trim(this_row.find('td:eq(1)').html());//td:eq(0) means first
                                      // alert(prod_name);
                                  var product_id = $.trim(this_row.find('td:eq(2)').html());
                                  var bcode = $.trim(this_row.find('td:eq(3)').html());
                                  // alert(bcode);
                                  var loc = $.trim(this_row.find('td:eq(4)').html());
                                  var qty = $.trim(this_row.find('td:eq(5)').html());
                                  // alert(qty);

                                  var rows = $('tr:visible').length ;
                                  var row = rows -1;

                                  var url5='stocktransfercheck';
                                  $.ajax
                                  ({
                                      url:url5,
                                      data: {prod_name:prod_name,product_id:product_id,bcode:bcode,qty:qty,loc:loc,loc1:loc1,row:row,notes:notes},
                                      type: 'get',
                                      success:function(data)
                                      {
                                          alert(data);
                                          // alert("fgfdsga");
                                          // var i=0;
                                          // if(i == 0)
                                          // {
                                          //   i=1;
                                          //   alert("Saved Successfully");
                                          // }

                                      },

                                  });


                              });

                      $('#smallModal').modal('hide');
                      location.reload();

                  });
              $( "#add_transfer" ).click(function()
              {
                 $("#transfer_add").show();
                 $("#transfer_modify").hide();

              });

              $( "#modify_transfer" ).click(function()
              {
                 $("#transfer_add").hide();
                 $("#edit_transfer_id").hide();
                 $("#transfer_modify").show();
                 $("#stock_display").hide();

                 $( "#search_product" ).click(function()
                 {
                   var edit_details=$('#edit_details').val();
                   var url6='stocktransfermodify';
                   $.ajax
                   ({
                      url: url6,
                      data: {edit_details:edit_details },
                      type: 'get',
                      success:function(data)
                      {
                         // // alert("Record Inserted");
                         $.each(data, function(i, ItemSel){
                         // alert(ItemSel.itemname);
                         // alert(ItemSel.bnumber);

                         // $("#edit_product_name").val(ItemSel.product_name);
                         // $("#edit_barcode").val(ItemSel.barcode);
                         // $("#edit_product_id").val(ItemSel.product_id);
                         // $("#edit_qty").val(ItemSel.quantity);
                         // $("#edit_from_location").val(ItemSel.from_location);
                         // $("#edit_to_location").val(ItemSel.to_location);
                         // $("#edit_id").val(ItemSel.id);

                         // alert(ItemSel.id);
                         // $("#qty").focus();
                         // $("#showloc").show();
                         // $("#stkloc").focus();

                        //  $('#transfer_edit tbody').append("<tr><td>" + " " + "</td><td>" + ItemSel.product_name + "</td><td>" +
                        //  ItemSel.product_id + "</td><td>" + ItemSel.barcode  + "</td><td>" + ItemSel.from_location + "</td><td>" +
                        //  ItemSel.to_location   + "</td><td>" + ItemSel.quantity
                        //  + "</td><td><input type='button' class='ajaxedit' id='ajaxedit' value='Edit'/> <input type='button' id='ajaxsave' class='ajaxsave' value='Save'>"
                        //  + "</td></tr>");

                        $('#transfer_edit tbody').append('<tr><td><input type="hidden" value=' + ' ' + ' /></td><td><input type="text" style="border: none;" size="10" value='
                        + ItemSel.product_name + ' /></td><td><input type="text" style="border: none;" size="10" value=' +
                        ItemSel.product_id  + ' ></td><td><input type="text" style="border: none;"  id="edit_supplier" class="content_edit" size="10" value='+ ItemSel.barcode +
                        ' ></td><td><input type="text" id="edit_invoice" class="content_edit" style="border: none;" size="10" value='+ ItemSel.from_location +
                        ' ></td><td><input type="text" id="edit_billeddate" class="content_edit" style="border: none;" size="10" value='
                        + ItemSel.to_location + ' /></td><td><input type="number"  id="edit_quantity" class="content_edit"  onkeypress="return event.charCode >= 48" min="1" style="border: none;width:80px;" size="5" value='
                        + ItemSel.quantity + ' ></td><td><input type="button" class="ajaxedit" id="ajaxedit" value="Edit" /> <input type="button" class="ajaxsave" id="ajaxsave" value="Save" />' + '</td></tr>');

                        $(".content_edit").attr("readonly", "false");
                       });

                       // alert(data);
                     },
                  });

                  });



              //    $( "#edit_details" ).keypress(function( event ) {
              //      if ( event.which == 13 || event.which == 9)
              //      {
               //
              //           var edit_details=$('#edit_details').val();
               //
              //           $.ajax
              //           ({
              //              url: '/stocktransfermodify',
              //              data: {edit_details:edit_details },
              //              type: 'get',
              //              success:function(data)
              //              {
              //                 // // alert("Record Inserted");
              //                 $.each(data, function(i, ItemSel){
              //                 // alert(ItemSel.itemname);
              //                 // alert(ItemSel.bnumber);
               //
              //                 // $("#edit_product_name").val(ItemSel.product_name);
              //                 // $("#edit_barcode").val(ItemSel.barcode);
              //                 // $("#edit_product_id").val(ItemSel.product_id);
              //                 // $("#edit_qty").val(ItemSel.quantity);
              //                 // $("#edit_from_location").val(ItemSel.from_location);
              //                 // $("#edit_to_location").val(ItemSel.to_location);
              //                 // $("#edit_id").val(ItemSel.id);
               //
              //                 // alert(ItemSel.id);
              //                 // $("#qty").focus();
              //                 // $("#showloc").show();
              //                 // $("#stkloc").focus();
               //
              //                     $('#transfer_edit tbody').append("<tr><td>" + " " + "</td><td class='product_name'>" + ItemSel.product_name + "</td><td>" +
              //                     ItemSel.product_id + "</td><td class='barcode'>" + ItemSel.barcode  + "</td><td class='from_location'>" + ItemSel.from_location + "</td><td class='to_location'>" +
              //                     ItemSel.to_location   + "</td><td class='quantity'>" + ItemSel.quantity
              //                     + "</td><td><input type='button' class='ajaxedit' id='ajaxedit' value='Edit'/> <input type='button' id='ajaxsave' class='ajaxsave' value='Save'>"
              //                     + "</td></tr>");
               //
               //
               //
               //
               //
              //               });
              //               // alert(data);
              //             },
              //          });
              //          return false;
              //     }
              //  });
             });


            //  $( "#edit_transfer_button" ).click(function()
            //  {
            //    var product_name=$('#edit_product_name').val();
            //    var barcode=$('#edit_barcode').val();
            //    var product_id=$('#edit_product_id').val();
            //    var from_location=$('#edit_from_location').val();
            //    var to_location=$('#edit_to_location').val();
            //    var edit_id=$('#edit_id').val();
            //    var edit_qty=$('#edit_qty').val();
            //
            //    $.ajax
            //    ({
            //       url: '/stocktransferupdate',
            //       data: {product_name:product_name,barcode:barcode,product_id:product_id,
            //         from_location:from_location,to_location:to_location,edit_id:edit_id,edit_qty:edit_qty},
            //       type: 'get',
            //       success:function(data)
            //       {
            //         alert(data);
            //         // $("#product_name").val('');
            //         // $("#barcode").val('');
            //         // $("#product_id").val('');
            //         // $("#from_location").val('');
            //         // $("#to_location").val('');
            //         // $("#edit_id").val('');
            //         // $("#edit_qty").val('');
            //         location.reload();
            //      },
            //
            //
            //   });
            //
            // });

          });
          $(document).on('click', '.ajaxedit', function()
          {
              // alert("edit");

              $("#edit_quantity").  removeAttr('readonly');

              var product_name = $(this).closest("tr").find("td:eq(1) input[type='text']").val();
              var product_id = $(this).closest("tr").find("td:eq(2) input[type='text']").val();
              var barcode = $(this).closest("tr").find("td:eq(3) input[type='text']").val();
              var from_location = $(this).closest("tr").find("td:eq(4) input[type='text']").val();
              var to_location = $(this).closest("tr").find("td:eq(5) input[type='text']").val();
              var quantity = $(this).closest("tr").find("td:eq(6) input[type='number']").val();


              $("#stock_qty").val(quantity);

              // $(this).closest("tr").find('td:eq(6)').prop('contenteditable', true);
              // $(this).closest("tr").find('td:eq(6)').focus();
              // $(this).closest("tr").find('td:eq(6)').text('');

          });

          $(document).on('click', '.ajaxsave', function()
          {


            var stock_qty=$('#stock_qty').val();
            var product_name = $(this).closest("tr").find("td:eq(1) input[type='text']").val();
            var product_id = $(this).closest("tr").find("td:eq(2) input[type='text']").val();
            var barcode = $(this).closest("tr").find("td:eq(3) input[type='text']").val();
            var from_location = $(this).closest("tr").find("td:eq(4) input[type='text']").val();
            var to_location = $(this).closest("tr").find("td:eq(5) input[type='text']").val();
            var quantity = $(this).closest("tr").find("td:eq(6) input[type='number']").val();


             var url7='ajax_check_quantity';
              $.ajax
              ({
                  url: url7,
                  data: {product_name:product_name,product_id:product_id,barcode:barcode,quantity:quantity,
                    from_location:from_location,to_location:to_location,stock_qty:stock_qty},
                  type: 'get',
                  success:function(data)
                  {
                    alert("gjhfdg");
                    // alert(data);
                    if(+quantity == '')
                    {
                      alert("Please enter the quantity to be modified");
                      $("#edit_quantity").  removeAttr('readonly');
                      $("#edit_quantity").  focus();
                    }
                    else if(+quantity > data)
                    {
                        // var quantity = $(this).closest("tr").find('td:eq(6)').val('');
                        alert("quantity is more than the stock");
                        $("#edit_quantity").  removeAttr('readonly');
                        $("#edit_quantity").  focus();

                    }
                    else
                    {
                      var url8='stocktransferupdate';
                      $.ajax
                      ({
                          url:url8,
                          data: {product_name:product_name,product_id:product_id,barcode:barcode,quantity:quantity,
                            from_location:from_location,to_location:to_location,stock_qty:stock_qty},
                          type: 'get',
                          success:function(data)
                          {
                            alert("Transfer Modified");
                          },
                        });

                       $('#table_content').html('');

                    }



                  },
                });


          });

    </script>
    <style type="text/css">
        body
        {
            counter-reset: Serial;           /* Set the Serial counter to 0 */
        }
        table
        {
            border-collapse: separate;
        }
        tr td:first-child:before
        {
            counter-increment: Serial;    /* Increment the Serial counter */
            content: counter(Serial);    /* Display the counter */
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
    <section id="display">
       <!-- Left Sidebar -->
       <aside id="leftsidebar" class="sidebar">
           <!-- User Info -->
           <div class="user-info">
               <div class="image">
                   <img src="images/user.png" width="48" height="48" alt="User" />
               </div>
               <div class="info-container">
                   <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{{Auth::user()->name}}}</div>
                   <div class="email">{{{Auth::user()->email}}}</div>
                   <div class="btn-group user-helper-dropdown">
                       <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                       <ul class="dropdown-menu pull-right">
                           <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                           <li role="seperator" class="divider"></li>
                           <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                           <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                           <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                           <li role="seperator" class="divider"></li>
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
                   <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">reorder</i>
                           <span>Stock</span>
                       </a>
                       <ul class="ml-menu">
                     @if(Auth::user()->role == "admin" || Auth::user()->role == "superuser")
                           <li>
                               <a href="{!! url('/add'); !!}">Stock Add</a>
                           </li>
                     @endif
                           <li class="active">
                               <a href="{!! url('/transfer'); !!}">Stock Transfer</a>
                           </li>

                           <li>
                               <a href="{!! url('/stockview'); !!}">Stock View</a>
                           </li>

                       </ul>
                   </li>
                   <li>
                       <a href="javascript:void(0);" class="menu-toggle">
                         <i class="material-icons">reorder</i>
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

    <section class="content" >
      <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <div class="card">
                      <div class="header bg-cyan">
                        <button type="button" data-color="cyan" class="btn bg-blue-grey waves-effect" id="add_transfer"  > <i class="material-icons">local_grocery_store</i>
                        <span>Add Transfer</span></button>
                        <button type="button" data-color="cyan" class="btn bg-blue-grey waves-effect" id="modify_transfer" > <i class="material-icons">redo</i>
                        <span>Modify Transfer</span></button>
                      </div>
                        <div class="card" id="transfer_add">
                            <div class="body">
                                <div class="row clearfix">
                                  <div class="col-md-2">
                                      <div class="input-group">
                                          <p>
                                              <b>Stock Location</b>
                                          </p>
                                          <div class="form-line">
                                              <select class="form-control" id="stock_location" name="stock_location" data-placement="bottom" data-toggle="popover">
                                              <!-- <input list="name" class="form-control date" id="stock_location" name="stock_location">
                                              <datalist id="name"> -->
                                                  @foreach($data1 as $item)
                                                       <option> {{$item->location}}</option>
                                                  @endforeach
                                              <!-- </datalist> -->
                                            </select>
                                          </div>

                                      </div>
                                  </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <p>
                                                <b>Product Name</b>
                                            </p>
                                            <div class="form-line">

                                                <select class="form-control" id="prod_name" name="prod_name" data-placement="bottom" data-toggle="popover" autocfocus="false">

                                                </select>
                                                <!-- <input list="name" class="form-control date" id="stock_location" name="stock_location">
                                                <datalist id="name">
                                                    @foreach($data1 as $item)
                                                         <option> {{$item->location}}</option>
                                                    @endforeach
                                                </datalist> -->
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <p>
                                                <b>Product Id</b>
                                            </p>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" id="product_id" name="product_id" >
                                            </div>
                                        </div>
                                    </div>
                                     <!-- <div class="col-md-1"></div> -->
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <p>
                                                <b>Barcode</b>
                                            </p>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" id="barcode" name="barcode" >
                                            </div>
                                        </div>
                                    </div>

                                     <!-- <div class="col-md-1"></div> -->
                                     <!-- <div id="shstk"> -->
                                        <div class="col-md-1">
                                        <div class="input-group">
                                            <p>
                                                <b>Stock</b>
                                            </p>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" id="stk" name="stk" >
                                            </div>
                                        </div>
                                        </div>
                                    <!-- </div> -->

                                   <!--  <div class="col-md-1"></div> -->
                                  <div class="col-md-2">
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
                                        <button type="button" id="transfer_product" name="transfer_product" class="btn bg-cyan waves-effect" >
                                            <!-- <i class="material-icons">local_grocery_store</i> -->
                                            <span>Transfer</span></button>
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
                                                    <th>Product Name</th>
                                                    <th>Product Id</th>
                                                    <th>Barcode</th>
                                                    <th>From Location</th>
                                                    <th>Quantity</th>
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
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="smallModalLabel"></h4>
                                                </div>
                                                 @if(Auth::user()->role == "admin")
                                                <div class="modal-body" >
                                                    <p>
                                                        <b >Dispatch To</b>
                                                    </p>
                                                    <!-- <select class="form-control show-tick" id="loc1" name="loc1" data-live-search="true">
                                                      @foreach($data1 as $item)
                                                           <option>  {{$item->location}}  </option>
                                                      @endforeach
                                                   </select> -->
                                                    <!-- <input list="name1" class="form-control date" id="loc1" name="loc1" autofocus="true" >
                                                    <datalist id="name1">

                                                    </datalist> -->
                                                    <select class="form-control" id="loc1" name="loc1" data-placement="bottom" data-toggle="popover">

                                                      <script>

                                                        $("#stock_location").change(function(){
                                                            // var country=$('#Country').val();
                                                            var loc=$('#stock_location').val();
                                                            var url8='selecttolocation';
                                                            $.ajax
                                                            ({
                                                               url: url8,
                                                               data: {loc:loc},
                                                               type: 'get',
                                                               success:function(data)
                                                               {
                                                                 $('#loc1').empty();
                                                                 var n=data.length;
                                                                 for(var i=0;i<=n-1;i++)
                                                                 {
                                                                   $('#loc1').append("<option>" + data[i] + "</option>");
                                                                    // alert(data[i]);
                                                                 }

                                                               },
                                                            });
                                                        });

                                                      </script>
                                                    </select>
                                                </div>
                                                <div class="modal-body" >
                                                    <p>
                                                        <b>Notes</b>
                                                    </p>
                                                    <div class="form-line">
                                                      <textarea rows="3" name="notes" id="notes" class="form-control no-resize" placeholder="Desciption"></textarea>
                                                    </div>
                                                </div>
                                                @endif

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link waves-effect" id="save" >SAVE</button>
                                                    <button type="button" class="btn btn-link waves-effect" id="close" data-dismiss="modal">CLOSE</button>
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
            <div class="row clearfix" id="transfer_modify">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-12 col-md-12">
                  <div class="card">
                                <div class="body">
                                    <div class="row clearfix">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <p>
                                                <b>Enter details </b>
                                            </p>
                                            <div class="form-line">
                                              <select class="form-control" id="edit_details" name="edit_details" data-placement="bottom" data-toggle="popover">
                                                 @foreach($data4 as $item)
                                                      <option>  {{$item->product_name}}  </option>
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
                                        <button type="button" id="search_product" name="search_product" class="btn bg-cyan waves-effect" >
                                            <i class="material-icons">search</i>
                                            <span>Search</span></button>
                                        </button>
                                    </div>
                                  </div>
                                                <div class="row-clearfix">
                                                    <div class="table-responsive">

                                                        <!--  <table class="table table-bordered table-striped table-hover js-basic-example dataTable"  id="data_table"> -->
                                                        <table class="table table-striped" id="transfer_edit" name="transfer_edit">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Product Name</th>
                                                                    <th>Product Id</th>
                                                                    <th>Barcode</th>
                                                                    <th>From Location</th>
                                                                    <th>To Location</th>
                                                                    <th>Quantity</th>
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


    <script src="/script/sales.js"></script>
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!-- <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

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
