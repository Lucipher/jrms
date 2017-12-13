<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExhibitStock extends Model
{
    protected $connection='pgsql';
   	protected $table='exhibitstock';
    protected $fillable=array(
   				  'id',
            'product_name',
            'product_id',
            'barcode',
            'supplier',
            'invoice_number',
            'billed_date',
            'received_date',
            'from_location',
            'to_location',
            'quantity',
            'status',
            'created_by',
            'created_at',
            'updated_at'

          );

}
