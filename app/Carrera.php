<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    	protected $connection= 'mysql';
    protected $table='carreras';

   	// Se especificar la clave primaria
   	protected $primaryKey='idcarrera';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'idCarrera',
   	'nombre',
   	'nombrelargo'
    
   	];
}
