<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use DateTime;
use App\Evento;
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


     public function reprobados($grupo,$periodo)
    {
     
            // $grupo=$request->get('grupo');
        
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

    public function reporteReprobados($grupo,$periodo)
    {
     
            // ('grupo');
        
            //  $periodo = Session::get('periodo');

            // $grupo='TTD-3A';
            // $periodo='2019B';
        

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

        // return $reprobados;

          // $pdf = new FPDF('L', 'mm', 'A4'); 
        $pdf = new FPDF('P', 'mm', 'A4'); 
        $pdf->AddPage();
        $pdf->SetXY(10,10);
    $pdf-> Image(public_path().'/imagenes/logos/logo.png', 25, 8, 30);
    $pdf->SetFont('Arial','B', 11);
    $pdf->Cell(188,4,utf8_decode('UNIVERSIDAD TECNOLÓGICA DEL CENTRO'),0,1,'C');
    $pdf->SetFont('Arial','B', 9);
    $pdf->Cell(188,4,'DEPARTAMENTO DE TUTORIAS',0,1,'C');
    $pdf->SetFont('Arial','B', 7);
    $pdf->Cell(188,4,'RESUMEN DE REPROBADOS POR UNIDAD',0,1,'C');
    $pdf->Ln(10);

    $now = Carbon::now();
    // $now = $date->format('d-m-Y');
    // $now = new DateTime(); 
    $pdf->Cell(188,5,$now,0,1,'R');
    $pdf->SetFillColor(255,214,10);
    $pdf->Cell(8,3.4,utf8_decode('N°'),1,0,'C',1);
    $pdf->Cell(20,3.4,utf8_decode('Matrícula'),1,0,'C',1);
    $pdf->Cell(60,3.4,utf8_decode('Alumno'),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode('U1'),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode('U2'),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode('U3'),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode('U4'),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode('U5'),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode('U6'),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode('TOTAL'),1,1,'C',1);

    $no=0;
    $sumU1=0;
    $sumU2=0;
    $sumU3=0;
    $sumU4=0;
    $sumU5=0;
    $sumU6=0;
    $sumTotal=0;
    $pdf->SetFont('Arial','', 7);
    foreach ($reprobados as $repro) {
        $no++;
        $total= $repro->u1 + $repro->u2 + $repro->u3 + $repro->u4 + $repro->u5 + $repro->u6;
        $sumTotal=$sumTotal+$total;
        $sumU1=$sumU1+$repro->u1;
        $sumU2=$sumU2+$repro->u2;
        $sumU3=$sumU3+$repro->u3;
        $sumU4=$sumU4+$repro->u4;
        $sumU5=$sumU5+$repro->u5;
        $sumU6=$sumU6+$repro->u6;

        $pdf->Cell(8,3.4,utf8_decode($no),1,0,'C');
        $pdf->Cell(20,3.4,utf8_decode($repro->matricula),1,0,'C');
        $pdf->Cell(60,3.4,utf8_decode($repro->alumno),1,0,'L');
        $pdf->Cell(10,3.4,utf8_decode($repro->u1),1,0,'C');
        $pdf->Cell(10,3.4,utf8_decode($repro->u2),1,0,'C');
        $pdf->Cell(10,3.4,utf8_decode($repro->u3),1,0,'C');
        $pdf->Cell(10,3.4,utf8_decode($repro->u4),1,0,'C');
        $pdf->Cell(10,3.4,utf8_decode($repro->u5),1,0,'C');
        $pdf->Cell(10,3.4,utf8_decode($repro->u6),1,0,'C');
        $pdf->Cell(10,3.4,utf8_decode($total),1,1,'C');
    }

    $pdf->SetFont('Arial','B', 7);
    $pdf->Cell(88,3.4,utf8_decode('TOTALES'),1,0,'R');
    $pdf->SetFillColor(255,214,10);
    $pdf->Cell(10,3.4,utf8_decode($sumU1),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode($sumU2),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode($sumU3),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode($sumU4),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode($sumU5),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode($sumU6),1,0,'C',1);
    $pdf->Cell(10,3.4,utf8_decode($sumTotal),1,1,'C',1);

    $pdf->SetFont('Arial','', 7);

    $pdf->Ln(10);

    $pdf->SetFont('Arial','B', 7);
    $pdf->Cell(188,4,'DETALLE DE REPROBADOS POR UNIDAD',0,1,'C');
      $pdf->Ln(8);


    // LISTA DE REPROBADOS

    $listado = DB::select("SELECT det.claveGrupo,
        alumnos.matricula,
        concat(alumnos.apellidop, ' ',alumnos.apellidom,' ',alumnos.nombre) as alumno, 
        det.claveAsig,asignaturas.Nombre as asignatura,
        concat(profesores.tratamiento,' ',profesores.apellidop, ' ',profesores.apellidom,' ',profesores.nombre) as profesor,act.unidad,
        act.tipo_unidad,act.ponderacion,det.calificacion,det.inasistencia
    FROM (((detalles_entrega as det INNER JOIN actas_entrega as act 
    ON act.acta=det.acta)) INNER JOIN asignaturas ON asignaturas.ClaveAsig=det.claveAsig
    INNER JOIN alumnos ON alumnos.matricula=det.matricula) INNER JOIN profesores ON profesores.cedula=act.cedula
    WHERE act.clavePeriodo='$periodo' AND det.calificacion<8
    AND act.claveGrupo='$grupo' 
    ORDER BY alumno ASC");

    // AND act.tipo_unidad='I'

    // return $listado;
    // $pdf->SetFillColor(206,250,0);

    $pdf->SetFillColor(255,214,10);
    $pdf->SetFont('Arial','B',7);
     
    $pdf->Cell(8,3.4,utf8_decode('N°'),1,0,'C',1);
    $pdf->Cell(20,3.4,utf8_decode('Matrícula'),1,0,'C',1);
    $pdf->Cell(50,3.4,utf8_decode('Alumno'),1,0,'C',1);
    $pdf->Cell(60,3.4,utf8_decode('Asignatura'),1,0,'C',1);
    $pdf->Cell(8,3.4,utf8_decode('Uni'),1,0,'C',1);
    $pdf->Cell(8,3.4,utf8_decode('Tipo'),1,0,'C',1);
    $pdf->Cell(8,3.4,utf8_decode('Pond.'),1,0,'C',1);
    $pdf->Cell(8,3.4,utf8_decode('Cal.'),1,0,'C',1);
    $pdf->Cell(8,3.4,utf8_decode('Ina'),1,1,'C',1);

    $pdf->SetFont('Arial','', 7);

    $no2=0;
    foreach ($listado as $lista) {
        $no2++;
        

        if ($lista->tipo_unidad=='C')
            $pdf->SetFillColor(255,255,255);
        else
            $pdf->SetFillColor(249,177,177);
        

            $pdf->Cell(8,3.4,utf8_decode($no2),1,0,'C',1);
            $pdf->Cell(20,3.4,utf8_decode($lista->matricula),1,0,'C',1);
            $pdf->Cell(50,3.4,utf8_decode($lista->alumno),1,0,'L',1);
            $pdf->Cell(60,3.4,utf8_decode($lista->asignatura),1,0,'L',1);
            $pdf->Cell(8,3.4,utf8_decode($lista->unidad),1,0,'C',1);
            $pdf->Cell(8,3.4,utf8_decode($lista->tipo_unidad),1,0,'C',1);
            $pdf->Cell(8,3.4,utf8_decode($lista->ponderacion),1,0,'C',1);
            $pdf->Cell(8,3.4,utf8_decode($lista->calificacion),1,0,'C',1);
            $pdf->Cell(8,3.4,utf8_decode($lista->inasistencia),1,1,'C',1);
        
    }
    $pdf->output('I','Reprobados-'.$grupo.'.pdf');
    exit;




    }

    public function reproPorAlumno($matricula,$periodo='2019B'){

        $periodo = Session::get('periodo');
        $reprobados=DB::select("SELECT asignaturas.ClaveAsig,
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
        return $reprobados;
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

    public function getEventosTutor()
    {
        $periodo=Session::get('periodo');
        // return $periodo;
        $grupo=Session::get('grupo');
        // return $grupo;
        $eventos = DB::select("SELECT eventos.id_evento,eventos.fecha_evento,eventos.titulo,eventos.expositor,eventos.descripcion,grupos.enterado
            FROM eventos INNER JOIN eventos_grupos as grupos on grupos.id_evento=eventos.id_evento
            WHERE eventos.periodo='$periodo' AND grupos.id_grupo='$grupo'
            ORDER BY eventos.created_at DESC");

        return $eventos;
    }




}
