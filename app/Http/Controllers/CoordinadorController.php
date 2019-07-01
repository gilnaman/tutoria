<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Grupo;
use App\Carrera;
use App\Alumno;
use Codedge\Fpdf\Fpdf\Fpdf;
use Response;
use Session;

class CoordinadorController extends Controller
{
    public function index(){
    	return view('coordinador.listas');
    }


    public function listaGrupo($id){

    	$prueba=Session::get('grupo');
    	// return $prueba;

    	// $alumnos=Alumno::where('grupoactual','=',$id)
    	// ->where('bajadefinitiva','=',0)
    	// ->where('bajatemporal','=',0)
    	// ->orderby('apellidop','ASC')->get();
    	//return $alumnos;


    	 $alumnos = DB::Select("SELECT alumnos.matricula,alumnos.apellidop,alumnos.apellidom,alumnos.nombre
            FROM alumnos INNER JOIN alumnos_grupo on alumnos.matricula=alumnos_grupo.matricula
            WHERE alumnos_grupo.periodo='2019B' and alumnos_grupo.clave_grupo='$id'
            ORDER BY alumnos.apellidop ASC");



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
	    $pdf->Cell(5,3.5,utf8_decode('N°'),1,0,'C',1);
	    $pdf->Cell(20,3.5,utf8_decode('MATRÍCULA'),1,0,'C',1);
	    $pdf->Cell(72,3.5,'NOMBRE',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,0,'C',1);
	    $pdf->Cell(6.5,3.5,'',1,1,'C',1);

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
	            $pdf->Cell(5,3.5,$ix,1,0,'C');
	            $pdf->SetFont('Arial','',7);
	            $pdf->Cell(20,3.5,$alumno->matricula,1,0,'C');
	            $pdf->Cell(72,3.5,utf8_decode("$alumno->apellidop $alumno->apellidom $alumno->nombre"),1,0,'L');
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1,1);
	        }
	        
	        while($ix < 30)
	        {
	            $ix = $ix+1;
	            $pdf->Cell(5.5);
	            $pdf->SetFont('Arial','B',7);
	            $pdf->Cell(5,3.5,$ix,1,0,'C');
	            $pdf->Cell(20,3.5,'',1,0,'C');
	            $pdf->Cell(72,3.5,'',1,0,'L');
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1);
	            $pdf->Cell(6.5,3.5,'',1,1);
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


   //   public function resumenGrupo($grupo,$periodo)
   //  {
   //      //$grupo=Session::get('grupo');
   //      //$periodo = Session::get('periodo');
   //      // return Session::get('grupo');

   //      // $grupo='TTS-4B';
   //      // $periodo='2018C';

   //      $becas=DB::select("SELECT Count(*) as becados
   //                  from alumnos inner join grupos 
   //                  on grupos.clavegrupo=alumnos.grupoactual
   //                  where alumnos.tipo_beca<>'' 
   //                  and alumnos.grupoactual='$grupo' 
   //                  and alumnos.tiene_beca='Si' 
   //                  and grupos.periodo='$periodo'" );

   //      $villas=DB::select("SELECT Count(*) as villas
   //              from alumnos inner join grupos 
   //              on grupos.clavegrupo=alumnos.grupoactual
   //              where alumnos.id_villa <> '' 
   //              and alumnos.grupoactual='$grupo' 
   //              and grupos.periodo='$periodo'");


   //      $promedios = DB::select("SELECT carga.ClaveAsig,asignaturas.Nombre as materia,
   //          Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,1),1) as U1,
   //          Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,2),1) as U2,
   //          Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,3),1) as U3,
   //          Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,4),1) as U4,
   //          Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,5),1) as U5,
   //          Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,6),1) as U6
   //          From docentesporgrupo as carga INNER JOIN asignaturas on asignaturas.ClaveAsig=carga.ClaveAsig
   //          WHERE carga.ClaveGrupo='$grupo'");

        
   //      //$promedios= response()->json($promedios);
   //      //return $promedios;
   //      $asigs = array();
   //      $u1 = array();
   //      $u2 = array();
   //      $u3 = array();
   //      $u4 = array();
   //      $u5 = array();
   //      $u6 = array();

        
   //      foreach($promedios as $promedio)
   //      {
   //          $asig = $promedio->materia;
   //          array_push($asigs,$asig);

   //          $vu1 = $promedio->U1;
   //          array_push($u1,$vu1);

   //           $vu2 = $promedio->U2;
   //           array_push($u2,$vu2);

   //           $vu3 = $promedio->U3;
   //           array_push($u3,$vu3);

   //           $vu4 = $promedio->U4;
   //           array_push($u4,$vu4);

   //          $vu5 = $promedio->U5;
   //           array_push($u5,$vu5);

   //            $vu6 = $promedio->U6;
   //           array_push($u6,$vu6);
   //      }
   //      //return $u3;

        
   //      $todos = array("materias" => $asigs,
   //                      "u1" =>$u1,
   //                      "u2" =>$u2,
   //                      "u3" =>$u3,
   //                      "u4" =>$u4,
   //                      "u5" =>$u5,
   //                      "u6" =>$u6

   //                      );

   //      //return $asigs;
   //      //return view('tutor.promediosjs')
   //      return view('tutor.resumenvue')
   //      ->with("materias",$asigs)
   //      ->with("unidad1",$u1)
   //      ->with("unidad2",$u2)
   //      ->with("unidad3",$u3)
   //      ->with("unidad4",$u4)
   //      ->with("unidad5",$u5)
   //      ->with("unidad6",$u6)
   //      ->with('becados',$becas)
   //      ->with('villas',$villas);

   //      //endforeach
   // }


    public function promediosjs(Request $request)
    {

        // $grupo=Session::get('grupo');
        // $periodo = Session::get('periodo');
        // // return Session::get('grupo');

        $grupo='TTD-3A';
        $periodo='2019B';

        // $grupo=$request->get('grupo');
        // $periodo=$request->get('periodo');

        // $becas=DB::select("SELECT Count(*) as becados
        //             from alumnos inner join alumnos_grupo 
        //             on alumnos_grupo.matricula=alumnos.matricula
        //             where alumnos.id_beca<>'' 
        //             and alumnos_grupo.clave_grupo='$grupo' 
        //             and alumnos.tiene_beca='Si' 
        //             and alumnos_grupo.periodo='$periodo'" );

        // $villas=DB::select("SELECT Count(*) as villas
        //                     FROM alumnos INNER JOIN alumnos_grupo 
        //                     on alumnos_grupo.matricula=alumnos.matricula
        //                     WHERE alumnos.id_villa <> '' 
        //                     AND alumnos.tiene_villa='Si'
        //                     AND alumnos_grupo.clave_grupo='$grupo' 
        //                     AND alumnos_grupo.periodo='$periodo'");


        $promedios = DB::select("SELECT carga.ClaveAsig,asignaturas.Nombre as materia,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,1),1) as U1,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,2),1) as U2,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,3),1) as U3,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,4),1) as U4,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,5),1) as U5,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,6),1) as U6
            From docentesporgrupo as carga INNER JOIN asignaturas on asignaturas.ClaveAsig=carga.ClaveAsig
            WHERE carga.ClaveGrupo='$grupo'");

        // return $promedios;

   

        
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
        ->with("unidad6",$u6);
        // ->with('becados',$becas)
        // ->with('villas',$villas);

        //endforeach

    }

    // Obtiene la lista de las entregas del desglose, organizados por carrera
    //grupo, y profesor.
    
    public function entregaDesglose(){
				$desglose = DB::select("SELECT ponderaciones.idperiodo,
		left(clavegrupo,3) as carrera,
		ponderaciones.clavegrupo,
		asignaturas.nombre as asignatura,
		concat(profesores.tratamiento,' ',profesores.apellidop,' ',profesores.apellidom,' ',profesores.nombre) as docente,
		ponderaciones.unidad,
		ponderaciones.tipounidad,
		ponderaciones.porcentaje 
		FROM (ponderaciones INNER JOIN asignaturas on asignaturas.ClaveAsig=ponderaciones.idasignatura)
		INNER JOIN profesores ON profesores.cedula=ponderaciones.cedula
		WHERE ponderaciones.idperiodo='2019B'
		ORDER BY Carrera ASC,ponderaciones.idasignatura ASC,ponderaciones.cedula");

		return $desglose;   	
    }
}
