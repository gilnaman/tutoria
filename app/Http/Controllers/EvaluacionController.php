<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\User;
class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupo=Session::get('grupo');
        $periodo=Session::get('periodo');
        
        $cargas=DB::select("SELECT d.Periodo,d.ClaveAsig,a.Nombre as asignatura,d.Cedula,concat(p.apellidop,' ',p.apellidom,' ',p.nombre) as profesor
            FROM (docentesporgrupo as d INNER JOIN asignaturas as a on a.ClaveAsig=d.ClaveAsig)
            INNER JOIN profesores as p on p.cedula=d.Cedula
            WHERE d.Periodo='$periodo' and d.ClaveGrupo='$grupo'
            ORDER BY a.Nombre asc");
        return $cargas;
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
        
        $usuario=User::find($id);
        return $usuario->presento;

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
