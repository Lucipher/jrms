<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Invoice;
use App\StockLocation;
use App\Address;
use App\CountryDetails;
use Session;
use Auth;
use Response;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('Sales.Sales');
    }

    public function state(Request $request)
    {
        try
        {
            $countryselection = DB::table('country')->distinct()->pluck('state')->where('country', $request->input('Country'));
            return response()->json($countryselection);

        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

    }
    public function district(Request $request)
    {
        try
        {
          $state=$request->state;
          //$districtselection = DB::table('country')->distinct()->where('state', $request->input('State'))->get();
          $districtselection = CountryDetails::distinct()->where('state',$state)->pluck('district');
          //echo $districtselection;
          //echo $districtselection;
          return response()->json($districtselection);
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

    }

    public function QuantityFinal(Request $request){
        $user = Auth::user();

        $stockQty = DB::table('addstock')
                ->where('barcode', $request->Barcodetxt)
                ->orWhere('product_name', $request->ItemsList)
                ->where('location', $user->branch)
                ->first();

        return response()->json(array('Quantity' => $stockQty->quantity ,'Barcode' => $stockQty->barcode,'ItemName' => $stockQty->product_name));
    }

    public function InvoiceNumber()
    {
        $value = Session::get('InvoiceNumber');
        if($value == "")
        {
            $InvoiceNumber = DB::select("select to_char(Current_Date, 'ddmmYY')||nextval('invoicenumber') nextval");
            $value =intval($InvoiceNumber['0']->nextval);
            Session::put('InvoiceNumber',intval($InvoiceNumber['0']->nextval));
        }
        return response(['INumber' => $value]);
    }

    public function HoldInVoice(Request $request){
        $user = Auth::user();
        Session::forget('InvoiceNumber');

            $InvoiceNumber = DB::select("select to_char(Current_Date, 'ddmmYY')||nextval('invoicenumber') nextval");

            Session::put('InvoiceNumber',intval($InvoiceNumber['0']->nextval));


            $selectTotal = DB::table('hdpos_receipt')
                     ->select(DB::raw('count(createdby) as totalqty,SUM(CAST(totalamount AS float8)) as totalamt'))
                     ->where('createdby', '=', $user->name)
                     ->where('invoicedate', '=',$request->invoiceDate)
                     ->first();

            // return response()->json(array('INumber' => intval($InvoiceNumber['0']->nextval)));


            return response()->json(array('INumber' => intval($InvoiceNumber['0']->nextval),'TotalQty' => $selectTotal->totalqty ,'Totalamt' => $selectTotal->totalamt,'InvoiceDate' => $request->invoiceDate));
    }

    public function InvoiceUpdate(Request $request) {

        // $Invoice = new Invoice;
        try
        {
            $InvoiceSelections = DB::table('hdpos_invoice')
                ->leftJoin('items', DB::raw('hdpos_invoice.itemid::integer'), '=', 'items.id' )
                ->where('invoicenumber', (string)$request->invoiceNumber)
                ->select('items.id','items.bnumber','hdpos_invoice.spotdiscountchkbox','hdpos_invoice.discountchkbox','items.itemname','items.openstock','items.minstock','items.isactive','items.notforsale','items.ispurchased','items.online','items.categoryname','items.subcategoryname','items.desc','items.featured_image','items.mrp','items.disc1','items.disc2','items.discvalue','items.finalprice','items.createdby','items.modifiedby','items.created_at','items.updated_at','hdpos_invoice.id','hdpos_invoice.invoicenumber','hdpos_invoice.itemid','hdpos_invoice.amount','hdpos_invoice.quantity','hdpos_invoice.discount','hdpos_invoice.spotdiscountpercent','hdpos_invoice.spotdiscountamount','hdpos_invoice.status','hdpos_invoice.createdby','hdpos_invoice.modifiedby','hdpos_invoice.created_at','hdpos_invoice.updated_at','hdpos_invoice.invoicedate')
                ->orderBy('items.id', 'DESC')
                ->get();

            return response()->json($InvoiceSelections);
        }
        catch(\Exception $Exe)
        {
            return $Exe-> getMessage();
        }
    }


    public function InvoiceInsert(Request $request) {

            $user = Auth::user();

            // $Invoice = new Invoice;
            try
            {
                $ItemDetails = DB::table('items')->where('bnumber', $request->input('Barcodetxt'))->orWhere('itemname', $request->input('ItemsList'))->first();

                $stockQty = DB::table('addstock')
                ->where('product_name', $ItemDetails->itemname)
                ->where('location', $user->branch)
                ->first();

                $Amt= ((float)$ItemDetails->mrp  * (float)$request->Quantity);

                if ($request->CheckboxStatusdiscount == "Checked")
                {
                    $Amt= (((float)$ItemDetails->mrp - (float)$ItemDetails->discvalue) * (float)$request->Quantity);
                }

                if ($request->CheckboxStatusspotdiscount == "Checked")
                {
                    $Amt= (((float)$ItemDetails->mrp - (float)$ItemDetails->discvalue) * (float)$request->Quantity);
                }

                if($request->Quantity <= $stockQty->quantity)
                {
                    $Invoice = Invoice::updateOrCreate(
                        [
                        'invoicenumber' => $request->invoiceNumber,
                        'invoicedate' => $request->invoiceDate,
                        'itemid' => $ItemDetails->id,
                        'discount' => $ItemDetails->discvalue,
                        'status' => 'Hold'
                        ],

                        [
                        'discountchkbox' => $request->discountChkBox,
                        'spotdiscountchkbox' => $request->spotdiscountChkBox,
                        'spotdiscountpercent' => $request->spotdiscountpercent,
                        'spotdiscountamount' => $request->spotdiscountamount,
                        'amount' => $Amt,
                        'quantity' => $request->Quantity,
                        'createdby' => $user->name,
                        'modifiedby' => $user->name
                        ]
                    );
                }

                $ULocation = $user->branch;

                $selectReceipts = DB::table('hdpos_invoice')
                    ->leftJoin('items', DB::raw('hdpos_invoice.itemid::integer'), '=', 'items.id' )
                    ->where('invoicenumber', (string)$request->invoiceNumber)
                    ->select('items.id','items.bnumber','hdpos_invoice.spotdiscountchkbox','hdpos_invoice.discountchkbox','items.itemname','items.openstock','items.minstock','items.isactive','items.notforsale','items.ispurchased','items.online','items.categoryname','items.subcategoryname','items.desc','items.featured_image','items.mrp','items.disc1','items.disc2','items.discvalue','items.finalprice','items.createdby','items.modifiedby','items.created_at','items.updated_at','hdpos_invoice.id','hdpos_invoice.invoicenumber','hdpos_invoice.itemid','hdpos_invoice.amount','hdpos_invoice.quantity','hdpos_invoice.discount','hdpos_invoice.spotdiscountpercent','hdpos_invoice.spotdiscountamount','hdpos_invoice.status','hdpos_invoice.createdby','hdpos_invoice.modifiedby','hdpos_invoice.created_at','hdpos_invoice.updated_at','hdpos_invoice.invoicedate')
                    ->orderBy('items.id', 'DESC')
                    ->get();


                foreach($selectReceipts as $selectReceipt)
                {
                    $updatestock=DB::table('addstock')
                        ->where('product_name', $selectReceipt->itemname)
                        ->Where('location', $ULocation)
                        ->decrement('quantity',$selectReceipt->quantity);
                }


                // $InvoiceSelections = DB::table('hdpos_invoice')->where('invoiceNumber', $request->invoiceNumber)->get();

                $InvoiceSelections = DB::table('hdpos_invoice')
                    ->leftJoin('items', DB::raw('hdpos_invoice.itemid::integer'), '=', 'items.id' )
                    ->where('invoicenumber', (string)$request->invoiceNumber)
                    ->select('items.id','items.bnumber','hdpos_invoice.spotdiscountchkbox','hdpos_invoice.discountchkbox','items.itemname','items.openstock','items.minstock','items.isactive','items.notforsale','items.ispurchased','items.online','items.categoryname','items.subcategoryname','items.desc','items.featured_image','items.mrp','items.disc1','items.disc2','items.discvalue','items.finalprice','items.createdby','items.modifiedby','items.created_at','items.updated_at','hdpos_invoice.id','hdpos_invoice.invoicenumber','hdpos_invoice.itemid','hdpos_invoice.amount','hdpos_invoice.quantity','hdpos_invoice.discount','hdpos_invoice.spotdiscountpercent','hdpos_invoice.spotdiscountamount','hdpos_invoice.status','hdpos_invoice.createdby','hdpos_invoice.modifiedby','hdpos_invoice.created_at','hdpos_invoice.updated_at','hdpos_invoice.invoicedate')
                    ->orderBy('items.id', 'DESC')
                    ->get();

                return response()->json($InvoiceSelections);

            }
            catch(\Exception $Exe)
            {
                return $Exe-> getMessage();
            }
        }


    public function GetAddress(Request $request) {

        // $Invoice = new Invoice;
        try
        {
            $InvoiceSelection = DB::table('address')
            ->where('phone', $request->input('Mobile'))
            ->orwhere('mobile1', $request->input('Mobile'))
            ->orWhere('mobile2', $request->input('Mobile'))
            ->first();

            return response()->json($InvoiceSelection);
        }
        catch(\Exception $Exe)
        {
            return $Exe-> getMessage();
        }
    }


    public function ReceiptInsert(Request $request) {

        $user = Auth::user();

        // $Invoice = new Invoice;
        try
        {
            // $ULocation = "Nalumavadi";
            $Address = Address::updateOrCreate(
                [
                    'id' => $request->UUID
                ],

                [
                 'salutation' => $request->Salutation,
                 'name' => $request->Name,
                 'gender' => $request->Gender,
                 'address1' => $request->Address1,
                 'address2' => $request->Address2,
                 'address3' => $request->Address3,
                 'address4' => $request->Address4,
                 'district' => $request->District,
                 'pincode' => $request->PinCode,
                 'state' => $request->State,
                 'country' => $request->Country,
                 'phone' => $request->Phone,
                 'mobile1' => $request->Mobile1,
                 'mobile2' => $request->Mobile2,
                 'email' => $request->EMail,
                 'bday' => $request->BDay,
                 'wday' => $request->WDay,
                 'occupation' => $request->Occupation,
                 'nameofchurch' => $request->NameofChurch,
                 'language' => $request->Language,
                 'addressyear' => $request->AddressYear,
                 'mode' => $request->Mode,
                 'remarks' => $request->Remarks,
                 'status' => $request->Status,
                 'createdby' => $user->name,
                 'modifiedby' => $user->name
                ]
            );

            $UserUId = DB::table('address')
            ->where('name', $request->Name)
            ->Where('address1', $request->Address1)->Where('district', $request->District)
            ->Where('address2', $request->Address2)->Where('pincode', $request->PinCode)
            ->Where('address3', $request->Address3)->Where('state', $request->State)
            ->Where('address4', $request->Address4)->Where('country', $request->Country)
            ->first();


        DB::table('hdpos_receipt')->insert(
            [
                'userid' => $UserUId->id,
                'invoicenumber' => $request->invoiceNumber,
                'invoicedate' => $request->invoiceDate,
                'totalproduct' => $request->Ttl_Product,
                'totalquantity' => $request->Ttl_Quantity,
                'amount' => $request->Ttl_Amount,
                'spotdiscountpercent' => $request->spotdiscountpercent,
                'spotdiscountamount' => $request->spotdiscountamount,
                'totalamount' => $request->Ttl_AmountFinal,
                'status' => 'Printed',
                'createdby' => $user->name,
                'modifiedby' => '',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );


            $ReceiptId = DB::table('hdpos_receipt')
            ->where('userid', $UserUId->id)
            ->Where('invoicenumber', $request->invoiceNumber)->Where('invoicedate', $request->invoiceDate)
            ->Where('totalproduct', $request->Ttl_Product)->Where('totalquantity', $request->Ttl_Quantity)
            ->Where('amount', $request->Ttl_Amount)->Where('spotdiscountpercent', $request->spotdiscountpercent)
            ->Where('totalamount', $request->Ttl_AmountFinal)->Where('spotdiscountamount', $request->spotdiscountamount)
            ->first();


            $insertReceiptItems=DB::insert("INSERT INTO hdpos_receiptitems
                (receiptid, itemid, amount,quantity,discount,discountchkbox,spotdiscountchkbox,spotdiscountpercent,spotdiscountamount,created_at,updated_at)
                SELECT '$ReceiptId->id',itemid,amount,quantity,discount,discountchkbox,spotdiscountchkbox,spotdiscountpercent,spotdiscountamount,created_at,updated_at
                FROM hdpos_invoice  WHERE invoicenumber='$request->invoiceNumber' ");


            $Update_Invoice=DB::update("UPDATE hdpos_invoice SET status = 'Finished' WHERE invoicenumber='$request->invoiceNumber' ");

            $Inum = $request->invoiceNumber;
            $Tamt = 0;
            $TQty = 0;
            $Idate = 0;

            if($request->WinLoc == "")
            {
                Session::forget('InvoiceNumber');
                $InvoiceNumber = DB::select("select to_char(Current_Date, 'ddmmYY')||nextval('invoicenumber') nextval");

                Session::put('InvoiceNumber',intval($InvoiceNumber['0']->nextval));

                $Invoicedate = DB::select("select to_char(Current_Date, 'dd/mm/YYYY') as date");
                $Idate = $Invoicedate['0']->date;
                $Inum = intval($InvoiceNumber['0']->nextval);
                // $selectTotal = DB::select("select count(createdby) as totalqty,SUM(CAST(totalamount AS float8)) as totalamt from hdpos_receipt where createdby = '$user->name' and invoicedate = '$request->invoiceDate' group by createdby limit 1");


                $selectTotal = DB::table('hdpos_receipt')
                         ->select(DB::raw('count(createdby) as totalqty,SUM(CAST(totalamount AS float8)) as totalamt'))
                         ->where('createdby', '=', $user->name)
                         ->where('invoicedate', '=',$request->invoiceDate)
                         ->groupBy('createdby')
                         ->first();


                if(intval($selectTotal->totalqty) > 0)
                {
                    $Tamt = $selectTotal->totalamt;
                    $TQty = $selectTotal->totalqty;
                }
                else
                {
                    $Tamt = 0;
                    $TQty = 0;
                }

            }

            // return response()->json(array('INumber' => intval($InvoiceNumber['0']->nextval)));


            return response()->json(array('INumber' => $Inum,'TotalQty' => $TQty ,'Totalamt' => $Tamt,'InvoiceDate' => $Idate));

        }
        catch(\Exception $Exe)
        {
            return $Exe-> getMessage();
        }
    }

    public function InvoiceDiscount(Request $request){

        $user = Auth::user();

        try
        {
            $ItemDetails = DB::table('items')->where('bnumber', $request->input('Barcodetxt'))->orWhere('itemname', $request->input('ItemsList'))->first();

            $Amt= ((float)$ItemDetails->mrp  * (float)$request->Quantity);

            $spotdiscountpercent = "0";
            $spotdiscountamount = "0";
            $SDValue= $request->SDVal;

            if ($request->productCheckboxStatus == "Checked")
            {
                $Amt= (((float)$ItemDetails->mrp - (float)$ItemDetails->discvalue) * (float)$request->Quantity);
            }

            if ($request->spotCheckboxStatus == "Checked")
            {
                if($request->SDType == "₹")
                {
                    $spotdiscountamount = $SDValue;
                    $Amt= ($Amt-$SDValue);
                }
                else
                {
                    $spotdiscountpercent = $SDValue;
                    $Amt= $Amt-(($SDValue/100)*$Amt);
                }
            }


            $Invoice = Invoice::updateOrCreate(
                [

                'invoicenumber' => $request->invoiceNumber,
                'invoicedate' => $request->invoiceDate,
                'itemid' => $ItemDetails->id,
                'status' => 'Hold'
                ],

                [
                'discount' => $ItemDetails->discvalue,
                'discountchkbox' => $request->discountChkBox,
                'spotdiscountpercent' => $spotdiscountpercent,
                'spotdiscountamount' => $spotdiscountamount,
                'spotdiscountchkbox' => $request->spotdiscountChkBox,
                'amount' => (string)$Amt,
                'quantity' => $request->Quantity,
                 'createdby' => $user->name,
                 'modifiedby' => $user->name
                ]
            );

            return response(['Amt' => $Amt]);
        }
        catch(\Exception $Exe)
        {
            return $Exe-> getMessage();
        }
    }

    public function Invoicedelete(Request $request) {

        $user = Auth::user();

        try
        {
            $ItemDetails = DB::table('items')->where('bnumber', $request->input('Barcodetxt'))->orWhere('itemname', $request->input('ItemsList'))->first();

                $ULocation = $user->branch;

                $selectReceipts = DB::table('hdpos_invoice')
                    ->leftJoin('items', DB::raw('hdpos_invoice.itemid::integer'), '=', 'items.id' )
                    ->where('invoicenumber', (string)$request->invoiceNumber)
                    ->where('itemid', (string)$ItemDetails->id)
                    ->select('items.id','items.bnumber','hdpos_invoice.spotdiscountchkbox','hdpos_invoice.discountchkbox','items.itemname','items.openstock','items.minstock','items.isactive','items.notforsale','items.ispurchased','items.online','items.categoryname','items.subcategoryname','items.desc','items.featured_image','items.mrp','items.disc1','items.disc2','items.discvalue','items.finalprice','items.createdby','items.modifiedby','items.created_at','items.updated_at','hdpos_invoice.id','hdpos_invoice.invoicenumber','hdpos_invoice.itemid','hdpos_invoice.amount','hdpos_invoice.quantity','hdpos_invoice.discount','hdpos_invoice.spotdiscountpercent','hdpos_invoice.spotdiscountamount','hdpos_invoice.status','hdpos_invoice.createdby','hdpos_invoice.modifiedby','hdpos_invoice.created_at','hdpos_invoice.updated_at','hdpos_invoice.invoicedate')
                    ->orderBy('items.id', 'DESC')
                    ->get();


                foreach($selectReceipts as $selectReceipt)
                {
                    $updatestock=DB::table('addstock')
                        ->where('product_name', $selectReceipt->itemname)
                        ->Where('location', $ULocation)
                        ->increment('quantity',$selectReceipt->quantity);
                }

            $deletedRows = Invoice::where('invoicenumber',(string)$request->invoiceNumber)
            ->where('itemid' , (string)$ItemDetails->id)
            ->delete();



            return response(['msg' => 'Product deleted', 'status' => 'success']);

        }
        catch(\Exception $Exe)
        {
            return $Exe-> getMessage();
        }
    }

    public function Invoicedeleteall(Request $request) {

        $user = Auth::user();
        try
        {

                $ULocation = $user->branch;

                $selectReceipts = DB::table('hdpos_invoice')
                    ->leftJoin('items', DB::raw('hdpos_invoice.itemid::integer'), '=', 'items.id' )
                    ->where('invoicenumber', (string)$request->invoiceNumber)
                    ->select('items.id','items.bnumber','hdpos_invoice.spotdiscountchkbox','hdpos_invoice.discountchkbox','items.itemname','items.openstock','items.minstock','items.isactive','items.notforsale','items.ispurchased','items.online','items.categoryname','items.subcategoryname','items.desc','items.featured_image','items.mrp','items.disc1','items.disc2','items.discvalue','items.finalprice','items.createdby','items.modifiedby','items.created_at','items.updated_at','hdpos_invoice.id','hdpos_invoice.invoicenumber','hdpos_invoice.itemid','hdpos_invoice.amount','hdpos_invoice.quantity','hdpos_invoice.discount','hdpos_invoice.spotdiscountpercent','hdpos_invoice.spotdiscountamount','hdpos_invoice.status','hdpos_invoice.createdby','hdpos_invoice.modifiedby','hdpos_invoice.created_at','hdpos_invoice.updated_at','hdpos_invoice.invoicedate')
                    ->orderBy('items.id', 'DESC')
                    ->get();


                foreach($selectReceipts as $selectReceipt)
                {
                    $updatestock=DB::table('addstock')
                        ->where('product_name', $selectReceipt->itemname)
                        ->Where('location', $ULocation)
                        ->increment('quantity',$selectReceipt->quantity);
                }

            $deletedRows = Invoice::where('invoicenumber',(string)$request->invoiceNumber)->delete();


            // Session::forget('InvoiceNumber');
            // $InvoiceNumber = DB::select("select to_char(Current_Date, 'ddmmYY')||nextval('invoicenumber') nextval");

            // Session::put('InvoiceNumber',intval($InvoiceNumber['0']->nextval));


            // $selectTotal = DB::table('hdpos_receipt')
            //          ->select(DB::raw('count(createdby) as totalqty,SUM(CAST(totalamount AS float8)) as totalamt'))
            //          ->where('createdby', '=', $user->name)
            //          ->where('invoicedate', '=',$request->invoiceDate)
            //          ->first();

            // return response()->json(array('INumber' => intval($InvoiceNumber['0']->nextval)));

                     // echo intval($InvoiceNumber['0']->nextval);
                     //   echo  $selectTotal->totalqty;
                     //  echo   $selectTotal->totalamt;
                     //  echo   $request->invoiceDate;

            // return response()->json(array('INumber' => intval($InvoiceNumber['0']->nextval),'TotalQty' => $selectTotal->totalqty ,'Totalamt' => $selectTotal->totalamt,'InvoiceDate' => $request->invoiceDate));
            $InvoiceNumber=0;
            return response()->json(array('INumber' => $InvoiceNumber));
        }

        catch(\Exception $Exe)
        {
            return $Exe-> getMessage();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_HeldInvoice($id){

        $user = Auth::user();
        $Items = DB::table('addstock')
        ->distinct()
        ->where('quantity', '>', '0')
        ->where('location', $user->branch)
        ->pluck('product_name');

        Session::forget('InvoiceNumberFromHold');
        Session::put('InvoiceNumberFromHold', $id);
        $Locations = StockLocation::orderBy('location', 'ASC')->get();
        $country= CountryDetails::distinct()->pluck('country');
        $state= CountryDetails::distinct()->pluck('state');
        $district= CountryDetails::distinct()->pluck('district');


        $Tamt = 0;
        $TQty = 0;
        $invoicedate="";

        if(count($Items) > 0){
            $data = array('Items'  => $Items,'Locations'  => $Locations,'INumber' => $id,'TotalQty' => $TQty ,'Totalamt' => $Tamt,'InvoiceDate' => $invoicedate,'country'  => $country,'state'  => $state,'district'  => $district,);
            return view('Sales.Invoice')->with($data);
        }
    }

    public function create_Invoice($id){

        $user = Auth::user();

        $Items = DB::table('addstock')
        ->distinct()
        ->where('location', $user->branch)
        ->where('quantity', '>', '0')
        ->pluck('product_name');

        $Locations = StockLocation::orderBy('location', 'ASC')->get();
        $country= CountryDetails::distinct()->pluck('country');
        $state= CountryDetails::distinct()->pluck('state');
        $district= CountryDetails::distinct()->pluck('district');

        $Invoicedate = DB::select("select to_char(Current_Date, 'dd/mm/YYYY') as date");

        $Tamt = 0;
        $TQty = 0;

        echo $Items;

        if(count($Items) > 0){
            $data = array('Items'  => $Items,'Locations'  => $Locations,'INumber' => $id,'TotalQty' => $TQty ,'Totalamt' => $Tamt,'InvoiceDate' => $Invoicedate['0']->date,'country'  => $country,'state'  => $state,'district'  => $district,);
            return view('Sales.Invoice')->with($data);
          }
    }
        public function create_ReceiptPOS($id)
        {
            $value = $id;
            $ReceiptSelections = DB::table('hdpos_receipt')
                    ->leftJoin('hdpos_receiptitems', DB::raw('hdpos_receipt.id'), '=', DB::raw('hdpos_receiptitems.receiptid::integer') )
                    ->leftJoin('items', DB::raw('hdpos_receiptitems.itemid::integer'), '=', 'items.id' )
                    ->leftJoin('address', DB::raw('hdpos_receipt.userid::integer'), '=', 'address.id' )
                    ->where('hdpos_receipt.invoicenumber', (string)$value)
                    ->select('items.id','items.bnumber','items.itemname','items.openstock','items.minstock','items.isactive','items.notforsale','items.ispurchased','items.online','items.categoryname','items.subcategoryname','items.desc','items.featured_image','items.mrp','items.disc1','items.disc2','items.discvalue','items.finalprice','items.createdby','items.modifiedby','items.created_at','items.updated_at','hdpos_receiptitems.id','hdpos_receiptitems.receiptid','hdpos_receiptitems.itemid','hdpos_receiptitems.amount as Itemamount','hdpos_receiptitems.quantity as Itemquantity','hdpos_receiptitems.discount','hdpos_receiptitems.discountchkbox','hdpos_receiptitems.spotdiscountchkbox','hdpos_receiptitems.spotdiscountpercent','hdpos_receiptitems.spotdiscountamount','hdpos_receiptitems.created_at','hdpos_receiptitems.updated_at','hdpos_receipt.id','hdpos_receipt.userid','hdpos_receipt.invoicenumber','hdpos_receipt.invoicedate','hdpos_receipt.totalproduct','hdpos_receipt.totalquantity','hdpos_receipt.amount','hdpos_receipt.spotdiscountpercent','hdpos_receipt.spotdiscountamount','hdpos_receipt.totalamount','hdpos_receipt.status','hdpos_receipt.createdby','hdpos_receipt.modifiedby','hdpos_receipt.created_at','hdpos_receipt.updated_at','address.salutation','address.name','address.gender','address.address1','address.address2','address.address3','address.address4','address.district','address.pincode','address.state','address.country','address.phone','address.mobile1','address.mobile2','address.email','address.bday','address.wday','address.occupation','address.nameofchurch','address.language','address.addressyear','address.mode','address.remarks','address.status')
                    ->orderBy('hdpos_receiptitems.id', 'DESC')
                    ->get();

                $data = array('ReceiptSelections'  => $ReceiptSelections,);
                return view('Sales.ReceiptPOS')->with($data);
                // if("$ReceiptSelections" == null)
                // {
                //     return view('Sales.Receipt');
                // }
                // else
                // {
                //     return response()->json(array('body' => view('Sales.Receipt')->render(), 'ReceiptSelections' => $ReceiptSelections));
                // }
            // $Items = DB::table('items')->pluck('itemname');

            // if(count($Items) > 0){
            //     $data = array('Items'  => $Items,);
            //     return view('Sales.Invoice')->with($data);
            // }
            // else{
            //     return view('Sales.Invoice');
            // }
        }


    public function create_Receipt($id)
    {
        $value = $id;
        $ReceiptSelections = DB::table('hdpos_receipt')
                ->leftJoin('hdpos_receiptitems', DB::raw('hdpos_receipt.id'), '=', DB::raw('hdpos_receiptitems.receiptid::integer') )
                ->leftJoin('items', DB::raw('hdpos_receiptitems.itemid::integer'), '=', 'items.id' )
                ->leftJoin('address', DB::raw('hdpos_receipt.userid::integer'), '=', 'address.id' )
                ->where('hdpos_receipt.invoicenumber', (string)$value)
                ->select('items.id','items.bnumber','items.itemname','items.openstock','items.minstock','items.isactive','items.notforsale','items.ispurchased','items.online','items.categoryname','items.subcategoryname','items.desc','items.featured_image','items.mrp','items.disc1','items.disc2','items.discvalue','items.finalprice','items.createdby','items.modifiedby','items.created_at','items.updated_at','hdpos_receiptitems.id','hdpos_receiptitems.receiptid','hdpos_receiptitems.itemid','hdpos_receiptitems.amount as Itemamount','hdpos_receiptitems.quantity as Itemquantity','hdpos_receiptitems.discount','hdpos_receiptitems.discountchkbox','hdpos_receiptitems.spotdiscountchkbox','hdpos_receiptitems.spotdiscountpercent','hdpos_receiptitems.spotdiscountamount','hdpos_receiptitems.created_at','hdpos_receiptitems.updated_at','hdpos_receipt.id','hdpos_receipt.userid','hdpos_receipt.invoicenumber','hdpos_receipt.invoicedate','hdpos_receipt.totalproduct','hdpos_receipt.totalquantity','hdpos_receipt.amount','hdpos_receipt.spotdiscountpercent','hdpos_receipt.spotdiscountamount','hdpos_receipt.totalamount','hdpos_receipt.status','hdpos_receipt.createdby','hdpos_receipt.modifiedby','hdpos_receipt.created_at','hdpos_receipt.updated_at','address.salutation','address.name','address.gender','address.address1','address.address2','address.address3','address.address4','address.district','address.pincode','address.state','address.country','address.phone','address.mobile1','address.mobile2','address.email','address.bday','address.wday','address.occupation','address.nameofchurch','address.language','address.addressyear','address.mode','address.remarks','address.status')
                ->orderBy('hdpos_receiptitems.id', 'DESC')
                ->get();

            $data = array('ReceiptSelections'  => $ReceiptSelections,);
            return view('Sales.Receipt')->with($data);
            // if("$ReceiptSelections" == null)
            // {
            //     return view('Sales.Receipt');
            // }
            // else
            // {
            //     return response()->json(array('body' => view('Sales.Receipt')->render(), 'ReceiptSelections' => $ReceiptSelections));
            // }
        // $Items = DB::table('items')->pluck('itemname');

        // if(count($Items) > 0){
        //     $data = array('Items'  => $Items,);
        //     return view('Sales.Invoice')->with($data);
        // }
        // else{
        //     return view('Sales.Invoice');
        // }
    }

    public function create_PickHeldInVoice()
    {
        $user = Auth::user();
        $Items = DB::table('addstock')->distinct()->where('location', $user->branch)->pluck('product_name');
        $userLists = DB::table('users')->distinct()->pluck('name');

        $data = array('Items'  => $Items,'userLists'  => $userLists,);
        return view('Sales.pickheld')->with($data);
    }

    public function PickheldSearch(Request $request) {
        $user = Auth::user();
        try
        {
            $FromDatePick = \Carbon\Carbon::createFromFormat('d/m/Y', $request->FromDatePick);
            $ToDate = \Carbon\Carbon::createFromFormat('d/m/Y', $request->ToDatePick);

            $InvoiceSelection = DB::table('hdpos_invoice')
                ->leftJoin('items', DB::raw('hdpos_invoice.itemid::integer'), '=', 'items.id' )
                ->select(DB::raw("hdpos_invoice.invoicenumber,array_to_string(array_agg(distinct items.itemname),',') AS itemname,SUM(CAST(amount AS float8))amount,SUM(CAST(quantity AS float8))quantity"))
                ->where('hdpos_invoice.createdby', 'like', '%'.$request->GeneratedPick.'%')
                ->where('hdpos_invoice.status', '=', 'Hold')
                ->where('invoicenumber', 'like', '%'.$request->InvoiceNumPick.'%')
                ->where('itemname', 'like', '%'.$request->ItemsListPick.'%')
                ->whereBetween(DB::raw("TO_DATE(invoicedate, 'DD/MM/YYYY  HH:MM:SSS')"), [$FromDatePick, $ToDate])
                ->groupBy('hdpos_invoice.invoicenumber')
                ->get();

            return response()->json($InvoiceSelection);
        }
        catch(\Exception $Exe)
        {
            return $Exe-> getMessage();
        }
    }

    public function ViewheldSearch(Request $request) {
        $user = Auth::user();
        try
        {
            $FromDatePick = \Carbon\Carbon::createFromFormat('d/m/Y', $request->FromDatePick);
            $ToDate = \Carbon\Carbon::createFromFormat('d/m/Y', $request->ToDatePick);
            $InvoiceSelection = DB::table('hdpos_receipt')
                    ->leftJoin('hdpos_receiptitems', DB::raw('hdpos_receipt.id'), '=', DB::raw('hdpos_receiptitems.receiptid::integer') )
                    ->leftJoin('items', DB::raw('hdpos_receiptitems.itemid::integer'), '=', 'items.id' )
                    ->leftJoin('address', DB::raw('hdpos_receipt.userid::integer'), '=', 'address.id' )

                    ->where('hdpos_receipt.invoicenumber', 'like', '%'.$request->InvoiceNumPick.'%')
                    ->where('hdpos_receipt.createdby', 'like', '%'.$request->GeneratedPick.'%')
                    ->where('items.itemname', 'like', '%'.$request->ItemsListPick.'%')

                    ->where('address.name', 'like', '%'.$request->Name.'%')
                    ->where('hdpos_receipt.totalamount', 'like', '%'.$request->TtlAmt.'%')
                    ->where('address.pincode', 'like', '%'.$request->Pincode.'%')
                    ->where('address.country', 'like', '%'.$request->Country.'%')
                    ->where('address.state', 'like', '%'.$request->State.'%')
                    ->where('address.district', 'like', '%'.$request->District.'%')
                    ->where('address.mobile1', 'like', '%'.$request->Mobile.'%')
                    ->whereBetween(DB::raw("TO_DATE(hdpos_receipt.invoicedate, 'DD/MM/YYYY  HH:MM:SSS')"), [$FromDatePick, $ToDate])

                    ->select(DB::raw("hdpos_receipt.invoicenumber,hdpos_receipt.invoicedate,address.name,hdpos_receipt.totalamount,hdpos_receipt.totalquantity,array_to_string(array_agg(distinct items.itemname),',') AS itemname,ltrim(rtrim(concat(',',mobile1,',',mobile2), ','), ',') AS mobile"))
                    ->groupBy('hdpos_receipt.invoicenumber','hdpos_receipt.invoicedate','address.name','hdpos_receipt.totalamount','hdpos_receipt.totalquantity','address.mobile1','address.mobile2')

                    ->get();

            return response()->json($InvoiceSelection);
        }
        catch(\Exception $Exe)
        {
            return $Exe-> getMessage();
        }
    }


    public function create_View()
    {
        $user = Auth::user();
        $Items = DB::table('addstock')->distinct()->where('location', $user->branch)->pluck('product_name');
        $userLists = DB::table('users')->distinct()->pluck('name');
        $Locations = StockLocation::orderBy('location', 'ASC')->get();
        $country= CountryDetails::distinct()->pluck('country');
        $state= CountryDetails::distinct()->pluck('state');
        $district= CountryDetails::distinct()->pluck('district');

        $data = array('Items'  => $Items,'Locations'  => $Locations,'userLists'  => $userLists,'country'  => $country,'state'  => $state,'district'  => $district,);
        return view('Sales.viewreceipt')->with($data);
    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}




    // public function InvoiceSeq()
    // {
    //     $user = Auth::user();
    //     $value = Session::get('InvoiceNumber');
    //     $valueFromHold=Session::get('InvoiceNumberFromHold');

    //     if($valueFromHold == "")
    //     {
    //         if($value == "")
    //         {
    //             $InvoiceNumber = DB::select("select to_char(Current_Date, 'ddmmYY')||nextval('invoicenumber') nextval");

    //             Session::put('InvoiceNumber',intval($InvoiceNumber['0']->nextval));


    //             $Invoicedate = DB::select("select to_char(Current_Date, 'dd/mm/YY') as date");
    //             $selectTotal = DB::table('hdpos_receipt')
    //                      ->select(DB::raw('count(createdby) as totalqty,SUM(CAST(totalamount AS float8)) as totalamt'))
    //                      ->where('createdby', '=', $user->name)
    //                      ->where('invoicedate', '=',$Invoicedate['0']->date)
    //                      ->first();
    //             $Tamt = 0;
    //             $TQty = 0;

    //             if(intval($selectTotal->totalqty) > 0)
    //             {
    //                 $Tamt = $selectTotal->totalamt;
    //                 $TQty = $selectTotal->totalqty;
    //             }
    //             else
    //             {
    //                 $Tamt = 0;
    //                 $TQty = 0;
    //             }

    //             // return response()->json(array('INumber' => intval($InvoiceNumber['0']->nextval)));


    //             return response()->json(array('INumber' => intval($InvoiceNumber['0']->nextval),'TotalQty' => $TQty ,'Totalamt' => $Tamt,'InvoiceDate' => $Invoicedate['0']->date));
    //         }
    //         else
    //         {

    //             $Invoicedate = DB::select("select to_char(Current_Date, 'dd/mm/YY') as date");
    //             $selectTotal = DB::table('hdpos_receipt')
    //                      ->select(DB::raw('count(createdby) as totalqty,SUM(CAST(totalamount AS float8)) as totalamt'))
    //                      ->where('createdby', '=', $user->name)
    //                      ->where('invoicedate', '=',$Invoicedate['0']->date)
    //                      ->first();
    //             $Tamt = 0;
    //             $TQty = 0;

    //             if(intval($selectTotal->totalqty) > 0)
    //             {
    //                 $Tamt = $selectTotal->totalamt;
    //                 $TQty = $selectTotal->totalqty;
    //             }
    //             else
    //             {
    //                 $Tamt = 0;
    //                 $TQty = 0;
    //             }
    //             // // return response()->json(array('INumber' => intval($InvoiceNumber['0']->nextval)));

    //            return response()->json(array('INumber' => $value,'TotalQty' => $TQty ,'Totalamt' => $Tamt,'InvoiceDate' => $Invoicedate['0']->date));

    //         }
    //     }

    //     else
    //     {
    //         $Invoicedate = DB::select("select to_char(Current_Date, 'dd/mm/YY') as date");
    //         $selectTotal = DB::table('hdpos_receipt')
    //                  ->select(DB::raw('count(createdby) as totalqty,SUM(CAST(totalamount AS float8)) as totalamt'))
    //                  ->where('createdby', '=', $user->name)
    //                  ->where('invoicedate', '=',$Invoicedate['0']->date)
    //                  ->first();
    //         $Tamt = 0;
    //         $TQty = 0;

    //         if(intval($selectTotal->totalqty) > 0)
    //         {
    //             $Tamt = $selectTotal->totalamt;
    //             $TQty = $selectTotal->totalqty;
    //         }
    //         else
    //         {
    //             $Tamt = 0;
    //             $TQty = 0;
    //         }
    //         // // return response()->json(array('INumber' => intval($InvoiceNumber['0']->nextval)));

    //         Session::forget('InvoiceNumberFromHold');
    //         return response()->json(array('INumber' => $valueFromHold,'TotalQty' => $TQty ,'Totalamt' => $Tamt,'InvoiceDate' => $Invoicedate['0']->date));

    //     }
    // }


    // public function createsessionFromHold(Request $request)
    // {
    //     Session::put('InvoiceNumberFromHold', $request->InvoiceNo);
    // }
