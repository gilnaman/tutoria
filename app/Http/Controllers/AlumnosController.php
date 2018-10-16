<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;
use Session;
use biblioUtc\Http\Requests;
use biblioUtc\Alumno;
use DB;

class AlumnosController extends Controller
{
    //

    public function cardex($matricula)
    {	
    


    	if (Session('matricula') == $matricula)
    	{

	    	$alumnos = DB::connection('mysql')
	    	->table('alumnos')
	    	->join('carreras','carreras.idcarrera','=','alumnos.idcarrera')
	    	->select('alumnos.*','carreras.nl')
	    	->where('matricula','=',$matricula)
	    	->first();

	    	$sangres=DB::connection('mysql')
    		->table('tipos_sangre')->get();

    		$villas=DB::connection('mysql')
    		->table('villas')->get();

            $periodos=DB::connection('mysql')
            ->table('cat_periodos')->get();


	    	return view('alumnos.create2')
	    	->with("alumnos",$alumnos)
	    	->with("sangres",$sangres)
            ->with('periodos',$periodos)
	    	->with("villas",$villas);

	    	//return view('alumnos.index');
	    }
	    else
	    {
	    	return Redirect::to('logout');
	    	//return 'Sesion: '. (Session('matricula')). ' matricula '. $matricula . ' no autorizado';

	    }

	 
	 
    	//->with("datos",$alumnos);
    }

    public function index()
    {
    	$alumnos=DB::connection('mysql')
    	->table('alumnos')->get();

    	

    	return view('alumnos.index')
    	->with("alumnos",$alumnos);
    	

    }


    public function update(Request $request, $matricula)
    {
    	$alumno=Alumno::findOrFail($matricula);
        
        // DATOS GENERALES 
        $alumno->id_periodo=$request->get('id_periodo');
        $alumno->anio=$request->get('anio');
         $alumno->tutor=$request->get('tutor');

         //DATOS ACADEMICOS

        //if (Input::hasFile('imagen')){
          //  $file=Input::file('imagen');
           
            
        //}

          //obtenemos el campo file definido en el formulario
       $file = $request->file('imagen'); 
       
      if($file!=null) 
      {
        $nombre = $file->getClientOriginalName();
        
        
            $file->move(public_path().'/imagenes/alumnos/',$matricula.'.jpg');
            $alumno->foto=$matricula.'.jpg';
        }
       //obtenemos el nombre del archivo
      
        //var_dump($file);

        $alumno->curp=$request->get('curp');
    	$alumno->email=$request->get('email');
    	$alumno->celular=$request->get('celular');
    	$alumno->calle=$request->get('calle');
    	$alumno->cruzamiento=$request->get('cruzamiento');
    	$alumno->localidad=$request->get('localidad');
    	$alumno->municipio=$request->get('municipio');
    	$alumno->curp=$request->get('curp');
    	$alumno->tel_casa=$request->get('tel_casa');
    	$alumno->lugar_nac=$request->get('lugar_nac');
        $alumno->fecha_nac=$request->get('fecha_nac');
        $alumno->edad=$request->get('edad');
        $alumno->tiene_beca=$request->get('tiene_beca');
        $alumno->tipo_beca=$request->get('tipo_beca');
        $alumno->nss=$request->get('nss');
        $alumno->pade_fisico=$request->get('pade_fisico');
        $alumno->enfermedad=$request->get('enfermedad');
        $alumno->alergia=$request->get('alergia');
        $alumno->plantel_procedencia=$request->get('plantel_procedencia');


        $alumno->tel_contacto=$request->get('tel_contacto');


    	$alumno->dl_empresa=$request->get('dl_empresa');
    	$alumno->dl_direccion=$request->get('dl_direccion');
    	$alumno->dl_depto=$request->get('dl_depto');
    	$alumno->dl_telefono=$request->get('dl_telefono');
    	$alumno->dl_jefe=$request->get('dl_jefe');
    	$alumno->dl_horario=$request->get('dl_horario');
    	$alumno->dl_puesto=$request->get('dl_puesto');
    	$alumno->id_tipo_sangre=$request->get('id_tipo_sangre');
    	$alumno->id_villa=$request->get('id_villa');
    	
    	$alumno->madre=$request->get('madre');
        $alumno->padre=$request->get('padre2');

    	$alumno->update();

    	Session::flash('sucess', "Tu ficha se ha actualizado");
		return Redirect::back()
        ->with('success','Tu ficha se ha actualizado');

    
    }
}

