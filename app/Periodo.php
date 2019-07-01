<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $connection= 'mysql';
    protected $table='periodos';

   	// Se especificar la clave primaria
   	protected $primaryKey='claveperiodo';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'claveperiodo',
   	'inicio',
   	'fin',
   	'cerrado',
    'activo',
    'nombregenerico'
    
   	];

    protected $hidden=[
      'activo',
      'cerrado'
    ];

}
