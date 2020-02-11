<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ApiResumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function becados(){
        // $grupo='TTS-4A';
        // $periodo='2018C';

        $grupo=Session::get('grupo');
        $periodo=Session::get('periodo');



        $becas=DB::select("SELECT Count(alumnos.tiene_beca) as becados
            FROM alumnos INNER JOIN alumnos_grupo ON alumnos_grupo.matricula=alumnos.matricula
            WHERE NOT ISNULL(alumnos.id_beca)
            AND alumnos_grupo.clave_grupo='$grupo' 
            AND alumnos.tiene_beca='Si' 
            AND alumnos_grupo.periodo='$periodo'" );

         $villas=DB::select("SELECT count(alumnos.tiene_villa) as villas
            FROM alumnos INNER JOIN alumnos_grupo ON alumnos.matricula=alumnos_grupo.matricula
            WHERE NOT ISNULL(alumnos.id_villa) AND id_villa<>0
            AND alumnos_grupo.clave_grupo='$grupo' 
            AND alumnos_grupo.periodo='$periodo'");

         
         $justificaciones=DB::select("SELECT COUNT(folio) as justificaciones
            FROM justificaciones
            WHERE periodo='$periodo' AND grupo='$grupo'
            AND cancelado=0");
         
        
     
        return response()->json([
                    "becados" => $becas[0]->becados,
                    "villas" => $villas[0]->villas,
                    "justificaciones"=>$justificaciones[0]->justificaciones
                 ]);
    }

    public function listaBecados()
    {
        $grupo=Session::get('grupo');
        $periodo=Session::get('periodo');

        $listaBecados=DB::select("SELECT UCASE(becas.nombre) as tipo_beca,A.matricula,Concat(A.apellidop,' ',A.apellidom,' ',A.nombre) AS alumno
            FROM    (alumnos AS A INNER JOIN alumnos_grupo ON alumnos_grupo.matricula = A.matricula)
            INNER JOIN becas ON becas.id_beca=A.id_beca
            WHERE alumnos_grupo.clave_grupo = '$grupo'
            AND NOT ISNULL(tiene_beca)
            AND alumnos_grupo.periodo = '$periodo'
            ORDER BY becas.nombre DESC, A.apellidop ASC");

        return $listaBecados;

    }

    public function listaVillas()
    {
            $grupo=Session::get('grupo');
            $periodo=Session::get('periodo');
            
            $listaVillas=DB::select("SELECT A.matricula,
            Concat(A.apellidop,' ',A.apellidom,' ',A.nombre) as alumno,villas.direccion
            FROM (alumnos as A INNER JOIN alumnos_grupo on alumnos_grupo.matricula=A.matricula)
            INNER JOIN villas on villas.id_villa=A.id_villa
            WHERE alumnos_grupo.clave_grupo='$grupo'  
            AND alumnos_grupo.periodo='$periodo'
            ORDER BY villas.nombre ASC, A.apellidop ASC");
            return $listaVillas;
    }


}
