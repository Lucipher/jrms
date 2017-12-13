<?php
namespace App\Http\Controllers;

class PagesController extends Controller {
  public function getHome() {
    return view('auth.login');
  }

  public function getInsertitem() {
    return view('Product.insertitem');
  }

  public function getItemlist() {
    return view('Product.modifyitem');
  }
}
?>
