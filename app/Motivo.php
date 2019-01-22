<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
    
    protected $connection= 'mysql';
    protected $table='motivos';

   	// Se especificar la clave primaria
   	protected $primaryKey='id_motivo';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=true;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'id_motivo',
   	'motivo'   	  
   	];
}
