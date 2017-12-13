<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockAdd;
use App\Invoice;
use App\Category;
use App\User;
use App\Item;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        $user = Auth::user()->id;
        $branch = Auth::user()->branch;
        $add_stock = StockAdd::all();
        $today_date = date("d/m/Y");
        $category = Category::all();
        $userslist = User::all();
        $invoice_details = DB::table('hdpos_receipt')->where('invoicedate','=',$today_date)->get();
        $items_list = Item::all();
        $selectTotal = DB::table('hdpos_receipt')
                 ->select(DB::raw('SUM(CAST(totalamount AS float8)) as totalamt'))
                 ->where('invoicedate',$today_date)->first();
        $usertotal = DB::table('hdpos_receipt')
                     ->select(DB::raw('SUM(CAST(totalamount AS float8)) as useramt'))
                     ->where('invoicedate',$today_date)
                     ->where('userid',$user)->first();
        $branch_stock = DB::table('addstock')
                        ->where('location',$branch)
                        ->sum('quantity');

        return view('home')->with('add_stock', $add_stock)
                           ->with('invoice_details',$invoice_details)
                           ->with('category',$category)
                           ->with('userslist',$userslist)
                           ->with('items_list',$items_list)
                           ->with('selectTotal',$selectTotal->totalamt)
                           ->with('usertotal',$usertotal->useramt)
                           ->with('branch_stock',$branch_stock);
    }
}
