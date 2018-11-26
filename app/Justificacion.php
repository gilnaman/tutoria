<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justificacion extends Model
{
   protected $connection= 'mysql';
    protected $table='justificaciones';

   	// Se especificar la clave primaria
   	protected $primaryKey='folio';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=false;

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
    'comentario'
    
   	];

  public function fechas()
  {
    return $this->belongsToMany(Detalle_justificacion::class, 'folio','folio');

  }

}
