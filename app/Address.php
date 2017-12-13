<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
 	protected $connection = 'pgsql';
    protected $primaryKey = 'id';
    protected $table = 'address';
    protected $fillable = array
    	(
			'salutation',
			'name',
			'gender',
			'address1',
			'address2',
			'address3',
			'address4',
			'district',
			'pincode',
			'state',
			'country',
			'phone',
			'mobile1',
			'mobile2',
			'email',
			'bday',
			'wday',
			'occupation',
			'nameofchurch',
			'language',
			'addressyear',
			'mode',
			'remarks',
			'status',
			'createdby',
			'modifiedby'
   		);
}
