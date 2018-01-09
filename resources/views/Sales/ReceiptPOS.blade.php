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
          <p class="textaligncenter font-20">Jesus Redeems Ministries</br>
          <h2>Invoice</h2>
      </div>

      				<div id="differentiate">
      				</div>
      <div class="linespacing5">
        <h5 align="left">Invoice Number</h5>

          @foreach ($ReceiptSelections as $ReceiptSelection)
              <div id="InvoiceNo" name="InvoiceNo" class="textalignleft font-18">
                {{$ReceiptSelection->invoicenumber}}
              </div>
              @break
          @endforeach
      </div>

            <div class="linespacing5">
              <h5 align="left">Date of Issue</h5>
                @foreach ($ReceiptSelections as $ReceiptSelection)
						    	<div id="InvoiceDate" name="InvoiceDate" class="textalignleft font-18">
						    		{{$ReceiptSelection->invoicedate}}
						    	</div>
						    	@break
                @endforeach
            </div>

            <div>
            <h5 style="font-family: 'Lato', sans-serif;">Invoice Total</h5>
            @foreach ($ReceiptSelections as $ReceiptSelection)
				    	<div name="Ttl_Amount" id="Ttl_Amount" style="text-align: left;" class="font-38">
                 <i class="fa fa-inr" aria-hidden="true"></i>
					    		 {{$ReceiptSelection->totalamount}}
                  </i>
				    	</div>
          @break
          @endforeach
          </div>


          <div>

          </div>




		</section>

	</body>
</html>
