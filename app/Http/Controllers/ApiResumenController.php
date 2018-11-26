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



        $becas=DB::select("SELECT Count(*) as becados
                    from alumnos inner join grupos 
                    on grupos.clavegrupo=alumnos.grupoactual
                    where alumnos.tipo_beca<>'' 
                    and alumnos.grupoactual='$grupo' 
                    and alumnos.tiene_beca='Si' 
                    and grupos.periodo='$periodo'" );

         $villas=DB::select("SELECT Count(*) as villas
                from alumnos inner join grupos 
                on grupos.clavegrupo=alumnos.grupoactual
                where alumnos.id_villa <> '' 
                and alumnos.grupoactual='$grupo' 
                and grupos.periodo='$periodo'");

         
         //return  $villas;
         
         foreach ($becas as $beca) {
             $bec= $beca->becados;
         }
         
        foreach ($villas as $villa) {
             $vill= $villa->villas;
         }
     
        return response()->json([
                    "becados" => $bec,
                    "villas" => $vill
                 ]);
    }

    public function listaBecados()
    {
        $grupo=Session::get('grupo');
        $periodo=Session::get('periodo');

        $listaBecados=DB::select("SELECT A.tipo_beca,A.matricula,
                    Concat(A.apellidop,' ',A.apellidom,' ',A.nombre) as alumno
                    FROM alumnos as A INNER JOIN grupos on grupos.clavegrupo=A.grupoactual
                    WHERE grupoactual='$grupo' and tiene_beca='Si' AND grupos.periodo='$periodo'
                    ORDER BY A.tipo_beca DESC, A.apellidop ASC");

        return $listaBecados;

    }

    public function listaVillas()
    {
            $grupo=Session::get('grupo');
            $periodo=Session::get('periodo');
            
            $listaVillas=DB::select("SELECT A.matricula,
            Concat(A.apellidop,' ',A.apellidom,' ',A.nombre) as alumno,villas.direccion
            FROM (alumnos as A INNER JOIN grupos on grupos.clavegrupo=A.grupoactual)
            INNER JOIN villas on villas.id_villa=A.id_villa
            WHERE grupoactual='$grupo'  AND grupos.periodo='$periodo'
            ORDER BY A.tipo_beca DESC, A.apellidop ASC");
            return $listaVillas;
    }


}
