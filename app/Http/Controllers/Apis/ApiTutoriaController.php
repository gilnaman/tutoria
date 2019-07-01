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


     public function reprobados(Request $request)
    {
     
            $grupo=$request->get('grupo');
        
            $periodo = $request->get('periodo');

        

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


      public function promediosjs(Request $request)
    {

        $grupo=$request->get('grupo');
        $periodo = $request->get('periodo');
        // $grupo='TTD-3A';
        // $periodo="2019B";

        $becas=DB::select("SELECT Count(*) as becados
                    from alumnos inner join alumnos_grupo 
                    on alumnos_grupo.matricula=alumnos.matricula
                    where alumnos.id_beca<>'' 
                    and alumnos_grupo.clave_grupo='$grupo' 
                    and alumnos.tiene_beca='Si' 
                    and alumnos_grupo.periodo='$periodo'" );

        $villas=DB::select("SELECT Count(*) as villas
                            FROM alumnos INNER JOIN alumnos_grupo 
                            on alumnos_grupo.matricula=alumnos.matricula
                            WHERE alumnos.id_villa <> '' 
                            AND alumnos.tiene_villa='Si'
                            AND alumnos_grupo.clave_grupo='$grupo' 
                            AND alumnos_grupo.periodo='$periodo'");


        $promedios = DB::select("SELECT carga.ClaveAsig,asignaturas.Nombre as materia,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,1),1) as U1,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,2),1) as U2,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,3),1) as U3,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,4),1) as U4,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,5),1) as U5,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,6),1) as U6
            From docentesporgrupo as carga INNER JOIN asignaturas on asignaturas.ClaveAsig=carga.ClaveAsig
            WHERE carga.ClaveGrupo='$grupo'");

   

        
        //$promedios= response()->json($promedios);
        //return $promedios;
        $asigs = array();
        $u1 = array();
        $u2 = array();
        $u3 = array();
        $u4 = array();
        $u5 = array();
        $u6 = array();

        
        foreach($promedios as $promedio)
        {
            $asig = $promedio->materia;
            array_push($asigs,$asig);

            $vu1 = $promedio->U1;
            array_push($u1,$vu1);

             $vu2 = $promedio->U2;
             array_push($u2,$vu2);

             $vu3 = $promedio->U3;
             array_push($u3,$vu3);

             $vu4 = $promedio->U4;
             array_push($u4,$vu4);

            $vu5 = $promedio->U5;
             array_push($u5,$vu5);

              $vu6 = $promedio->U6;
             array_push($u6,$vu6);
        }
        //return $u3;

        
        $todos = array("materias" => $asigs,
                        "u1" =>$u1,
                        "u2" =>$u2,
                        "u3" =>$u3,
                        "u4" =>$u4,
                        "u5" =>$u5,
                        "u6" =>$u6

                        );

        //return $asigs;
        //return view('tutor.promediosjs')
        return view('coordinador.resumenvue')
        ->with("materias",$asigs)
        ->with("unidad1",$u1)
        ->with("unidad2",$u2)
        ->with("unidad3",$u3)
        ->with("unidad4",$u4)
        ->with("unidad5",$u5)
        ->with("unidad6",$u6)
        ->with('becados',$becas)
        ->with('villas',$villas);

        //endforeach

    }
}
