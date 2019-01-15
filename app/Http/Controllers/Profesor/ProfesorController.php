<?php

namespace App\Http\Controllers\Profesor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Fpdf\Fpdf;
use Response;
use App\Alumno;
use Session;
use DB;

class ProfesorController extends Controller
{
    public function index()
    {
        $periodo=Session::get('periodo');
        $cedula=Session::get('cedula');

        $carga=DB::select("SELECT Doc.ClaveGrupo,Doc.ClaveAsig,
            asignaturas.Nombre as Asignatura
        FROM docentesporgrupo as Doc INNER JOIN asignaturas 
        ON asignaturas.ClaveAsig=Doc.ClaveAsig
        WHERE Doc.Periodo='$periodo' AND Doc.Cedula='$cedula'
        ORDER BY Doc.ClaveGrupo ASC, Asignatura ASC");
        
        return view('profesor.listas')
        ->with('cargas',$carga);
    }
    
    public function imprimir_lista($claveasig,$clavegrupo,$unidad)

    {
       

            $asignatura=DB::connection('mysql')
                    ->table('asignaturas')
                    ->select('nombre')
                    ->where('ClaveAsig','=',$claveasig)
                    ->get();
            foreach($asignatura as $asigna){
                $asig=$asigna->nombre;
            }
            
            //return $asig;
        
        $cuatrimestre=substr($clavegrupo,4,1);
        $carrera=DB::connection('mysql')
        ->table('carreras')
        ->select('nombrelargo')
        ->where('idcarrera','=',substr($clavegrupo,0,3))
        ->get();

         foreach($carrera as $carr){
                $ncar=$carr->nombrelargo;
            }
        //return $ncar;

        

        //$grupo,$asignatura,$unidad
        //$grupo='TTS-4B';
        $alumnos=Alumno::where('grupoactual','=',$clavegrupo)
        ->where('bajadefinitiva','=',0)
        ->orderBy('apellidop','ASC')
        ->get();
        //return $alumno;
    	
		$pdf = new FPDF('L', 'mm', 'A4'); //Creamos un objeto de la librería horizontal o vertical, tamaño en milimetros y tipo de hoja
for ($i=0; $i < 1; $i++)
{ 
    $pdf->AddPage();
    $pdf->SetXY(10,15);
    $pdf-> Image(public_path().'/imagenes/logos/logo.png', 25, 13, 30);
    $pdf->SetFont('Arial','B', 11);
    $pdf->Cell(277,4,utf8_decode('UNIVERSIDAD TECNOLÓGICA DEL CENTRO'),0,1,'C');
    $pdf->SetFont('Arial','B', 9);
    $pdf->Cell(277,4,'DEPARTAMENTO DE SERVICIOS ESOLARES',0,1,'C');
    $pdf->SetFont('Arial','B', 7);
    $pdf->Cell(277,4,'LISTA DE ASISTENCIA',0,1,'C');
    $pdf->Ln(10);
    $pdf->SetFillColor(206,250,0);
    $pdf->SetFont('Arial','B',7); 
    $pdf->SetXY(10,26);
    $pdf->Cell(277,4,utf8_decode($ncar),0,1,'C');
    $pdf->Cell(10.5);
    $pdf->Cell(20,4,'DOCENTE: ',0,0,'C');
    $pdf->Cell(72,4,utf8_decode(Session::get('usuario')),'B',0,'C');
    $pdf->Cell(64.5,4,'UNIDAD: ',0,0,'R');
    $pdf->Cell(20,4,$unidad,'B',0,'C');
    $pdf->Cell(54.5,4,'CUATRIMESTRE: ',0,0,'R');
    $pdf->Cell(30,4,$cuatrimestre,'B',1,'C');
    $pdf->Cell(10.5);
    $pdf->Cell(20,4,'MATERIA:',0,0,'C');
    $pdf->Cell(72,4,utf8_decode($asig),'B',0,'C');
    $pdf->Cell(64.5,4,'GRUPO: ',0,0,'R');
    $pdf->Cell(20,4,$clavegrupo,'B',0,'C');
    $pdf->Cell(54.5,4,'PERIODO: ',0,0,'R');
    $pdf->Cell(30,4,'ENERO-ABRIL 2019','B',1,'C');

    $pdf->SetXY(10,41);
    $pdf->SetFont('Arial','B',9); 
    $pdf->Cell(5.5);
    $pdf->Cell(97,6,'DATOS DEL ALUMNO',1,0,'C');
    $pdf->Cell(169,6,'',1,1);

    $pdf->SetFillColor(216,216,216);
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(5.5);
    $pdf->Cell(5,4,utf8_decode('N°'),1,0,'C',1);
    $pdf->Cell(20,4,utf8_decode('MATRÍCULA'),1,0,'C',1);
    $pdf->Cell(72,4,'NOMBRE',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,0,'C',1);
    $pdf->Cell(6.5,4,'',1,1,'C',1);

    //$resultado = mysql_query("SELECT * FROM lista");

        $ix = 0;
        $fila=0;
        //while($fila = mysql_fetch_array($resultado))
        foreach($alumnos as $alumno)
        {
        	$fila++;
            $ix = $ix+1;
            $matricula =$alumno->matricula;
            $nombre_alumno = "$alumno->apellidop $alumno->apellidom $alumno->nombre";
            $pdf->Cell(5.5);
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(5,4,$ix,1,0,'C');
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(20,4,$matricula,1,0,'C');
            $pdf->Cell(72,4,utf8_decode($nombre_alumno),1,0,'L');
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1,1);
        }
        
        while($ix < 32)
        {
            $ix = $ix+1;
            $pdf->Cell(5.5);
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(5,4,$ix,1,0,'C');
            $pdf->Cell(20,4,'',1,0,'C');
            $pdf->Cell(72,4,'',1,0,'L');
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1);
            $pdf->Cell(6.5,4,'',1,1);
        }

            $pdf->SetXY(10,183);
            $pdf->Cell(70.5,4);
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(30,4);
            $pdf->Cell(76,4,'FIRMA DEL DOCENTE','T',0,'C');
            $pdf->Cell(30,4);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(70.5,4,'F-UTC-SES-05/V04',0,1,'L');
    
}

			$headers=['Content-Type'=>'aplication/pdf'];

            return Response::make($pdf->Output(),200,$headers);


//$pdf->Output(); 

    }
}

