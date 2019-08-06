<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{

	//Relaciono una tabla con el modelo
    protected $table='autos';

   	// Se especificar la clave primaria
   	protected $primaryKey='placa';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	   'placa',
   	   'modelo',
   	   'id_fabricante',
   	   'precio'
   	];
}
