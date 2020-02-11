<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //
    protected $connection= 'mysql';
    protected $table='eventos';
    protected $with = ['tipo','grupos'];

   	// Se especificar la clave primaria
   	protected $primaryKey='id_evento';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Desactiva las etiquetas de tiempo
   	public $timestamps=true;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'id_evento',
   	'id_tipo',
   	'fecha_evento',
   	'titulo',
   	'expositor',
   	'periodo',
   	'descripcion',
   	];


  public function tipo()
  {
    return $this->belongsTo(TipoEvento::class, 'id_tipo','id_tipo');

  }

   public function grupos()
    {
        return $this->hasMany('App\Evento_Grupo','id_evento','id_evento');
    }

   	


}
