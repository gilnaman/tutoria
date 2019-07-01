<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    protected $connection= 'mysql';
    protected $table='villas';

   	// Se especificar la clave primaria
   	protected $primaryKey='id_villa';

   	//Solo cuando la PK no sea numerica
   	//public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'id_villa',
   	'nombre',
   	'direccion'   
   	];

    protected $hidden=['inactivo'];
}
