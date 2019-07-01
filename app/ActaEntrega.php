<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaEntrega extends Model
{
    protected $connection= 'mysql';
    protected $table='actas_entrega';
    protected $with=['grupo'];
    //protected $with = ['tutor','alumno','motivo','carrera'];
    protected $dates = ['fecha_entrega','fecha_planeada','fecha_subida'];
   	// Se especificar la clave primaria
   	protected $primaryKey='Acta';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'Acta',
   	'fecha_entrega',
   	'fecha_planeada',
   	'fecha_subida',
   	'claveGrupo',
    'claveAsig',
    'ClavePeriodo',
    'unidad',
    'ponderacion',
    'tipo_unidad',
    'promedio',
    'promedio_ajustado'
    
   	];

  // public function fechas()
  // {
  //   return $this->belongsToMany(Detalle_justificacion::class, 'folio');

  // }

  public function grupo(){
    
    return $this->belongsTo(Grupo::class, 'claveGrupo', 'clavegrupo');
  }

  // public function motivo(){
    
  //   return $this->belongsTo(Motivo::class, 'id_motivo');
  // }
}
