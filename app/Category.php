<?php

namespace App;
use Eloquent;
use Illuminate\Database\Eloquent\Model;


class Category extends Eloquent
{
    //protected $table = 'categories';
    //public static $table = 'categories';
    public $timestamps = false;
    protected $fillable = ['category'];
    public function items()
    {
      return $this->hasMany('App\Post');
    }
}
