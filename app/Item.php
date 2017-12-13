<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  //public static $table = 'items';
    //protected $table = 'items';

    public function category()
    {
      return $this->belongsTo('App\Category');
    }
}
