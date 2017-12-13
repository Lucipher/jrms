<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Auth;
use App\User;
use App\StockLocation;
use Hash;
use DB;

class AuthController extends Controller
{
    //
    public function index()
    {
      $data = StockLocation::orderBy('location', 'ASC')->get();
      return view('product.userregistration')->withData($data);
    }

    public function store(Request $request)
    {
      try
      {
        $user = new User;
        $id = User::orderBy('id', 'desc')->first()->id;
        $user->id = $id+1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->addr1 = $request->addr1;
        $user->addr2 = $request->addr2;
        $user->city = $request->city;
        $user->pincode = $request->pincode;
        $user->mobile = $request->mobile;
        $user->branch = $request->branch;
        $user->save();
        return redirect()->back();
        //return view('items.insert');
      }
      catch (\Exception $e)
      {
        return $e->getMessage();
      }
    }

    public function changepwd(Request $request)
    {
      try
      {
          $password = Hash::make($request->newpwd);
          $Update_user=DB::update("UPDATE users SET password = '$password' WHERE email='$request->useremail' ");
      }
      catch(\Exception $e)
      {
        return $e->getMessage();
      }
    }
}
