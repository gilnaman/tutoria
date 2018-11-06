<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    	protected $connection= 'mysql';
    protected $table='grupos';

   	// Se especificar la clave primaria
   	protected $primaryKey='clavegrupo';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'clavegrupo',
   	'periodo',
   	'idcarera',
   	'grado',
    'grupo',
    'cupo',
    'claveplan',
    'inscritos',
    'bajas',
    'fechacreacion',
    'creador',
    'idtutor'

    
   	];
}
