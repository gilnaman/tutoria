<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Alumno;
use Session;
use DB;

class ApiAlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grupo = Session::get('grupo');
        // $alumno = Alumno::where('grupoactual','=',$grupo)
        // ->where('bajadefinitiva','=','0')
        // ->get();


        $alumno = DB::select("SELECT alumnos.matricula,alumnos.apellidop,alumnos.apellidom,alumnos.nombre 
            FROM alumnos_grupo INNER JOIN alumnos on alumnos.matricula=alumnos_grupo.matricula  
            where alumnos_grupo.clave_grupo='$grupo'");
        return $alumno;

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
}
