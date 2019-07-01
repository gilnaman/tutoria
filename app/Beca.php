<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beca extends Model
{
  	protected $connection= 'mysql';
    protected $table='becas';

    protected $primaryKey='id_beca';

    protected $hidden=[
    	'inactivo'
    ];
}
