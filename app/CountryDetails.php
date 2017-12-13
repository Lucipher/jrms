<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryDetails extends Model
{
  protected $connection='pgsql';
  protected $table='country';
  protected $fillable=array(
          'id',
          'area',
          'district',
          'state',
          'country',
    );
}
