<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockAdd extends Model
{
    protected $connection='pgsql';
   	protected $table='addstock';
  	protected $fillable=array(
   				  'id',
            'product_name',
            'product_id',
            'barcode',
            'supplier',
            'invoice_number',
            'billed_date',
            'received_date',
            'location',
            'quantity',
            'notes',
            'status',
            'created_by'

          );
}
