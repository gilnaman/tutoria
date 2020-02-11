<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento_Grupo extends Model
{
    protected $connection= 'mysql';
    protected $table='eventos_grupos';
    // protected $with = ['tipo'];

   	// Se especificar la clave primaria
   	protected $primaryKey='id';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=true;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'id_evento',
   	'id_grupo',
   	
   	];
}
