<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Subcategory;
use App\Category;
use DB;
use Illuminate\Support\Facades\Input;

class SubcategoryController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubcategory()
    {
      $subcategories = Subcategory::all();
      return view('Product.insertitem')->withSubcategories($subcategories);
      return view('Product.modifyitem')->withSubcategories($subcategories);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
      try {
        //$id = Subcategory::orderBy('id', 'desc')->first()->id;
        $id = DB::table('subcategories')->count();
        $subcatadd = new Subcategory;
        $subcatadd->id = $id+1; //Subcategory Id
        $subcatadd->subcategory = $request->subcat; //New Subcategory
        $temp = $request->input('categoryname');//English

        $catid = Category::select('id')->where('category','=',$temp)->pluck('id');
        $catid = $catid[0];
        //$catid = DB::select("select id from categories where category='.$temp.'");
        $subcatadd->category_id = $catid;
        $subcatadd->save();
        return redirect()->back();
      }
      catch (\Exception $e)
      {
        return $e->getMessage();
      }
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
