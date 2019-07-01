<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
	protected $connection= 'mysql';
    protected $table='alumnos';
    protected $with = ['villa','sangre','carrera','municipio',
    'beca','tutor','periodo','escuela'];

   	// Se especificar la clave primaria
   	protected $primaryKey='matricula';

   	//Solo cuando la PK no sea numerica
   	public $incrementing=false;

   	//Activo las etiquetas de tiempo
   	public $timestamps=true;

   	//Definimos los campos que van a recibir valor
   	protected $fillable=[
   	'matricula',
   	'nombre',
   	'apellidop',
   	'apellidom',
    'idcarrera',  // foranea apunta a carreras
    'l_procedencia',
    'celular',
    'email',
    'calle',
    'cruzamiento',
    'localidad',
    'id_municipio', // Foranea apunta a municipios
    'curp',
    'tel_casa',
    'lugar_nac',
    'fecha_nac',
    'id_beca',  // Foranea  que apunta a becas
    'tiene_beca',
    'edad',
    'padre',
    'madre',
    'trabaja',
    'dl_empresa',
    'dl_direccion',
    'dl_depto',
    'dl_telefono',
    'dl_jefe',
    'dl_horario',
    'dl_puesto',
    'id_villa',  // Foranea apunta a modelo villas
    'id_tipo_sangre',  // Foranea apunta a sangres
    'claveperiodo', // Foranea apunta a tabla periodos
    'anio',
    'cedula',   // Foranea apunta a modelo profesores
    'nss',
    'contacto',
    'tel_contacto',
    'pade_fisico',
    'enfermedad',
    'alergia',
    'plantel_procedencia',
    'foto',
    'id_escuela'

    
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

  public function municipio()
  {
    return $this->belongsTo(Municipio::class, 'id_municipio');
  }

  public function beca()
  {
    return $this->belongsTo(Beca::class, 'id_beca');
  }

  public function tutor()
  {
    return $this->belongsTo(Profesor::class, 'cedula');
  }

  public function periodo()
  {
    return $this->belongsTo(Periodo::class, 'claveperiodo');
  }

  public function escuela()
  {
    return $this->belongsTo(EscuelaProcedencia::class, 'id_escuela');
  }


    
}
