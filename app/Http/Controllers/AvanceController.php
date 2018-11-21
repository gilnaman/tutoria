<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
class AvanceController extends Controller
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
        $carrera="$grupo[0]$grupo[1]$grupo[2]";
        $grado=$grupo[4];
        //return " $carrera  $grado";

        $avance=DB::select("SELECT
                ClaveAsig AS clave,
                Nombre AS asignatura,
                GetUnidadesEntregadasPorMateria ('$periodo', '$grupo', ClaveAsig) AS entregadas,
                GetUnidadesAcumuladaEntregadasPorMateria ('$periodo', '$grupo', ClaveAsig) AS 'avance'
            FROM
                Asignaturas
            WHERE
                idCarrera = '$carrera'
            AND Cuatrimestre =$grado");

        return $avance;
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

       $grupo=Session::get('grupo');
        $periodo=Session::get('periodo');
        $asignatura=$id;
        $unidades=6;
        $sum='';
        $unidad=0;
      
        for ($i=0; $i < $unidades ; $i++) { 
            $unidad=$i+1;
            $sum=$sum."getTotalUnidadxAsig(alumnos.Matricula,$unidad,'$periodo','$grupo','$asignatura') as 'U$unidad',";
        }
        //return $sum;

        $detalle_avance=DB::select("SELECT alumnos.matricula,
            Concat(alumnos.ApellidoP,' ',alumnos.ApellidoM,' ',alumnos.Nombre)as Alumno,
            $sum
            Round(getAcumuladoPorAlumno('$periodo','$grupo','$asignatura',alumnos.Matricula),2) as acumulado, 
            Round(getPromedioPorAlumno('$periodo','$grupo','$asignatura',alumnos.Matricula),1) as promedio 
            FROM alumnos WHERE alumnos.GrupoActual='$grupo' and alumnos.bajadefinitiva=0");
        return $detalle_avance;
        

    }

    function detalle()
    {
         

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
