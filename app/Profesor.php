<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    

    protected $connection= 'mysql';
    protected $table='profesores';

   	// Se especificar la clave primaria
   	protected $primaryKey='cedula';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'cedula',
   	'apellidop',
   	'apellidom',
   	'nombre',
    'tratamiento',
    'profesion'
    
   	];
}
