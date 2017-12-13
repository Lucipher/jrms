<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Modify Item | JRPoP</title>
  <!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->
  <link rel="icon" type="image/x-icon" href="{{ URL::asset('favicon.ico')}}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <!-- <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="plugins/node-waves/waves.css" rel="stylesheet" />
  <link href="plugins/animate-css/animate.css" rel="stylesheet" />
  <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />
  <link href="plugins/dropzone/dropzone.css" rel="stylesheet">
  <link href="plugins/multi-select/css/multi-select.css" rel="stylesheet">
  <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">
  <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
  <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
  <link href="plugins/nouislider/nouislider.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/themes/all-themes.css" rel="stylesheet" />
  <script src="plugins/jquery/jquery.js"></script> -->
  <link rel="stylesheet" href="{{ URL::asset('/plugins/bootstrap/css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/node-waves/waves.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/animate-css/animate.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/dropzone/dropzone.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/multi-select/css/multi-select.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/jquery-spinner/css/bootstrap-spinner.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/bootstrap-select/css/bootstrap-select.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/plugins/nouislider/nouislider.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/css/style.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/css/themes/all-themes.css')}}">
  <script src="{{ URL::asset('/plugins/jquery/jquery.js')}}"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
</head>
<body class="theme-cyan">
  <script>
    $('document').ready(function() {
      $('#modify').on('click',function() {
        var chkvalue = $('#wrapper').val();
        var bnumber = $('#bnumber').val();
        var itemname= $('#itemname').val();
        var openstock= $('#openstock').val();
        var minstock= $('#minstock').val();
        var isactive= $('#isactive').val();
        var notforsale= $('#notforsale').val();
        var ispurchased= $('#ispurchased').val();
        var online= $('#online').val();
        var categoryname= $('#categoryname').val();
        var subcategoryname= $('#subcategoryname').val();
        var desc= $('#desc').val();
        //var featured_image= $('#featured_image').val();
        var mrp= $('#mrp').val();
        var disc1= $('#disc1').val();
        var disc2= $('#disc2').val();
        var discvalue= $('#discvalue').val();
        var finalprice= $('#finalprice').val();
        var url1 = 'modify';
        $.ajax({
          url: url1,
          data: {chkvalue: chkvalue, bnumber: bnumber, itemname: itemname, openstock: openstock, minstock: minstock,
          isactive: isactive, notforsale: notforsale, ispurchased: ispurchased, online: online, categoryname: categoryname,
        subcategoryname: subcategoryname, desc: desc, mrp: mrp, disc1: disc1, disc2: disc2, discvalue: discvalue, finalprice: finalprice},
          type: 'GET',
          success: function(data)
          {
            //alert(data);
          },
          error: function()
          {
            alert("Error in modifying data! Please try again.");
          }
        });
      });

      $('#discvalue').on('change',function() {
        var mrp = $('#mrp').val();
        var discvalue = $('#discvalue').val();
        var finalprice = mrp-discvalue;
        $('#finalprice').text(finalprice);
        var status = $('input[type="radio"][id="disc1"]:checked').val();
        if (status == 'rupees') {
          var finalprice = mrp-discvalue;
          // $('#finalprice').text(finalprice);
          document.getElementById("finalprice").value = finalprice;
        }
        else if (status == 'percent') {
          var temp = (discvalue/100)*mrp;
          var finalprice = mrp-temp;
          //$('#finalprice').text(finalprice);
          document.getElementById("finalprice").value = finalprice;
        }
      });

      // $('#wrapper').on('keyup',function() {
      //   var search_text = $('#wrapper').val();
      //   $.ajax({
      //     url: '/get_item_details',
      //     data: {search_text: search_text},
      //     type: 'GET',
      //     success: function(data)
      //     {
      //       $('#wrapper').append(data);
      //     }
      //     // error: function()
      //     // {
      //     //   alert("Error occured while retrieving Item details!");
      //     // }
      //   });
      // });

        $('#wrapper').typeahead({
          source: function(search_text, result)
          {
           $.ajax({
            url:"get_item_details.php",
            method:"POST",
            data:{search_text:search_text},
            dataType:"json",
            success:function(data)
            {
             result($.map(data, function(item){
              return item;
             }));
            }
           })
          }
         });

      $('#disc1').on('change',function() {
        //var status = $('input[type="radio"][id="disc1"]:checked').val();
        var status = "rupees";
        var mrp = $('#mrp').val();
        var discvalue = $('#discvalue').val();
        // if (status =='rupees') {
          var finalprice = mrp-discvalue;
          //$('#finalprice').text(finalprice);
          document.getElementById("finalprice").value = finalprice;
        // } else if (status == 'percent') {
        //   var temp = (discvalue/100)*mrp;
        //   var finalprice = mrp-temp;
        //   $('#finalprice').text(finalprice);
        // }
      });

      $('#disc2').on('change',function() {
        //var status = $('input[type="radio"][id="disc2"]:checked').val();
        var status = "percent";
        var mrp = $('#mrp').val();
        var discvalue = $('#discvalue').val();
        // if (status =='rupees') {
        //   var finalprice = mrp-discvalue;
        //   $('#finalprice').text(finalprice);
        // } else if (status == 'percent') {
          var temp = (discvalue/100)*mrp;
          var finalprice = mrp-temp;
          //$('#finalprice').text(finalprice);
          document.getElementById("finalprice").value = finalprice;
        // }
      });

      $('#mrp').on('change',function() {
        var status = $('input[type="radio"][id="disc1"]:checked').val();
        var mrp = $('#mrp').val();
        var discvalue = $('#discvalue').val();
        if (status =='rupees') {
          var finalprice = mrp-discvalue;
          $('#finalprice').text(finalprice);
        } else if (status == 'percent') {
          var temp = (discvalue/100)*mrp;
          var finalprice = mrp-temp;
          //$('#finalprice').text(finalprice);
          document.getElementById("finalprice").value = finalprice;
        }
      });
    });
  </script>

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
                <li class="">
                    <a href="{{ url('/register') }}">
                        <i class="material-icons">home</i>
                        <span>Registration</span>
                    </a>
                </li>
                <li class="active">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">dns</i>
                        <span>Items</span>
                    </a>
                    <ul class="ml-menu">
                        <li >
                            <a href="{{ url('insertitem') }}">Add Item</a>
                        </li>
                        <li class="active">
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
  <div class="container-fluid">
    <!-- <div class="block-header">
      <h2>Modify Item</h2>
    </div> -->
    <div class="row clearfix">
      <div class="">
        <div class="card col-md-12">
          <div class="header">
            <h2>Enter Item details</h2>
          </div>

          <div class="body">
              <div class="row clearfix">
              {{ Form::open(array('name'=>'myform','method'=>'GET','class'=>'form-horizontal','data-parsley-validate'=>'','files'=>true))}}
                <span class="col-md-6">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="wrapper">Enter details</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="wrapper" id="wrapper" class="form-control" autocomplete="off" placeholder="Item Name or Barcode Number" autofocus>
                    </div>
                  </div>
                  </div>

                  <script>
                  var id = 2;
                    $('#wrapper').change(function(){
                      var idetail = $('#wrapper').val();
                      $('#bnumber').removeAttr('disabled');
                      $('#itemname').removeAttr('disabled');
                      $('#openstock').removeAttr('disabled');
                      $('#minstock').removeAttr('disabled');
                      $('#isactive').removeAttr('disabled');
                      $('#notforsale').removeAttr('disabled');
                      $('#ispurchased').removeAttr('disabled');
                      $('#online').removeAttr('disabled');
                      $('#categoryname').removeAttr('disabled');
                      $('#subcategoryname').removeAttr('disabled');
                      $('#desc').removeAttr('disabled');
                      //$('#featured_image').removeAttr('disabled');
                      $('#mrp').removeAttr('disabled');
                      $('#disc1').removeAttr('disabled');
                      $('#disc2').removeAttr('disabled');
                      $('#discvalue').removeAttr('disabled');
                      // $('#finalprice').removeAttr('disabled');

                      $.ajax({
                        url: 'get_modify_item_value.php',
                        data: {idetail: idetail},
                        type: 'GET',
                        success: function(data)
                        {
                          var temp1 = data;
                          var temp2 = temp1.split("%");
                          var bnumber = temp2[0];
                          var itemname = temp2[1];
                          var openstock = temp2[2];
                          var minstock = temp2[3];
                          var isactive = temp2[4];
                          var notforsale = temp2[5];
                          var ispurchased = temp2[6];
                          var online = temp2[7];
                          //var categoryname = temp2[8];
                          var temp3 = temp2[8];
                          var subcategoryname = temp2[9];
                          var desc = temp2[10];
                          var featured_image = temp2[11];
                          var mrp = temp2[12];
                          var disc1 = temp2[13];
                          var disc2 = temp2[14];
                          var discvalue = temp2[15];
                          var finalprice = temp2[16];
                          $('#bnumber').val(bnumber);
                          $('#itemname').val(itemname);
                          $('#openstock').val(openstock);
                          $('#minstock').val(minstock);
                          if(isactive == "t")
                          {
                            document.getElementById("isactive").checked = true;
                          }
                          if(notforsale == "t")
                          {
                            document.getElementById("notforsale").checked = true;
                          }
                          if(ispurchased == "t")
                          {
                            document.getElementById("ispurchased").checked = true;
                          }
                          if(online == "t")
                          {
                            document.getElementById("online").checked = true;
                          }
                          $('#isactive').val(isactive);
                          $('#notforsale').val(notforsale);
                          $('#ispurchased').val(ispurchased);
                          $('#online').val(online);
                          // $('#categoryname').val(categoryname);
                          // $('#subcategoryname').val(subcategoryname);
                          $('#desc').val(desc);
                          //$('#featured_image').val(featured_image);
                          //$('#featured_image').file('/item_images/'+featured_image);
                          $('#mrp').val(mrp);
                          if(disc1 == "rupees") {
                            //$('#disc1').checked = true;
                            $('#disc1').prop('checked', true).button("refresh");
                            //$('#disc1').val(disc1);
                            //$('#disc2').val(disc2);
                          }
                          else if(disk1 = "percent") {
                            $('#disc2').checked = true;
                          }
                          $('#discvalue').val(discvalue);
                          $('#finalprice').val(finalprice);
                        },
                        error: function()
                        {
                          alert("Error occured while retrieving item details!");
                        }
                      });
                    });
                  </script>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="bnumber">Barcode</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="bnumber" id="bnumber" class="form-control" disabled>
                    </div>
                  </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="itemname">Item Name</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="form-group">
                      <div class="form-line">
                          <input type="text" name="itemname" id="itemname" class="form-control" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="openstock">Opening Stock</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="form-group">
                      <div class="form-line">
                          <input type="number" name="openstock" id="openstock" class="form-control" value="0" min="0" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="minstock">Minimum Stock</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="form-group">
                      <div class="form-line">
                          <input type="number" name="minstock" id="minstock" class="form-control" value="0" min="0" disabled>
                      </div>
                      <div class="help-info">Minimum stock to be maintained (Optional)</div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="selch">Select Options</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 demo-checkbox">
                    <input type="checkbox" id="isactive" name="isactive" class="chk-col-blue" disabled><label for="isactive">Is active</label>
                    <input type="checkbox" id="notforsale" name="notforsale" class="chk-col-blue" disabled><label for="notforsale">Not for sale</label>
                    <input type="checkbox" id="ispurchased" name="ispurchased" class="chk-col-blue" disabled><label for="ispurchased">Is purchased</label>
                    <input type="checkbox" id="online" name="online" class="chk-col-blue" disabled><label for="online">Only for online</label>
                  </div><br>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="categoryname">Select Category</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="input-group">
                      <div class="form-line">
                        <select class="form-control" name="categoryname" id="categoryname" data-placement="bottom" data-toggle="popover">
                          <script>
                          $('document').ready(function(){
                            $.ajax({
                              url: 'get_category.php',
                              data: {},
                              type: 'GET',
                              success: function(data)
                              {
                                var temp5 = data.split("%");
                                var n = temp5.length;
                                for(var i=0;i<n-1;i++)
                                {
                                  $('#categoryname').append($('<option></option>').html(temp5[i]));
                                }
                              }
                            });
                          });
                          </script>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-7 form-control-label">
                    <label for="subcategoryname">Sub-Category</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 subs" style="z-index:0">
                    <div class="input-group">
                      <div class="form-line" data-placement="bottom" data-toggle="popover">
                        <select class="form-control input-sm" id="subcategoryname" name="subcategoryname" data-placement="bottom" data-toggle="popover">
                          <option value="">--Please Select--</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </span>

                <span class="col-md-6">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                  <label for="desc">Item Description</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="form-group">
                        <div class="form-line">
                            <textarea rows="4" name="desc" id="desc" class="form-control no-resize" disabled></textarea>
                        </div>
                    </div>
                  </div>



                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-7 form-control-label">
                    <label for="mrp">MRP Price</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-5">
                    <div class="input-group">
                      <div class="form-line">
                          <input type="number" name="mrp" id="mrp" class="form-control" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" placeholder="00.00" min="0" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="discvalue">Discount Value</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="input-group">
                      <div class="input-group">
                        <div class="form-line">
                            <input type="number" name="discvalue" id="discvalue" class="form-control" min="0" disabled>
                        </div>
                      </div>
                      <span class="input-group-addon beautiful">
                          <input type="radio" id="disc1" name="disc1" value="rupees" class="with-gap radio-col-blue"><label for="disc1"><b>Rs.</b></label>
                          <input type="radio" id="disc2" name="disc1" value="percent" class="with-gap radio-col-blue"><label for="disc2"><b>%</b></label>
                      </span>
                    </div>
                  </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                      <label for="finalprice">Final Price</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                      <div class="input-group">
                        <div class="form-line">
                            <input type="number" name="finalprice" id="finalprice" class="form-control" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" min="0" disabled>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="finalprice" id="finalprice" class="form-control" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" min="0">
                    <script>
                      $("#categoryname").change(function(){
                        var temp = $('#categoryname :selected').html();
                        var categoryCode = temp.substring(15,16);
                        $.ajax({
                          url: 'get_subcategory.php',
                          data: {categoryCode: categoryCode},
                          type: 'GET',
                          success: function(data)
                          {
                            $('#subcategoryname').html(data);
                          },
                          error: function()
                          {
                            alert("Error occured while retreiving sub-category! Please try again");
                          }
                        });
                      });
                    </script>

                  <div class="align-right">
                    {{-- {{Form::submit('Modify Item',array('class'=>'btn btn-primary m-t-5 waves-effect'))}} --}}
                    <button id="modify" class="btn btn-primary m-t-5 waves-effect">Modify Item</button>
                  </div>
                </span>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- <script src="plugins/bootstrap/js/bootstrap.js"></script> -->
<!-- <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script> -->
<!-- <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<!-- <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="plugins/dropzone/dropzone.js"></script>
<script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="plugins/multi-select/js/jquery.multi-select.js"></script>
<script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
<script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="plugins/nouislider/nouislider.js"></script>
<script src="plugins/node-waves/waves.js"></script>
<script src="js/admin.js"></script>
<script src="js/pages/forms/advanced-form-elements.js"></script>
<script src="js/demo.js"></script>
<script src="/script/sales.js"></script> -->
<script src="{{ URL::asset('/plugins/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{ URL::asset('/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<script src="{{ URL::asset('/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
<script src="{{ URL::asset('/plugins/dropzone/dropzone.js')}}"></script>
<script src="{{ URL::asset('/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
<script src="{{ URL::asset('/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
<script src="{{ URL::asset('/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>
<script src="{{ URL::asset('/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{ URL::asset('/plugins/nouislider/nouislider.js')}}"></script>
<script src="{{ URL::asset('/plugins/node-waves/waves.js')}}"></script>
<script src="{{ URL::asset('/js/admin.js')}}"></script>
<script src="{{ URL::asset('/js/pages/forms/advanced-form-elements.js')}}"></script>
<script src="{{ URL::asset('/js/demo.js')}}"></script>
<script src="{{ URL::asset('/script/sales.js')}}"></script>
</body>
</html>
