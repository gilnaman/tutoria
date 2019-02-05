<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Grupo;
use App\Carrera;
use App\Alumno;
use Codedge\Fpdf\Fpdf\Fpdf;
use Response;

class CoordinadorController extends Controller
{
    public function index(){
    	return view('coordinador.listas');
    }


    public function listaGrupo($id){

    	$alumnos=Alumno::where('grupoactual','=',$id)
    	->where('bajadefinitiva','=',0)
    	->where('bajatemporal','=',0)
    	->orderby('apellidop','ASC')->get();
    	//return $alumnos;


    	 $carrera=DB::connection('mysql')
        ->table('carreras')
        ->select('nombrelargo')
        ->where('idcarrera','=',substr($id,0,3))
        ->get();

         foreach($carrera as $carr){
                $ncar=$carr->nombrelargo;
           }
       $cuatrimestre=substr($id,4,1);


    $pdf = new FPDF('L', 'mm', 'A4'); //Creamos un objeto de la librería horizontal o vertical, tamaño en milimetros y tipo de hoja
	for ($i=0; $i < 1; $i++)
	{ 
	    $pdf->AddPage();
	    $pdf->SetXY(10,10);
	    $pdf-> Image(public_path().'/imagenes/logos/logo.png', 25, 8, 30);
	    $pdf->SetFont('Arial','B', 11);
	    $pdf->Cell(277,4,utf8_decode('UNIVERSIDAD TECNOLÓGICA DEL CENTRO'),0,1,'C');
	    $pdf->SetFont('Arial','B', 9);
	    $pdf->Cell(277,4,'DEPARTAMENTO DE SERVICIOS ESOLARES',0,1,'C');
	    $pdf->SetFont('Arial','B', 7);
	    $pdf->Cell(277,4,'LISTA DE ASISTENCIA',0,1,'C');
	    $pdf->Ln(10);
	    $pdf->SetFillColor(206,250,0);
	    $pdf->SetFont('Arial','B',7); 
	    $pdf->SetXY(10,21);
	    $pdf->Cell(277,4,utf8_decode($ncar),0,1,'C');
	    $pdf->Cell(10.5);
	    $pdf->Cell(20,4,'DOCENTE: ',0,0,'C');
	    $pdf->Cell(72,4,'','B',0,'C');
	    $pdf->Cell(64.5,4,'UNIDAD: ',0,0,'R');
	    $pdf->Cell(20,4,'','B',0,'C');
	    $pdf->Cell(54.5,4,'CUATRIMESTRE: ',0,0,'R');
	    $pdf->Cell(30,4,$cuatrimestre,'B',1,'C');
	    $pdf->Cell(10.5);
	    $pdf->Cell(20,4,'MATERIA:',0,0,'C');
	    $pdf->Cell(72,4,'','B',0,'C');
	    $pdf->Cell(64.5,4,'GRUPO: ',0,0,'R');
	    $pdf->Cell(20,4,$id,'B',0,'C');
	    $pdf->Cell(54.5,4,'PERIODO: ',0,0,'R');
	    $pdf->Cell(30,4,'ENERO-ABRIL 2019','B',1,'C');

	    $pdf->SetXY(10,35);
	    $pdf->SetFont('Arial','B',9); 
	    $pdf->Cell(5.5);
	    $pdf->Cell(97,6,'DATOS DEL ALUMNO',1,0,'C');
	    $pdf->Cell(169,6,'',1,1);

	    $pdf->SetFillColor(216,216,216);
	    $pdf->SetFont('Arial','B',7);
	    $pdf->Cell(5.5);
	    $pdf->Cell(5,3.9,utf8_decode('N°'),1,0,'C',1);
	    $pdf->Cell(20,3.9,utf8_decode('MATRÍCULA'),1,0,'C',1);
	    $pdf->Cell(72,3.9,'NOMBRE',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.9,'',1,1,'C',1);

	    //$resultado = mysql_query("SELECT * FROM lista");

	        $ix = 0;
	        $fila=0;
	        //while($fila = mysql_fetch_array($resultado))
	        
	        foreach($alumnos as $alumno)
	        {
	            $fila++;
	            $ix = $ix+1;
	            //$matricula =$alumno->matricula;
	            //$nombre_alumno = "$alumno->apellidop $alumno->apellidom $alumno->nombre";
	            $pdf->Cell(5.5);
	            $pdf->SetFont('Arial','B',7);
	            $pdf->Cell(5,3.9,$ix,1,0,'C');
	            $pdf->SetFont('Arial','',7);
	            $pdf->Cell(20,3.9,$alumno->matricula,1,0,'C');
	            $pdf->Cell(72,3.9,utf8_decode("$alumno->apellidop $alumno->apellidom $alumno->nombre"),1,0,'L');
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1,1);
	        }
	        
	        while($ix < 30)
	        {
	            $ix = $ix+1;
	            $pdf->Cell(5.5);
	            $pdf->SetFont('Arial','B',7);
	            $pdf->Cell(5,3.9,$ix,1,0,'C');
	            $pdf->Cell(20,3.9,'',1,0,'C');
	            $pdf->Cell(72,3.9,'',1,0,'L');
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1);
	            $pdf->Cell(6.5,3.9,'',1,1);
	        }

	            $pdf->SetXY(10,185);
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
