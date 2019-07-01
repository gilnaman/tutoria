<?php

namespace App\Http\Controllers\Profesor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Fpdf\Fpdf;
use DB;
class AcuseController extends Controller
{
    //

    public function acuse(){
    	$pdf = new FPDF('P', 'mm', 'A4'); //Creamos un objeto de la librería horizontal o vertical, tamaño en milimetros y tipo de 

        $acuse = DB::select("SELECT actas_entrega.acta,
concat(profesores.tratamiento,' ',profesores.apellidop, ' ',profesores.apellidom,' ',profesores.nombre) as profesor,
det.claveGrupo as clavegrupo,det.claveAsig as claveasig,asignaturas.Nombre as asignatura,
det.matricula,
concat(alumnos.apellidop,' ',alumnos.apellidom,' ',alumnos.nombre) as alumno,
det.unidad,det.ponderacion,det.calificacion,det.nivel
FROM (((detalles_entrega as det INNER JOIN alumnos ON alumnos.matricula=det.matricula)
INNER JOIN asignaturas on asignaturas.ClaveAsig=det.claveAsig)
INNER JOIN actas_entrega on actas_entrega.acta=det.acta)
INNER JOIN profesores on profesores.cedula=actas_entrega.cedula
WHERE det.clavePeriodo='2019B' and det.claveGrupo='TMI-3A' AND det.claveAsig='TMI18-307' and det.unidad=1 and actas_entrega.cedula='08'
ORDER BY alumnos.apellidop ASC");

        // return $acuse;

    	$pdf->AddPage();
    $pdf->SetXY(10,10);
    $pdf-> Image(public_path().'/imagenes/logos/logo.png', 25, 8, 30);

    $pdf->SetFont('Arial','B', 12);
    $pdf->Cell(190,4,utf8_decode('UNIVERSIDAD TECNOLÓGICA DEL CENTRO'),0,1,'C');
    $pdf->SetFont('Arial','B', 10);
    $pdf->Cell(190,4,utf8_decode('DIRECCIÓN ACADÉMICA'),0,1,'C');
    $pdf->SetFont('Arial','B', 9);
    $pdf->Cell(190,4,'ACUSE DE ENTREGA DE CALIFICACIONES',0,1,'C');
    $pdf->Ln(10);
    
    $pdf->SetFont('Arial','', 10);

    $pdf->Cell(80,4,utf8_decode('Por  este  medio  se hace  constar que, el profesor :'),0,0,'L');
    $pdf->SetFont('Arial','B', 10);
    $pdf->Cell(100,4,utf8_decode($acuse[0]->profesor),'B',1,'C');
    $pdf->Ln(2);
    $pdf->SetFont('Arial','', 10);
    $pdf->Cell(120,4,utf8_decode('entregó en formato digital, las calificaciones correspondientes a la unidad : '),0,0,'L');
    $pdf->SetFont('Arial','B', 10);
	$pdf->Cell(10,4,utf8_decode($acuse[0]->unidad),'B',0,'C');
    $pdf->SetFont('Arial','', 10);
	$pdf->Cell(25,4,utf8_decode('del grupo: '),0,0,'L');
    $pdf->SetFont('Arial','B', 10);
    $pdf->Cell(25,4,utf8_decode($acuse[0]->clavegrupo),'B',1,'C');
    $pdf->Ln(2);
    $pdf->SetFont('Arial','', 10);
    $pdf->Cell(34,4,utf8_decode('de la asignatura : '),0,0,'L');
    $pdf->SetFont('Arial','B', 9);
    $pdf->Cell(75,4,utf8_decode($acuse[0]->asignatura),'B',0,'C');
    $pdf->SetFont('Arial','', 10);
    $pdf->Cell(20,4,utf8_decode('con folio : '),0,0,'L');
    $pdf->SetFont('Arial','B', 10);
    $pdf->Cell(50,4,utf8_decode($acuse[0]->acta),'B',1,'C');

    $pdf->SetFont('Arial','', 10);
    $pdf->Cell(40,4,utf8_decode('los cuales se detallan a continuación: '),0,1,'L');

    $pdf->Ln(6);
    // 180
    $pdf->SetFont('Arial','B', 7);
    $pdf->Cell(5,5,utf8_decode('No'),1,0,'L');
    $pdf->Cell(25,5,utf8_decode('MATRÍCULA'),1,0,'L');
    $pdf->Cell(70,5,'ALUMNO',1,0,'L');
    $pdf->Cell(20,5,utf8_decode('CALIFICACIÓN'),1,0,'L');
    $pdf->Cell(20,5,utf8_decode('DESEMPEÑO'),1,0,'L');
    $pdf->Cell(40,5,utf8_decode('FIRMA'),1,1,'L');

    $pdf->SetFont('Arial','', 8);
    $no=0;
    $num_alumnos = count($acuse);
    $resto = 36 - $num_alumnos;
    $alt=5.2;
    foreach ($acuse as $acus) {
        $no++;
        $pdf->Cell(5,$alt,$no,1,0,'L');
        $pdf->Cell(25,$alt,utf8_decode($acus->matricula),1,0,'L');
        $pdf->Cell(70,$alt,utf8_decode($acus->alumno),1,0,'L');
        $pdf->Cell(20,$alt,utf8_decode($acus->calificacion),1,0,'C');
        $pdf->Cell(20,$alt,utf8_decode($acus->nivel),1,0,'C');
        $pdf->Cell(40,$alt,utf8_decode(''),1,1,'L');
    }

    for ($i=0; $i < $resto ; $i++) { 
        $pdf->Cell(5,5,'',1,0,'L');
        $pdf->Cell(25,5,'',1,0,'L');
        $pdf->Cell(70,5,'',1,0,'L');
        $pdf->Cell(20,5,'',1,0,'C');
        $pdf->Cell(20,5,'',1,0,'C');
        $pdf->Cell(40,5,'',1,1,'L');
    }
        
    $pdf->Ln(15);
    $pdf->Cell(60,5,'','B',0,'C');
    $pdf->Cell(60,5,'',0,0,'C');
    $pdf->Cell(60,5,'','B',1,'C');

    $pdf->SetFont('Arial','', 6);
    $pdf->Cell(60,5,utf8_decode('ENTREGÓ'),0,0,'C');
    $pdf->Cell(60,5,'',0,0,'C');
    $pdf->Cell(60,5,'APROBADO',0,1,'C');
    
    $pdf->SetFont('Arial','B', 6);
    $pdf->Cell(60,5,utf8_decode($acuse[0]->profesor),0,0,'C');
    $pdf->Cell(60,5,'',0,0,'C');
    $pdf->Cell(60,5,utf8_decode('DIRECTOR ACADÉMICO'),0,1,'C');





    
    $name = $acuse[0]->acta .'.pdf';
    //return $name;
    $pdf->Output('I',$name);
    exit;

    }
}
