<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockLocation extends Model
{
    protected $connection='pgsql';
   	protected $table='location_stock';
  	protected $fillable=array(
   				  'id',
            'location',
      );
}
