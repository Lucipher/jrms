<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $connection='pgsql';
  protected $table='suppliers';
  protected $fillable=array(
          'id',
          'supplier',
          'door_number',
          'street',
          'area',
          'city',
          'district',
          'state',
          'country',
          'pincode',
          'mobile',
          'phone',
          'email',
          'notes',
          'status',
          'created_by'

        );
}
