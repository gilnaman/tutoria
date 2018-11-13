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
    'foto',
    'id_villa',
    'id_tipo_sangre'
    
   	];

    public function getFullNameAttribute() {
        return ucfirst($this->apellidop) . ' ' . ucfirst($this->apellidom)
        . ' '. ucfirst($this->nombre);
    }

  public function villa()
  {
    return $this->belongsTo(Villa::class, 'id_villa');

  }

  public function sangre()
  {
    return $this->belongsTo(Sangre::class, 'id_tipo_sangre');

  }


  public function carrera()
  {
    return $this->belongsTo(Carrera::class, 'idcarrera');

  }


    
}
