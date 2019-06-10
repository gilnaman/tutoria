<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
class ApiTutoriaController extends Controller
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


     public function reprobados()
    {
        $grupo=Session::get('grupo');
        $periodo = Session::get('periodo');

        $reprobados = DB::select("SELECT alumnos.matricula,concat(alumnos.apellidop,' ',alumnos.apellidom,' ',alumnos.nombre) as 'alumno',
            getReprobadas(alumnos.matricula,1,'$periodo','$grupo') as u1,
            getReprobadas(alumnos.matricula,2,'$periodo','$grupo') as u2,
            getReprobadas(alumnos.matricula,3,'$periodo','$grupo') as u3,
            getReprobadas(alumnos.matricula,4,'$periodo','$grupo') as u4,
            getReprobadas(alumnos.matricula,5,'$periodo','$grupo') as u5,
            getReprobadas(alumnos.matricula,6,'$periodo','$grupo') as u6
            FROM alumnos INNER JOIN alumnos_grupo ON alumnos.matricula=alumnos_grupo.matricula
            WHERE alumnos_grupo.periodo='$periodo' AND alumnos_grupo.clave_grupo='$grupo'
            ORDER BY alumnos.apellidop ASC,alumnos.apellidom ASC");

        return $reprobados;
    }

    public function reproPorAlumno($matricula,$periodo='2019B'){

        $reprobadas=DB::select("SELECT asignaturas.ClaveAsig,
                        asignaturas.Nombre as asignatura,
                        concat(profesores.tratamiento,' ',profesores.apellidop,' ',profesores.apellidom,' ',profesores.nombre) as profesor,
                        det.unidad,
                        actas_entrega.tipo_unidad,det.ponderacion as valor,
                        det.calificacion,
                        det.total_unidad,actas_entrega.numero_sesiones,
                        det.inasistencia
                        
                        FROM ((detalles_entrega as det INNER JOIN actas_entrega ON actas_entrega.acta=det.acta)
                        INNER JOIN asignaturas on asignaturas.ClaveAsig=det.claveAsig) 
                        INNER JOIN profesores on profesores.cedula=actas_entrega.cedula
                        WHERE det.matricula='$matricula'  AND 
                              actas_entrega.clavePeriodo='$periodo' and det.calificacion<7
                        ORDER BY asignaturas.Nombre asc,det.unidad asc");
        return $reprobadas;
    }
}
