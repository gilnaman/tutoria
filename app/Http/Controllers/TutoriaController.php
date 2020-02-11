<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Alumno;
use APP\Grupo;
use Session;
use Response;



// use Barryvdh\DomPDF\Facade;
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
        // $alumnos = Alumno::where('grupoactual','=',Session::get('grupo'))
        // ->where('bajatemporal','=','0')
        // ->where('bajadefinitiva','=','0')
        // ->orderby('apellidop','ASC')

        // ->paginate(20);
        
      return view('tutor.panel_tutor2');
      // ->with('alumnos',$alumnos);
        
        
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

    public function cardex(){
        $pdf=new Fpdf('L','mm','A4');    
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',6);
        
        $pdf->Cell(5,3,'',1,0,'C');
        $pdf->Cell(15,3,'',1,0,'C');
        $pdf->Cell(50,3,'',1,0,'L');
        

        // Listado de asignaturas

        $asignaturas = DB::select("SELECT doc.periodo,doc.claveasig,asignaturas.nombre,
                (SELECT count(*) as unidades
                from ponderaciones 
                WHERE ponderaciones.idperiodo='2019B' AND ponderaciones.clavegrupo='TGA-3A' AND idasignatura=doc.ClaveAsig
                ) as unidades,
                doc.cedula,
                doc.clavegrupo
                from docentesporgrupo as doc INNER JOIN asignaturas on asignaturas.ClaveAsig=doc.ClaveAsig
                WHERE doc.Periodo='2019B' AND doc.ClaveGrupo='TGA-3A'
                ORDER BY ClaveAsig ASC");
        $unid=0;
        $ancho_col=0;
        $num_asig=count($asignaturas);
        $aux_cont=0;
        foreach ($asignaturas as $asignatura) {
            $aux_cont++;
            $unid=$asignatura->unidades;
            $ancho_col=$unid * 6;
            if ($aux_cont<$num_asig)
                $pdf->Cell($ancho_col,3,utf8_decode($asignatura->claveasig),1,0,'C');
            else
                $pdf->Cell($ancho_col,3,utf8_decode($asignatura->claveasig),1,1,'C');
       }

        $pdf->SetFont('Arial','',5);
        $pdf->Cell(5,3,'',1,0,'C');
        $pdf->Cell(15,3,'',1,0,'C');
        $pdf->Cell(50,3,'',1,0,'L');

        $num_unidades=0;
        foreach ($asignaturas as $asignatura) {
            $num_unidades=($asignatura->unidades);

            for ($i=0; $i < ($num_unidades) ; $i++) { 
                
                    $pdf->Cell(6,3,utf8_decode($i+1),1,0,'C');
                
            }
            // $pdf->Cell(6,3,utf8_decode('T'),1,0,'C');
        }
        $pdf->Ln(3);
        $ponderaciones = DB::select("SELECT ponderaciones.*
                        from ponderaciones where ponderaciones.idperiodo='2019B' and ponderaciones.clavegrupo='TGA-3A'
                        ORDER BY ponderaciones.idasignatura,ponderaciones.unidad");
        $pdf->Cell(5,3,'',1,0,'C');
        $pdf->Cell(15,3,'',1,0,'C');
        $pdf->Cell(50,3,'',1,0,'L');


        // imprimo tipos de unidad
        foreach ($ponderaciones   as $pond) {
            $pdf->Cell(6,3,utf8_decode($pond->tipounidad),1,0,'C');
        }



        $pdf->Ln(3);

        $pdf->Cell(5,3,'',1,0,'C');
        $pdf->Cell(15,3,'',1,0,'C');
        $pdf->Cell(50,3,'',1,0,'L');

        // imprimo valor de unidades
        foreach ($ponderaciones   as $pond) {
            $pdf->Cell(6,3,utf8_decode($pond->porcentaje),1,0,'C');
        }


         $pdf->output();
        exit;


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
            ORDER BY alumnos.apellidop ASC");

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
        $grupo=Session::get('grupo');
        $periodo = Session::get('periodo');
        // $grupo='TTS-4A';
        // $periodo='2018C';

        $promedios = DB::select("SELECT carga.ClaveAsig,asignaturas.Nombre as materia,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,1),1) as U1,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,2),1) as U2,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,3),1) as U3,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,4),1) as U4,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,5),1) as U5,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,6),1) as U6
            From docentesporgrupo as carga INNER JOIN asignaturas on asignaturas.ClaveAsig=carga.ClaveAsig
            WHERE carga.ClaveGrupo='$grupo'");
        //return $promedios;

    
        
        return view('tutor.resumenvue')
        ->with('promedios',$promedios);
        //return response()->json($promedios);

    }

     public function promediosjs()
    {

        $grupo=Session::get('grupo');
        $periodo = Session::get('periodo');
        // return Session::get('grupo');

        // $grupo='TTS-4B';
        // $periodo='2018C';

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
            WHERE carga.ClaveGrupo='$grupo' 
            AND carga.periodo='$periodo'");

        

        
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
        return view('tutor.resumenvue')
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

    public function resumen()
     {
        $grupo='TTS-4A';
        $periodo='2018C';

        $becas=DB::select("SELECT Count(*) as becados
                    from alumnos inner join grupos 
                    on grupos.clavegrupo=alumnos.grupoactual
                    where alumnos.tipo_beca<>'' 
                    and alumnos.grupoactual='$grupo' 
                    and alumnos.tiene_beca='Si' 
                    and grupos.periodo='$periodo'" );

        $villas=DB::select("SELECT Count(*) as villas
                from alumnos inner join grupos 
                on grupos.clavegrupo=alumnos.grupoactual
                where alumnos.id_villa <> '' 
                and alumnos.grupoactual='$grupo' 
                and grupos.periodo='$periodo'");


        $promedios = DB::select("SELECT carga.ClaveAsig,asignaturas.Nombre as materia,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,1),1) as U1,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,2),1) as U2,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,3),1) as U3,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,4),1) as U4,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,5),1) as U5,
            Round(getPromedioPorAsig('$periodo','$grupo',carga.ClaveAsig,6),1) as U6
            From docentesporgrupo as carga INNER JOIN asignaturas on asignaturas.ClaveAsig=carga.ClaveAsig
            WHERE carga.ClaveGrupo='$grupo'");

        $asigs = array();
        $u1 = array();
        $u2 = array();
        $u3 = array();
        $u4 = array();

        
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
        }

        //return $u2;

        //return json_encode($becas);
        return view('tutor.resumen')
        ->with('becados',$becas)
        ->with('villas',$villas)
        ->with("materias",$asigs)
        ->with("u1",$u1)
        ->with("u2",$u2)
        ->with("u3",$u3);

     }

     public function avance()
     {
        return view('tutor.avance');       
     }

     public function regsEvento()
     {
         $pdf=new Fpdf('P','mm','A4');    
         $pdf->AddPage();

        //ENCABEZADO
        $pdf->SetXY(10,8);
        $pdf->Image(public_path().'/imagenes/logos/logo.png', 8, 5, 30);//x, y, tamaño
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(70);
        $pdf->Cell(100,6,utf8_decode('REGISTRO DE ASISTENCIA'),1,0,'C');
        $pdf->Ln(6);
        $pdf->Cell(70);
        $pdf->Cell(100,6,utf8_decode('PARA CONFERENCIA'),0,0,'C');
        $pdf->Ln(10);
        $pdf->Cell(70,6,'',0,0,'C');
        $pdf->Cell(30,6,utf8_decode('CARRERA :'),0,0,'L');
        $pdf->Cell(10,6,'',0,0,'L');
        $pdf->Cell(75,6,'','B',0,'L');

        $pdf->Ln(8);
        $pdf->Cell(70,6,'',0,0,'C');
        $pdf->Cell(30,6,utf8_decode('CUATRIMESTRE :'),0,0,'L');
        $pdf->Cell(10,6,'',0,0,'L');
        $pdf->Cell(25,6,'','B',0,'L');

        $pdf->Cell(15,6,utf8_decode('GRUPO:'),0,0,'R');
        $pdf->Cell(7,6,'',0,0,'L');
        $pdf->Cell(28,6,'','B',0,'L');

        $pdf->Ln(9);
        $pdf->Cell(15,6,'',0,0,'C');
        $pdf->Cell(60,6,'NOMBRE DE LA CONFERENCIA: ',0,0,'L');
        $pdf->Cell(80,6,'','B',0,'L');

        $pdf->Ln(6);
        $pdf->Cell(15,6,'',0,0,'C');
        $pdf->Cell(60,6,'EXPOSITOR : ',0,0,'C');
        $pdf->Cell(80,6,'','B',0,'L');

        $pdf->Ln(6);
        $pdf->Cell(15,6,'',0,0,'C');
        $pdf->Cell(60,6,'FECHA : ',0,0,'C');
        $pdf->Cell(80,6,'','B',0,'L');


        $pdf->SetFont('Arial','', 8);
        $pdf->Ln(8);
        $pdf->Cell(15,6,'No',0,0,'C');
        $pdf->Cell(90,6,'NOMBRE DEL ALUMNO',0,0,'C');
        $pdf->Cell(10,6,'',0,0,'L');
        $pdf->Cell(70,6,'FIRMA',0,0,'C');

        $pdf->Ln(5);
        for ($i=0; $i <35 ; $i++) { 
        
        
        $pdf->Cell(15,6,$i+1,0,0,'C');
        $pdf->Cell(90,6,'12345678-'.' '.'MARIA ANA VICTORIA POOL BALAM',1,0,'L');
        $pdf->Cell(10,6,'',0,0,'L');
        $pdf->Cell(70,6,'','B',0,'C');
        $pdf->Ln(5.9);

        }




         $headers=['Content-Type'=>'aplication/pdf'];

            return Response::make($pdf->Output(),200,$headers);

     }



    
}
