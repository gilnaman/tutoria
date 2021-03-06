<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Alumno;
use DB;
class ApiAlumnadoGralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //  return $alumnos = Alumno::where('bajatemporal','=','0')
        // ->where('bajadefinitiva','=','0')
        // ->orderBy('apellidop','asc')
        // ->get();

        return $alumnos=DB::select("SELECT al.clave_grupo,al.matricula,
                                    alumnos.apellidop,
                                    alumnos.apellidom,
                                    alumnos.nombre
                                    FROM alumnos_grupo as al INNER JOIN alumnos on alumnos.matricula=al.matricula
                                    WHERE al.periodo='2020A'
                                    ORDER BY al.clave_grupo ASC, apellidop ASC,apellidom ASC");
           
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
