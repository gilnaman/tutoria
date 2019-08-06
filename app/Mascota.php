<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    //Relaciono una tabla con el modelo
    protected $table='mascotas';

   	// Se especificar la clave primaria
   	protected $primaryKey='id_mascota';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=true;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	   'id_mascota',
   	   'nombre',
   	   'edad'
   	];
}
