<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

class AutoCompleteController extends Controller {

    public function index(){
        return view('modifyitem');
   }

    public function autoComplete(Request $request) {
        $query = $request->get('wrapper','');

        $products=Product::where('bnumber','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($products as $product) {
                $data[]=array('value'=>$product->name,'id'=>$product->id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

}
