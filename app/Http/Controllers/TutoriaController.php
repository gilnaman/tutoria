<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Alumno;
use APP\Grupo;
use Session;
use Response;



use Barryvdh\DomPDF\Facade;
//use Codedge\Fpdf\Facades\Fpdf;
use Codedge\Fpdf\Fpdf\Fpdf;

class TutoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::where('grupoactual','=',Session::get('grupo'))
        ->where('bajatemporal','=','0')
        ->where('bajadefinitiva','=','0')
        ->orderby('apellidop','ASC')

        ->paginate(20);

      return view('tutor.panel_tutor')
      ->with('alumnos',$alumnos);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        

        $alumno=Alumno::find($id);


    
    $pdf=new Fpdf('P','mm','A4');    
    $pdf->AddPage();

        //ENCABEZADO

                $pdf->SetXY(10,8);
                $pdf->Image(public_path().'/imagenes/logos/logo.png', 8, 5, 30);//x, y, tamaño
                $pdf->SetFont('Arial','B', 11);
                $pdf->Cell(90);
                $pdf->Cell(100,8,utf8_decode('DIRECCIÓN DE CARRERAS / TUTORIAS'),0,0,'R');
                $pdf->Ln(10);

        //CUERPO

        $pdf->SetFillColor(206,250,0);
        $pdf->SetFont('Arial','B',9); //Establecemos tipo de fuente, negrita y tamaño 6
        $pdf->SetXY(10,30);
        $pdf->Cell(188,8,utf8_decode('CÉDULA DE INFORMACIÓN INDIVIDUAL'),1,1,'C',1); //Agregamos texto en una celda de 40px ancho y 10px de alto, Con Borde, Sin salto de linea y Alineada a la derecha

        $pdf->Cell(188,4,'',1,1,'C');

        $pdf->SetFont('Arial','B',7); //Establecemos tipo de fuente, negrita y tamaño 6
        $pdf->Cell(38,6,'CARRERA: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        //$pdf->Cell(150,6,$prueba[utf8_decode('carrera')],1,1,'C');
        $pdf->Cell(150,6,utf8_decode($alumno->carrera->nombrelargo),1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,utf8_decode('PERÍODO: '),1,0,'R');
        $pdf->SetFont('Arial','',6);

        $pdf->Cell(55,6,'2018C',1,0,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(12,6,utf8_decode('AÑO: '),1,0,'C');
        $pdf->SetFont('Arial','',6);

        $pdf->Cell(20,6,'2018',1,0,'C');

        $pdf->Cell(63,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,utf8_decode('TUTOR ACADÉMICO: '),1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(87,6,utf8_decode($alumno->tutor),1,0,'C');
        $pdf->Cell(63,6,' ',1,1,'C');


        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'GRADO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);

        $pdf->Cell(15,6,utf8_decode($alumno->gradoactual),1,0,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(18,6,utf8_decode('GRUPO: '),1,0,'C');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(10,6,$alumno->grupoactual,1,0,'C');
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(18,6,utf8_decode('TURNO: '),1,0,'C');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(26,6,'MATUTINO',1,0,'C');
        $pdf->Cell(63,6,' ',1,1,'C');

        $pdf->Cell(188,4,'',1,1,'C');

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(188,8,'DATOS DEL ALUMNO',1,1,'C');

        $pdf->Cell(188,4,'',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'FOTO:','L,R',0,'C');
        $pdf->Cell(38,6,'NOMBRE COMPLETO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(87,6,utf8_decode($alumno->fullname),1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C'); 

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'','L,R',0,'C');
        $pdf->Cell(38,6,'MATRICULA: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(49,6,$alumno->matricula,1,0,'C');
        $pdf->Cell(63,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'','L,R',0,'C');
        $pdf->Cell(38,6,'DOMICILIO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(87,6,utf8_decode("Calle: $alumno->calle Entre: $alumno->cruzamiento  $alumno->localidad,  $alumno->municipio"),1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'','L,R',0,'C');
        $pdf->Cell(38,6,'APOYO DE VILLA: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(8,6,'prueba',1,0,'C');
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(34,6,'ESPECIFICAR VILLA: ',1,0,'C');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(45,6,utf8_decode($alumno->villa->direccion),1,0,'C');
        $pdf->Cell(25,6,'',1,1,'C'); 

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'','L,R',0,'C');
        $pdf->Cell(38,6,'TEL. DOMICILIO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(22,6,utf8_decode($alumno->tel_casa),1,0,'C');
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(24,6,'CURP: ',1,0,'C');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(41,6,utf8_decode($alumno->curp),1,0,'C');
        $pdf->Cell(25,6,'',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'','L,R',0,'C');
        $pdf->Cell(38,6,'TEL. CELULAR: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(22,6,utf8_decode($alumno->celular),1,0,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(17,6,'BECA: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(10,6,'prueba',1,0,'C');
        
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(25,6,'TIPO DE BECA: ',1,0,'C');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(19,6,utf8_decode($alumno->tipo_beca),1,0,'C');
        $pdf->Cell(19,6,'',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'','L,R',0,'C');
        $pdf->Cell(38,6,'E-MAIL: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(50,6,utf8_decode($alumno->email),1,0,'C');
        $pdf->Cell(62,6,' ',1,1,'C');  

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'','L,R',0,'C');
        $pdf->Cell(38,6,'FECHA DE NACIMIENTO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(22,6,utf8_decode($alumno->fecha_nac),1,0,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(24,6,'EDAD: ',1,0,'C');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(28,6,utf8_decode($alumno->edad),1,0,'C');
        $pdf->Cell(38,6,'',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'','L,R',0,'C');
        $pdf->Cell(38,6,'LUGAR DE NACIMIENTO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(50,6,utf8_decode($alumno->lugar_nac),1,0,'C');
        $pdf->Cell(62,6,' ',1,1,'C'); 

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(27,6,'',1,0,'C');
        $pdf->Cell(49,6,'NOMBRE COMPLETO DEL PADRE: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(87,6,utf8_decode($alumno->padre),1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(27,6,'',1,0,'C');
        $pdf->Cell(49,6,'NOMBRE COMPLETO DE LA MADRE: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(87,6,utf8_decode($alumno->madre),1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(27,6,'TEL. CONTACTO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(22,6,utf8_decode($alumno->tel_contacto),1,0,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(49,6,'CONTACTO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(65,6,'prueba',1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(27,6,'TIPO DE SANGRE: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(22,6,utf8_decode($alumno->sangre->tipo),1,0,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(49,6,'NSS: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(45,6,utf8_decode($alumno->nss),1,0,'C');
        $pdf->Cell(45,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,'PADECIMIENTO FISICO DE SALUD: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(38,6,utf8_decode($alumno->pade_fisico),1,0,'C');
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(39,6,'ENFERMEDAD CRONICA: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(39,6,utf8_decode($alumno->enfermedad),1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,'prueba',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(38,6,'prueba',1,0,'C');
        $pdf->Cell(103,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,utf8_decode('ANTECEDENTES ACADÉMICOS: '),1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(116,6,utf8_decode($alumno->plantel_procedencia),1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,'PLANTEL: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(96,6,utf8_decode($alumno->plantel_procedencia),1,0,'C');
        $pdf->Cell(45,6,' ',1,1,'C');

        $pdf->Image(public_path().'/imagenes/alumnos/'. $alumno->foto, 12, 88, 34,42);

        $pdf->Cell(188,4,'',1,1,'C');
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(188,8,'CENTRO DE TRABAJO',1,1,'C');
        $pdf->Cell(188,4,'',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,'EMPRESA: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(116,6,utf8_decode($alumno->dl_empresa),1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,utf8_decode('DIRECCION: '),1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(116,6,utf8_decode($alumno->dl_direccion),1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,'DEPARTAMENTO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(46,6,utf8_decode($alumno->dl_depto),1,0,'C');
        
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(48,6,'TEL. CONTACTO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(22,6,utf8_decode($alumno->dl_telefono),1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,'JEFE INMEDIATO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(56,6,utf8_decode($alumno->dl_jefe),1,0,'C');
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'HORARIO DE TRABAJO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(22,6,utf8_decode($alumno->dl_horario),1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,'PUESTO LABORAL: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(56,6,utf8_decode($alumno->dl_puesto),1,0,'C');
        $pdf->Cell(85,6,' ',1,1,'C');

        $pdf->Cell(188,3,'',1,1,'C');
        $pdf->Cell(188,4,utf8_decode('Manifiesto bajo protesta de decir verdad que la información contenida en este documento es verídica'),'L,R',1,'C');
        $pdf->Cell(188,20,'','L,R',1,'C');
        $pdf->Cell(188,3,'_______________________________________','L,R',1,'C');
        $pdf->Cell(50,3,'','L',0,'C');
        $pdf->Cell(88,3,'FIRMA DEL ALUMNO',0,0,'C');
        $pdf->Cell(20,3,'',0,0,'C');
        $pdf->Cell(30,3,utf8_decode('Fecha de actualización:'),'R',1,'C');
        $pdf->Cell(50,3,'','L',0,'C');
        $pdf->Cell(88,3,utf8_decode($alumno->fullname),0,0,'C');
        $pdf->Cell(20,3,'',0,0,'C');
        $pdf->Cell(30,3,date("d/m/Y"),'R',1,'C');
        $pdf->Cell(188,3,'','L,B,R',1,'C');

        // PIE
        //$pdf->SetY(-10);
        $pdf->SetFont('Arial','', 7);
        $pdf->Cell(0,5,'_____________________________________Firma de revisado por tutor',0,0,'L');
        //$pdf->SetY(-10);
        $pdf->SetFont('Arial','', 7);
        $pdf->Cell(0,5,'F-UTC-DCA-25',0,0,'R');
            
            $headers=['Content-Type'=>'aplication/pdf'];

            return Response::make($pdf->Output(),200,$headers);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       



        $alumnos = DB::connection('mysql')
            ->table('alumnos')
            ->join('carreras','carreras.idcarrera','=','alumnos.idcarrera')
            ->select('alumnos.*','carreras.nombrelargo')
            ->where('matricula','=',$id)
            ->first();

            $sangres=DB::connection('mysql')
            ->table('tipos_sangre')->get();

            $villas=DB::connection('mysql')
            ->table('villas')->get();

            $periodos=DB::connection('mysql')
            ->table('cat_periodos')->get();


            return view('alumnos.create2')
            ->with("alumnos",$alumnos)
            ->with("sangres",$sangres)
            ->with('periodos',$periodos)
            ->with("villas",$villas);
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

        $reprobados = DB::select("SELECT matricula,concat(apellidop,' ',apellidom,' ',nombre) as 'alumno',
            getReprobadas(matricula,1,'$periodo','$grupo') as u1,
            getReprobadas(matricula,2,'$periodo','$grupo') as u2,
            getReprobadas(matricula,3,'$periodo','$grupo') as u3,
            getReprobadas(matricula,4,'$periodo','$grupo') as u4,
            getReprobadas(matricula,5,'$periodo','$grupo') as u5,
            getReprobadas(matricula,6,'$periodo','$grupo') as u6
            FROM alumnos 
            WHERE grupoactual='$grupo' and bajadefinitiva=0");

        //return $reprobados;

        $totu1=0;
        $totu2=0;
        $totu3=0;
        $totu4=0;
        $totu5=0;
        $totu6=0;
        $totales= array();
        foreach($reprobados as $reprobado)
        {
            $totu1=$totu1 + $reprobado->u1;
            $totu2=$totu2 + $reprobado->u2;
            $totu3=$totu3 + $reprobado->u3;
            $totu4=$totu4 + $reprobado->u4;
            $totu5=$totu5 + $reprobado->u5;
            $totu6=$totu6 + $reprobado->u6;
        }
       $totales[0]=$totu1;
       $totales[1]=$totu2;
       $totales[2]=$totu3;
       $totales[3]=$totu4;
       $totales[4]=$totu5;
       $totales[5]=$totu6;
       //return $totales;

       //$repros = [
              //  'ru1' => $totu1,
               // 'u2' => $totu2,
               // 'u3' => $totu3,
               // 'u4' => $totu4,
               // 'u5' => $totu5,
               // 'u6' => $totu6
            //];


        //return $repros;

        return view('tutor.reprobados')
        ->with('reprobados',$reprobados)
        ->with('totales',$totales);
       
        
        

    }

    public function pdf()
    {
            
            
            $pdf = \PDF::loadView('tutor.fjustificaciones');
            return $pdf->download('justifica.pdf');
    }


    public function promediosgrupo()
    {
        //$grupo=Session::get('grupo');
        //$periodo = Session::get('periodo');
        $grupo='TTS-4A';
        $periodo='2018C';

        $promedios = DB::select("SELECT carga.ClaveAsig,asignaturas.Nombre as materia,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,1),1) as U1,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,2),1) as U2,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,3),1) as U3,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,4),1) as U4,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,5),1) as U5,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,6),1) as U6
            From docentesporgrupo as carga INNER JOIN asignaturas on asignaturas.ClaveAsig=carga.ClaveAsig
            WHERE carga.ClaveGrupo='$grupo'");

        return view('tutor.promasig')
        ->with('promedios',$promedios);
        //return response()->json($promedios);

    }


    public function fpdf()
    {
        
    }


    public function otro()
    {
    
        $fpdf=new Fpdf('P','mm','A5');    

    $fpdf->AddPage();
    $fpdf->SetFont('Courier', 'B', 18);
    $fpdf->Cell(50, 25, 'Hello World!');
    
    //$fpdf->Output();

    $headers=['Content-Type'=>'aplication/pdf'];

            return Response::make($fpdf->Output(),200,$headers);


    }    
}
