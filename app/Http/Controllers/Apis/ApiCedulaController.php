<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use App\Alumno;

class ApiCedulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Alumno::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $matricula=$request->get('matricula');

          $alumno=Alumno::find($matricula);

          
        
       // DATOS GENERALES 
        $alumno->claveperiodo=$request->get('claveperiodo');
        $alumno->anio=$request->get('anio');
        $alumno->cedula=$request->get('cedula');

         //DATOS ACADEMICOS

      //   //if (Input::hasFile('imagen')){
      //     //  $file=Input::file('imagen');
           
            
      //   //}

      //     //obtenemos el campo file definido en el formulario
       $file = $request->file('foto'); 
       
      if($file!=null) 
      {
        $nombre = $file->getClientOriginalName();
        
        
            $file->move(public_path().'/imagenes/alumnos/',$matricula.'.jpg');
            $alumno->foto=$matricula.'.jpg';
        }
   

        $alumno->curp=$request->get('curp');
        $alumno->email=$request->get('email');
        $alumno->celular=$request->get('celular');
        $alumno->calle=$request->get('calle');
        $alumno->cruzamiento=$request->get('cruzamiento');
        $alumno->localidad=$request->get('localidad');
        $alumno->id_municipio=$request->get('id_municipio');
        $alumno->curp=$request->get('curp');
        $alumno->tel_casa=$request->get('tel_casa');
        $alumno->lugar_nac=$request->get('lugar_nac');
        $alumno->fecha_nac=$request->get('fecha_nac');
        $alumno->edad=$request->get('edad');
        $alumno->tiene_beca=$request->get('tiene_beca');
        $alumno->id_beca=$request->get('id_beca');
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
        
        $alumno->tiene_villa=$request->get('tiene_villa');
        $alumno->id_villa=$request->get('id_villa');
        $alumno->contacto=$request->get('contacto');
        
        $alumno->madre=$request->get('madre');
        $alumno->padre=$request->get('padre');
        $alumno->trabaja=$request->get('trabaja');

        
        $alumno->update();
        return $alumno;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno=Alumno::find($id);
        return $alumno;


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $alumno=Alumno::find($id);
        
      //   // DATOS GENERALES 
        // $alumno->claveperiodo=$request->get('claveperiodo');
        // $alumno->anio=$request->get('anio');
        //  $alumno->cedula=$request->get('cedula');

         //DATOS ACADEMICOS

      //   //if (Input::hasFile('imagen')){
      //     //  $file=Input::file('imagen');
           
            
      //   //}

      //     //obtenemos el campo file definido en el formulario
      //  $file = $request->file('foto'); 
       
      // if($file!=null) 
      // {
      //   $nombre = $file->getClientOriginalName();
        
        
      //       $file->move(public_path().'/imagenes/alumnos/',$id.'.jpg');
      //       $alumno->foto=$id.'.jpg';
      //   }
   

        // $alumno->curp=$request->get('curp');
        // $alumno->email=$request->get('email');
        // $alumno->celular=$request->get('celular');
        // $alumno->calle=$request->get('calle');
        // $alumno->cruzamiento=$request->get('cruzamiento');
        // $alumno->localidad=$request->get('localidad');
        // $alumno->id_municipio=$request->get('id_municipio');
        // $alumno->curp=$request->get('curp');
        // $alumno->tel_casa=$request->get('tel_casa');
        // $alumno->lugar_nac=$request->get('lugar_nac');
        // $alumno->fecha_nac=$request->get('fecha_nac');
        // $alumno->edad=$request->get('edad');
        // $alumno->tiene_beca=$request->get('tiene_beca');
        // $alumno->id_beca=$request->get('id_beca');
        // $alumno->nss=$request->get('nss');
        // $alumno->pade_fisico=$request->get('pade_fisico');
        // $alumno->enfermedad=$request->get('enfermedad');
        // $alumno->alergia=$request->get('alergia');
        // $alumno->plantel_procedencia=$request->get('plantel_procedencia');


        // $alumno->tel_contacto=$request->get('tel_contacto');


        // $alumno->dl_empresa=$request->get('dl_empresa');
        // $alumno->dl_direccion=$request->get('dl_direccion');
        // $alumno->dl_depto=$request->get('dl_depto');
        // $alumno->dl_telefono=$request->get('dl_telefono');
        // $alumno->dl_jefe=$request->get('dl_jefe');
        // $alumno->dl_horario=$request->get('dl_horario');
        // $alumno->dl_puesto=$request->get('dl_puesto');
        // $alumno->id_tipo_sangre=$request->get('id_tipo_sangre');
        // $alumno->id_villa=$request->get('id_villa');
        
        // $alumno->madre=$request->get('madre');
        // $alumno->padre=$request->get('padre');


        $alumno->update();

   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAlumnoToCedula(){
        // Obtenemos los datos de un alumno
        $periodo=Session::get('periodo');
        // return $periodo;
        $matricula = Session::get('matricula');
        // return $matricula;

        $alumno = DB::select("SELECT alumnos_grupo.clave_grupo,alumnos.*
FROM alumnos INNER JOIN alumnos_grupo ON alumnos.matricula=alumnos_grupo.matricula
WHERE alumnos_grupo.periodo='$periodo' AND alumnos_grupo.matricula='$matricula'");

        return $alumno;
    }
}
