<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reboundstock extends Model
{
 	protected $connection='pgsql';
   	protected $table='reboundstock';
  	protected $fillable=array(
   				 'id',
            'product_name',
            'barcode',
            'from_location',
            'to_location',
            'quantity',
            'status',
            'created_by',
            'created_at',
            'updated_at'
    				
          );
}
