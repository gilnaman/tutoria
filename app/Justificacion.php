<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justificacion extends Model
{
   protected $connection= 'mysql';
    protected $table='justificaciones';
    protected $with = ['tutor','alumno','motivo','carrera'];
    protected $dates = ['fecha_solicitud'];
   	// Se especificar la clave primaria
   	protected $primaryKey='folio';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=true;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'folio',
   	'periodo',
   	'grupo',
   	'modulos',
   	'id_carrera',
    'matricula',
    'id_motivo',
    'id_tutor',
    'comentario',
    'fecha_solicitud'
    
   	];

  // public function fechas()
  // {
  //   return $this->belongsToMany(Detalle_justificacion::class, 'folio');

  // }

  public function tutor(){
    
    return $this->belongsTo(Profesor::class, 'id_tutor', 'cedula');
  }

  public function motivo(){
    
    return $this->belongsTo(Motivo::class, 'id_motivo');
  }


  public function alumno(){
    
    return $this->belongsTo(Alumno::class, 'matricula');
  }

   public function carrera(){
    
    return $this->belongsTo(Carrera::class, 'id_carrera','idcarrera');
  }

  // public function motivo(){
    
  //   return $this->belongsTo(Motivo::class, 'id_motivo');
  // }




}
