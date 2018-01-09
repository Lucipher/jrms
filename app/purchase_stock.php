<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchase_stock extends Model
{
  protected $connection='pgsql';
  protected $table='purchase_details';
  protected $fillable=array(
          'id',
          'supplier',
          'invoice_number',
          'billed_date',
          'received_date',
          'product_name',
          'product_id',
          'barcode',
          'location',
          'quantity',
          'notes',
          'status',
          'created_by'

        );
}
