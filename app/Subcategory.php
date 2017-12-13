<?php

namespace App;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Eloquent
{
  public $timestamps = false;
  protected $fillable = ['subcategory','category_id'];
  //protected $table = 'subcategories';
  //public static $table = 'subcategories';
}
