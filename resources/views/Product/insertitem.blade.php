<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Insert Item | JRPoP</title>
  <!-- <link rel="stylesheet" href="{{ URL::asset('/plugins/bootstrap/css/bootstrap.css')}}"> -->
  <link rel="icon" type="image/x-icon" href="{{ URL::asset('favicon.ico')}}">
  <!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
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

  <!-- <link href="/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="/plugins/node-waves/waves.css" rel="stylesheet" />
  <link href="/plugins/animate-css/animate.css" rel="stylesheet" />
  <link href="/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />
  <link href="/plugins/dropzone/dropzone.css" rel="stylesheet">
  <link href="/plugins/multi-select/css/multi-select.css" rel="stylesheet">
  <link href="/plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">
  <link href="/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
  <link href="/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
  <link href="/plugins/nouislider/nouislider.min.css" rel="stylesheet" />
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/themes/all-themes.css" rel="stylesheet" />
  <script src="/plugins/jquery/jquery.js"></script> -->
</head>
<body class="theme-cyan">
  <script>
    $(document).ready(function() {
      // $(document).on('change','#mrp',function() {
      //   var status = $('input[type="radio"][id="disc1"]:checked').val();
      //   var mrp = Number($('#mrp').val());
      //   var discvalue = $('#discvalue').val();
      //   if(mrp == '0.00'){
      //     alert("MRP should not be Zero.");
      //     $('#mrp').focus();
      //   }
      //   else {
      //     if (status =='rupees')
      //     {
      //       var finalprice = mrp-discvalue;
      //       // $('#finalprice').text((finalprice).toFixed(2));
      //       $('#finalprice').val(finalprice);
      //     }
      //     else if (status == 'percent')
      //     {
      //       var temp = (discvalue/100)*mrp;
      //       var finalprice = mrp-temp;
      //       // $('#finalprice').text((finalprice).toFixed(2));
      //       $('#finalprice').val(finalprice);
      //     }
      //   }
      // });
      $('#mrp').change(function(){
        (function(el){el.value=parseFloat(el.value).toFixed(2);})(this)
        var status = $("input[name='disc']:checked").val();
        var mrp = Number($('#mrp').val());
        if(mrp == "" || mrp <= 0 || mrp == 0.00){
          alert("Please enter a value");
          // document.getElementById("mrp").value = "0";
          $('#mrp').val('');
          $('#mrp').focus();
        } else {
        var discvalue = Number($('#discvalue').val());
        if (status !='percent') {
            var finalprice = mrp-discvalue;
            // $('#finalprice').text(finalprice);
            document.getElementById("finalprice").value = finalprice;
            document.getElementById("finalprice1").value = finalprice;

          } else if (status == 'percent') {
            var temp = (discvalue/100)*mrp;

            var finalprice = mrp-temp;
            //$('#finalprice').text(finalprice);
            document.getElementById("finalprice").value = finalprice;
            document.getElementById("finalprice1").value = finalprice;
          }
        }
      });

      $("#discvalue").on('keydown', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode == 9) {
          // e.preventDefault();
          // alert("TAB Pressed");
          $('#disc1').attr('checked', true);
        }
      });

      //$('input[type="checkbox"][id="isactive1"]').click(function(){
        $('input[type="checkbox"][id="isactive1"]').click(function(){
            if($(this).is(":checked")){
                $('#notforsale').prop("disabled", false);
            }
            else if($(this).is(":not(:checked)")){
                $('#notforsale').attr('checked', false);
                $('#notforsale').prop("disabled", true);
            }
        });
      //});

      // $(document).on('change','#discvalue',function() {
      //   var mrp = Number($('#mrp').val());
      //   var discvalue = Number($('#discvalue').val());
      //   // var finalprice = mrp-discvalue;
      //   // $('#finalprice').text((finalprice).toFixed(2));
      //   // $('#finalprice').val(finalprice);
      //   if(discvalue > mrp){
      //     alert("Discount value must be less than MRP");
      //     document.getElementById("discvalue").value= "";
      //     document.getElementById("finalprice").value= "";
      //     $("#discvalue").focus();
      //   }
      //   else {
      //     var status = $('input[type="radio"][id="disc1"]:checked').val();
      //     if (status =='rupees') {
      //       var finalprice = mrp-discvalue;
      //       // $('#finalprice').text((finalprice).toFixed(2));
      //       $('#finalprice').val(finalprice);
      //     } else if (status == 'percent') {
      //       var temp = (discvalue/100)*mrp;
      //       var finalprice = mrp-temp;
      //       // $('#finalprice').text((finalprice).toFixed(2));
      //       $('#finalprice').val(finalprice);
      //     }
      //   }
      // });
      $('#discvalue').on('change',function() {
        var mrp = Number($('#mrp').val());
        var discvalue = Number($('#discvalue').val());
        // var finalprice = mrp-discvalue;
        // $('#finalprice').text(finalprice);
        var status = $('input[type="radio"][name="disc"]:checked').val();
          if (status != 'percent') {
            if(discvalue>=mrp){
              alert("Enter discount value less than MRP");
              document.getElementById("discvalue").value = "";
              $('#discvalue').focus();
            } else {
              var finalprice = mrp-discvalue;
              // $('#finalprice').text(finalprice);
              document.getElementById("finalprice").value = finalprice;
              document.getElementById("finalprice1").value = finalprice;
            }
          }
          else if (status == 'percent') {
            if(discvalue>100){
              alert("Discount percentage value should be less than 100.");
              document.getElementById("discvalue").value = "";
              $('#discvalue').focus();
            } else {
              var temp = (discvalue/100)*mrp;
              var finalprice = mrp-temp;
              //$('#finalprice').text(finalprice);
              document.getElementById("finalprice").value = finalprice;
              document.getElementById("finalprice1").value = finalprice;
            }
          }
      });

      $(document).on('change','#disc1',function() {
        var status = $('input[type="radio"][id="disc1"]:checked').val();
        var mrp = Number($('#mrp').val());
        var discvalue = Number($('#discvalue').val());
        if (status =='rupees') {
          var finalprice = mrp-discvalue;
          // $('#finalprice').text((finalprice).toFixed(2));
          $('#finalprice').val(finalprice);
        } else if (status == 'percent') {
          var temp = (discvalue/100)*mrp;
          var finalprice = mrp-temp;
          // $('#finalprice').text((finalprice).toFixed(2));
          $('#finalprice').val(finalprice);
        }
      });

      $(document).on('click','#disc2',function() {
        var discvalue = Number($('#discvalue').val());
        if(discvalue >= 100) {
          alert("Percentage should be less than 100");
          document.getElementById("discvalue").value = "";
          $('#discvalue').focus();
        }
      });

      $(document).on('change','#disc2',function() {
        var status = $('input[type="radio"][id="disc2"]:checked').val();
        var mrp = Number($('#mrp').val());
        var discvalue = Number($('#discvalue').val());
        if (status =='rupees') {
          var finalprice = mrp-discvalue;
          // $('#finalprice').text((finalprice).toFixed(2));
          // $('#finalprice').val(finalprice);
          document.getElementById("finalprice").value = finalprice;
          document.getElementById("finalprice1").value = finalprice;
        } else if (status == 'percent') {
          var temp = (discvalue/100)*mrp;
          var finalprice = mrp-temp;
          // $('#finalprice').text((finalprice).toFixed(2));
          // $('#finalprice').val(finalprice);
          document.getElementById("finalprice").value = finalprice;
          document.getElementById("finalprice1").value = finalprice;
        }
      });

      // $('#mrp').on('change', function() {
      //   //this.form.submit();
      //   var mrp = $('#mrp').val();
      //   if(mrp == '0.00')
      //   {
      //     alert("MRP should not be zero");
      //     $('#mrp').focus();
      //   }
      // });
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
                            <li class="active">
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
<section class="content">
  <div class="container-fluid">

    <div class="row clearfix">
      <div class="">
        <div class="card col-md-12">
          <div class="header">
            <h2>Enter Item Details</h2>
          </div>
          <div class="body">
              <div class="row clearfix">
              {!! Form::open(array('class'=>'form-horizontal','route' => 'items.store','data-parsley-validate'=>'','files'=>true))!!}
                <span class="col-md-6">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="bnumber">Barcode</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                  <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="bnumber" id="bnumber" class="form-control" placeholder="Barcode Number" autofocus required>
                    </div>
                  </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="itemname">Item Name</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="form-group">
                      <div class="form-line">
                          <input type="text" name="itemname" class="form-control" placeholder="Enter Item Name" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="openstock">Opening Stock</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="form-group">
                      <div class="form-line">
                          <input type="number" name="openstock" id="openstock" class="form-control" value="0" min="0" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="minstock">Minimum Stock</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="form-group">
                      <div class="form-line">
                          <input type="number" name="minstock" id="minstock" class="form-control" value="0" min="0">
                      </div>
                      <div class="help-info">Minimum stock to be maintained (Optional)</div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="selch">Select Options</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 demo-checkbox">
                    <input type="checkbox" id="isactive1" name="isactive1" class="filled-in chk-col-blue"><label for="isactive1">Is active</label>
                    <input type="checkbox" id="notforsale" name="notforsale" class="filled-in chk-col-blue" disabled="true"><label for="notforsale">Not for sale</label>
                    <input type="checkbox" id="ispurchased" name="ispurchased" class="filled-in chk-col-blue"><label for="ispurchased">Is purchased</label>
                    <input type="checkbox" id="online" name="online" class="filled-in chk-col-blue"><label for="online">Only for online</label>
                  </div><br>

                  <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="suppname">Supplier Name</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="form-group">
                      <div class="form-line">
                          <input type="text" name="suppname" id="suppname" class="form-control">
                      </div>
                      <div class="help-info">Optional</div>
                    </div>
                  </div> -->

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="categoryname">Select Category</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="input-group">
                      <div class="form-line" data-placement="bottom" data-toggle="popover">
                        <select class="form-control input-sm" id="categoryname" name="categoryname" data-placement="bottom" data-toggle="popover">
                          @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="subcategoryname">Sub-Category</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 subs" style="z-index:0">
                    <div class="input-group">
                      <div class="form-line" data-placement="bottom" data-toggle="popover">
                        <select class="form-control input-sm" id="subcategoryname" name="subcategoryname" data-placement="bottom" data-toggle="popover" disabled>
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
                            <textarea rows="3" name="desc" class="form-control no-resize" placeholder="Type item description..."></textarea>
                        </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    {{Form::label('featured_image', 'Upload Image')}}<br>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="input-group">
                      <div class="form-line">
                        {{Form::file('featured_image',['class' => 'm-t-5 waves-effect','accept'=>'image/*','id' => 'imgInp'])}}
                      </div>
                    </div>
                    <div><img id="blah" src="#" alt="" height="150" width="150" style="border-radius:50%;"/></div>
                  </div>
                  <script type="text/javascript">
                  function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#blah').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                      }
                    }
                    $("#imgInp").change(function(){
                        readURL(this);
                    });
                    </script>

                    <!-- <script type="text/javascript">
                      function readURL(input)
                      {
                        if(input.files && input.files[0]) {
                          var reader = new FileReader();
                          reader.onload = function(e)
                        }
                      }
                    </script> -->
<!-- onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" -->

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="mrp">MRP</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="input-group">
                      <div class="form-line">
                          <input type="number" name="mrp" id="mrp" class="form-control"  placeholder="00.00" min="0" onchange="validate();" required>
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
                            <input type="number" name="discvalue" id="discvalue" class="form-control" min="0" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" required>
                        </div>
                      </div>
                      <span class="input-group-addon beautiful">
                          <input type="radio" id="disc1" name="disc" value="rupees" class="with-gap radio-col-blue"><label for="disc1"><b>&#8377;</b></label>
                          <input type="radio" id="disc2" name="disc" value="percent" class="with-gap radio-col-blue"><label for="disc2"><b>%</b></label>
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                    <label for="finalprice">Final Price</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <div class="input-group">
                      <div class="form-line">
                          <input type="number" name="finalprice" id="finalprice" class="form-control" disabled onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" min="0" placeholder="0">
                          <input type="hidden" name="finalprice1" id="finalprice1" class="form-control">
                      </div>
                    </div>
                  </div>

                  <!-- <input type="hidden" name="finalprice" id="finalprice" class="form-control" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" min="0"> -->
                  <!-- <label for="finalprice" name="finalprice" id="finalprice">Final Price</label> -->

                  {{-- <div class="col-md-8 info-box-3 bg-blue hover-zoom-effect align-right">
                        <div class="icon">
                            <i class="material-icons">shopping_basket</i>
                        </div>
                        <div class="content">
                            <div class="text">Sales Price (In Rupees)</div>
                            <label name="finalprice" id="finalprice">0</label>
                        </div>
                    </div> --}}

                  <div class="align-right">
                    {{ Form::submit('Insert Item',array('class'=>'btn btn-primary m-t-5 waves-effect'))}}
                  </div>

                  <!-- Sub-category -->
                  {{-- <div class="form-group">
                    <div class="col-sm-3 pull-left">
                      <label for="subcategoryname" class="control-label">Sub-Category</label>
                    </div>
                    <div class="col-sm-9 pull-right">
                      <div class="input-group">
                        <select class="form-control" name="subcategoryname" id="subcategoryname" style="width: 100%;">
                          <option value="" selected="selected">--- Select Sub-Category ---</option>
                        </select>
                        <span class="input-group-addon"><i class="fa fa-fw fa-th"></i></span>
                      </div>
                    </div>
                  </div> --}}

                </span>
                <script>
                  $("#categoryname").change(function(){
                      var categoryCode = $('#categoryname :selected').val();
                      $("#subcategoryname").attr("disabled", false);
                      $.ajax({
                          url: 'get_sub_category_product.php',
                          // data: "categoryCode=" + selected_cat_type,
                          data: {categoryCode: categoryCode},
                          type: 'GET',
                          success: function(data)
                          {
                            $('#subcategoryname').html(data);
                            //$('#subcategoryname').focus();
                          },
                          error: function()
                          {
                            alert("Error occured while Retreiving Sub Category! Please try again");
                          }
                      });
                  });
                </script>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="{{ URL::asset('/plugins/bootstrap/js/bootstrap.js')}}"></script>
<!-- <script src="{{ URL::asset('/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script> -->
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

<!-- // <script src="/plugins/bootstrap/js/bootstrap.js"></script>-->
 <!-- <script src="/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->
<!-- // <script src="/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
// <script src="/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
// <script src="/plugins/dropzone/dropzone.js"></script>
// <script src="/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
// <script src="/plugins/multi-select/js/jquery.multi-select.js"></script>
// <script src="/plugins/jquery-spinner/js/jquery.spinner.js"></script>
// <script src="/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
// <script src="/plugins/nouislider/nouislider.js"></script>
// <script src="/plugins/node-waves/waves.js"></script>
// <script src="/js/admin.js"></script>
// <script src="/js/pages/forms/advanced-form-elements.js"></script>
// <script src="/js/demo.js"></script>
// <script src="/script/sales.js"></script> -->
</body>
</html>
