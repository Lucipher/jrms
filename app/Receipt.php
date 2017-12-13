<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
 	protected $connection = 'pgsql';
    protected $primaryKey = 'id';
    protected $table = 'hdpos_receipt';
    protected $fillable = array
    	(
            'userid',
			      'invoicenumber',
            'invoicedate',
            'totalproduct',
            'totalquantity',
            'amount',
            'spotdiscountpercent',
            'spotdiscountamount',
            'totalamount',
            'status',
            'createdby',
            'modifiedby'
   		);
}
