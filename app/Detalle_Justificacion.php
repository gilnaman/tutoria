<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Justificacion extends Model
{
    protected $connection= 'mysql';
    protected $table='detalle_justificaciones';

   	// Se especificar la clave primaria
   	protected $primaryKey='id';

   	//Solo cuando la PK no sea numerica
   	//public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'folio',
   	'fecha'
   	];
}
