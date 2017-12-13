<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title> Stock Return| JR-POP</title>

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

     <!-- <script src="jquery-ui.js"></script> -->

    <script type="text/javascript">
         $(document).ready(function()
            {
                $("#prod_name").focus();
                $("#showloc").hide();
                 $("#shstk").hide();

                $( "#prod_name" ).keypress(function( event ) {
                    if ( event.which == 13 || event.which == 9)
                    {
                        // alert("pressed");
                        var prod_name=$('#prod_name').val();
                        var url1 = 'demo';
                         $.ajax({
                        url: url1,
                        data: {prod_name:prod_name },
                        type: 'get',
                        success:function(data)
                        {
                          // alert("Record Inserted");
                            $.each(data, function(i, ItemSel){
                            // alert(ItemSel.itemname);
                            // alert(ItemSel.bnumber);
                            $("#prod_name").val(ItemSel.itemname);
                            $("#barcode").val(ItemSel.bnumber);
                            // $("#qty").focus();
                            $("#showloc").show();
                            $("#stkloc").focus();

                            });
                        },

                     });
                      return false;
                    }

                });

                  $( "#stkloc" ).keypress(function( event ) {
                    if ( event.which == 13 )
                    {
                        var prod_name=$('#prod_name').val();
                        var shloc=$('#stkloc').val();

                        $("#shstk").show();
                        $("#stk").focus();
                        // alert(shloc);
                        var url2 = 'stock';
                        $.ajax({
                            url: url2,
                            data: {shloc:shloc ,prod_name:prod_name  },
                            type: 'get',
                            success:function(data)
                            {

                                $.each(data, function(i, stk){

                                $("#stk").val(stk.quantity);
                                 $("#stk").attr("disabled", "disabled");
                                $("#qty").focus();

                                });
                            },

                     });
                    }
                });


                $( "#qty" ).keypress(function( event ) {
                if ( event.which == 13 )
                {
                    var prod_name=$('#prod_name').val();
                    var barcode=$('#barcode').val();
                    var qty=$('#qty').val();
                    var stk=$('#stk').val();
                    // alert(qty);
                    // alert(stk);

                    if(qty == '0')
                    {
                        alert("Quantity should not be zero!!!");
                        $("#qty").val('');
                    }
                    else if (qty == '')
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
                        $("#barcode").val('');
                        $("#qty").val('');
                        $("#showloc").hide();
                        $("#shstk").hide();
                        $("#prod_name").focus();
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

                        $('#display_table tbody').append("<tr><td>" + " " + "</td><td>" + prod_name + "</td><td>" + barcode    + "</td><td>" + qty  + "</td></tr>");

                            $("#prod_name").val('');
                            $("#barcode").val('');
                            $("#qty").val('');
                            $("#showloc").hide();
                            $("#shstk").hide();
                            $("#prod_name").focus();
                    }
                }
                });

                  $( "#save" ).click(function() {
                    var loc=$('#loc').val();
                    var loc1=$('#loc1').val();

                        $("#display_table tr:gt(0)").each(function ()
                                {
                                    var this_row = $(this);

                                    var prod_name = $.trim(this_row.find('td:eq(1)').html());//td:eq(0) means first
                                        // alert(prod_name);
                                    var bcode = $.trim(this_row.find('td:eq(2)').html());
                                    // alert(bcode);
                                    var qty = $.trim(this_row.find('td:eq(3)').html());
                                    // alert(qty);

                                    var rows = $('tr:visible').length ;
                                    var row = rows -1;
                                    var url3 = 'stockreturncheck';
                                    $.ajax ({
                                        url: url3,
                                        data: {prod_name:prod_name,bcode:bcode,qty:qty,loc:loc,loc1:loc1,row:row},
                                        type: 'get',
                                        success:function(data)
                                        {
                                            // alert("fgfdsga");
                                            // alert(data);
                                        },
                                    });
                                });
                        alert("Saved successfully");
                        $('#smallModal').modal('hide');
                        location.reload();

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
            counter-increment: Serial;      /* Increment the Serial counter */
            content: counter(Serial); /* Display the counter */
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
                              <i class="material-icons">home</i>
                              <span>Registration</span>
                          </a>
                      </li>
                      <li>
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
                              <li>
                                  <a href="{!! url('/transfer'); !!}">Stock Transfer</a>
                              </li>

                              <li class="active">
                                  <a href="{!! url('/return'); !!}">Stock Return</a>
                              </li>

                              <li>
                                  <a href="{!! url('/view'); !!}">View</a>
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

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Stock Return </h2>

                        </div>
                        <div class="card">
                            <div class="body">
                                <div class="row clearfix">
                                <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <p>
                                                <b>Product Name</b>
                                            </p>
                                            <div class="form-line">
                                                <input list="name" class="form-control date" id="prod_name" name="prod_name"  >
                                                <datalist id="name">
                                                    @foreach($data2 as $item)
                                                         <option> {{$item->product_name}}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>

                                        </div>
                                    </div>
                                     <!-- <div class="col-md-1"></div> -->
                                    <div class="col-md-3">
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
                                     <div id ="showloc">
                                    <!-- <div class="col-md-2">
                                        <div class="input-group">
                                            <p>
                                                <b>Location</b>
                                            </p>
                                            <div class="form-line">
                                                <input list="stloc" class="form-control date" id="stkloc" name="stkloc">
                                                <datalist id="stloc">
                                                     @foreach($data1 as $item)
                                                         <option> {{$item->location}}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>

                                        </div>
                                    </div> -->
                                    <div class="col-md-2">
                                        <div class="input-group">
                                          <div class="form-line"><label>Location</label>
                                                <select class="form-control" id="stkloc" name="stkloc" data-placement="bottom" data-toggle="popover">
                                                  <script>
                                                  //$('document').ready(function(){
                                                    $("#prod_name").change(function(){
                                                        // var country=$('#Country').val();
                                                        var prod_name=$('#prod_name').val();
                                                        var url4 = 'stocklocation';
                                                        $.ajax ({
                                                           url: url4,
                                                           data: {prod_name:prod_name},
                                                           type: 'get',
                                                           success:function(data)
                                                           {
                                                             $('#stkloc').empty();
                                                             var n=data.length;
                                                            for(var i=0;i<=n-1;i++)
                                                             {
                                                               $('#stkloc').append("<option>" + data[i] + "</option>");
                                                             }

                                                           },
                                                        });
                                                    });
                                                  //});
                                                  </script>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                     <!-- <div class="col-md-1"></div> -->
                                     <div id="shstk">
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
                                    </div>

                                   <!--  <div class="col-md-1"></div> -->
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <p>
                                                <b>Quantity</b>
                                            </p>
                                            <div class="form-line">
                                                <input type="number" onkeypress="return event.charCode >= 48" min="1" class="form-control date" id="qty" name="qty" >                                            </div>
                                            </div>
                                        </div>
                                    </div>
-
                                <div class="row-clearfix">
                                    <div class="table-responsive">

                                        <!--  <table class="table table-bordered table-striped table-hover js-basic-example dataTable"  id="data_table"> -->
                                        <table class="table table-striped" id="display_table" name="display_table">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Product Name</th>
                                                    <th>Barcode</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <br />
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
                                                        <b > From Location</b>
                                                    </p>
                                                    <select class="form-control show-tick" id="loc" name="loc"  data-live-search="true">
                                                       @foreach($data1 as $item)
                                                            <option>  {{$item->location}}  </option>
                                                       @endforeach
                                                    </select>
                                                </div>


                                                 <div class="modal-body" >
                                                    <p>
                                                        <b >To Location</b>
                                                    </p>
                                                    <!-- <select class="form-control show-tick" id="loc1" name="loc1" data-live-search="true">
                                                      @foreach($data1 as $item)
                                                           <option>  {{$item->location}}  </option>
                                                      @endforeach
                                                   </select> -->
                                                    <!-- <input list="name1" class="form-control date" id="loc1" name="loc1" autofocus="true" >
                                                    <datalist id="name1">
                                                    @foreach($data1 as $item)
                                                         <option> {{$item->location}}</option>
                                                    @endforeach
                                                    </datalist> -->
                                                    <select class="form-control" id="loc1" name="loc1" data-placement="bottom" data-toggle="popover">
                                                      <script>

                                                        $("#loc").change(function(){
                                                            // var country=$('#Country').val();
                                                            var loc=$('#loc').val();
                                                            var url5 = 'selecttolocation';
                                                            $.ajax({
                                                               url: url5,
                                                               data: {loc:loc},
                                                               type: 'get',
                                                               success:function(data)
                                                               {
                                                                 $('#loc1').empty();
                                                                 var n=data.length;
                                                                 for(var i=0;i<=n-1;i++)
                                                                 {
                                                                   $('#loc1').append("<option>" + data[i] + "</option>");

                                                                 }

                                                               },
                                                            });
                                                        });

                                                      </script>
                                                    </select>
                                                </div>
                                                @endif
                                                 @if(Auth::user()->role == "user")
                                                 <div class="modal-body" >
                                                     <p>
                                                         <b > From Location</b>
                                                     </p>
                                                     <input type="text" class="form-control date" id="loc" name="loc" value="{{Auth::user()->branch}}">
                                                 </div>
                                                 <div class="modal-body" >
                                                     <p>
                                                         <b > To Location</b>
                                                     </p>
                                                     <select class="form-control show-tick" id="loc1" name="loc1"  data-live-search="true">
                                                        @foreach($data3 as $item)
                                                             <option>  {{$item->location}}  </option>
                                                        @endforeach
                                                     </select>
                                                 </div>
                                                 @endif
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

        </div>




 </section>

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
    <script src="script/sales.js"></script>

</body>

</html>
