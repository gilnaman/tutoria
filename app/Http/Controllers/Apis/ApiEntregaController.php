<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
class ApiEntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodo=Session::get('periodo');
        $rol=Session::get('rol');
        $cedula=Session::get('cedula');
        //return $cedula;
        
        if ($rol=='Administrador' || $rol=='Coordinador')
        $consulta = "SELECT actas_entrega.acta,profesores.cedula,profesores.tratamiento,CONCAT(profesores.apellidop,' ',profesores.apellidom,' ', profesores.nombre) as docente,actas_entrega.fecha_subida,
            actas_entrega.claveGrupo,actas_entrega.claveAsig,asignaturas.Nombre as asignatura,actas_entrega.clavePeriodo,actas_entrega.unidad,getUnidadesTotales('$periodo',actas_entrega.ClaveAsig,actas_entrega.cedula,actas_entrega.claveGrupo) as unidades_totales,actas_entrega.ponderacion,
            actas_entrega.tipo_unidad,actas_entrega.promedio,actas_entrega.promedio_ajustado,actas_entrega.fecha_planeada,actas_entrega.fecha_entrega,getStatusEntrega(fecha_subida,fecha_planeada) as status_entrega
            FROM ((docentesporgrupo INNER JOIN profesores on profesores.cedula=docentesporgrupo.Cedula)
            INNER JOIN actas_entrega on actas_entrega.claveAsig=docentesporgrupo.ClaveAsig)
            INNER JOIN asignaturas ON asignaturas.ClaveAsig=actas_entrega.claveAsig
            WHERE Periodo='$periodo' AND docentesporgrupo.ClaveGrupo=actas_entrega.claveGrupo
            ORDER BY Docente ASC,actas_entrega.claveGrupo ASC,asignaturas.Nombre ASC,actas_entrega.unidad ASC
            ";
        elseif ($rol=='Profesor')
            $consulta="SELECT actas_entrega.acta,profesores.cedula,profesores.tratamiento,CONCAT(profesores.apellidop,' ',profesores.apellidom,' ', profesores.nombre) as docente,actas_entrega.fecha_subida,
            actas_entrega.claveGrupo,actas_entrega.claveAsig,asignaturas.Nombre as asignatura,actas_entrega.clavePeriodo,actas_entrega.unidad,getUnidadesTotales('$periodo',actas_entrega.ClaveAsig,actas_entrega.cedula,actas_entrega.claveGrupo) as unidades_totales,actas_entrega.ponderacion,
            actas_entrega.tipo_unidad,actas_entrega.promedio,actas_entrega.promedio_ajustado,actas_entrega.fecha_planeada,actas_entrega.fecha_entrega,getStatusEntrega(fecha_subida,fecha_planeada) as status_entrega

            FROM ((docentesporgrupo INNER JOIN profesores on profesores.cedula=docentesporgrupo.Cedula)
            INNER JOIN actas_entrega on actas_entrega.claveAsig=docentesporgrupo.ClaveAsig)
            INNER JOIN asignaturas ON asignaturas.ClaveAsig=actas_entrega.claveAsig
            WHERE Periodo='$periodo' AND docentesporgrupo.ClaveGrupo=actas_entrega.claveGrupo
            AND profesores.cedula='$cedula'
            ORDER BY Docente ASC,actas_entrega.claveGrupo ASC,asignaturas.Nombre ASC,actas_entrega.unidad ASC
            ";

            

        $entregas=DB::select($consulta);
        //return $consulta;
        return $entregas;
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
        $periodo=Session::get('periodo');
        $entregas = DB::select("SELECT actas_entrega.acta,profesores.cedula,profesores.tratamiento,CONCAT(profesores.apellidop,' ',profesores.apellidom,' ', profesores.nombre) as docente,actas_entrega.fecha_subida,
            actas_entrega.claveGrupo,actas_entrega.claveAsig,asignaturas.Nombre as asignatura,actas_entrega.clavePeriodo,actas_entrega.unidad,actas_entrega.ponderacion,
            actas_entrega.tipo_unidad,actas_entrega.promedio,actas_entrega.promedio_ajustado

            FROM ((docentesporgrupo INNER JOIN profesores on profesores.cedula=docentesporgrupo.Cedula)
            INNER JOIN actas_entrega on actas_entrega.claveAsig=docentesporgrupo.ClaveAsig)
            INNER JOIN asignaturas ON asignaturas.ClaveAsig=actas_entrega.claveAsig
            WHERE Periodo='$periodo' AND docentesporgrupo.ClaveGrupo=actas_entrega.claveGrupo
            AND profesores.cedula='$id'
            ORDER BY Docente ASC,actas_entrega.claveGrupo ASC,asignaturas.Nombre ASC,actas_entrega.unidad ASC
            ");

        return $entregas;

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
