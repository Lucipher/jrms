<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests;
use App\StockAdd;
use App\movestock;
use App\reboundstock;
use App\ExhibitStock;
use App\StockLocation;
use App\CountryDetails;
use App\Item;
use App\Supplier;
use DB;
use View;
use Input;
use Auth;

class StocksController extends Controller
{
    public function add()
   {
       $data = StockAdd::all();
       // $data1 = StockLocation::all();
       $data1 = StockLocation::orderBy('location', 'ASC')->get();
       $data2= StockAdd::distinct()->get(['product_name']);
       $data3= Item::distinct()->get(['itemname']);
       $data4 = Supplier::distinct()->get(['supplier']);
       return view('Stock.add1')->withData($data)->withData1($data1)->withData2($data2)->withData3($data3)->withData4($data4);
   }
   public function transfer()
   {
       $user = Auth::user();
       $data = movestock::all();
       $data1 = StockLocation::orderBy('location', 'ASC')->get();
       $data2= StockAdd::distinct()->get(['product_name']);
       $data4= movestock::distinct()->get(['product_name']);
       $data3 = StockLocation::where('location', '!=', $user->branch)->get(['location']);


       return view('Stock.transfer')->withData($data)->withData1($data1)->withData2($data2)->withData3($data3)->withData4($data4);
   }

   public function return()
   {
       $user = Auth::user();
       $data = reboundstock::all();
       $data1 = StockLocation::orderBy('location', 'ASC')->get();
       $data2= StockAdd::distinct()->get(['product_name']);
       $data3 = StockLocation::where('location', '!=', $user->branch)->get(['location']);

       return view('Stock.return')->withData($data)->withData1($data1)->withData2($data2)->withData3($data3);
   }

   public function stockview()
   {
       $data = StockAdd::all();
       $data1 = movestock::all();
       $data2 = Supplier::all();

       return view('Stock.stockview')->withData($data)->withData1($data1)->withData2($data2);
   }

   public function supplier()
   {
       $data= CountryDetails::distinct()->get(['country']);
       $data1 = Supplier::distinct()->get(['supplier']);
       return view('Product.supplier')->withData($data)->withData1($data1);
   }

   ######################################Stockadd##########################################


   ##################################To get product name and barcode from items table##########################################################
   public function transfer_select_product(Request $request)
   {
       try
       {
           $stockselection = DB::table('addstock')->select( 'barcode','product_name','product_id','quantity','location')->where('product_name', $request->input('prod_name'))->where('location', $request->input('stock_location'))->get();
           // $locationsel = DB::table('addstock')->select( 'product_name','location')->where('product_name', $request->input('prod_name'))->get();
           //  return response()->json(array('$stockselection','$locationsel'));

           if(count($stockselection)>0)
           {
             $stockselection = DB::table('addstock')->select( 'barcode','product_name','product_id','quantity','location')->where('product_name', $request->input('prod_name'))->where('location', $request->input('stock_location'))->get();
                return response()->json($stockselection);
           }

       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }

   public function demo(Request $request)
   {
       try
       {
           $stockselection = DB::table('items')->select( 'bnumber','itemname','id')->where('itemname', $request->input('prod_name'))->get();
           // $locationsel = DB::table('addstock')->select( 'product_name','location')->where('product_name', $request->input('prod_name'))->get();
           //  return response()->json(array('$stockselection','$locationsel'));

           if(count($stockselection)>0)
           {
                $stockselection = DB::table('items')->select( 'bnumber','itemname','id')->where('itemname', $request->input('prod_name'))->get();
                return response()->json($stockselection);
           }

           // $stockselection = DB::table('addstock')->select( 'barcode','product_name','product_id','quantity','location')->where('product_name', $request->input('prod_name'))->get();
           // // $locationsel = DB::table('addstock')->select( 'product_name','location')->where('product_name', $request->input('prod_name'))->get();
           // //  return response()->json(array('$stockselection','$locationsel'));
           //
           // if(count($stockselection)>0)
           // {
           //   $stockselection = DB::table('addstock')->select( 'barcode','product_name','product_id','quantity','location')->where('product_name', $request->input('prod_name'))->get();
           //      return response()->json($stockselection);
           // }

       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }


       public function select_barcode(Request $request)
       {
           try
           {
               $stockselection1 = DB::table('items')->select( 'bnumber','itemname','id')->where('bnumber', $request->input('barcode'))->get();
               // $locationsel = DB::table('addstock')->select( 'product_name','location')->where('product_name', $request->input('prod_name'))->get();
               //  return response()->json(array('$stockselection','$locationsel'));

               if(count($stockselection1)>0)
               {
                    $stockselection1 = DB::table('items')->select( 'bnumber','itemname','id')->where('bnumber', $request->input('barcode'))->get();
                    return response()->json($stockselection1);
               }

           }
           catch(\Exception $e)
           {
               return $e->getMessage();
           }

       }


   ###########################To select stock location based on product name###################################
   public function stocklocation(Request $request)
   {
       try
       {
         $prod_name=$request->prod_name;
         $locationselection = StockAdd::distinct()->where('product_name',$prod_name)->pluck('location');
         // echo $locationselection;
         return response()->json($locationselection);
       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }
   public function selecttolocation(Request $request)
   {
       try
       {
         $loc=$request->loc;

         $selectlocation =  StockLocation::where('location', '!=', $loc)->pluck('location');
         // echo $locationselection;
         return response()->json($selectlocation);
       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }


   //addstock
   public function stockaddcheck(Request $request)
   {
       try
       {
           $supplier=$request->supplier;
           $invoice_number=$request->invoice_number;
           $billed_date=$request->billed_date;
           $received_date=$request->received_date;
           $prod_name=$request->prod_name;
           $product_id=$request->product_id;
           $bcode=$request->bcode;
           $qty=$request->qty;
           $loc=$request->loc;
           $notes=$request->notes;

           //addstock
           $addstock = StockAdd::all();
           // echo count($addstock);
           $row = $request->row;


           if(count($addstock) == 0)
           {
                   # code...

                   $user = Auth::user();
                   $stockadd1=new StockAdd;
                   $stockadd1->product_name = $request->prod_name;
                   $stockadd1->product_id = $request->product_id;
                   $stockadd1->barcode = $request->bcode;
                   $stockadd1->supplier = $request->supplier;
                   $stockadd1->invoice_number = $request->invoice_number;
                   $stockadd1->billed_date = $request->billed_date;
                   $stockadd1->received_date = $request->received_date;
                   $stockadd1->location =$request->loc;
                   $stockadd1->quantity =$request->qty;
                   $stockadd1->notes =$request->notes;
                   $stockadd1->status ='Success';
                   $stockadd1->created_by = $user->name;
                   $stockadd1->save();

           }
           elseif (count($addstock) >0)
           {
             # code...
             $a=1;
             while ($a <= $row)
             {
               # code...
               if (StockAdd::where('product_name', '=', $prod_name)->where('location', '=', $loc)->exists())
               {
                 $stkupt= DB::table('addstock')->where('product_name', '=', $prod_name)->where('location', '=', $loc)-> increment('quantity', $qty);
                 break;
               }
               else
               {
                 $user = Auth::user();
                 $stockadd1=new StockAdd;
                 $stockadd1->product_name = $request->prod_name;
                 $stockadd1->product_id = $request->product_id;
                 $stockadd1->barcode = $request->bcode;
                 $stockadd1->supplier = $request->supplier;
                 $stockadd1->invoice_number = $request->invoice_number;
                 $stockadd1->billed_date = $request->billed_date;
                 $stockadd1->received_date = $request->received_date;
                 $stockadd1->location =$request->loc;
                 $stockadd1->quantity =$request->qty;
                 $stockadd1->notes =$request->notes;
                 $stockadd1->status ='Success';
                 $stockadd1->created_by = $user->name;
                 $stockadd1->save();
                 $a++;
                 break;
               }
             }
           }

           //exhibit stock
           $stocklog = ExhibitStock::all();
           // echo count();
           $row = $request->row;

           if(count($stocklog) == 0)
           {
                   # code...

                   $user = Auth::user();
                   $stockadd1=new ExhibitStock;

                   $stockadd1->product_name = $request->prod_name;
                   $stockadd1->product_id = $request->product_id;
                   $stockadd1->barcode = $request->bcode;
                   $stockadd1->supplier = $request->supplier;
                   $stockadd1->invoice_number = $request->invoice_number;
                   $stockadd1->billed_date = $request->billed_date;
                   $stockadd1->received_date = $request->received_date;
                   $stockadd1->from_location =$request->loc;
                   $stockadd1->to_location =' ';
                   $stockadd1->quantity =$request->qty;
                   $stockadd1->notes =$request->notes;
                   $stockadd1->status ='Success';
                   $stockadd1->created_by = $user->name;
                   $stockadd1->save();
           }
           elseif (count($stocklog) >0)
           {
             # code...
             $a=1;
             while ($a <= $row)
             {
               # code...
               if (ExhibitStock::where('product_name', '=', $prod_name)->where('from_location', '=', $loc)->exists())
               {
                 $stkupt= DB::table('exhibitstock')->where('product_name', '=', $prod_name)->where('from_location', '=', $loc)-> increment('quantity', $qty);
                 break;
               }
               else
               {
                 $user = Auth::user();
                 $stockadd1=new ExhibitStock;
                 $stockadd1->product_name = $request->prod_name;
                 $stockadd1->product_id = $request->product_id;
                 $stockadd1->barcode = $request->bcode;
                 $stockadd1->supplier = $request->supplier;
                 $stockadd1->invoice_number = $request->invoice_number;
                 $stockadd1->billed_date = $request->billed_date;
                 $stockadd1->received_date = $request->received_date;
                 $stockadd1->from_location =$request->loc;
                 $stockadd1->to_location =' ';
                 $stockadd1->quantity =$request->qty;
                 $stockadd1->notes =$request->notes;
                 $stockadd1->status ='Success';
                 $stockadd1->created_by = $user->name;
                 $stockadd1->save();
                 $a++;
                 break;
               }
             }
           }

       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }

   public function stockaddmodify(Request $request)
   {
       try
       {
           $stockaddmodify = DB::table('addstock')->select( 'id','barcode','product_name','quantity','location','supplier','invoice_number','billed_date','received_date','notes')
           ->where('product_name', $request->input('edit_details'))->get();
           // $locationsel = DB::table('addstock')->select( 'product_name','location')->where('product_name', $request->input('prod_name'))->get();
           //  return response()->json(array('$stockselection','$locationsel'));
           if(count($stockaddmodify)>0)
           {
             $stockaddmodify = DB::table('addstock')->select( 'id','barcode','product_name','quantity','location','supplier','invoice_number','billed_date','received_date','notes')
             ->where('product_name', $request->input('edit_details'))->get();

                return response()->json($stockaddmodify);
           }

       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }
   }

   ##########################################Stock Transfer#################################################

  //transfer stock
   public function stocktransfercheck(Request $request)
   {
       try
       {
           $prod_name=$request->prod_name;
           $product_id=$request->product_id;
           $bcode=$request->bcode;
           $qty=$request->qty;
           $loc=$request->loc;
           $loc1=$request->loc1;
           $notes=$request->notes;

           //addstock
          $transfer=movestock::all();
           //  echo count($transfer);
          $row = $request->row;
         //  echo "rows : ".$row;

          if(count($transfer) == 0)
          {
                  # code...
                       echo "count 0";
                       $user = Auth::user();
                       $stktransel = new movestock;
                       $stktransel->product_name = $request->prod_name;
                       $stktransel->product_id = $request->product_id;
                       $stktransel->barcode = $request->bcode;
                       $stktransel->from_location =$request->loc;
                       $stktransel->to_location =$request->loc1;
                       $stktransel->quantity =$request->qty;
                       $stktransel->notes =$request->notes;
                       $stktransel->status ='success';
                       $stktransel->created_by = $user->name;
                       $stktransel->save();

                       $stkupt2= DB::table('addstock')->where('product_name', '=', $prod_name)->where('location', '=', $loc)-> decrement('quantity', $qty);

                       if(StockAdd::where('product_name', '=', $prod_name)->where('location', '=', $loc1)->exists())
                       {
                           $stkupt1= DB::table('addstock')->where('product_name', '=', $prod_name)->where('location', '=', $loc1)-> increment('quantity', $qty);
                       }
                       else
                       {
                         # code...
                         $user = Auth::user();
                         $stockadd1=new StockAdd;
                         $stockadd1->product_name = $request->prod_name;
                         $stockadd1->product_id = $request->product_id;
                         $stockadd1->barcode = $request->bcode;
                         $stockadd1->supplier = '';
                         $stockadd1->invoice_number = '';
                         $stockadd1->billed_date = '';
                         $stockadd1->received_date = '';
                         $stockadd1->location =$request->loc1;
                         $stockadd1->quantity =$request->qty;
                         $stockadd1->notes =$request->notes;
                         $stockadd1->status ='Success';
                         $stockadd1->created_by = $user->name;
                         $stockadd1->save();

                       }
             }
          elseif (count($transfer) >0)
          {
            # code...
            $a=1;
            while ($a <= $row)
            {
              # code...
              if (movestock::where('product_name', '=', $prod_name)->where('from_location', '=', $loc)->where('to_location', '=', $loc1)->exists())
              {
                   $stkupt= DB::table('movestock')->where('product_name', '=', $prod_name)->where('from_location', '=', $loc)->where('to_location', '=', $loc1)-> increment('quantity', $qty);
                   $stkupt2= DB::table('addstock')->where('product_name', '=', $prod_name)->where('location', '=', $loc)-> decrement('quantity', $qty);

                   if(StockAdd::where('product_name', '=', $prod_name)->where('location', '=', $loc1)->exists())
                   {
                       $stkupt1= DB::table('addstock')->where('product_name', '=', $prod_name)->where('location', '=', $loc1)-> increment('quantity', $qty);
                   }
                   else
                   {
                     # code...
                     $user = Auth::user();
                     $stockadd1=new StockAdd;
                     $stockadd1->product_name = $request->prod_name;
                     $stockadd1->product_id = $request->product_id;
                     $stockadd1->barcode = $request->bcode;
                     $stockadd1->supplier = '';
                     $stockadd1->invoice_number = '';
                     $stockadd1->billed_date = '';
                     $stockadd1->received_date = '';
                     $stockadd1->location =$request->loc1;
                     $stockadd1->quantity =$request->qty;
                     $stockadd1->notes =$request->notes;
                     $stockadd1->status ='Success';
                     $stockadd1->created_by = $user->name;
                     $stockadd1->save();
                     $a++;
                     break;
                   }

              }
              else
              {
                $user = Auth::user();
                $stktransel = new movestock;
                $stktransel->product_name = $request->prod_name;
                $stktransel->product_id = $request->product_id;
                $stktransel->barcode = $request->bcode;
                $stktransel->from_location =$request->loc;
                $stktransel->to_location =$request->loc1;
                $stktransel->quantity =$request->qty;
                $stktransel->notes =$request->notes;
                $stktransel->status ='success';
                $stktransel->created_by = $user->name;
                $stktransel->save();
                $a++;

                $stkupt2= DB::table('addstock')->where('product_name', '=', $prod_name)->where('location', '=', $loc)-> decrement('quantity', $qty);

                if(StockAdd::where('product_name', '=', $prod_name)->where('location', '=', $loc1)->exists())
                {
                    $stkupt1= DB::table('addstock')->where('product_name', '=', $prod_name)->where('location', '=', $loc1)-> increment('quantity', $qty);
                }
                else
                {
                  # code...
                  $user = Auth::user();
                  $stockadd1=new StockAdd;
                  $stockadd1->product_name = $request->prod_name;
                  $stockadd1->product_id = $request->product_id;
                  $stockadd1->barcode = $request->bcode;
                  $stockadd1->supplier = '';
                  $stockadd1->invoice_number = '';
                  $stockadd1->billed_date = '';
                  $stockadd1->received_date = '';
                  $stockadd1->location =$request->loc1;
                  $stockadd1->quantity =$request->qty;
                  $stockadd1->notes =$request->notes;
                  $stockadd1->status ='Success';
                  $stockadd1->created_by = $user->name;
                  $stockadd1->save();
                  $a++;
                  break;
                }


              }

              break;


            }
          }
          //exhibitstock

         $stocklog=ExhibitStock::all();
         $row = $request->row;

         if (count($stocklog) >0)
         {
           # code...
           $a=1;
           while ($a <= $row)
           {
             # code...
             if (ExhibitStock::where('product_name', '=', $prod_name)->where('from_location', '=', $loc)->where('to_location', '=', $loc1)->exists())
             {
                  $stkupt= DB::table('exhibitstock')->where('product_name', '=', $prod_name)->where('from_location', '=', $loc)->where('to_location', '=', $loc1)-> increment('quantity', $qty);



             }
             else
             {
               $user = Auth::user();
                   $stktransel=new ExhibitStock;
                   $stktransel->product_name = $request->prod_name;
                   $stktransel->product_id = $request->product_id;
                   $stktransel->barcode = $request->bcode;
                   $stktransel->supplier = '';
                   $stktransel->invoice_number ='' ;
                   $stktransel->billed_date = '';
                   $stktransel->received_date = '';
                   $stktransel->from_location =$request->loc;
                   $stktransel->to_location =$request->loc1;
                   $stktransel->quantity =$request->qty;
                   $stktransel->notes =$request->notes;
                   $stktransel->status ='Success';
                   $stktransel->created_by = $user->name;
                   $stktransel->save();
               $a++;


             }

             break;

         }
       }

         }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }



   //selecting product name from addstock
   public function prodname(Request $request)
   {
       try
       {
           $results = DB::select( DB::raw("SELECT DISTINCT product_name FROM addstock" ));
           return response()->json($results);
       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }
   }

   //selecting quantity for the particular product and location
   public function stock(Request $request)
   {
       try
       {
           $stk = DB::table('addstock')->select( 'product_name','location','quantity')->where('product_name', $request->input('prod_name'))->where('location', $request->input('shloc'))->get();
                return response()->json($stk);
       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }
   }

   ###################################################modify stock transfer####################################################
   public function stocktransfermodify(Request $request)
   {
       try
       {
           $stocktransfermodify = DB::table('movestock')->select( 'id','barcode','product_name','quantity','product_id','from_location','to_location')->where('barcode', $request->input('edit_details'))->orWhere('product_name', $request->input('edit_details'))->get();
           // $locationsel = DB::table('addstock')->select( 'product_name','location')->where('product_name', $request->input('prod_name'))->get();
           //  return response()->json(array('$stockselection','$locationsel'));
           if(count($stocktransfermodify)>0)
           {
             $stocktransfermodify = DB::table('movestock')->select( 'id','barcode','product_name','quantity','product_id','from_location','to_location')->where('barcode', $request->input('edit_details'))->orWhere('product_name', $request->input('edit_details'))->get();

                return response()->json($stocktransfermodify);
           }

       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }
   }
   public function stocktransferupdate(Request $request)
   {
       try
       {
           $prod_name=$request->product_name;
           $barcode=$request->barcode;
           $product_id=$request->product_id;
           $from_location=$request->from_location;
           $to_location=$request->to_location;
           $qty=$request->quantity;
           $stock_qty=$request->stock_qty;

           $stocktransfermodify = DB::table('addstock')->select('quantity')
           ->where('product_name', $request->prod_name)->where('location', $request->from_location)->first();


           $diff= $stock_qty - $qty;

           if($diff > 0)
           {
             // echo "decrement";
             $transfer_update=DB::table('movestock')
                 ->where('product_name',$prod_name)
                 ->where('from_location',$from_location)
                 ->where('to_location',$to_location)
                 ->update(['product_name' => $prod_name,'product_id'=>$product_id,'barcode'=>$barcode,
                 'from_location'=>$from_location,'to_location'=>$to_location,'quantity'=>$qty,'status'=>'Success']);

           $transfer_update_log=DB::table('exhibitstock')
                 ->where('product_name',$prod_name)
                 ->where('from_location',$from_location)
                 ->where('to_location',$to_location)
                 ->update(['product_name' => $prod_name,'product_id'=>$product_id,'barcode'=>$barcode,
                   'from_location'=>$from_location,'to_location'=>$to_location,'quantity'=>$qty,'status'=>'Success']);

           // addstock table modificatoion
           $add_update=DB::table('addstock')
                 ->where('product_name',$prod_name)
                 ->where('location',$to_location)
                 ->decrement('quantity', $diff);

             $add_update1=DB::table('addstock')
                 ->where('product_name',$prod_name)
                 ->where('location',$from_location)
                 ->increment('quantity', $diff);

             // addstock table modificatoion
           $add_update_log=DB::table('exhibitstock')
                 ->where('product_name',$prod_name)
                 ->where('location',$to_location)
                 ->decrement('quantity', $diff);

           $add_update_log1=DB::table('exhibitstock')
                 ->where('product_name',$prod_name)
                 ->where('location',$from_location)
                 ->increment('quantity', $diff);
           }
           else
           {
             $diff1= $diff * (-1);
             // echo "increment";
             $transfer_update=DB::table('movestock')
                 ->where('product_name',$prod_name)
                 ->where('from_location',$from_location)
                 ->where('to_location',$to_location)
                 ->update(['product_name' => $prod_name,'product_id'=>$product_id,'barcode'=>$barcode,
                 'from_location'=>$from_location,'to_location'=>$to_location,'quantity'=>$qty,'status'=>'Success']);

                 $add_update=DB::table('addstock')
                     ->where('product_name',$prod_name)
                     ->where('location',$to_location)
                     ->increment('quantity', $diff1);

                 $add_update=DB::table('addstock')
                     ->where('product_name',$prod_name)
                     ->where('location',$from_location)
                     ->decrement('quantity', $diff1);
           }

           // $transfer_update=DB::table('movestock')
           //     ->where('product_name',$prod_name)
           //     ->where('from_location',$from_location)
           //     ->where('to_location',$to_location)
           //     ->update(['product_name' => $prod_name,'product_id'=>$product_id,'barcode'=>$barcode,
           //     'from_location'=>$from_location,'to_location'=>$to_location,'quantity'=>$qty,'status'=>'Success']);


          //
         //   return response()->json($transfer_update);


       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }
   // public function transfer_edit_location(Request $request)
   // {
   //     try
   //     {
   //       $edit_details=$request->edit_details;
   //       $locationselection = movestock::distinct()->where('product_name',$edit_details)->pluck('from_location');
   //       // echo $locationselection;
   //       return response()->json($locationselection);
   //     }
   //     catch(\Exception $e)
   //     {
   //         return $e->getMessage();
   //     }
   //
   // }
   public function ajax_add_edit_quantity(Request $request)
   {
       try
       {
         $prod_name=$request->product_name;
         $location=$request->location;
         $qty=$request->quantity;
         $stock_qty=$request->stock_qty;


         $product_selection = StockAdd::distinct()->where('location',$location)->where('product_name',$prod_name)->pluck('quantity');
         return response()->json($product_selection);

       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }

   public function ajax_check_quantity(Request $request)
   {
       try
       {
         $prod_name=$request->product_name;
         $barcode=$request->barcode;
         $product_id=$request->product_id;
         $from_location=$request->from_location;
         $to_location=$request->to_location;
         $qty=$request->quantity;
         $stock_qty=$request->stock_qty;

         $product_selection = StockAdd::distinct()->where('location',$from_location)->where('product_name',$prod_name)->pluck('quantity');
         return response()->json($product_selection);
       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }

   public function select_product_name(Request $request)
   {
       try
       {
         $stock_location=$request->stock_location;
         $product_selection = StockAdd::distinct()->where('location',$stock_location)->pluck('product_name');
         // echo $locationselection;
         return response()->json($product_selection);
       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }
   public function select_state(Request $request)
   {
       try
       {
         $country=$request->country;
         // echo $country;
         $countryselection = CountryDetails::distinct()->where('country',$country)->pluck('state');
         return response()->json($countryselection);

       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }

   public function select_district(Request $request)
   {
       try
       {
         $state=$request->state;
         // echo $country;
         $districtselection = CountryDetails::distinct()->where('state',$state)->pluck('district');
         return response()->json($districtselection);

       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }

   // add stock update
   public function stock_add_update(Request $request)
   {
       try
       {
             $prod_name=$request->product_name;
             $location=$request->location;
             $qty=$request->quantity;
             $stock_qty=$request->stock_qty;
             $supplier=$request->supplier;
             $invoice_number=$request->invoice_number;
             $billed_date=$request->billed_date;
             $received_date=$request->received_date;
             $notes=$request->notes;
             echo $received_date;
             $diff= $stock_qty - $qty;

             if($diff > 0)
             {
                 $add_update=DB::table('addstock')
                       ->where('product_name',$prod_name)
                       ->where('location',$location)
                       ->update(['product_name' => $prod_name,'location'=>$location,'supplier'=>$supplier,'invoice_number'=>$invoice_number,
                       'billed_date'=>$billed_date, 'received_date'=>$received_date,'quantity'=>$qty,'notes'=>$notes,'status'=>'Success']);

                 $add_update1=DB::table('exhibitstock')
                       ->where('product_name',$prod_name)
                       ->where('from_location',$location)
                       ->update(['product_name' => $prod_name,'from_location'=>$location,'supplier'=>$supplier,'invoice_number'=>$invoice_number,
                         'billed_date'=>$billed_date, 'received_date'=>$received_date,'quantity'=>$qty,'notes'=>$notes,'status'=>'Success']);
             }
             else
              {
                  $diff1= $diff * (-1);
                  $add_update=DB::table('addstock')
                        ->where('product_name',$prod_name)
                        ->where('location',$location)
                        ->update(['product_name' => $prod_name,'location'=>$location,'supplier'=>$supplier,'invoice_number'=>$invoice_number,
                        'billed_date'=>$billed_date, 'received_date'=>$received_date,'quantity'=>$qty,'notes'=>$notes,'status'=>'Success']);

                 $add_update1=DB::table('exhibitstock')
                       ->where('product_name',$prod_name)
                       ->where('from_location',$location)
                       ->update(['product_name' => $prod_name,'from_location'=>$location,'supplier'=>$supplier,'invoice_number'=>$invoice_number,
                         'billed_date'=>$billed_date, 'received_date'=>$received_date,'quantity'=>$qty,'notes'=>$notes,'status'=>'Success']);
              }
       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }

   public function add_supplier(Request $request)
   {
     // echo "hdghfjghjdg";
     try
     {
         $supplier=$request->supplier;
         $door_no=$request->door_no;
         $street=$request->street;
         $area1=$request->area1;
         $city=$request->city;
         $country=$request->country;
         $state=$request->state;
         $district=$request->district;
         $pincode=$request->pincode;
         $mobile=$request->mobile;
         $email=$request->email;
         $notes=$request->notes;

          $user = Auth::user();
         $supplier1=new Supplier;
         $supplier1->supplier = $request->supplier;
         $supplier1->door_number = $request->door_no;
         $supplier1->street = $request->street;
         $supplier1->area = $request->area1;
         $supplier1->city = $request->city;
         $supplier1->district =$request->district;
         $supplier1->state = $request->state;
         $supplier1->country = $request->country;
         $supplier1->pincode =$request->pincode;
         $supplier1->mobile =$request->mobile;
         $supplier1->email =$request->email;
         $supplier1->notes =$request->notes;
         $supplier1->status ='Enable';
         $supplier1->created_by = $user->name;
         $supplier1->save();

       }
      catch(\Exception $e)
      {
          return $e->getMessage();
      }

   }
   public function fill_supplier_details(Request $request)
   {
       try
       {
         $supplier=$request->supplier;
         // $supplier_selection = Supplier::distinct()->where('supplier',$supplier)->pluck('door_number','street','area','city','district','state','country','pincode','mobile','email','notes');
         // return response()->json($supplier_selection);

         $supplier_selection = DB::table('suppliers')->select( 'door_number','street','area','city','district','state','country','pincode','mobile','email','notes')->where('supplier', $request->input('supplier'))->get();

            return response()->json($supplier_selection);
       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }
   }
   public function modify_supplier(Request $request)
   {
       try
       {
         $supplier=$request->supplier;
         $door_no=$request->door_no;
         $street=$request->street;
         $area1=$request->area1;
         $city=$request->city;
         $country=$request->country;
         $state=$request->state;
         $district=$request->district;
         $pincode=$request->pincode;
         $mobile=$request->mobile;
         $email=$request->email;
         $notes=$request->notes;
         $status=$request->status;
         // $supplier_selection = DB::table('suppliers')->select( 'door_number','street','area','city','district','state','country','pincode','mobile','email','notes')->where('supplier', $request->input('supplier'))->get();
         //
         //    return response()->json($supplier_selection);

         $supplier_update=DB::table('suppliers')
               ->where('supplier',$supplier)
               ->update(['door_number' => $door_no,'street'=>$street,'area'=>$area1,'city'=>$city,
               'state'=>$state, 'district'=>$district,'country'=>$country,'pincode'=>$pincode,'mobile'=>$mobile,'email'=>$email,'notes'=>$notes,'status'=>$status]);

       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }
   public function add_country(Request $request)
   {
       try
       {
         // echo $country;
         $countryselection = CountryDetails::distinct()->pluck('country');
         return response()->json($countryselection);

       }
       catch(\Exception $e)
       {
           return $e->getMessage();
       }

   }

}
