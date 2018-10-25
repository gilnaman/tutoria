<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
	protected $connection= 'mysql';
    protected $table='alumnos';

   	// Se especificar la clave primaria
   	protected $primaryKey='matricula';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'matricula',
   	'nombre',
   	'apellidop',
   	'apellidom',
    'foto'
    
   	];

 public function getFullNameAttribute() {
        return ucfirst($this->apellidop) . ' ' . ucfirst($this->apellidom)
        . ' '. ucfirst($this->nombre);
    }


    
}
