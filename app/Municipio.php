<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    //
    protected $connection= 'mysql';
    protected $table='municipios';

    protected $primaryKey='id_municipio';
}
