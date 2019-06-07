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

        $plan=DB::select("SELECT claveplan 
                          FROM grupos 
                          WHERE clavegrupo='$grupo' AND periodo='$periodo'");

        $getplan='';

        foreach ($plan as $pla) {
            $getPlan= $pla->claveplan;
        }

        


         $avance=DB::select("SELECT Asig.ClaveAsig as clave,asignaturas.Nombre as asignatura,
        GetUnidadesEntregadasPorMateria ('$periodo', '$grupo', Asig.ClaveAsig) AS entregadas,
        GetUnidadesAcumuladaEntregadasPorMateria ('$periodo', '$grupo', Asig.ClaveAsig) AS 'avance',
        profesores.cedula,concat(profesores.apellidop,' ',profesores.apellidom,' ',profesores.nombre) as docente,profesores.tratamiento
        from (docentesporgrupo as Asig INNER JOIN profesores on profesores.cedula=Asig.Cedula)
        INNER JOIN asignaturas on asignaturas.ClaveAsig=Asig.ClaveAsig
        WHEre asignaturas.idCarrera='$carrera' AND asignaturas.Cuatrimestre=$grado AND asignaturas.id_plan='$getPlan' AND
Asig.ClaveGrupo='$grupo'");


       //return $grupo;

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
            FROM alumnos INNER JOIN alumnos_grupo ON alumnos.matricula=alumnos_grupo.matricula
            WHERE alumnos_grupo.clave_grupo='$grupo' and alumnos_grupo.periodo='$periodo'
            ORDER BY alumnos.apellidop ASC,alumnos.apellidom ASC");
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

    public function getPonderacion($id)
    {
        $periodo=Session::get('periodo');
        $ponderaciones=DB::select("SELECT idasignatura,unidad,porcentaje,tipounidad from ponderaciones WHERE ponderaciones.idperiodo='$periodo' AND idasignatura='$id'
ORDER BY unidad ASC");
        return $ponderaciones;
    }
}
