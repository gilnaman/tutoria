<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Justificacion;
use App\Detalle_Justificacion;
use Codedge\Fpdf\Fpdf\Fpdf;
use Response;
use Collection;
use Session;
use DB;

class ApiJustificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$justificacion = Justificacion::all();
        
        return Justificacion::all()->where('grupo','=',Session::get('grupo'));
        
        
        // return $justificacion;

         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $just = new Justificacion;

       $just->folio=$request->get('folio');
       $just->periodo=$request->get('periodo');
       $just->grupo=$request->get('grupo');
       $just->id_carrera=$request->get('id_carrera');
       $just->matricula=$request->get('matricula');
       $just->id_motivo=$request->get('id_motivo');
       $just->fecha_solicitud=$request->get('fecha_solicitud');
       $just->id_tutor=$request->get('id_tutor');
       $just->modulos=$request->get('modulos');
       $just->num_dias=$request->get('num_dias');


       $folio=$just->folio=$request->get('folio');
       $detalles=$request->get('detalles');
       
       //return $detalles;
       //return $just;
      $just->save();
       //return $just->save();

       $records = [];

        //GENERAR DETALLE DE FECHAS 
        for ($i=0; $i <count($detalles) ; $i++) { 
            $records[] = [
                    'folio' => $folio,
                    'fecha' => $detalles[$i]
                ];
        }

        Detalle_Justificacion::insert($records);

       //$this->imprimir($folio);
        //return redirect()->route('prueba');
        //return view('tutor.listajustificacion');
        return $just;
        //return ['redirect' => route('JustiController@index')];
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    
    public function imprimir ($folio)

    {
        $justifica = Justificacion::find($folio);
        $fechas=DB::table('Detalle_Justificaciones')
        ->where('folio','=',$folio)
        ->OrderBy('fecha','ASC')
        ->get();
        //return $fechas;

        $fjust='';
        foreach($fechas as $fecha)
        {
            $newDateFormat2 = date('d/m/Y', strtotime($fecha->fecha));
            $fjust=$fjust.', '. $newDateFormat2;
        }
        
        //return $fjust;

        $per=substr($justifica->periodo,4,1);
        //return $per;
        $perio='';

        switch ($per) {
            case 'A':
                $perio='( '.$justifica->periodo. ')- '. 'ENERO-ABRIL';
                break;
            case 'B':
                $perio='( '.$justifica->periodo. ')- '. 'MAYO-AGOSTO';
                break;
            case 'C':
                $perio='( '.$justifica->periodo. ')- '. 'MAYO-AGOSTO';
                break;

            default:
                # code...
                break;
        }
        

        $alum=$justifica->alumno->apellidop . ' '. $justifica->alumno->apellidom . ' '. $justifica->alumno->nombre;

        $tut=$justifica->tutor->tratamiento .' '. $justifica->tutor->nombre .' '. $justifica->tutor->apellidop.' '.$justifica->tutor->apellidom;
        //return $alum;
        //$justificacion=Justificacion::find($id);

        $pdf2=new Fpdf('P','mm','A4');    
        $pdf2->AddPage();

        //ENCABEZADO

        $pdf2->SetXY(10,8);
        $pdf2-> Image(public_path().'/imagenes/logos/logo.png',15, 12, 35);//x, y, tamaño
        
        $pdf2->SetFont('Arial','B', 12);
        $pdf2->SetXY(10,20);
        $pdf2->Cell(28);
        $pdf2->Cell(160,8,utf8_decode('SOLICITUD DE JUSTIFICACIÓN'),0,0,'C');
        $pdf2->Ln(10);

        //CUERPO

$pdf2->SetXY(10,36);
$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(37,6,'CUATRIMESTRE: ',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(141,6,$perio,'B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(37,6,'ALUMNO:',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(141,6,utf8_decode($alum),'B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(37,6,utf8_decode('MATRÍCULA:'),0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(141,6,$justifica->matricula,'B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(37,6,'CARRERA:',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(141,6,strtoupper(utf8_decode($justifica->carrera->nombre)),'B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(37,6,'GRUPO:',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(141,6,utf8_decode($justifica->grupo),'B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(47,6,'FECHA DE SOLICITUD:',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(55,6,$justifica->fecha_solicitud->format('d/m/Y'),'B',0,'C');
$pdf2->Cell(81,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(47,6,'FECHA(S) DE INASISTENCIA:',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(55,6,$fjust,'B',0,'C');
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(21,6,'MODULO:',0,0,'C');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(55,6,'TODOS','B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->SetXY(10,84);
$pdf2->Cell(5);
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(178,5,'*NOTA: Este documento solamente JUSTIFICA faltas, no exime al estudiante de la entrega de tareas, informes, proyectos o',0,0,'L');
$pdf2->Cell(5,5,' ',0,1);
$pdf2->Cell(5);
$pdf2->Cell(178,5,utf8_decode('exámenes a presentar para obtener su calificación. Deberá presentarse máximo tres días hábiles posteriores a la inasistencia para'),0,0,'L');
$pdf2->Cell(5,5,' ',0,1);
$pdf2->Cell(5);
$pdf2->Cell(178,5,utf8_decode('solicitar la Justificación de la misma.'),0,0,'L');
$pdf2->Cell(5,5,' ',0,1);

$pdf2->SetXY(10,104);
$pdf2->Cell(5);
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(89,6,utf8_decode('ELABORÓ Y REVISÓ'),0,0,'C');
$pdf2->Cell(89,6,utf8_decode('APROBÓ'),0,0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(15,6,' ',0,0);
$pdf2->Cell(59,6,utf8_decode($tut),'B',0,'C');
$pdf2->Cell(30,6,' ',0,0);
$pdf2->Cell(59,6,utf8_decode('MIP. JOSÉ EDUARDO PUGA SOSA'),'B',0,'C');
$pdf2->Cell(20,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(89,6,'TUTOR DE GRUPO',0,0,'C');
$pdf2->Cell(89,6,utf8_decode('DIRECTOR DE CARRERAS'),0,0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->SetFont('Arial','',7);
$pdf2->Cell(0,12,'',0,1);
$pdf2->Cell(0,8,'F-UTC-DCA-23',0,1,'R');

$pdf2->Cell(188,8,'_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _',0,1,'C');


   
$pdf2->SetXY(10,146);

$pdf2->Image(public_path().'/imagenes/logos/logo.png',15, 158, 35);
$pdf2->SetFont('Arial','B', 12);
$pdf2->SetXY(10,168);
$pdf2->Cell(28);
$pdf2->Cell(160,8,utf8_decode('SOLICITUD DE JUSTIFICACIÓN'),0,0,'C');
$pdf2->Ln(10);

$pdf2->SetXY(10,186);
$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(37,6,'CUATRIMESTRE: ',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(141,6,$perio,'B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(37,6,'ALUMNO:',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(141,6,utf8_decode($alum),'B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(37,6,utf8_decode('MATRÍCULA:'),0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(141,6,$justifica->matricula,'B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(37,6,'CARRERA:',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(141,6,strtoupper(utf8_decode($justifica->carrera->nombre)),'B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(37,6,'GRUPO:',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(141,6,$justifica->grupo,'B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(47,6,'FECHA DE SOLICITUD:',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(55,6,$justifica->fecha_solicitud->format('d/m/Y'),'B',0,'C');
$pdf2->Cell(81,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(47,6,'FECHA(S) DE INASISTENCIA:',0,0,'L');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(55,6,$fjust,'B',0,'C');
$pdf2->SetFont('Arial','B',8);
$pdf2->Cell(21,6,'MODULO:',0,0,'C');
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(55,6,'TODOS','B',0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->SetXY(10,234);
$pdf2->Cell(5);
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(178,5,'*NOTA: Este documento solamente JUSTIFICA faltas, no exime al estudiante de la entrega de tareas, informes, proyectos o',0,0,'L');
$pdf2->Cell(5,5,' ',0,1);
$pdf2->Cell(5);
$pdf2->Cell(178,5,utf8_decode('exámenes a presentar para obtener su calificación. Deberá presentarse máximo tres días hábiles posteriores a la inasistencia para'),0,0,'L');
$pdf2->Cell(5,5,' ',0,1);
$pdf2->Cell(5);
$pdf2->Cell(178,5,utf8_decode('solicitar la Justificación de la misma.'),0,0,'L');
$pdf2->Cell(5,5,' ',0,1);

$pdf2->SetXY(10,254);
$pdf2->Cell(5);
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(89,6,utf8_decode('ELABORÓ Y REVISÓ'),0,0,'C');
$pdf2->Cell(89,6,utf8_decode('APROBÓ'),0,0,'C');
$pdf2->Cell(5,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(15,6,' ',0,0);
$pdf2->Cell(59,6,strtoupper(utf8_decode($tut)),'B',0,'C');
$pdf2->Cell(30,6,' ',0,0);
$pdf2->Cell(59,6,utf8_decode('MIP. José Eduardo Puga Sosa'),'B',0,'C');
$pdf2->Cell(20,6,' ',0,1);

$pdf2->Cell(5);
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(89,6,'TUTOR DE GRUPO',0,0,'C');
$pdf2->Cell(89,6,utf8_decode('DIRECTOR DE CARRERAS'),0,0,'C');
$pdf2->Cell(5,6,' ',0,1);



 $headers=['Content-Type'=>'aplication/pdf'];

            return Response::make($pdf2->Output(),200,$headers);

 }

}
