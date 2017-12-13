<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Item;
use Auth;
use App\Category;
use App\Subcategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\View;
use DB;



class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$results = jrms::select(jrms::raw("SELECT category FROM categories"));
      return view::make('Product.insertitem')
        ->with('categories',Category::all());

        //->with('subcategories',Subcategory::all());
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
      //Validating Data
      $this->validate($request, array(
        'bnumber' => 'required|max:255',
        'itemname' => 'required'
      ));
      //Storing in database
      try {
          $user = Auth::user();
          $item = new Item;
          $item->bnumber = $request->bnumber;
          $item->itemname = $request->itemname;
          $item->openstock = $request->openstock;
          $item->minstock = $request->minstock;
          $item->isactive = $request->input('isactive');
          $item->notforsale = $request->input('notforsale');
          $item->ispurchased = $request->input('ispurchased');
          $item->online = $request->input('online');
          if ($item->isactive == null) {
            $item->isactive = 'f';
          }
          if ($item->notforsale == null) {
            $item->notforsale = 'f';
          }
          if ($item->ispurchased == null) {
            $item->ispurchased = 'f';
          }
          if ($item->online == null) {
            $item->online = 'f';
          }
          // $item->suppname = $request->input('suppname');
          $item->categoryname = $request->categoryname;
          $item->subcategoryname = $request->subcategoryname;
          if($item->subcategoryname==""){

          }
          else {
          $item->desc = $request->desc;
          if($request->hasFile('featured_image'))
          {
            $image = $request->file('featured_image');
            $filename = $item->bnumber.'.'.$image->getClientOriginalExtension();
            $location = public_path('images/item_images/'.$filename);
            Image::make($image)->save($location);//->resize(500,500)
            $item->featured_image = $filename;
          }
          else
          {
            $item->featured_image = "Error";
          }
          $item->mrp = $request->mrp;
          $item->disc1 = $request->disc1;
          if($request->disc2==null) {
            $item->disc2 = 'Error';
          }
          if($request->disc1==null) {
            $item->disc2 = 'Error';
          }
          //$item->disc2 = $request->disc2;
          $item->discvalue = $request->discvalue;
          $item->finalprice = $request->finalprice;
          $item->createdby = $user->name;
          $item->modifiedby = $user->name;
          $item->save();
          return redirect()->back()->withItem($item);
          //return view('items.insert');
          }
      }
      catch (\Exception $e)
      {
        return $e->getMessage();
      }
    }

    public function modify(Request $request)
    {
      try
      {
        $item = new Item;
        $chkvalue = $_REQUEST['chkvalue'];
        $bnumber = $_REQUEST['bnumber'];
        $itemname = $_REQUEST['itemname'];
        $openstock = $_REQUEST['openstock'];
        $minstock = $_REQUEST['minstock'];
        $isactive = $_REQUEST['isactive'];
        $notforsale = $_REQUEST['notforsale'];
        $ispurchased = $_REQUEST['ispurchased'];
        $online = $_REQUEST['online'];
        // $suppname = $_REQUEST['suppname'];
        $categoryname = $_REQUEST['categoryname'];
        $subcategoryname = $_REQUEST['subcategoryname'];
        $desc = $_REQUEST['desc'];
        // $item->featured_image = DB::table('items')
        //     ->select('featured_image')
        //     ->where('itemname',$chkvalue)
        //     ->orWhere('bnumber',$chkvalue);
        //$featured_image = $_REQUEST['featured_image'];
        // if($request->hasFile('featured_image')) {
        //   $image = $request->file('featured_image');
        //   $filename = $item->bnumber.'.'.$image->getClientOriginalExtension();
        //   $location = public_path('images/item_images/'.$filename);
        //   Image::make($image)->save($location);//->resize(500,500)
        //   $item->featured_image = $filename;
        // }
        // else {
        //   $item->featured_image = "Error";
        // }
        $mrp = $_REQUEST['mrp'];
        // $disc1 = $_REQUEST['disc1'];
        // $disc2 = $_REQUEST['disc2'];

        $item->disc1 = $request->disc1;
        $item->disc2 = $request->disc2;

        if($item->disc1==null) {
          $item->disc2 = $request->disc2;
          $item->disc1 = 'null';
        }
        elseif ($request->disc2==null) {
          $item->disc2 = 'null';
          $item->disc1 = $request->disc1;
        }

        if($request->disc1==null) {
          $item->disc2 = 'novalue';
        }
        if($request->disc2==null) {
          $item->disc2 = 'null';
        }


        $discvalue = $_REQUEST['discvalue'];
        $finalprice = $_REQUEST['finalprice'];//'featured_image'=>$item->featured_image,
        $upt=DB::table('items')
            ->where('itemname',$chkvalue)
            ->orWhere('bnumber',$chkvalue)
            ->update(['bnumber' => $bnumber,'itemname'=>$itemname,'openstock'=>$openstock,'minstock'=>$minstock,
          'isactive'=>$isactive,'notforsale'=>$notforsale,'ispurchased'=>$ispurchased,'online'=>$online,'suppname'=>$suppname,
        'categoryname'=>$categoryname,'subcategoryname'=>$subcategoryname,'desc'=>$desc,
      'mrp'=>$mrp,'disc1'=>$item->disc1,'disc2'=>$item->disc2,'discvalue'=>$discvalue,'finalprice'=>$finalprice]);
        echo $upt;
      }
      catch(\Exception $e)
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $item = Item::find($id);
        // console.log("Success");
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
