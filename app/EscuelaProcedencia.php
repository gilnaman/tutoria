<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EscuelaProcedencia extends Model
{
    
    protected $connection= 'mysql';
    protected $table='escuelas_procedencia';

   	// Se especificar la clave primaria
   	protected $primaryKey='id_escuela';

   	
   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'id_escuela',
   	'nombre'    
   	];
}
