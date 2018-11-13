<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sangre extends Model
{
    protected $connection= 'mysql';
    protected $table='tipos_sangre';

   	// Se especificar la clave primaria
   	protected $primaryKey='id_tipo_sangre';

   	//Solo cuando la PK no sea numerica
   	//public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'id_tipo_sangre',
   	'tipo'
   	
   	];
}
