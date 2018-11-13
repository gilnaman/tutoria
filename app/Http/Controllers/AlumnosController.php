<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;
use Session;
use App\Http\Requests;
use App\Alumno;
use App\Grupo;
use DB;
use Codedge\Fpdf\Fpdf\Fpdf;
use Response;

class AlumnosController extends Controller
{
    //

    public function cardex($matricula)
    {	
    


    	if (Session('matricula') == $matricula)
    	{

        $datos = Alumno::where('matricula','=',$matricula)->first();
        $grupo=$datos->grupoactual;

        
        
        $datgrup=Grupo::where('clavegrupo','=',$grupo)->first();
        $mitutor=$datgrup->idtutor;

        

        $dato_tutor=DB::connection('mysql')
        ->table('profesores')
        ->where('cedula','=',$mitutor)
        ->select('tratamiento','apellidop','apellidom','nombre')
        ->first();

        //return response()->json($dato_tutor);
        $mitutor = $dato_tutor->tratamiento .' ' .$dato_tutor->nombre . ' '. $dato_tutor->apellidop. ' '.$dato_tutor->apellidom;
        //return $mitutor;

	    	$alumnos = DB::connection('mysql')
	    	->table('alumnos')
	    	->join('carreras','carreras.idcarrera','=','alumnos.idcarrera')
	    	->select('alumnos.*','carreras.nombrelargo')
	    	->where('matricula','=',$matricula)
	    	->first();

	    	$sangres=DB::connection('mysql')
    		->table('tipos_sangre')->get();

    		$villas=DB::connection('mysql')
    		->table('villas')->get();

            $periodos=DB::connection('mysql')
            ->table('cat_periodos')->get();


	    	return view('alumnos.create')
	    	->with("alumnos",$alumnos)
	    	->with("sangres",$sangres)
            ->with('periodos',$periodos)
	    	->with("villas",$villas)
            ->with('tutor',$mitutor);

	    	//return view('alumnos.index');
	    }
	    else
	    {
	    	return Redirect::to('logout');
	    	//return 'Sesion: '. (Session('matricula')). ' matricula '. $matricula . ' no autorizado';

	    }

	 
	 
    	//->with("datos",$alumnos);
    }


public function index()
    {
        $alumnos = Alumno::where('grupoactual','=','TTS-4A')
        ->where('bajatemporal','=','0')
        ->where('bajadefinitiva','=','0')
        ->paginate(20);

      return view('tutor.panel_tutor')
      ->with('alumnos',$alumnos);
               
    }



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
        
        if ($alumno->id_villa==0)
            $pdf->Cell(8,6,'No',1,0,'C');
        else
            $pdf->Cell(8,6,'Si',1,0,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(34,6,'ESPECIFICAR VILLA: ',1,0,'C');
        $pdf->SetFont('Arial','',6);

        if (!empty($alumno->villa->direccion))
            $pdf->Cell(45,6,utf8_decode($alumno->villa->direccion),1,0,'C');
        else
            $pdf->Cell(45,6,'',1,0,'C');
        
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


        $pdf->Cell(10,6,$alumno->tiene_beca,1,0,'C');
        
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(25,6,'TIPO DE BECA: ',1,0,'C');
        $pdf->SetFont('Arial','',6);

        if($alumno->tiene_beca=='Si')
            $pdf->Cell(19,6,utf8_decode($alumno->tipo_beca),1,0,'C');
        else
            $pdf->Cell(19,6,'',1,0,'C');
        
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
        $pdf->Cell(65,6,'MADRE',1,0,'C');
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(27,6,'TIPO DE SANGRE: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        if(!empty($alumno->sangre->tipo))
            $pdf->Cell(22,6,utf8_decode($alumno->sangre->tipo),1,0,'C');
        else
            $pdf->Cell(22,6,'',1,0,'C');

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
        $pdf->Cell(47,6,utf8_decode('ALERGIA A ALGÚN MEDICAMENTO:'),1,0,'R');
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(38,6,$alumno->alergia,1,0,'C');
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
        if(!empty($alumno->foto))
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

    public function update(Request $request, $matricula)
    {
    	$alumno=Alumno::findOrFail($matricula);
        
        // DATOS GENERALES 
        $alumno->id_periodo=$request->get('id_periodo');
        $alumno->anio=$request->get('anio');
         $alumno->tutor=$request->get('tutor');

         //DATOS ACADEMICOS

        //if (Input::hasFile('imagen')){
          //  $file=Input::file('imagen');
           
            
        //}

          //obtenemos el campo file definido en el formulario
       $file = $request->file('imagen'); 
       
      if($file!=null) 
      {
        $nombre = $file->getClientOriginalName();
        
        
            $file->move(public_path().'/imagenes/alumnos/',$matricula.'.jpg');
            $alumno->foto=$matricula.'.jpg';
        }
       //obtenemos el nombre del archivo
      
        //var_dump($file);

        $alumno->curp=$request->get('curp');
    	$alumno->email=$request->get('email');
    	$alumno->celular=$request->get('celular');
    	$alumno->calle=$request->get('calle');
    	$alumno->cruzamiento=$request->get('cruzamiento');
    	$alumno->localidad=$request->get('localidad');
    	$alumno->municipio=$request->get('municipio');
    	$alumno->curp=$request->get('curp');
    	$alumno->tel_casa=$request->get('tel_casa');
    	$alumno->lugar_nac=$request->get('lugar_nac');
        $alumno->fecha_nac=$request->get('fecha_nac');
        $alumno->edad=$request->get('edad');
        $alumno->tiene_beca=$request->get('tiene_beca');
        $alumno->tipo_beca=$request->get('tipo_beca');
        $alumno->nss=$request->get('nss');
        $alumno->pade_fisico=$request->get('pade_fisico');
        $alumno->enfermedad=$request->get('enfermedad');
        $alumno->alergia=$request->get('alergia');
        $alumno->plantel_procedencia=$request->get('plantel_procedencia');


        $alumno->tel_contacto=$request->get('tel_contacto');


    	$alumno->dl_empresa=$request->get('dl_empresa');
    	$alumno->dl_direccion=$request->get('dl_direccion');
    	$alumno->dl_depto=$request->get('dl_depto');
    	$alumno->dl_telefono=$request->get('dl_telefono');
    	$alumno->dl_jefe=$request->get('dl_jefe');
    	$alumno->dl_horario=$request->get('dl_horario');
    	$alumno->dl_puesto=$request->get('dl_puesto');
    	$alumno->id_tipo_sangre=$request->get('id_tipo_sangre');
    	$alumno->id_villa=$request->get('id_villa');
    	
    	$alumno->madre=$request->get('madre');
        $alumno->padre=$request->get('padre2');

    	$alumno->update();

    	Session::flash('sucess', "Tu ficha se ha actualizado");
		return Redirect::back()
        ->with('success','Tu ficha se ha actualizado');

    
    }
}

