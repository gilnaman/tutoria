<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;
use Session;
use App\Http\Requests;
use App\Alumno;
use App\Grupo;
use DB;

class AlumnosController extends Controller
{
    //

    public function cardex($matricula)
    {	
    


    	if (Session('matricula') == $matricula)
    	{

        $datos = Alumno::where('matricula','=',$matricula)->first();
        $grupo=$datos->grupoactual;

        
        
        $datgrup=Grupo::where('clavegrupo','=',$grupo)->first();
        $mitutor=$datgrup->idtutor;

        

        $dato_tutor=DB::connection('mysql')
        ->table('profesores')
        ->where('cedula','=',$mitutor)
        ->select('tratamiento','apellidop','apellidom','nombre')
        ->first();

        //return response()->json($dato_tutor);
        $mitutor = $dato_tutor->tratamiento .' ' .$dato_tutor->nombre . ' '. $dato_tutor->apellidop. ' '.$dato_tutor->apellidom;
        //return $mitutor;

	    	$alumnos = DB::connection('mysql')
	    	->table('alumnos')
	    	->join('carreras','carreras.idcarrera','=','alumnos.idcarrera')
	    	->select('alumnos.*','carreras.nombrelargo')
	    	->where('matricula','=',$matricula)
	    	->first();

	    	$sangres=DB::connection('mysql')
    		->table('tipos_sangre')->get();

    		$villas=DB::connection('mysql')
    		->table('villas')->get();

            $periodos=DB::connection('mysql')
            ->table('cat_periodos')->get();


	    	return view('alumnos.create')
	    	->with("alumnos",$alumnos)
	    	->with("sangres",$sangres)
            ->with('periodos',$periodos)
	    	->with("villas",$villas)
            ->with('tutor',$mitutor);

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
        $alumnos = Alumno::where('grupoactual','=','TTS-4A')
        ->where('bajatemporal','=','0')
        ->where('bajadefinitiva','=','0')
        ->paginate(20);

      return view('tutor.panel_tutor')
      ->with('alumnos',$alumnos);
        
        
    }

/*
    public function index()
    {
    	$alumnos=DB::connection('mysql')
    	->table('alumnos')->get();

    	

    	return view('alumnos.index')
    	->with("alumnos",$alumnos);
    	

    }
    */

public function edit($id)
    {
        $alumnos = DB::connection('mysql')
            ->table('alumnos')
            ->join('carreras','carreras.idcarrera','=','alumnos.idcarrera')
            ->select('alumnos.*','carreras.nombrelargo')
            ->where('matricula','=',$id)
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

