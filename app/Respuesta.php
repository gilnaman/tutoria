<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    //



    protected $table='respuestas';
    protected $primaryKey='id';
    public $incrementing=true;
    public $timestamps=false;
}
