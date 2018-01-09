<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Jesus Redeems Management System</title>
    <link href="../css/receipt.css" rel="stylesheet">
    <!-- <link href="/css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <script type="text/javascript">
    	window.onload = function()
        {
                var address = document.getElementById("addresshidden").innerHTML.split("*");
                var addressfinal="";
                for(var i = 0; i < address.length; i++)
                {
                    if(address[i].length > 0)
                    {
                        var addressone = address[i].split(" ");
                        var addressfl = "";
                        for(var j = 0; j < addressone.length; j++)
                        {
                            if(addressone[j].length > 0)
                            {
                                var add = (addressone[j].toUpperCase());
                                addressfl = addressfl + add +" ";
                            }
                        }
                        addressfinal = addressfinal + addressfl + "</br>";
                    }
                }
                document.getElementById("address").innerHTML=addressfinal;

            window.print();
            window.close();

        }
    </script>

	</head>
	<body>
		<section id="sectionMain">
			<div>
				<div id="JRDetails">
				    <div id="col1">
						  <img src="../images/LOGO5.png" id="Logo" width="150px" height="90px">
				    </div>
				    <div id="col1" class="col-md-3">
				    	<p class="linespacing25 textalignright font-18">
							04639-220022</br>
							info@jesusredeems.com</br>
							www.jesusredeems.com</br>
						</p>
				    </div>
				    <div id="col1" class="col-md-3">
				    	<p class="linespacing25 textalignright font-18">
							Jesus Redeems Ministries</br>
							Nalumavadi - 628211</br>
							Tuticorin</br>
						</p>
				    </div>
				</div>
        <hr>

				<div id="InvoiceDetails">
				  <div id="rowfix">

				    <div id="col1" class="linespacing3">
				    	<h5 align="left">&nbsp;Billing To</h5>
                @foreach ($ReceiptSelections as $ReceiptSelection)
						    	<div id="BillAddress" name="BillAddress" class="textalignleft font-16">
						    		<p class="linespacing17" id="address" name="address">
						    		</p>
						    		<p id="addresshidden" name="addresshidden" hidden>{{$ReceiptSelection->salutation}}{{$ReceiptSelection->name}}*{{$ReceiptSelection->address1}}*{{$ReceiptSelection->address2}}*{{$ReceiptSelection->address3}}*{{$ReceiptSelection->address4}}*{{$ReceiptSelection->district}}*{{$ReceiptSelection->pincode}}*{{$ReceiptSelection->state}}*{{$ReceiptSelection->country}}*{{$ReceiptSelection->mobile1}}*</p>
						    	</div>
						    	@break
                @endforeach
				    	</div>
				    </div>
					</br>
				    <div id="col1" class="linespacing5">
				    	<h5 align="left">Invoice Number</h5>

                        	@foreach ($ReceiptSelections as $ReceiptSelection)
						    	<div id="InvoiceNo" name="InvoiceNo" class="textalignleft font-18">
						    		{{$ReceiptSelection->invoicenumber}}
						    	</div>
						    	@break
                            @endforeach
						</br>
				    	<h5 align="left">Date of Issue</h5>
                @foreach ($ReceiptSelections as $ReceiptSelection)
						    	<div id="InvoiceDate" name="InvoiceDate" class="textalignleft font-18">
						    		{{$ReceiptSelection->invoicedate}}
						    	</div>
						    	@break
                @endforeach
				    </div>

				    <div id="col1">
                <h5 style="font-family: 'Lato', sans-serif;">Invoice Total</h5>
                @foreach ($ReceiptSelections as $ReceiptSelection)
						    	<div name="Ttl_Amount" id="Ttl_Amount" style="text-align: center;" class="font-38">
                    <i class="fa fa-inr" aria-hidden="true"></i>
						    		 {{$ReceiptSelection->totalamount}}
                     </i>
						    	</div>
						    	@break
                @endforeach
				    </div>

				  </div>
				</div>
				<div id="differentiate">
				</div>


				<div id="col12">
					<table id="ItemTablereceipt" name="ItemTablereceipt">
						<thead align="left">
							<tr>
                  <th id="thead_Items">SNo</th>
							    <th id="thead_Items">Description</th>
							    <th id="thead_Items">Quantity</th>
							    <th id="thead_Items">MRP</th>
							    <th id="thead_Items">Amount</th>
						  	</tr>
                    	</thead>
                    	<tbody>

                        	@foreach ($ReceiptSelections as $ReceiptSelection)
                            	<tr>
                                	<td style="text-align: center; font-size:14px;"></td>
                                    <td style="font-size:14px;">{{$ReceiptSelection->itemname}}</td>
                                    <td style="text-align: right; font-size:14px;">{{$ReceiptSelection->Itemquantity}}</td>
                                    <td style="text-align: right; font-size:14px;">{{$ReceiptSelection->mrp}}</td>
                                    <td style="text-align: right; font-size:14px;">{{$ReceiptSelection->Itemamount}}</td>
                                </tr>
                            @endforeach

                	</tbody>
                    </br>
					</table>
				</div>
			</div>


		</section>

	</body>
</html>
