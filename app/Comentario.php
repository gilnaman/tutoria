<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    
     protected $table='respuestas_com';
    protected $primaryKey='id';
    public $incrementing=true;
    public $timestamps=false;
}
