<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movestock extends Model
{
    protected $connection='pgsql';
   	protected $table='movestock';
  	protected $fillable=array(
   			    'id',
            'product_name',
            'product_id',
            'barcode',
            'from_location',
            'to_location',
            'quantity',
            'status',
            'notes',
            'created_by',
            'created_at',
            'updated_at'


          );
}
