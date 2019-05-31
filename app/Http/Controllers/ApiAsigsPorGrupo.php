<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ApiAsigsPorGrupo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$periodo='2019B';
        //$cedula='01';

        $periodo=Session::get('periodo');
        $cedula=Session::get('cedula');

        //return $periodo;

        $carga=DB::select("SELECT Doc.ClaveGrupo,Doc.ClaveAsig,
            asignaturas.Nombre as Asignatura
        FROM docentesporgrupo as Doc INNER JOIN asignaturas 
        ON asignaturas.ClaveAsig=Doc.ClaveAsig
        WHERE Doc.Periodo='$periodo' AND Doc.Cedula='$cedula'
        ORDER BY Doc.ClaveGrupo ASC, Asignatura ASC");

        return $carga;

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
        $carga=DB::select("SELECT Doc.ClaveGrupo,Doc.ClaveAsig,asignaturas.Nombre 
        from docentesporgrupo as Doc INNER JOIN asignaturas 
        on asignaturas.ClaveAsig=Doc.ClaveAsig
        WHERE Doc.Periodo='2018C'");

        return $carga;
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
