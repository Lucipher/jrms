<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptItems extends Model
{
 	protected $connection = 'pgsql';
    protected $primaryKey = 'id';
    protected $table = 'hdpos_receiptitems';
    protected $fillable = array
    	(
			'receiptid',
            'itemid',
            'amount',
            'quantity',
            'discount',
            'discountchkbox',
            'spotdiscountchkbox',
            'spotdiscountpercent',
            'spotdiscountamount'
   		);
}