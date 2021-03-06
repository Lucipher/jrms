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
             $("#modifier_supplier_div").hide();
             $("#supplier").focus();
             $( "#add_supplier_button" ).hide();

             $( "#add_supplier_button" ).click(function()
             {
                 $("#state").blur();
                 $("#district").blur();
                 $("#supplier").focus();
                 $("#add_supplier_div").show();
                 $("#modifier_supplier_div").hide();
                 $( "#modify_supplier_button" ).show();
                 $( "#add_supplier_button" ).hide();

             });
             $( "#modify_supplier_button" ).click(function()
             {
                 $("#edit_state").blur();
                 $("#edit_district").blur();
                 $("#add_supplier_div").hide();
                 $("#modifier_supplier_div").show();
                 $( "#add_supplier_button" ).show();
                 $( "#modify_supplier_button" ).hide();

                 $("#edit_door_number").attr("disabled", "disabled");
                 $("#edit_street").attr("disabled", "disabled");
                 $("#edit_area").attr("disabled", "disabled");
                 $("#edit_city").attr("disabled", "disabled");
                 $("#edit_state").attr("disabled", "disabled");
                 $("#edit_district").attr("disabled", "disabled");
                 $("#edit_country").attr("disabled", "disabled");
                 $("#edit_pincode").attr("disabled", "disabled");
                 $("#edit_mobile").attr("disabled", "disabled");
                 $("#edit_phone").attr("disabled", "disabled");
                 $("#edit_email").attr("disabled", "disabled");
                 $("#edit_notes").attr("disabled", "disabled");

                 $( "#edit_supplier" ).change(function( event )
                  {
                       $("#edit_supplier").attr("disabled", "disabled");
                         var supplier=$('#edit_supplier').val();

                         // alert(supplier);
                         var url1='fill_supplier_details';
                         $.ajax
                         ({
                             url: url1,
                             data: {supplier:supplier },
                             type: 'get',
                             success:function(data)
                             {

                                 $.each(data, function(i, ItemSel)
                                 {

                                     $('#edit_door_number').val(ItemSel.door_number);
                                     $('#edit_street').val(ItemSel.street);
                                     $('#edit_area').val(ItemSel.area);
                                     $('#edit_city').val(ItemSel.city);
                                     $('#edit_country').val(ItemSel.country);
                                     $('#edit_state').val(ItemSel.state);
                                     $('#edit_district').val(ItemSel.district);
                                     $('#edit_pincode').val(ItemSel.pincode);
                                     $('#edit_mobile').val(ItemSel.mobile);
                                     $('#edit_phone').val(ItemSel.phone);
                                     $('#edit_email').val(ItemSel.email);
                                     $('#edit_notes').val(ItemSel.notes);
                                  });
                                    $("#edit_door_number").  removeAttr('disabled');
                                    $("#edit_street").  removeAttr('disabled');
                                    $("#edit_area").  removeAttr('disabled');
                                    $("#edit_city").  removeAttr('disabled');
                                    $("#edit_country").  removeAttr('disabled');
                                    $("#edit_state").  removeAttr('disabled');
                                    $("#edit_pincode").  removeAttr('disabled');
                                    $("#edit_mobile").  removeAttr('disabled');
                                    $("#edit_phone"). removeAttr('disabled');
                                    $("#edit_email").  removeAttr('disabled');
                                    $("#edit_notes").  removeAttr('disabled');
                             },


                        });

                      return false;
                   });

                 $( "#modify" ).click(function()
                 {
                   var supplier=$('#edit_supplier').val();
                   var door_no=$('#edit_door_number').val();
                   var street=$('#edit_street').val();
                   var area1=$('#edit_area').val();
                   var city=$('#edit_city').val();
                   var country=$('#edit_country').val();
                   var state=$('#edit_state').val();
                   var district=$('#edit_district').val();
                   var pincode=$('#edit_pincode').val();
                   var mobile =$('#edit_mobile').val();
                   var phone =$('#edit_phone').val();
                   var email=$('#edit_email').val();
                   var notes=$('#edit_notes').val();
                   var status=$('input[name=group1]:checked').val();
                   // alert(status);
                   if(state== "")
                   {
                     $('#edit_state').focus();
                   }
                   else if(district== "")
                   {
                     $('#edit_district').focus();
                   }
                   else
                   {
                       var url2='modify_supplier';
                     $.ajax
                    ({
                        url: url2,
                        data: {supplier:supplier,door_no:door_no,street:street,area1:area1,city:city,country:country,state:state,district:district,
                         pincode:pincode,mobile:mobile,email:email,notes:notes,phone:phone,status:status},
                        type: 'get',
                        success:function(data)
                        {

                          alert("Modified Successfully");

                        }
                   });
                   $('#edit_supplier').val('');
                   $('#edit_door_number').val('');
                   $('#edit_street').val('');
                   $('#edit_area').val('');
                   $('#edit_city').val('');
                   $('#edit_country').val('');
                   $('#edit_state').val('');
                   $('#edit_district').val('');
                   $('#edit_pincode').val('');
                   $('#edit_mobile').val('');
                   $('#edit_phone').val('');
                   $('#edit_email').val('');
                   $('#edit_notes').val('');
                   $("#edit_supplier").  removeAttr('disabled');
                   }


             });

         });

         $('#email').keydown( function(e) {
                if (e.keyCode == 9 && !e.shiftKey)
                {
                  var email=$('#email').val();
                  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                  if( !emailReg.test( email ))
                  {
                      alert('Please enter valid email');
                      $(this).focus();
                      return false;
                  }
                  else if( email == '')
                  {
                      alert("Please fill this field");
                      $(this).focus();
                      return false;
                  }
                }

              });
              $('#mobile').keydown( function(e) {
                  if (e.keyCode == 9 && !e.shiftKey)
                  {
                    var mobile=$('#mobile').val();
                    var mobReg = /^\d{10}$/;
                    if( mobile == '')
                    {
                        alert("Please fill this field");
                        $(this).focus();
                        return false;
                    }
                    else if( !mobReg.test( mobile ))
                    {
                        alert('Please enter valid mobile number');
                        $(this).focus();
                        return false;
                    }
                  }

                });

                $('#pincode').keydown( function(e) {
                    if (e.keyCode == 9 && !e.shiftKey)
                    {
                      var pincode=$('#pincode').val();
                      var pinReg =/^\d{6}$/;
                      if( pincode == '')
                      {
                          alert("Please fill this field");
                          $(this).focus();
                          return false;
                      }
                      else if( !pinReg.test( pincode ) )
                      {
                          alert('Please enter valid pincode');
                          $(this).focus();
                          return false;
                      }
                    }

                  });


            //edit
            $('#edit_email').keydown( function(e) {
                if (e.keyCode == 9 && !e.shiftKey)
                {
                  var email=$('#edit_email').val();
                  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                  if( !emailReg.test( email ))
                  {
                      alert('Please enter valid email');
                      $(this).focus();
                      return false;
                  }
                  else if( email == '')
                  {
                      alert("Please fill this field");
                      $(this).focus();
                      return false;
                  }
                }

              });

              $('#edit_mobile').keydown( function(e) {
                  if (e.keyCode == 9 && !e.shiftKey)
                  {
                    var mobile=$('#edit_mobile').val();
                    var mobReg = /^\d{10}$/;
                    if( mobile == '')
                    {
                        alert("Please fill this field");
                        $(this).focus();
                        return false;
                    }
                    else if( !mobReg.test( mobile ) )
                    {
                        alert('Please enter valid phone');
                        $(this).focus();
                        return false;
                    }
                  }

                });
                $('#edit_pincode').keydown(function(e) {
                    if (e.keyCode == 9 && !e.shiftKey)
                    {
                      var pincode=$('#edit_pincode').val();
                      var pinReg =/^\d{6}$/;
                      if( pincode == '')
                      {
                          alert("Please fill this field");
                          $(this).focus();
                          return false;
                      }
                      else if( !pinReg.test( pincode ) )
                      {
                          alert('Please enter valid pincode');
                          $(this).focus();
                          return false;
                      }
                    }

                  });
             $( "#save" ).click(function()
             {
               var supplier=$('#supplier').val();
               var door_no=$('#door_number').val();
               var street=$('#street').val();
               var area1=$('#area1').val();
               var city=$('#city').val();
               var country=$('#country').val();
               var state=$('#state').val();
               var district=$('#district').val();
               var pincode=$('#pincode').val();
               var mobile =$('#mobile').val();
               var phone =$('#phone').val();
               var email=$('#email').val();
               var notes=$('#notes').val();
               var status=$('input[name=group2]:checked').val();

               if(supplier == "")
               {
                   alert("Enter Supplier");
                   $('#supplier').focus();
               }
               else if(door_no == "")
               {
                 alert("Enter Door Number");
                 $('#door_number').focus();
               }
               else if(street == "")
               {
                 alert("Enter Supplier");
                 $('#street').focus();
               }
               else if(city == "")
               {
                 alert("Enter City");
                 $('#city').focus();
               }
               else if(state == "")
               {
                 alert("Enter City");
                 $('#city').focus();
               }
               else if(district == "")
               {
                 alert("Enter District");
                 $('#district').focus();
               }
               else if(country == "")
               {
                 alert("Enter Country");
                 $('#country').focus();
               }
               // else if(mobile == "")
               // {
               //   alert("Enter Mobile");
               //   $('#mobile').focus();
               // }
               // else if(email == "")
               // {
               //   alert("Enter Email");
               //   $('#email').focus();
               // }
               else if(pincode == "")
               {
                 alert("Enter Pincode");
                 $('#pincode').focus();
               }
               else
               {
                 var url3='add_supplier';
                 $.ajax
                ({
                url: url3,
                data: {supplier:supplier,door_no:door_no,street:street,area1:area1,city:city,country:country,state:state,district:district,
                 pincode:pincode,mobile:mobile,phone:phone,email:email,notes:notes,status:status},
                type: 'get',
                success:function(data)
                {
                 //  alert(data);
                 alert("Saved Successfully");

                },

             });
             $('#supplier').val('');
             $('#door_number').val('');
             $('#street').val('');
             $('#area1').val('');
             $('#city').val('');
             $('#country').val('');
             $('#state').val('');
             $('#district').val('');
             $('#pincode').val('');
             $('#mobile').val('');
             $('#phone').val('');
             $('#email').val('');
             $('#notes').val('');
             $("#supplier").  removeAttr('disabled');
               }


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
                    <div style="color: white;" class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{{Auth::user()->name}}}</div>
                    <div style="color: white;" class="email">{{{Auth::user()->email}}}</div>
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
                    <li class="active">
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
                            <li class="active">
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

                    <li >
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
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="header bg-cyan">
                       <button type="button" data-color="cyan" class="btn bg-blue-grey waves-effect" id="add_supplier_button"  > <i class="material-icons">local_grocery_store</i>
                       <span>Add Supplier</span></button>
                       <button type="button" data-color="cyan" class="btn bg-blue-grey waves-effect" id="modify_supplier_button" > <i class="material-icons">redo</i>
                       <span>Modify Supplier</span></button>
                     </div>
                     <div id="add_supplier_div">
                     <div class="body" >
                         <form class="form-horizontal" name="myform">
                            <span class="col-md-6">
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="supplier">Supplier</label>
                                 </div>
                                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                             <input type="text" id="supplier" class="form-control" placeholder="Supplier" required>

                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="door_number">Address</label>
                                 </div>
                                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                             <input type="text" id="door_number" class="form-control" placeholder="Flat/House No." required>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="street"></label>
                                 </div>
                                     <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                             <input type="text" id="street" class="form-control" placeholder="Colony/ Street Name." required>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="address1"></label>
                                 </div>
                                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                             <input type="text" id="area1" class="form-control" placeholder="Land Mark">
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="city"></label>
                                 </div>
                                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                             <input type="text" id="city" class="form-control" placeholder="city" required >
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" required>
                                     <label for="country">Country</label>
                                 </div>
                                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                            <input list="name1" class="form-control date" id="country" name="country">
                                            <datalist id="name1">
                                                 <!-- <option>Select Country </option> -->
                                              @foreach($data as $item)
                                                   <option>  {{$item->country}}  </option>
                                              @endforeach
                                          </datalist>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="state">State</label>
                                 </div>
                                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                           <select class="form-control" id="state" name="state" data-placement="bottom" data-toggle="popover">
                                             <script>
                                             $("#country").change(function(){
                                                 // var country=$('#Country').val();
                                                 var country=$('#country').val();
                                                //  alert(country);
                                                  var url5='select_state';
                                                 $.ajax
                                                 ({
                                                    url: url5,
                                                    data: {country:country},
                                                    type: 'get',
                                                    success:function(data)
                                                    {

                                                      $('#state').empty();
                                                      var n=data.length;
                                                      // alert(n);
                                                        // $('#prod_name').focus();
                                                        // $('#state').append( "<option>" + "Select State" + "</option>");
                                                        for(var i=0;i<=n-1;i++)
                                                        {
                                                          $('#state').append( "<option>" + data[i] + "</option>");
                                                           // alert(data[i]);
                                                        }
                                                    }

                                                 });
                                             });
                                             </script>
                                           </select>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             </span>
                            <span class="col-md-6">


                              <div class="row clearfix">
                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                      <label for="district">District</label>
                                  </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                      <div class="form-group">
                                          <div class="form-line">
                                              <!-- <input type="text" id="district" class="form-control" placeholder="District"> -->
                                              <select class="form-control" id="district" name="district" data-placement="bottom" data-toggle="popover">
                                                <script>
                                                $("#state").change(function(){
                                                    // var country=$('#Country').val();
                                                    var state=$('#state').val();
                                                   //  alert(state);
                                                   var url6='select_district';
                                                    $.ajax
                                                    ({
                                                       url: url6,
                                                       data: {state:state},
                                                       type: 'get',
                                                       success:function(data)
                                                       {

                                                         $('#district').empty();
                                                         var n=data.length;
                                                         // alert(n);
                                                           // $('#prod_name').focus();
                                                           // $('#district').append( "<option>" + "Select District" + "</option>");
                                                           for(var i=0;i<=n-1;i++)
                                                           {
                                                             $('#district').append( "<option>" + data[i] + "</option>");
                                                              // alert(data[i]);
                                                           }
                                                       }

                                                    });
                                                });
                                                </script>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="group1">Status</label>
                                 </div>
                                 <div class="demo-radio-button">
                                    <input name="group2" type="radio" id="radio_1" value="Enable" checked />
                                    <label for="radio_1">Enable</label>
                                    <input name="group2" type="radio" id="radio_2" value="Disable" disabled/>
                                    <label for="radio_2">Disable</label>
                                 </div>
                             </div>
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="pincode">Pincode</label>
                                 </div>
                                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                             <input type="number" id="pincode" class="form-control" placeholder="pincode" required min="0" oninput="if(value.length>6)value=value.slice(0,6)">
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="phone">Mobile</label>
                                 </div>
                                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                             <input type="number" id="mobile" class="form-control" maxlength="10" minlength="10" placeholder="Mobile" min="0" oninput="if(value.length>10)value=value.slice(0,10)" required  oninvalid="alert('Enter proper Mobile Number');">
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="phone">Phone</label>
                                 </div>
                                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                             <input type="number" id="phone" class="form-control" placeholder="Phone" required min="0" oninput="if(value.length>10)value=value.slice(0,10)">
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="email">E-mail</label>
                                 </div>
                                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                             <input type="email" id="email" name="email" class="form-control" placeholder="abc@gmail.com" required  oninvalid="alert('Enter proper Email');">
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <!-- <div class="col-md-1"></div> -->
                             <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="notes">Notes</label>
                                 </div>
                                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                     <div class="form-group">
                                         <div class="form-line">
                                           <textarea rows="1" name="notes" id="notes" class="form-control no-resize" placeholder="Desciption"></textarea>
                                           <!-- <input type="email" id="email" name="email" class="form-control" placeholder="abc@gmail.com"  required=""> -->
                                         </div>
                                     </div>
                                 </div>
                             </div>
                           </span>
                             <div class="row clearfix">

                             </div>
                         </form>
                     </div>
                     <div class="header bg-cyan" >
                         <button type="button" data-color="blue-grey" class="btn bg-blue-grey waves-effect" id="save" > <i class="material-icons">save</i>
                         <span>Save</span></button>
                     </div>
               </div>

               <!-- modify supplier -->

               <div id="modifier_supplier_div">
               <div class="body" >
                   <form class="form-horizontal" name="myform">
                      <span class="col-md-6">
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="supplier">Supplier</label>
                           </div>
                           <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                       <!-- <input type="text" id="supplier" class="form-control" placeholder="Supplier"> -->
                                       <select class="form-control" id="edit_supplier" name="edit_supplier" data-placement="bottom" data-toggle="popover">
                                              <option>Select Supplier</option>
                                           @foreach($data1 as $item)
                                                <option> {{$item->supplier}}</option>
                                           @endforeach
                                     </select>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="door_number">Address</label>
                           </div>
                           <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                       <input type="text" id="edit_door_number" class="form-control" placeholder="Flat/House No.">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="street"></label>
                           </div>
                               <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                       <input type="text" id="edit_street" class="form-control" placeholder="Colony/ Street Name.">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="address1"></label>
                           </div>
                             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                       <input type="text" id="edit_area" class="form-control" placeholder="Land Mark">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="city"></label>
                           </div>
                             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                       <input type="text" id="edit_city" class="form-control" placeholder="city">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="country">Country</label>
                           </div>
                             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                      <!-- <input list="name1" class="form-control date" id="edit_country" name="edit_country"> -->
                                      <!-- <input type="text" id="edit_country"  name="edit_country" class="form-control" > -->
                                    <select class="form-control" id="edit_country" name="edit_country" data-placement="bottom" data-toggle="popover" >
                                         <option> </option>
                                      @foreach($data as $item)
                                           <option>  {{$item->country}}  </option>
                                      @endforeach
                                    </select>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="state">State</label>
                           </div>
                             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                     <!-- <input list="name1" class="form-control date" id="edit_state" name="edit_state">
                                     <datalist id="name1" >

                                   </datalist> -->
                                    <!-- <input type="text" id="edit_state"  name="edit_state" class="form-control" > -->
                                    <select class="form-control" id="edit_state" name="edit_state" data-placement="bottom" data-toggle="popover">
                                        <option> </option>
                                      @foreach($data2 as $item)
                                           <option>  {{$item->state}}  </option>
                                      @endforeach
                                      <script>
                                      $("#edit_country").change(function(){
                                          // var country=$('#Country').val();
                                          var country=$('#edit_country').val();
                                         //  alert(country);
                                         var url7='select_state';

                                          $.ajax
                                          ({
                                             url: url7,
                                             data: {country:country},
                                             type: 'get',
                                             success:function(data)
                                             {

                                               $('#edit_state').empty();
                                               $('#edit_district').empty();
                                               var n=data.length;
                                               // alert(n);
                                                 // $('#prod_name').focus();
                                                 // $('#edit_state').append( "<option>" + "Select State" + "</option>");
                                                 for(var i=0;i<=n-1;i++)
                                                 {
                                                   $('#edit_state').append( "<option>" + data[i] + "</option>");
                                                    // alert(data[i]);
                                                 }

                                             }

                                          });
                                      });
                                      </script>
                                    </select>
                                   </div>
                               </div>
                           </div>
                       </div>
                       </span>
                      <span class="col-md-6">
                       <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="district">District</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                <div class="form-group">
                                    <div class="form-line">
                                      <!-- <input list="name1" class="form-control date" id="edit_district" name="edit_district">
                                      <datalist id="name1" >
                                      </datalist> -->
                                      <!-- <input type="text" id="edit_district"  name="edit_district" class="form-control" > -->
                                      <select class="form-control" id="edit_district" name="edit_district" data-placement="bottom" data-toggle="popover">
                                        <option> </option>
                                      @foreach($data3 as $item)
                                           <option>  {{$item->district}}  </option>
                                      @endforeach
                                      <script>
                                      $("#edit_state").change(function(){
                                          // var country=$('#Country').val();
                                          var state=$('#edit_state').val();
                                         //  alert(state);
                                         var url8='select_district';
                                          $.ajax
                                          ({
                                             url: url8,
                                             data: {state:state},
                                             type: 'get',
                                             success:function(data)
                                             {
                                                 //  $("#edit_district").  removeAttr('disabled');
                                               $('#edit_district').empty();
                                               var n=data.length;
                                               // alert(n);
                                                 // $('#prod_name').focus();
                                                 // $('#district').append( "<option>" + "Select District" + "</option>");
                                                   $("#edit_district").removeAttr("disabled");
                                                 for(var i=0;i<=n-1;i++)
                                                 {
                                                   $('#edit_district').append( "<option>" + data[i] + "</option>");
                                                    // alert(data[i]);
                                                 }
                                             }

                                          });
                                      });
                                      </script>
                                      </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="country">Status</label>
                           </div>
                           <div class="demo-radio-button">
                              <input name="group1" type="radio" id="radio_1" value="Enable" checked />
                              <label for="radio_1">Enable</label>
                              <input name="group1" type="radio" id="radio_2" value="Disable"/>
                              <label for="radio_2">Disable</label>
                           </div>
                       </div>
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="pincode">Pincode</label>
                           </div>
                             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                       <input type="text" id="edit_pincode" class="form-control" placeholder="pincode" required min="0" oninput="if(value.length>6)value=value.slice(0,6)">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="phone">Mobile</label>
                           </div>
                             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                       <input type="phone" id="edit_mobile" class="form-control" placeholder="Mobile" min="0" oninput="if(value.length>10)value=value.slice(0,10)">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="phone">Phone</label>
                           </div>
                             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                       <input type="phone" id="edit_phone" class="form-control" placeholder="Phone" required min="0" oninput="if(value.length>10)value=value.slice(0,10)">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="email">E-mail</label>
                           </div>
                             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                       <input type="email" id="edit_email" name="edit_email" class="form-control" placeholder="abc@gmail.com"  required="">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <!-- <div class="col-md-1"></div> -->
                       <div class="row clearfix">
                           <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                               <label for="notes">Notes</label>
                           </div>
                             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                               <div class="form-group">
                                   <div class="form-line">
                                     <textarea rows="1" name="edit_notes" id="edit_notes" class="form-control no-resize" placeholder="Desciption"></textarea>
                                     <!-- <input type="email" id="email" name="email" class="form-control" placeholder="abc@gmail.com"  required=""> -->
                                   </div>
                               </div>
                           </div>
                       </div>
                     </span>
                       <div class="row clearfix">

                       </div>
                   </form>
               </div>
               <div class="header bg-cyan" >

                           <button type="button" data-color="blue-grey" class="btn bg-blue-grey waves-effect" id="modify" > <i class="material-icons">save</i>
                           <span>Modify</span></button>

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
