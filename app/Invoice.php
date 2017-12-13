<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'id';
    protected $table = 'hdpos_invoice';
    protected $fillable = array
        (
            'invoicenumber',
            'invoicedate',
            'itemid',
            'amount',
            'quantity',
            'discount',
            'discountchkbox',
            'spotdiscountchkbox',
            'spotdiscountpercent',
            'spotdiscountamount',
            'status',
            'createdby',
            'modifiedby'
        );
}