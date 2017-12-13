






















function FocusQuantity() {

            var ItemsList = document.getElementById("ItemsList").value;
            var Barcodetxt = document.getElementById("Barcodetxt").value;
                var url98 = '../ajaxQuantityFinal';
                $.ajax({
                    type:'get',
                    url:url98,
                    data: {
                      '_token': $('input[name="_token"]').val(),
                      'ItemsList':ItemsList,
                      'Barcodetxt':Barcodetxt
                    },
                    success:function(msg)
                    {
                        $.each(msg, function(i, ItemSel){
                            document.getElementById("Final_Count").value = msg.Quantity;
                            document.getElementById("Barcodetxt").value = msg.Barcode;
                            document.getElementById("ItemsList").value = msg.ItemName;
                            document.getElementById("Quantity").disabled = false;
                            document.getElementById("Quantity").value = "";
                            document.getElementById("Quantity").focus();
                        });
                    }
                });
        }

        function salesKeyDown(evt,id){
            var e = event || evt; // for
            var charCode = e.which || e.keyCode;
            var Val = document.getElementById(id).value;
            if(Val != "")
            {
                if (charCode == 9){// LEAVE EVENT
                    FocusQuantity();
                }
                else if (charCode == 13){ //ENTER KEYPRESS
                    FocusQuantity();
                }
            }
        }

        function salesKeyupQuantity(evt){
            var e = event || evt; // for
            var charCode = e.which || e.keyCode;

            var Final_Count=document.getElementById("Final_Count").value;
            var Qty=document.getElementById("Quantity").value;
                if(+Final_Count < +Qty)
                {
                    Qty=Qty.substring(0, Qty.length-1);
                    document.getElementById("Quantity").value=Qty;
                    alert("Only "+Final_Count+" remaining!!!")
                    return false;
                }
        }

        function salesKeyPressQuantity(evt){
            var e = event || evt; // for
            var charCode = e.which || e.keyCode;

            if (String.fromCharCode(e.keyCode).match(/[^0-9]/g))
            {
                 return false;
            }
        }

        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode
            if(!(keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1){
                return false;
            }
        }

        function SpotDiscounttxtKeyDown(evt,id){
            var e = event || evt; // for
            var charCode = e.which || e.keyCode;
            var Val = document.getElementById(id).value;
            if(Val != "")
            {
                // if (charCode == 8){// LEAVE EVENT
                    SpotDiscounttxt(id);
                // }
            }
        }

        function SpotDiscounttxtKeyPressSD(e,id){
            e = e || window.event;

            var e = event || evt; // for
            var charCode = e.which || e.keyCode;

            if (String.fromCharCode(e.keyCode).match(/[^0-9]/g))
            {
                 return false;
            }
        }


        function SpotDiscounttxtKeypress(evt){
            var e = event || evt; // for
            var charCode = e.which || e.keyCode;

            if (String.fromCharCode(e.keyCode).match(/[^0-9]/g))
            {
                 return false;
            }
        }

        function salesKeyDownQuantity(evt){
            var e = event || evt; // for
            var charCode = e.which || e.keyCode;

            var Quantity = document.getElementById("Quantity").value;
            if(Quantity != "")
            {
                if (charCode == 9){// LEAVE EVENT
                    InsertshowItemsList();
                }
                else if (charCode == 13){ //ENTER KEYPRESS
                    InsertshowItemsList();
                }
            }
            else
            {
                document.getElementById("Quantity").focus();
            }
        }

        function InsertshowItemsList() {

            // var myTable = document.getElementById("ItemTable");
            // var rowCount = myTable.rows.length;
            //     for (var x=rowCount-1; x>0; x--) {
            //        myTable.deleteRow(x);
            //     }

            var Quantity = document.getElementById("Quantity").value;
            if (Quantity != "") {

            var InvoiceNum = document.getElementById("InvoiceNo").innerHTML;

            var invoiceDate = document.getElementById("InvoiceDate").innerHTML;


            var ItemsList = document.getElementById("ItemsList").value;
            var Barcodetxt = document.getElementById("Barcodetxt").value;

            document.getElementById("Barcodetxt").value = "";

            var CheckboxStatusdiscount="Checked";
            var CheckboxStatusspotdiscount="Checked";
            var discountChkBox="1";
            var spotdiscountChkBox ="0";
            var spotdiscountpercent ="0";
            var spotdiscountamount ="0";

            // var table_len=(table.rows.length);
            var ValueExist=0;
            var r=0;
            var table = document.getElementById("ItemTable");
            // while(row=table.rows[r++])
            // {
            //     if(r > 1)
            //     {
            //         if(row.cells[1].innerText == ItemsList)
            //         {
            //             ValueExist = 1;
            //             var rowcnt=Number(r-1);
            //             var CHBName="basic_cb1_"+rowcnt;
            //             var CBName="basic_cb2_"+rowcnt;
            //             var CBNameRd1=CBName+"rd1";
            //             var CBNameRd2=CBName+"rd2";
            //             var CBNameTXT=CBName+"txt";
            //
            //             if (document.getElementById(CHBName).checked == true)
            //             {
            //                 CheckboxStatusdiscount="Checked";
            //                 discountChkBox="1";
            //             }
            //             else
            //             {
            //                 CheckboxStatusdiscount="UnChecked";
            //                 discountChkBox="0";
            //             }
            //
            //             if (document.getElementById(CBName).checked == true)
            //             {
            //                 CheckboxStatusspotdiscount="Checked";
            //                 spotdiscountChkBox="1";
            //                 if (document.getElementById(CBNameRd1).checked == true)
            //                 {
            //                     spotdiscountamount =document.getElementById(CBNameTXT).value;
            //                 }
            //                 else
            //                 {
            //                     spotdiscountpercent =document.getElementById(CBNameTXT).value;
            //                 }
            //             }
            //             else
            //             {
            //                 CheckboxStatusspotdiscount="UnChecked";
            //                 spotdiscountChkBox="0";
            //             }
            //         }
            //     }
            // }
            while(row=table.rows[r++])
            {
                if(r > 1)
                {
                    if(row.cells[1].innerText == ItemsList)
                    {
                        ValueExist = 1;
                        var rowcnt=Number(r-1);
                        var CHBName="basic_cb1_"+rowcnt;
                        var CBName="basic_cb2_"+rowcnt;
                        var CBNameRd1=CBName+"rd1";
                        var CBNameRd2=CBName+"rd2";
                        var CBNameTXT=CBName+"txt";

                        if (document.getElementById(CHBName).checked == true)
                        {
                            CheckboxStatusdiscount="Checked";
                            discountChkBox="1";
                        }
                        else
                        {
                            CheckboxStatusdiscount="UnChecked";
                            discountChkBox="0";
                        }

                        if (document.getElementById(CBName).checked == true)
                        {
                            CheckboxStatusspotdiscount="Checked";
                            spotdiscountChkBox="1";
                            if (document.getElementById(CBNameRd1).checked == true)
                            {
                                spotdiscountamount =document.getElementById(CBNameTXT).value;
                            }
                            else
                            {
                                spotdiscountpercent =document.getElementById(CBNameTXT).value;
                            }
                        }
                        else
                        {
                            CheckboxStatusspotdiscount="UnChecked";
                            spotdiscountChkBox="0";
                        }
                    }
                }
            }
            InvoiceNum = InvoiceNum.trim();
            invoiceDate = invoiceDate.trim();
            var url98 = '../ajaxInvoiceinsert';
            $.ajax({
                   type:'get',
                   url:url98,
                   data: {
                      '_token': $('input[name="_token"]').val(),
                      'invoiceNumber': InvoiceNum,
                      'invoiceDate':invoiceDate,
                      'ItemsList':ItemsList,
                      'Barcodetxt':Barcodetxt,
                      'discountChkBox':discountChkBox,
                      'spotdiscountChkBox':spotdiscountChkBox,
                      'CheckboxStatusdiscount':CheckboxStatusdiscount,
                      'CheckboxStatusspotdiscount':CheckboxStatusspotdiscount,
                      'spotdiscountpercent':spotdiscountpercent,
                      'spotdiscountamount':spotdiscountamount,
                      'Quantity':Quantity
                    },
                   success:function(data){
                    $.each(data, function(i, InvoiceSelection){
                        var TableItems = ["0"];
                        var table = document.getElementById("ItemTable");
                        var rowCount = table.rows.length;
                        var r=1;
                        while(row=table.rows[r++])
                        {
                            if(r > 1)
                            {
                                var a = TableItems.indexOf(row.cells[1].innerText);
                                if(a == -1)
                                {
                                    TableItems.push(row.cells[1].innerText);
                                }
                            }
                        }

                        var ItemExist = TableItems.indexOf(InvoiceSelection.itemname);

                        if(ItemExist == -1)
                        {
                            var row = table.insertRow(rowCount);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            var cell4 = row.insertCell(3);
                            var cell5 = row.insertCell(4);
                            var cell6 = row.insertCell(5);
                            var cell7 = row.insertCell(6);
                            var cell8 = row.insertCell(7);

                            cell1.innerHTML = "";
                            cell1.style.textAlign = "left";
                            cell1.style.align = "center";
                            // cell1.style.padding = "35px";
                            cell1.style.width="40px";

                            cell2.innerHTML = InvoiceSelection.itemname;
                            cell2.style.textAlign = "left";
                            cell2.style.align = "center";
                            // cell2.style.padding = "35px";
                            cell2.style.width="250px";

                            cell3.innerHTML = InvoiceSelection.mrp;
                            cell3.style.textAlign = "left";
                            cell3.style.align = "center";
                            // cell3.style.padding = "35px";
                            cell3.style.width="200px";

                            var Amt_Pdt = parseFloat(InvoiceSelection.amount);
                            cell4.innerHTML =Amt_Pdt.toFixed(2);
                            cell4.style.textAlign = "left";
                            cell4.style.align = "center";
                            // cell4.style.padding = "35px";
                            cell4.style.width="100px";

                            var CHBName="basic_cb1_"+rowCount;
                            // cell5.innerHTML = "<div class='body'><input type='checkbox' onclick='ProductDiscountED(id)' id="+CHBName+" class='filled-in' checked /><label for="+CHBName+"> </label></div>";
                            cell5.innerHTML = "<input type='checkbox' onclick='ProductDiscountED(id)' id="+CHBName+" class='filled-in' checked /><label for="+CHBName+"> </label>";
                            cell5.style.textAlign = "center";
                            cell5.style.align = "center";
                            cell5.style.width="200px";
                            if(InvoiceSelection.discountChkBox == "0"){
                                document.getElementById(CHBName).checked = false;
                            }


                            var CBName="basic_cb2_"+rowCount;
                            var CBNamenm=CBName+"grp";
                            var CBNameRd1=CBName+"rd1";
                            var CBNameRd2=CBName+"rd2";
                            var CBNameTXT=CBName+"txt";
                            // cell6.innerHTML = "<div class='body'><input type='checkbox' onclick='SpotDiscountED(id);' id="+CBName+" class='filled-in' /><label for="+CBName+">&nbsp;&nbsp;</label><input name="+CBNamenm+" type='radio' id="+CBNameRd1+" class='with-gap radio-col-teal' value='fixed' disabled /><label for="+CBNameRd1+">$&nbsp;&nbsp;</label><input name="+CBNamenm+" type='radio' id="+CBNameRd2+" class='with-gap radio-col-teal' value='true' disabled /><label for="+CBNameRd2+">%&nbsp;&nbsp;</label><input type='text' value='0' id="+CBNameTXT+" onfocusout='SpotDiscounttxt(id);' onkeypress='return SpotDiscounttxtKeyPress(event,id);'  size='10' disabled></div>";
                            cell6.innerHTML = "<input type='checkbox' onclick='SpotDiscountED(id);' id="+CBName+" class='filled-in' /><label for="+CBName+">&nbsp;&nbsp;</label><input name="+CBNamenm+" type='radio' id="+CBNameRd1+" class='with-gap radio-col-teal' value='fixed' disabled /><label for="+CBNameRd1+">₹&nbsp;&nbsp;</label><input name="+CBNamenm+" type='radio' id="+CBNameRd2+" class='with-gap radio-col-teal' value='true' disabled /><label for="+CBNameRd2+">%&nbsp;&nbsp;</label><input type='text' value='0' id="+CBNameTXT+" onfocusout='SpotDiscounttxt(id);' onkeyup='return SpotDiscounttxtKeyDown(event,id);' onkeypress='return SpotDiscounttxtKeyPressSD(event,id);'  size='15' disabled>";
                            cell6.style.textAlign = "left";
                            cell6.style.width="500px";
                            cell6.style.align = "center";
                            if(InvoiceSelection.spotdiscountChkBox == "0"){
                                document.getElementById(CBName).checked = false;
                            }

                            cell7.innerHTML = InvoiceSelection.quantity;
                            cell7.style.textAlign = "left";
                            cell7.style.align = "center";
                            // cell7.style.padding = "35px";
                            cell7.style.width="60px";

                            cell8.innerHTML = "<button type='button' class='btn bg-teal btn-block btn-xs waves-effect' onclick='deleteRows(this)'><i class='material-icons'>delete</i></button>";
                            cell8.style.textAlign = "left";
                            cell8.style.align = "center";
                            // cell8.style.padding = "25px";
                            cell8.style.width="60px";
                        }
                        else
                        {
                            var r=0;
                            var txtinc=0;
                            var Amt = 0;
                            var Qty_Count = 0;
                            while(row=table.rows[r++])
                            {
                                if(r > 1)
                                {
                                    if(InvoiceSelection.itemname == row.cells[1].innerHTML)
                                    {
                                        var Amt_Pdt = parseFloat(InvoiceSelection.amount);
                                        row.cells[3].innerHTML = Amt_Pdt.toFixed(2);
                                        row.cells[6].innerHTML = InvoiceSelection.quantity;
                                        // alert(row.cells[3].innerText);
                                        // var checkBoxPD = row.cells[4].children[0];
                                        // alert(checkBoxPD.id);
                                        // // var rowcount=Number(r)-1;
                                        // // var CHBName="basic_cb1_"+rowcount;
                                        // // alert(CHBName);
                                        // document.getElementById(checkBoxPD).checked = true;
                                        // break;
                                    }
                                }
                            }
                        }
                    })

                        var r=0;
                        var txtinc=0;
                        var Amt = 0;
                        var Qty_Count = 0;

                        var table = document.getElementById("ItemTable");
                        while(row=table.rows[r++])
                        {
                            if(r > 1)
                            {
                                var Qty = row.cells[6].innerText;

                                var Amt_Pdt = parseFloat(Amt)+parseFloat(row.cells[3].innerText);
                                Amt = Amt_Pdt.toFixed(2);

                                Qty_Count = Number(Qty_Count)+Number(Qty);
                            }
                        }

                        var Pdt_Count = table.rows.length - 1;

                        $("#Ttl_Product").html(Pdt_Count);
                        $("#Ttl_Quantity").html(Qty_Count);
                        $("#Ttl_Amount").html("₹ "+parseFloat(Amt).toLocaleString());
                        $("#Ttl_AmountFinal").val(Amt);
                        SpotDiscounttxtKeyup_Overall();

                        document.getElementById("Final_Count").value ="";
                        document.getElementById("Quantity").value="";
                        document.getElementById("Quantity").disabled = true;

                        document.getElementById("ItemsList").value="";

                        $('#Barcodetxt').focus();
                        document.getElementById("Quantity").focus();
                    }
                });
            }
            else{
                document.getElementById("Quantity").focus();
            }
        }

        function UpdateItemsList(InvoiceNum) {
            var myTable = document.getElementById("ItemTable");
            var rowCount = myTable.rows.length;
                for (var x=rowCount-1; x>0; x--) {
                   myTable.deleteRow(x);
                }
                if (InvoiceNum=="") {
                    InvoiceNum = document.getElementById("InvoiceNo").innerHTML;
                }
                var url97 = '../ajaxInvoiceupdate';
                $.ajax({
                   type:'get',
                   url:url97,
                   data: {
                      '_token': $('input[name="_token"]').val(),
                      'invoiceNumber': InvoiceNum
                    },
                   success:function(data){
                    $.each(data, function(i, InvoiceSelection){
                        var k=0;
                        if (k == 0) {
                            $("#InvoiceDate").html(InvoiceSelection.invoicedate);
                            k=1;
                        };

                        var TableItems = ["0"];
                        var table = document.getElementById("ItemTable");
                        var rowCount = table.rows.length;
                        var r=1;
                        while(row=table.rows[r++])
                        {
                            if(r > 1)
                            {
                                var a = TableItems.indexOf(row.cells[1].innerText);
                                if(a == -1)
                                {
                                    TableItems.push(row.cells[1].innerText);
                                }
                            }
                        }

                        var ItemExist = TableItems.indexOf(InvoiceSelection.itemname);

                        if(ItemExist == -1)
                        {
                            var row = table.insertRow(rowCount);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            var cell4 = row.insertCell(3);
                            var cell5 = row.insertCell(4);
                            var cell6 = row.insertCell(5);
                            var cell7 = row.insertCell(6);
                            var cell8 = row.insertCell(7);

                            cell1.innerHTML = "";
                            cell1.style.textAlign = "left";
                            cell1.style.align = "center";
                            // cell1.style.padding = "35px";
                            cell1.style.width="40px";

                            cell2.innerHTML = InvoiceSelection.itemname;
                            cell2.style.textAlign = "left";
                            cell2.style.align = "center";
                            // cell2.style.padding = "35px";
                            cell2.style.width="250px";

                            cell3.innerHTML = InvoiceSelection.mrp;
                            cell3.style.textAlign = "left";
                            cell3.style.align = "center";
                            // cell3.style.padding = "35px";
                            cell3.style.width="200px";

                            var Amt_Pdt = parseFloat(InvoiceSelection.amount);
                            cell4.innerHTML =Amt_Pdt.toFixed(2);
                            cell4.style.textAlign = "left";
                            cell4.style.align = "center";
                            // cell4.style.padding = "35px";
                            cell4.style.width="100px";

                            var CHBName="basic_cb1_"+rowCount;
                            // cell5.innerHTML = "<div class='body'><input type='checkbox' onclick='ProductDiscountED(id)' id="+CHBName+" class='filled-in' checked /><label for="+CHBName+"> </label></div>";
                            cell5.innerHTML = "<input type='checkbox' onclick='ProductDiscountED(id)' id="+CHBName+" class='filled-in' checked /><label for="+CHBName+"> </label>";
                            cell5.style.textAlign = "center";
                            cell5.style.align = "center";
                            cell5.style.width="200px";
                            if(InvoiceSelection.discountChkBox == "0"){
                                document.getElementById(CHBName).checked = false;
                            }


                            var CBName="basic_cb2_"+rowCount;
                            var CBNamenm=CBName+"grp";
                            var CBNameRd1=CBName+"rd1";
                            var CBNameRd2=CBName+"rd2";
                            var CBNameTXT=CBName+"txt";
                            // cell6.innerHTML = "<div class='body'><input type='checkbox' onclick='SpotDiscountED(id);' id="+CBName+" class='filled-in' /><label for="+CBName+">&nbsp;&nbsp;</label><input name="+CBNamenm+" type='radio' id="+CBNameRd1+" class='with-gap radio-col-teal' value='fixed' disabled /><label for="+CBNameRd1+">$&nbsp;&nbsp;</label><input name="+CBNamenm+" type='radio' id="+CBNameRd2+" class='with-gap radio-col-teal' value='true' disabled /><label for="+CBNameRd2+">%&nbsp;&nbsp;</label><input type='text' value='0' id="+CBNameTXT+" onfocusout='SpotDiscounttxt(id);' onkeypress='return SpotDiscounttxtKeyPress(event,id);'  size='10' disabled></div>";
                            cell6.innerHTML = "<input type='checkbox' onclick='SpotDiscountED(id);' id="+CBName+" class='filled-in' /><label for="+CBName+">&nbsp;&nbsp;</label><input name="+CBNamenm+" type='radio' id="+CBNameRd1+" class='with-gap radio-col-teal' value='fixed' disabled /><label for="+CBNameRd1+">₹&nbsp;&nbsp;</label><input name="+CBNamenm+" type='radio' id="+CBNameRd2+" class='with-gap radio-col-teal' value='true' disabled /><label for="+CBNameRd2+">%&nbsp;&nbsp;</label><input type='text' value='0' id="+CBNameTXT+" onfocusout='SpotDiscounttxt(id);'  onkeyup='return SpotDiscounttxtKeyDown(event,id);'  onkeypress='return SpotDiscounttxtKeyPressSD(event,id);'  size='15' disabled>";
                            cell6.style.textAlign = "left";
                            cell6.style.align = "left";
                            cell6.style.width="500px";
                            if(InvoiceSelection.spotdiscountChkBox == "1"){
                                document.getElementById(CBName).checked = true;
                                document.getElementById(CBNameRd1).disabled = false;
                                document.getElementById(CBNameRd2).disabled = false;
                                document.getElementById(CBNameTXT).disabled = false;
                                if(InvoiceSelection.spotdiscountamount == "0")
                                {
                                    document.getElementById(CBNameRd2).checked = true;
                                    document.getElementById(CBNameTXT).value = InvoiceSelection.spotdiscountpercent;
                                }
                                else
                                {
                                    document.getElementById(CBNameRd1).checked = true;
                                    document.getElementById(CBNameTXT).value = InvoiceSelection.spotdiscountamount;
                                }
                            }

                            cell7.innerHTML = InvoiceSelection.quantity;
                            cell7.style.textAlign = "left";
                            cell7.style.align = "center";
                            // cell7.style.padding = "35px";
                            cell7.style.width="60px";

                            cell8.innerHTML = "<button type='button' class='btn bg-teal btn-block btn-xs waves-effect' onclick='deleteRows(this)'><i class='material-icons'>delete</i></button>";
                            cell8.style.textAlign = "left";
                            cell8.style.align = "center";
                            // cell8.style.padding = "25px";
                            cell8.style.width="60px";
                        }
                        else
                        {
                            var r=0;
                            var txtinc=0;
                            var Amt = 0;
                            var Qty_Count = 0;
                            while(row=table.rows[r++])
                            {
                                if(r > 1)
                                {
                                    if(InvoiceSelection.itemname == row.cells[1].innerHTML)
                                    {
                                        var Amt_Pdt = parseFloat(InvoiceSelection.amount);
                                        row.cells[3].innerHTML = Amt_Pdt.toFixed(2);
                                        row.cells[6].innerHTML = InvoiceSelection.quantity;
                                        // alert(row.cells[3].innerText);
                                        // var checkBoxPD = row.cells[4].children[0];
                                        // alert(checkBoxPD.id);
                                        // // var rowcount=Number(r)-1;
                                        // // var CHBName="basic_cb1_"+rowcount;
                                        // // alert(CHBName);
                                        // document.getElementById(checkBoxPD).checked = true;
                                        // break;
                                    }
                                }
                            }
                        }
                    })

                        var r=0;
                        var txtinc=0;
                        var Amt = 0;
                        var Qty_Count = 0;

                        var table = document.getElementById("ItemTable");
                        while(row=table.rows[r++])
                        {
                            if(r > 1)
                            {
                                var Qty = row.cells[6].innerText;

                                var Amt_Pdt = parseFloat(Amt)+parseFloat(row.cells[3].innerText);
                                Amt = Amt_Pdt.toFixed(2);

                                Qty_Count = Number(Qty_Count)+Number(Qty);
                            }
                        }

                        var Pdt_Count = table.rows.length - 1;
                        $("#Ttl_Product").html(Pdt_Count);
                        $("#Ttl_Quantity").html(Qty_Count);
                        $("#Ttl_Amount").html("₹ "+parseFloat(Amt).toLocaleString());
                         $("#Ttl_AmountFinal").val(Amt);
                        SpotDiscounttxtKeyup_Overall();
                        document.getElementById("Final_Count").value ="";
                        document.getElementById("Quantity").value="";
                        document.getElementById("Quantity").disabled = true;

                        document.getElementById("Quantity").focus();
                    }
                });
        }

        function ProductDiscountED(PDId){

            var i = PDId.replace("basic_cb1_", "");
            var Rowin= Number(i);
            var table = document.getElementById("ItemTable");
            var rowCount = table.rows.length;

            for (var x=0; x<rowCount; x++)
            {
                if(x == Rowin)
                {
                    row=table.rows[x]
                    var Item=row.cells[1].innerText;
                    var Barcode=row.cells[2].innerText;
                    var SDId = PDId.replace("basic_cb1_", "basic_cb2_");
                    var Quantity=row.cells[6].innerText;
                    var Amt=row.cells[3].innerText;
                    var CheckboxStatus="UnChecked";
                    var SDType="₹";
                    var RD1 = SDId+"rd1";
                    var RD2 = SDId+"rd2";
                    var TXT = SDId+"txt";
                    DiscountshowItemsList(Item,Barcode,Rowin,Quantity,PDId,SDId,Amt,RD1,RD2,TXT,CheckboxStatus,SDType);
                }
            }
        }

        function SpotDiscounttxtKeyup_Overall(){

            var TotalAmt=document.getElementById("Ttl_AmountFinal").value;
            var SpotD=document.getElementById("sd_Txt").value;
            if (document.getElementById("sd_Radiobutton1").checked == true) {
                if(+SpotD<+TotalAmt)
                {
                    var Amt= (TotalAmt-SpotD).toFixed(2);
                    $("#Ttl_Amount").html("₹ "+parseFloat(Amt).toLocaleString() );
                }
                else
                {
                    if(+TotalAmt!=0)
                    {
                        var TotalAmt=document.getElementById("Ttl_AmountFinal").value;
                        $("#Ttl_Amount").html("₹ "+parseFloat(TotalAmt).toLocaleString() );
                        alert("Discount Exceeds the TotalAmount");
                    }
                    $("#sd_Txt").val("");
                }
            }

            if (document.getElementById("sd_Radiobutton2").checked == true) {
                if(+SpotD<+101)
                {
                    var Amt = TotalAmt-((SpotD/100)*TotalAmt).toFixed(2);
                    Amt=Amt.toFixed(2);
                    $("#Ttl_Amount").html("₹ "+parseFloat(Amt).toLocaleString() );
                }
                else
                {
                    if(+TotalAmt!=0)
                    {
                        var TotalAmt=document.getElementById("Ttl_AmountFinal").value;
                        $("#Ttl_Amount").html("₹ "+parseFloat(TotalAmt).toLocaleString() );
                        alert("Discount Exceeds the TotalAmount");
                    }
                    $("#sd_Txt").val("");
                }
            }
        }


        function EmailValidation(id) {
            var x = document.getElementById(id).value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            var i=0;
            if(i==0)
            {
                i=1;
                if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                    alert("Not a valid e-mail address");
                    document.getElementById(id).value= "";
                }
            }
        }

        function SpotDiscountED(SDId){

            var RD1 = SDId+"rd1";
            var RD2 = SDId+"rd2";
            var TXT = SDId+"txt";

            if (document.getElementById(SDId).checked==true)
            {
                document.getElementById(RD1).disabled = false;
                document.getElementById(RD1).checked = true;
                document.getElementById(RD2).disabled = false;
                document.getElementById(TXT).disabled = false;
                document.getElementById(TXT).focus();
            }
            else
            {
                document.getElementById(RD1).disabled = true;
                document.getElementById(RD2).disabled = true;
                document.getElementById(TXT).disabled = true;
                var i = SDId.replace("basic_cb2_", "");
                var Rowin= Number(i);
                var table = document.getElementById("ItemTable");
                var rowCount = table.rows.length;
                for (var x=0; x<rowCount; x++)
                {
                    if(x == Rowin)
                    {
                        row=table.rows[x]
                        var Item=row.cells[1].innerText;
                        var Barcode=row.cells[2].innerText;
                        var Amt=row.cells[3].innerText;
                        var Quantity=row.cells[6].innerText;
                        var PDId = SDId.replace("basic_cb2_", "basic_cb1_");
                        var CheckboxStatus="UnChecked";
                        var SDType="₹";
                        DiscountshowItemsList(Item,Barcode,Rowin,Quantity,PDId,SDId,Amt,RD1,RD2,TXT,CheckboxStatus,SDType);
                    }
                }
            }
        }

        function SpotDiscounttxt(SDId){
            SDId=SDId.replace("txt", "");
            var RD1 = SDId+"rd1";
            var RD2 = SDId+"rd2";
            var TXT = SDId+"txt";

            var i = SDId.replace("basic_cb2_", "");
            var Rowin= Number(i);
            var table = document.getElementById("ItemTable");
            var rowCount = table.rows.length;
            for (var x=0; x<rowCount; x++)
            {
                if(x == Rowin)
                {
                    row=table.rows[x]
                    var Item=row.cells[1].innerText;
                    var Barcode=row.cells[2].innerText;
                    var Amt=row.cells[3].innerText;
                    var Quantity=row.cells[6].innerText;
                    var PDId = SDId.replace("basic_cb2_", "basic_cb1_");
                    var CheckboxStatus="Checked";
                    var SDType="₹";
                    DiscountshowItemsList(Item,Barcode,Rowin,Quantity,PDId,SDId,Amt,RD1,RD2,TXT,CheckboxStatus,SDType);
                }
            }
        }

        function DiscountshowItemsList(ItemsList,Barcodetxt,rowindex,Quantity,PDId,SDId,Amt,RD1,RD2,TXT,CheckboxStatus,SDType) {

            var InvoiceNum = document.getElementById("InvoiceNo").innerHTML;

            var invoiceDate = document.getElementById("InvoiceDate").innerHTML;

            var ItemsList_Text = document.getElementById("ItemsList").value;
            var Barcodetxt_Text = document.getElementById("Barcodetxt").value;

            var table = document.getElementById("ItemTable");

            var SDVal=document.getElementById(TXT).value;

            var productCheckboxStatus="Checked";
            var spotCheckboxStatus="Checked";

            var productdiscountChkBox="1";
            var spotdiscountChkBox="1";


                if (document.getElementById(PDId).checked == true) {
                    productCheckboxStatus="Checked";
                    productdiscountChkBox="1";
                }
                else{
                    productCheckboxStatus="UnChecked";
                    productdiscountChkBox="0";
                }

                if (document.getElementById(SDId).checked == true) {
                    spotCheckboxStatus="Checked";
                    spotdiscountChkBox="1";
                    if (document.getElementById(RD1).checked == true) {
                            SDType="₹";
                    }
                    else{
                        SDType="%";
                    }
                }
                else{

                    document.getElementById(TXT).value="0";
                    spotCheckboxStatus="UnChecked";
                    spotdiscountChkBox="0";
                    if (document.getElementById(RD1).checked == true) {
                            SDType="₹";
                    }
                    else{
                        SDType="%";
                    }
                }
                var IncChk=0;
                if(SDType == "₹")
                {
                    if(+Amt<+SDVal)
                    {
                       IncChk=1;
                    }
                }
                if(IncChk == 0){

                    if(Barcodetxt_Text != "")
                    {
                        Barcodetxt = Barcodetxt_Text;
                    }
                    if(ItemsList_Text != "")
                    {
                        ItemsList = ItemsList_Text;
                    }
                    var url96 = '../ajaxDiscount';
                        $.ajax({
                           type:'get',
                           url:url96,
                           data: {
                              '_token': $('input[name="_token"]').val(),
                              'invoiceNumber': InvoiceNum,
                              'invoiceDate':invoiceDate,
                              'amount' : Amt,
                              'SDType': SDType,
                              'SDVal': SDVal,
                              'ItemsList': ItemsList,
                              'discountChkBox': productdiscountChkBox,
                              'spotdiscountChkBox': spotdiscountChkBox,
                              'Barcodetxt': Barcodetxt,
                              'productCheckboxStatus': productCheckboxStatus,
                              'spotCheckboxStatus': spotCheckboxStatus,
                              'Quantity':Quantity
                            },
                           success:function(data){
                                var r=0;
                                var txtinc=0;
                                var Amt = 0;
                                var Qty_Count = 0;
                                while(row=table.rows[r++])
                                {
                                    if(r > 1)
                                    {
                                        var Qty=row.cells[6].innerText;
                                        if(r == rowindex+1)
                                        {
                                            var Amt_Pdt = parseFloat(data.Amt);
                                            row.cells[3].innerHTML =Amt_Pdt.toFixed(2);
                                        }

                                        var Amt_Pdt = parseFloat(Amt)+parseFloat(row.cells[3].innerText);
                                        Amt = Amt_Pdt.toFixed(2);

                                        Qty_Count = Number(Qty_Count)+Number(Qty);
                                    }
                                }



                                var Pdt_Count = table.rows.length - 1;
                                $("#Ttl_Product").html(Pdt_Count);
                                $("#Ttl_Quantity").html(Qty_Count);
                                $("#Ttl_Amount").html("₹ "+parseFloat(Amt).toLocaleString() );
                                 $("#Ttl_AmountFinal").val(Amt);
                                SpotDiscounttxtKeyup_Overall();
                                document.getElementById("Final_Count").value ="";
                                document.getElementById("Quantity").value="";
                                document.getElementById("Quantity").disabled = true;

                            }
                    });


                }

        }

        function DeleteshowItemsList(ItemsList,Barcodetxt,rowindex) {


            document.getElementById("ItemTable").deleteRow(rowindex);

            var InvoiceNum = document.getElementById("InvoiceNo").innerHTML;

            var invoiceDate = document.getElementById("InvoiceDate").innerHTML;

            var Quantity=0;

            // var table_len=(table.rows.length);

            var url95 = '../ajaxInvoicedelete';
            $.ajax({
                   type:'post',
                   url:url95,
                   data: {
                      '_token': $('input[name="_token"]').val(),
                      'invoiceNumber': InvoiceNum,
                      'invoiceDate':invoiceDate,
                      'ItemsList':ItemsList,
                      'Barcodetxt':Barcodetxt,
                      'Quantity':Quantity
                    },

                    success: function( msg ) {
                        if ( msg.status === 'success' )
                        {
                            var table = document.getElementById("ItemTable");


                                var r=0;
                                var txtinc=0;
                                var Amt = 0;
                                var Qty_Count = 0;
                                while(row=table.rows[r++])
                                {

                                    var Qty = row.cells[6].innerText;

                                    if(r > 1)
                                    {
                                        var Amt_Pdt = parseFloat(Amt)+parseFloat(row.cells[3].innerText);
                                        Amt = Amt_Pdt.toFixed(2);

                                        Qty_Count = Number(Qty_Count)+Number(Qty);
                                    }
                                }



                                var Pdt_Count = table.rows.length - 1;

                                $("#Ttl_Product").html(Pdt_Count);
                                $("#Ttl_Quantity").html(Qty_Count);
                                $("#Ttl_Amount").html("₹ "+parseFloat(Amt).toLocaleString() );
                                 $("#Ttl_AmountFinal").val(Amt);
                                SpotDiscounttxtKeyup_Overall();
                                document.getElementById("Final_Count").value ="";
                                document.getElementById("Quantity").value="";
                                document.getElementById("Quantity").disabled = true;
                        }
                    },
                    error: function( data ) {
                        if ( data.status === 422 ) {
                            toastr.error('Cannot delete the category');
                        }
                    }
            });
        }

        function ViewHeldSearch() {

            var InvoiceNumPick = document.getElementById("V_Inum").value;
            var ItemsListPick = document.getElementById("V_ItemsList").value;
            var GeneratedPick = document.getElementById("V_Generated").value;
            var FromDatePick = document.getElementById("V_fromdate").value;
            var ToDatePick = document.getElementById("V_todate").value;
            var Name = document.getElementById("V_Name").value;
            var Mobile = document.getElementById("V_Mobile").value;
            var TtlAmt = document.getElementById("V_TtlAmt").value;
            var Pincode = document.getElementById("V_Pincode").value;
            var Country = document.getElementById("V_Country").value;
            var State = document.getElementById("V_State").value;
            var District = document.getElementById("V_District").value;

            // alert(InvoiceNumPick);
            // alert(ItemsListPick);
            // alert(GeneratedPick);
            // alert(FromDatePick);
            // alert(ToDatePick);
            // alert(Name);
            // alert(Mobile);
            // alert(TtlAmt);
            // alert(Pincode);
            // alert(Country);
            // alert(State);
            // alert(District);

            if(FromDatePick == "")
            {
                FromDatePick = "02/10/1978";
            }

            if(ToDatePick == "")
            {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!

                var yyyy = today.getFullYear();
                if(dd<10){
                    dd='0'+dd;
                }
                if(mm<10){
                    mm='0'+mm;
                }
                ToDatePick = dd+'/'+mm+'/'+yyyy;
            }


            var table = document.getElementById("ItemTableview");
                 var rowCounts = table.rows.length;
                for (var x=rowCounts-1; x>0; x--)
                {
                    table.deleteRow(x);
                }
                var url99 = './ajaxViewheldSearch';

                $.ajax({
                           type:'get',
                           url:url99,
                           data:
                            {
                              '_token': $('input[name="_token"]').val(),
                              'InvoiceNumPick': InvoiceNumPick,
                              'ItemsListPick': ItemsListPick,
                              'GeneratedPick': GeneratedPick,
                              'FromDatePick': FromDatePick,
                              'ToDatePick': ToDatePick,
                              'Name': Name,
                              'Mobile': Mobile,
                              'TtlAmt': TtlAmt,
                              'Pincode': Pincode,
                              'Country': Country,
                              'State': State,
                              'District': District,
                            },

                        success:function(data)
                        {
                            $.each(data, function(i, InvoiceSelection)
                            {
                                var rowCount = table.rows.length;
                                var row = table.insertRow(rowCount);
                                var cell1 = row.insertCell(0);
                                var cell2 = row.insertCell(1);
                                var cell3 = row.insertCell(2);
                                var cell4 = row.insertCell(3);
                                var cell5 = row.insertCell(4);
                                var cell6 = row.insertCell(5);
                                var cell7 = row.insertCell(6);
                                var cell8 = row.insertCell(7);

                                cell1.innerHTML = "";
                                cell1.style.textAlign = "left";
                                cell1.style.align = "center";
                                // cell1.style.padding = "35px";
                                cell1.style.width="40px";

                                var elLink = document.createElement('a');
                                var href='./Receipt/'+InvoiceSelection.invoicenumber;
                                elLink.href = href;
                                elLink.setAttribute('target', '_blank');
                                elLink.innerHTML = InvoiceSelection.invoicenumber;
                                cell2.appendChild(elLink);
                                // cell2.innerHTML = '<a href="'+{!! url('/InVoiceFromHold', array('id' => InvoiceSelection.invoicenumber)); !!}+'" target="_blank" >'+{{InvoiceSelection.invoicenumber}}+'</a>';;
                                cell2.style.textAlign = "left";
                                cell2.style.align = "center";
                                // cell2.style.padding = "35px";
                                cell2.style.width="150px";

                                cell3.innerHTML = InvoiceSelection.name;
                                cell3.style.textAlign = "left";
                                cell3.style.align = "center";
                                // cell3.style.padding = "35px";
                                cell3.style.width="300px";

                                cell4.innerHTML = InvoiceSelection.mobile;
                                cell4.style.textAlign = "left";
                                cell4.style.align = "center";
                                // cell3.style.padding = "35px";
                                cell4.style.width="300px";

                                cell5.innerHTML = InvoiceSelection.invoicedate;
                                cell5.style.textAlign = "left";
                                cell5.style.align = "center";
                                // cell3.style.padding = "35px";
                                cell5.style.width="300px";

                                cell6.innerHTML = InvoiceSelection.itemname;
                                cell6.style.textAlign = "left";
                                cell6.style.align = "center";
                                // cell3.style.padding = "35px";
                                cell6.style.width="300px";

                                cell7.innerHTML =InvoiceSelection.totalquantity;
                                cell7.style.textAlign = "left";
                                cell7.style.align = "center";
                                // cell4.style.padding = "35px";
                                cell7.style.width="100px";

                                var Amt_Pdt = parseFloat(InvoiceSelection.totalamount);
                                cell8.innerHTML =Amt_Pdt.toFixed(2);
                                cell8.style.textAlign = "left";
                                cell8.style.align = "center";
                                // cell4.style.padding = "35px";
                                cell8.style.width="100px";
                            });
                        }
                    });

        }



        function PickHeldSearch() {

            var InvoiceNumPick = document.getElementById("P_Inum").value;
            var ItemsListPick = document.getElementById("P_ItemsList").value;
            var GeneratedPick = document.getElementById("P_Generated").value;
            var FromDatePick = document.getElementById("fromdate").value;
            var ToDatePick = document.getElementById("todate").value;

            if(FromDatePick == "")
            {
                FromDatePick = "02/10/1978";
            }

            if(ToDatePick == "")
            {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!

                var yyyy = today.getFullYear();
                if(dd<10){
                    dd='0'+dd;
                }
                if(mm<10){
                    mm='0'+mm;
                }
                ToDatePick = dd+'/'+mm+'/'+yyyy;
            }

            var table = document.getElementById("ItemTablepick");
                 var rowCounts = table.rows.length;
                for (var x=rowCounts-1; x>0; x--)
                {
                    table.deleteRow(x);
                }
                var url94 = './ajaxPickheldSearch';
                $.ajax({
                           type:'get',
                           url:url94,
                           data:
                            {
                              '_token': $('input[name="_token"]').val(),
                              'InvoiceNumPick': InvoiceNumPick,
                              'ItemsListPick': ItemsListPick,
                              'GeneratedPick': GeneratedPick,
                              'FromDatePick': FromDatePick,
                              'ToDatePick': ToDatePick,
                            },

                        success:function(data)
                        {
                            $.each(data, function(i, InvoiceSelection)
                            {
                                var rowCount = table.rows.length;
                                var row = table.insertRow(rowCount);
                                var cell1 = row.insertCell(0);
                                var cell2 = row.insertCell(1);
                                var cell3 = row.insertCell(2);
                                var cell4 = row.insertCell(3);
                                var cell5 = row.insertCell(4);

                                cell1.innerHTML = "";
                                cell1.style.textAlign = "left";
                                cell1.style.align = "center";
                                // cell1.style.padding = "35px";
                                cell1.style.width="40px";


                                var elLink = document.createElement('a');
                                var href='./InVoiceFromHold/'+InvoiceSelection.invoicenumber;
                                elLink.href = href;
                                elLink.setAttribute('target', '_blank');
                                elLink.innerHTML = InvoiceSelection.invoicenumber;
                                cell2.appendChild(elLink);
                                // cell2.innerHTML = '<a href="'+{!! url('/InVoiceFromHold', array('id' => InvoiceSelection.invoicenumber)); !!}+'" target="_blank" >'+{{InvoiceSelection.invoicenumber}}+'</a>';;
                                cell2.style.textAlign = "left";
                                cell2.style.align = "center";
                                // cell2.style.padding = "35px";
                                cell2.style.width="150px";

                                cell3.innerHTML = InvoiceSelection.itemname;
                                cell3.style.textAlign = "left";
                                cell3.style.align = "center";
                                // cell3.style.padding = "35px";
                                cell3.style.width="300px";

                                cell4.innerHTML =InvoiceSelection.quantity;
                                cell4.style.textAlign = "left";
                                cell4.style.align = "center";
                                // cell4.style.padding = "35px";
                                cell4.style.width="100px";

                                var Amt_Pdt = parseFloat(InvoiceSelection.amount);
                                cell5.innerHTML =Amt_Pdt.toFixed(2);
                                cell5.style.textAlign = "left";
                                cell5.style.align = "center";
                                // cell4.style.padding = "35px";
                                cell5.style.width="100px";
                            });
                        }
                    });

        }


        function SaveInVoice() {

            var Name = document.getElementById("UName").value;
            var Address1 = document.getElementById("Address1").value;
            var PinCode = document.getElementById("PinCode").value;

            if(Name == "")
            {
                alert("Please Enter the Name");
                $("#UName").focus();
            }
            else if(Address1 == "")
            {
                alert("Address Field cannot be Empty");
                $("#Address1").focus();
            }
            else if(PinCode == "")
            {
                alert("PinCode Field cannot be Empty");
                $("#PinCode").focus();
            }
            else
            {
                var WLoc=String(window.location);
                if(WLoc.search("/InVoiceFromHold/")!=-1)
                {
                    Loc = "Close";
                }
                else{
                    Loc = "";
                }
                var r = confirm("Do you want to Continue??");
                if (r == true)
                {

                    var InvoiceNum = document.getElementById("InvoiceNo").innerHTML.trim();

                    var invoiceDate = document.getElementById("InvoiceDate").innerHTML.trim();

                    var Ttl_Product = document.getElementById("Ttl_Product").innerHTML.trim();

                    var Ttl_Quantity = document.getElementById("Ttl_Quantity").innerHTML.trim();

                    var Ttl_AmountFinal = document.getElementById("Ttl_AmountFinal").value.trim();

                    var Ttl_Amount = document.getElementById("Ttl_Amount").innerHTML.replace("₹ ","");

                    var spotdiscountpercent = 0;

                    var spotdiscountamount = 0;

                    if (document.getElementById("sd_Radiobutton1").checked == true) {
                        if(document.getElementById("sd_Txt").value != ""){
                            spotdiscountpercent = document.getElementById("sd_Txt").value;
                        }
                    }

                    if (document.getElementById("sd_Radiobutton2").checked == true) {
                        if(document.getElementById("sd_Txt").value != ""){
                            spotdiscountamount = document.getElementById("sd_Txt").value;
                        }
                    }
                    var Salutation = "";
                    var Address2 = document.getElementById("Address2").value;
                    var Address3 = document.getElementById("Address3").value;
                    var Address4 = document.getElementById("Address4").value;
                    var District = document.getElementById("District").value;
                    var PinCode = document.getElementById("PinCode").value;
                    var State = document.getElementById("State").value;
                    var Country = document.getElementById("Country").value;
                    var Phone = "";
                    var Mobile1 = document.getElementById("Mob1").value;
                    var Mobile2 = "";
                    var EMail = document.getElementById("EMail").value;
                    var BDay = "";
                    var WDay = "";
                    var Occupation = "";
                    var NameofChurch = "";
                    var Language = "Tamil";
                    var AddressYear = new Date().getFullYear();
                    var Mode = "";
                    var Remarks = "";
                    var Status = "1";
                    var UUID=0;
                    if(document.getElementById("UUID").value != "")
                    {
                        UUID=document.getElementById("UUID").value;
                    }
                    var Gender="";
                    var url93 = '../ajaxInvoiceinsertAll';

                    $.ajax({
                           type:'get',
                           url:url93,
                           data: {
                              '_token': $('input[name="_token"]').val(),
                              'UUID': UUID,
                              'invoiceNumber': InvoiceNum,
                              'invoiceDate':invoiceDate,
                              'Salutation': Salutation,
                                'Name': Name,
                                'Ttl_AmountFinal':   Ttl_AmountFinal,
                                'Ttl_Amount':   Ttl_Amount,
                                'Ttl_Product':   Ttl_Product,
                                'Ttl_Quantity':   Ttl_Quantity,
                                'spotdiscountpercent':   spotdiscountpercent,
                                'spotdiscountamount':   spotdiscountamount,
                                'Gender':   Gender,
                                'Address1': Address1,
                                'Address2': Address2,
                                'Address3': Address3,
                                'Address4': Address4,
                                'District': District,
                                'PinCode':  PinCode,
                                'State':    State,
                                'Country':  Country,
                                'Phone':    Phone,
                                'Mobile1':  Mobile1,
                                'Mobile2':  Mobile2,
                                'EMail':    EMail,
                                'BDay': BDay,
                                'WDay': WDay,
                                'Occupation':   Occupation,
                                'NameofChurch': NameofChurch,
                                'Language': Language,
                                'AddressYear':  AddressYear,
                                'Mode': Mode,
                                'Remarks':  Remarks,
                                'Status':   Status,
                                'WinLoc'   : Loc
                            },

                            success: function( msg )
                            {
                                if(WLoc.search("/InVoiceFromHold/") <= -1)
                                {
                                    $.each(msg, function(i, ItemSel){
                                        Inum=msg.INumber;
                                        var locinc=0;
                                        if(locinc == 0)
                                        {
                                          locinc=1;
                                          window.location = "../InVoice/" + Inum;
                                        }
                                     });
                                }
                                else
                                {
                                  window.opener.location.reload()
                                  window.close();
                                }
                            }
                        });
                        window.open('../Receipt/'+ InvoiceNum.replace(/ /g,""),'_blank');
                }
            }

        }

        function HoldInVoice() {

            var myTable = document.getElementById("ItemTable");
            var rowCount = myTable.rows.length;
                for (var x=rowCount-1; x>0; x--) {
                   myTable.deleteRow(x);
                }

            var invoiceDate = document.getElementById("InvoiceDate").innerHTML;
            var url92 = '../ajaxHoldInVoice';
                $.ajax({
                    type:'get',
                    url:url92,
                    data: {
                      '_token': $('input[name="_token"]').val(),
                      'invoiceDate':invoiceDate
                    },
                    success:function(msg)
                    {
                        $.each(msg, function(i, ItemSel){
                            Inum=msg.INumber;
                            var locinc=0;
                            if(locinc == 0)
                            {
                                locinc=1;
                                var WLoc=String(window.location);
                                if(WLoc.search("/InVoice/")!=-1)
                                {
                                  window.location = "../InVoice/" + Inum;
                                }
                                else{
                                  window.location = "./InVoice/" + Inum;
                                }
                                if(WLoc.search("/InVoiceFromHold/")!=-1)
                                {
                                    window.close();
                                }
                            }
                        });
                   }
                });
        }

        function CancelInVoice() {

            var myTable = document.getElementById("ItemTable");
            var rowCount = myTable.rows.length;
                for (var x=rowCount-1; x>0; x--) {
                   myTable.deleteRow(x);
                }

            var InvoiceNum = document.getElementById("InvoiceNo").innerHTML;

            var invoiceDate = document.getElementById("InvoiceDate").innerHTML;

            var Quantity=0;

            // var table_len=(table.rows.length);
            var url91 = '../ajaxInvoicedeleteAll';
            $.ajax({
                   type:'post',
                   url:url91,
                   data: {
                      '_token': $('input[name="_token"]').val(),
                      'invoiceNumber': InvoiceNum,
                      'invoiceDate':invoiceDate
                    },

                    success: function(msg)
                    {
                      var WLoc=String(window.location);
                      if(WLoc.search("/InVoiceFromHold/")!=-1)
                      {
                          window.opener.location.reload()
                          window.close();
                      }
                      else {
                        $.each(msg, function(i, ItemSel){
                                $("#Ttl_Product").html("0");
                                $("#Ttl_Quantity").html("0");
                                $("#Ttl_Amount").html("₹ 0");
                                $("#Ttl_AmountFinal").val("0");
                                // $("#InvoiceNo").html(msg.INumber);
                                $("#Barcodetxt").focus();
                             });
                      }
                    }
            });
        }

        function AddressSelection(Mobile){
            //==== Delete Rows

            var table = document.getElementById("ItemTable");
            var rowCount = table.rows.length;
            if(rowCount > 1)
            {
                if(Mobile != "")
                {
                  var url90 = '../ajaxGetAddress';
                    $.ajax({
                           type:'get',
                           url:url90,
                           data:
                            {
                              '_token': $('input[name="_token"]').val(),
                              'Mobile': Mobile
                            },

                           success:function(InvoiceSelection)
                           {
                                $('#UUID').val(InvoiceSelection.id);
                                $('#UName').val(InvoiceSelection.name);
                                $('#Address1').val(InvoiceSelection.address1);
                                $('#Address2').val(InvoiceSelection.address2);
                                $('#Address3').val(InvoiceSelection.address3);
                                $('#Address4').val(InvoiceSelection.address4);
                                $('#PinCode').val(InvoiceSelection.pincode);

                                var x = document.getElementById("Country");
                                var i;
                                for (i = 0; i < x.length; i++) {
                                    if(x.options[i].text == InvoiceSelection.country)
                                    {
                                        document.getElementById("Country").selectedIndex = x.options[i].index;
                                    }
                                }

                                var url1 = '../state';
                                $.ajax({
                                   url: url1,
                                   data: {country:InvoiceSelection.country},
                                   type: 'get',
                                   success:function(data)
                                   {
                                     $('#State').empty();
                                     var n=data.length;
                                     for(var i=0;i<n-1;i++)
                                     {
                                        $('#State').append($('<option></option>').html(data[i]));
                                        if((data[i]) == InvoiceSelection.state)
                                        {

                                            document.getElementById("State").selectedIndex = i;
                                        }
                                     }
                                   },
                                });

                                var url2 = '../district';
                                $.ajax ({
                                   url: url2,
                                   data: {state:InvoiceSelection.state},
                                   type: 'get',
                                   success:function(data)
                                   {
                                     $('#District').empty();
                                     var n=data.length;
                                     for(var i=0;i<=n-1;i++)
                                     {
                                        $('#District').append($('<option></option>').html(data[i]));
                                        if((data[i]) == InvoiceSelection.district)
                                        {
                                            document.getElementById("District").selectedIndex = i;
                                        }
                                       // $('#District').append("<option>" + data[i] + "</option>");
                                     }
                                   },
                                });

                                // $('#State').val(InvoiceSelection.state);
                                // var y = document.getElementById("State");
                                // var j;
                                // for (j = 0; j < y.length; j++) {
                                //     if(y.options[j].text == InvoiceSelection.state)
                                //     {
                                //         alert(y.options[j].index);
                                //         document.getElementById("State").selectedIndex = y.options[j].index;
                                //     }
                                // }
                                // // $('#Country').val(InvoiceSelection.country);
                                // // alert(InvoiceSelection.state);
                                // // alert(InvoiceSelection.district);
                                // $('#District').val(InvoiceSelection.district);
                                $('#Mob1').val(InvoiceSelection.mobile1);
                                $('#EMail').val(InvoiceSelection.email);
                                $('#BirthDay').val(InvoiceSelection.bday);
                                $('#WeddingDay').val(InvoiceSelection.wday);
                                $('#Church').val(InvoiceSelection.nameofchurch);
                                $('#Occupation').val(InvoiceSelection.occupation);

                                //==========================================

                                if ($('#Mob1').val() == "")
                                {
                                    $('#Mob1').val(Mobile);
                                }
                            }
                    });
                }
            }
        }

        function InvoiceNum(){

            var Inum="";
            var WLoc=String(window.location);
            var url89 = '';
            if(WLoc.search("/InVoice/")!=-1)
            {
              url89 = '../ajaxInvoiceNextval';
            }
            else{
              url89 = './ajaxInvoiceNextval';
            }
                $.ajax({
                   type:'GET',
                   url:url89,
                   data: {
                      '_token': $('input[name="_token"]').val()
                    },
                   success:function(data)
                   {
                        Inum=data.INumber;
                        if(WLoc.search("/InVoice/")!=-1)
                        {
                          window.location = "../InVoice/" + Inum;
                        }
                        else{
                          window.location = "./InVoice/" + Inum;
                        }
                   }
                });
        }

        function deleteRows(r) {

            //==== Delete Rows

            var i = r.parentNode.parentNode.rowIndex;
            var table = document.getElementById("ItemTable");
            var rowCount = table.rows.length;
            for (var x=0; x<rowCount; x++)
            {
                if(x == i)
                {
                    row=table.rows[x]
                    var Item=row.cells[1].innerText;
                    var Barcode=row.cells[2].innerText;
                    DeleteshowItemsList(Item,Barcode,i);
                }
            }
        }
        //=======================================================================


        //=======================================================================

        $('document').ready(function(){
        //=======================================================================

            var InvoiceNo = document.getElementById("InvoiceNo").innerHTML;
            InvoiceNo = InvoiceNo.replace(/ /g,"");
            var Loc=String(window.location);
            if(Loc.search("/InVoiceFromHold/")!=-1)
            {
                UpdateItemsList(InvoiceNo);
            }
            else{

              UpdateItemsList(InvoiceNo);
            }

            $("#Quantity").keydown(function(e){
                if(e.keyCode == 9)
                {
                    return false;
                }
            });


            $("#Mobile").keydown(function(e){
                var Val= $('#Mobile').val();
                if(Val != "")
                {
                    if(e.keyCode == 9)
                    {
                        AddressSelection(Val);
                    }
                    if(e.keyCode == 13)
                    {
                        AddressSelection(Val);
                    }
                }
            });


            $("#ItemsList").keydown(function(e){
                var Val= $('#ItemsList').val();
                if(Val != "")
                {
                    if(e.keyCode == 9)
                    {
                        $('#ItemsList').disabled=false;
                        $('#ItemsList').value="";
                        $('#ItemsList').focus();
                    }
                    if(e.keyCode == 13)
                    {
                        $('#ItemsList').disabled=false;
                        $('#ItemsList').value="";
                        $('#ItemsList').focus();
                    }
                }
            });

            $("#sd_Txt").change(function(){
                SpotDiscounttxtKeyup_Overall();
            });



            $("#Barcodetxt").keydown(function(e){
                var Val= $('#Barcodetxt').val();
                if(Val != "")
                {
                    if(e.keyCode == 9)
                    {
                        $('#ItemsList').disabled=false;
                        $('#ItemsList').value="";
                        $('#ItemsList').focus();
                    }
                    if(e.keyCode == 13)
                    {
                        $('#ItemsList').disabled=false;
                        $('#ItemsList').value="";
                        $('#ItemsList').focus();
                    }
                }
            });

            $("#Country").focusout(function(){
                var country=$('#Country').val();
                // alert(country);
                var url1 = '../state';
                $.ajax({
                   url: url1,
                   data: {country:country},
                   type: 'get',
                   success:function(data)
                   {
                     var n=data.length;
                     for(var i=0;i<n-1;i++)
                     {
                       $('#State').append($('<option></option>').html(data[i]));
                     }
                   },
                });
            });

            $("#Country").change(function(){
                var country=$('#Country').val();
                // alert(country);
                var url1 = '../state';
                $.ajax({
                   url: url1,
                   data: {country:country},
                   type: 'get',
                   success:function(data)
                   {
                     var n=data.length;
                     for(var i=0;i<n-1;i++)
                     {
                       $('#State').append($('<option></option>').html(data[i]));
                     }
                   },
                });
            });

            $("#State").focusout(function(){
                // var country=$('#Country').val();
                var state=$('#State').val();
                var url2 = '../district';
                $.ajax ({
                   url: url2,
                   data: {state:state},
                   type: 'get',
                   success:function(data)
                   {
                     $('#District').empty();
                     var n=data.length;
                     for(var i=0;i<=n-1;i++)
                     {
                       $('#District').append("<option>" + data[i] + "</option>");
                     }
                   },
                });
            });

        //=======================================================================

            $("#State").change(function(){
                // var country=$('#Country').val();
                var state=$('#State').val();
                var url2 = '../district';
                $.ajax ({
                   url: url2,
                   data: {state:state},
                   type: 'get',
                   success:function(data)
                   {
                     $('#District').empty();
                     var n=data.length;
                     for(var i=0;i<=n-1;i++)
                     {
                       $('#District').append("<option>" + data[i] + "</option>");
                     }
                   },
                });
            });

        //=======================================================================

            // Get Next Invoice Number from Database

            //     $.ajax({
            //        type:'GET',
            //        url:'/ajaxInvoiceNextval',
            //        data: {
            //           '_token': $('input[name="_token"]').val()
            //         },
            //        success:function(data)
            //        {
            //           $("#InvoiceNo").html(data.INumber);
            //           $("#UserTotal").html(data.TotalQty);
            //           $("#UserAmt").html("₹ "+data.Totalamt);
            //           $("#InvoiceDate").html(data.InvoiceDate);
            //        }
            //     });

        //=======================================================================

        $(document).keydown(function(e){
            if(Loc.search("/InVoice/")>-1 || Loc.search("/InVoiceFromHold/")>-1)
            {
                if(e.keyCode == 119)
                {
                    SaveInVoice();
                }
                if(e.keyCode == 115)
                {
                    CancelInVoice();
                }
                if(e.keyCode == 117)
                {
                    HoldInVoice();
                }
            }
        });



        //=======================================================================

        });


    $('#Barcodetxt').focus();
