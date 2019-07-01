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
        $alumno=Alumno::find($matricula);
        return $alumno;


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
        // return $alumno;
    
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

        if($alumno->clavePeriodo!=null)
            $pdf->Cell(55,6,utf8_decode($alumno->periodo->nombregenerico),1,0,'C');
        else
            $pdf->Cell(55,6,utf8_decode(''),1,0,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(12,6,utf8_decode('AÑO: '),1,0,'C');
        $pdf->SetFont('Arial','',6);

        $pdf->Cell(20,6,$alumno->anio,1,0,'C');

        $pdf->Cell(63,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,utf8_decode('TUTOR ACADÉMICO: '),1,0,'R');
        $pdf->SetFont('Arial','',6);

        
        if($alumno->tutor!=null)
        $tutor = $alumno->tutor->tratamiento. ' '. $alumno->tutor->apellidop. ' ' .$alumno->tutor->apellidom. ' '.$alumno->tutor->nombre;
        else 
            $tutor='';
        
        $pdf->Cell(87,6,utf8_decode($tutor),1,0,'C');
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


        $municipio='';

        if($alumno->municipio!=null)
            $municipio=$alumno->municipio->nombre;
        $dire='Calle: '. $alumno->calle .' Entre: '.$alumno->cruzamiento. ' '.  $alumno->localidad.','. $municipio;
        

        $pdf->Cell(87,6,utf8_decode($dire),1,0,'C');
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
            $pdf->Cell(19,6,utf8_decode($alumno->beca->nombre),1,0,'C');
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

        $antecedente='';

        if($alumno->escuela!=null)
            $antecedente=$alumno->escuela->nombre;
        $pdf->Cell(116,6,utf8_decode($antecedente),1,0,'C');
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
        
        if($alumno->dl_empresa!=null)
            $pdf->Cell(116,6,utf8_decode($alumno->dl_empresa),1,0,'C');
        else
            $pdf->Cell(116,6,'',1,0,'C');

        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,utf8_decode('DIRECCION: '),1,0,'R');
        $pdf->SetFont('Arial','',6);
        
        if($alumno->dl_direccion!="null")
            $pdf->Cell(116,6,utf8_decode($alumno->dl_direccion),1,0,'C');
        else
            $pdf->Cell(116,6,'',1,0,'C');

        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,'DEPARTAMENTO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);

        if($alumno->dl_depto!="null")
            $pdf->Cell(46,6,utf8_decode($alumno->dl_depto),1,0,'C');
        else
            $pdf->Cell(46,6,'',1,0,'C');
        
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(48,6,'TEL. CONTACTO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);
        
        if($alumno->dl_telefono!="null")
            $pdf->Cell(22,6,utf8_decode($alumno->dl_telefono),1,0,'C');
        else
            $pdf->Cell(22,6,'',1,0,'C');
        
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,'JEFE INMEDIATO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);

        if($alumno->dl_jefe!="null")
            $pdf->Cell(56,6,utf8_decode($alumno->dl_jefe),1,0,'C');
        else
            $pdf->Cell(56,6,'',1,0,'C');
        
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(38,6,'HORARIO DE TRABAJO: ',1,0,'R');
        $pdf->SetFont('Arial','',6);

        if($alumno->dl_horario!="null")
            $pdf->Cell(22,6,utf8_decode($alumno->dl_horario),1,0,'C');
        else
            $pdf->Cell(22,6,'',1,0,'C');
        
        $pdf->Cell(25,6,' ',1,1,'C');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(47,6,'PUESTO LABORAL: ',1,0,'R');
        $pdf->SetFont('Arial','',6);

        if($alumno->dl_puesto!="null")
            $pdf->Cell(56,6,utf8_decode($alumno->dl_puesto),1,0,'C');
        else
            $pdf->Cell(56,6,'',1,0,'C');
        
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
        // date("d/m/Y")
        $pdf->Cell(30,3, $alumno->updated_at,'R',1,'C');
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
        // Fin de la ficha 


    public function getBoletas($grupo,$matricula){
        $periodo='2019A';

        $boleta = DB::connection('boletas')
        ->Select("SELECT  det.clavePeriodo,det.claveGrupo,det.claveAsig,asignaturas.Nombre,asignaturas.HrsTotales,det.matricula,
                concat(alumnos.apellidop,' ',alumnos.apellidom,' ',alumnos.nombre) as alumno,det.calificacion,det.nivel
                from (detalles_cardex as det INNER JOIN asignaturas on asignaturas.ClaveAsig=det.claveAsig)
                INNER JOIN alumnos on alumnos.matricula=det.matricula
                WHERE det.claveGrupo='$grupo' and det.matricula='$matricula' and det.clavePeriodo='$periodo'");

        return $boleta;

    }



    public function boleta($grupo,$matricula)
    {
      


        $periodo='2019A';

        $auxCarrera = substr($grupo,0,3);
        $carr="";
        if ($auxCarrera=="TAF")
            $carr="ADMINISTRACIÓN A.F.P";
        elseif (($auxCarrera=="TMI")) 
            $carr="MANTENIMIENTO ÁREA INDUSTRIAL";
        elseif ($auxCarrera=="TTD")
            $carr = "T.I AREA DESARROLLO DE SOFTWARE";
        elseif ($auxCarrera=="TGA")
            $carr="GASTRONOMÍA";
        elseif ($auxCarrera=="TTH")
            $carr="TURISMO ÁREA HOTELERÍA";
        elseif ($auxCarrera=="TTS")
            $carr="T.I.C ÁREA SISTEMAS INFORMÁTICOS";

        
        $boleta = DB::connection('boletas')
        ->Select("SELECT  det.clavePeriodo,det.claveGrupo,det.claveAsig,asignaturas.Nombre,asignaturas.HrsTotales,det.matricula,
                concat(alumnos.apellidop,' ',alumnos.apellidom,' ',alumnos.nombre) as alumno,det.calificacion,det.nivel
                from (detalles_cardex as det INNER JOIN asignaturas on asignaturas.ClaveAsig=det.claveAsig)
                INNER JOIN alumnos on alumnos.matricula=det.matricula
                WHERE det.claveGrupo='$grupo' and det.matricula='$matricula' and det.clavePeriodo='$periodo'");

        //return $boleta;





        $pdf = new Fpdf('P','mm','A4');

        $pdf->AddPage();

        //Principio
        $pdf->SetXY(10,8);
        $pdf-> Image('imagenes/logos/logo.png',15, 8, 30);//x, y, tamaño

        $pdf->SetFont('Arial','I',11);
        $pdf->Cell(180,4,'Departamento de Servicios Escolares',0,1,'R');
        $pdf->Ln(3);

        //Titulo

        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(180,14,'BOLETA DE CALIFICACIONES','B',1,'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial','',11);

        //Datos del Alumno

        $pdf->Cell(16,4,'Nombre: ',0,0,'L');
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(80,4,utf8_decode($boleta[0]->alumno),0,0,'L');

        $pdf->SetFont('Arial','',11);

        $pdf->Cell(18,4,utf8_decode('Matrícula:'),0,0,'L');
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(28,4,utf8_decode($boleta[0]->matricula),0,0,'L');

        $pdf->SetFont('Arial','',11);

        $pdf->Cell(13,4,utf8_decode('Grupo:'),0,0,'L');
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(25,4,utf8_decode($boleta[0]->claveGrupo),0,1,'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial','',11);

        $pdf->Cell(15,4,'Carrera: ',0,0,'L');
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(81,4,utf8_decode($carr),0,0,'L');


        $pdf->SetFont('Arial','',11);

        $pdf->Cell(24,4,'Cuatrimestre: ',0,0,'L');
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(60,4,'ENERO-ABRIL 2019',0,1,'L');
        $pdf->Ln(15);

        //Tabla
        //Títulos

        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(120,14,'ASIGNATURAS',1,0,'C');
        $pdf->Cell(20,14,'HORAS',1,0,'C');
        $pdf->Cell(40,7,utf8_decode('CALIFICACIÓN'),1,1,'C');
        $pdf->Cell(140,7,'',0,0,'C');
        $pdf->Cell(20,7,utf8_decode('NÚMERO'),1,0,'C');
        $pdf->Cell(20,7,'LETRA',1,1,'C');

        //Datos de Tabla

        $pdf->SetFont('Arial','',11);

        //Repite el bloque de código

        foreach ($boleta as $bole) {
            $pdf->Cell(120,10,utf8_decode($bole->Nombre),1,0,'L');
            $pdf->Cell(20,10,utf8_decode($bole->HrsTotales),1,0,'C');
            $pdf->Cell(20,10,utf8_decode($bole->calificacion),1,0,'C');
            $pdf->Cell(20,10,utf8_decode($bole->nivel),1,1,'C');
            
        }


         for ($i=0; $i <(8-count($boleta)) ; $i++) { 
             $pdf->Cell(120,10,'',1,0,'L');
            $pdf->Cell(20,10,'',1,0,'C');
            $pdf->Cell(20,10,'',1,0,'C');
            $pdf->Cell(20,10,'',1,1,'C');
         }
        
         
        //Firmas

        $pdf->Ln(25);
    

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(50,4,'',0,0,'C');
        $pdf->Cell(80,4,utf8_decode('VALIDACIÓN'),0,0,'C');
        $pdf->Cell(50,4,'',0,1,'C');
        $pdf->Ln(56);

        
        $pdf-> Image('imagenes/logos/firma_boletas.jpg',40,200, 120, 35);//x, y, tamaño
      

        //Tabla de Abreviaturas

        $pdf->SetFont('Arial','',6);

        $pdf->Cell(40,4,'ASIGNATURAS NO INTEGRADORAS:','L T B',0,'L');

        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(10,4,'10 AU','T B',0,'C');

        $pdf->SetFont('Arial','',6);
        $pdf->Cell(30,4,utf8_decode('AUTÓNOMO'),'T B',0,'L');

        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(10,4,'9 DE','T B',0,'C');

        $pdf->SetFont('Arial','',6);
        $pdf->Cell(30,4,'DESTACADO','T B',0,'L');

        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(10,4,'8 SA','T B',0,'C');

        $pdf->SetFont('Arial','',6);
        $pdf->Cell(25,4,'SATISFACTORIO','T B',0,'L');

        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(5,4,'NA','T B',0,'C');

        $pdf->SetFont('Arial','',6);
        $pdf->Cell(20,4,'NO ACREDITADO','R T B',1,'L');


        $pdf->SetFont('Arial','',6);

        $pdf->Cell(40,4,'ASIGNATURAS INTEGRADORAS:','L T B',0,'L');

        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(10,4,'10 CA','T B',0,'C');

        $pdf->SetFont('Arial','',6);
        $pdf->Cell(30,4,utf8_decode('COMPETENTE AUTÓNOMO'),'T B',0,'L');

        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(10,4,'9 CD','T B',0,'C');

        $pdf->SetFont('Arial','',6);
        $pdf->Cell(30,4,'COMPETENTE DESTACADO','T B',0,'L');

        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(10,4,'8 CO','T B',0,'C');

        $pdf->SetFont('Arial','',6);
        $pdf->Cell(25,4,'COMPETENTE','T B',0,'L');

        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(5,4,'NA','T B',0,'L');

        $pdf->SetFont('Arial','',6);
        $pdf->Cell(20,4,'NO ACREDITADO','R T B',1,'L');
        $pdf->Ln(12);

        //Pie de Página

        $pdf->SetFont('Arial','',11);
        $pdf->Cell(180,4,'F-UTC-SES-06/01',0,1,'R');
        

        $pdf->output();
        exit;




    }
    // Fin de boleta

    public function boleta2()
    {


$pdf = new FPDF('L', 'mm', 'A5'); //Creamos un objeto de la librería horizontal o vertical, tamaño en milimetros y tipo de hoja
$pdf->AddPage();

$pdf->SetXY(10,8);
$pdf-> Image('imagenes/logos/logo.png',15, 12, 35);//x, y, tamaño
$pdf->SetFont('Arial','', 9);
$pdf->SetXY(10,19);
$pdf->Cell(188,5,utf8_decode('Universidad Tecnológica del Centro'),0,1,'C');
$pdf->SetFont('Arial','B', 12);
$pdf->Cell(188,6,'BOLETA DE CALIFICACIONES',0,1,'C');
$pdf->Ln(2);
$pdf->Cell(188,6,'','T');
$pdf->Ln(5);

$pdf->SetXY(5,37);
$pdf->Cell(5);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(14,5,'NOMBRE:',0,0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(55,5,utf8_decode('JOSÉ GILBERTO BALAM'),0,0,'C');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(18,5,utf8_decode('MATRÍCULA:'),0,0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(16,5,utf8_decode('12345'),0,0,'C');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(14,5,utf8_decode('PERÍODO:'),0,0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(32,5,utf8_decode($alumnos->periodo->nombregenerico),0,0,'C');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(29,5,utf8_decode('CUATRIMESTRE-GRUPO:'),0,0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(10,5,utf8_decode('ENERO-ABRIL'),0,1,'C');

$pdf->SetXY(5,45);
$pdf->Cell(5);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(14,5,'CARRERA:',0,0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(75,5,utf8_decode('TECNOLOGÍAS'),0,0,'C');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(18,5,utf8_decode('GENERACIÓN:'),0,0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(31,5,utf8_decode('generacionX'),0,0,'C');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(25,5,utf8_decode('FECHA DE EMISIÓN:'),0,0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(25,5,date("d/m/Y"),0,1,'C');

$pdf->SetXY(5,55);
$pdf->Cell(5);
$pdf->SetFillColor(216,216,216);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(120,6,'ASIGNATURA',1,0,'C',1);
$pdf->Cell(50,6,utf8_decode('CALIFICACIÓN'),1,0,'C',1);
$pdf->Cell(18,6,'EVAL',1,1,'C',1);

$pdf->SetFont('Arial','',7);
$pdf->Cell(5,6,'','L');
$pdf->Cell(115,6,utf8_decode('algebra'),'R',0,'L');
$pdf->Cell(50,6,'9.2','L,R',0,'C');
$pdf->Cell(18,6,'AU','L,R',1,'C');

// $pdf->Cell(5,6,'','L');
// $pdf->Cell(115,6,$prueba2[utf8_decode('desarrollo')],'R',0,'L');
// $pdf->Cell(50,6,$prueba2['calificacion_dos'],'L,R',0,'C');
// $pdf->Cell(18,6,$calificacion_dos,'L,R',1,'C');


// $pdf->Cell(5,6,'','L');
// $pdf->Cell(115,6,$prueba2[utf8_decode('fundamentos')],'R',0,'L');
// $pdf->Cell(50,6,$prueba2['calificacion_tres'],'L,R',0,'C');
// $pdf->Cell(18,6,$calificacion_tres,'L,R',1,'C');


// $pdf->Cell(5,6,'','L');
// $pdf->Cell(115,6,$prueba2[utf8_decode('metodologia')],'R',0,'L');
// $pdf->Cell(50,6,$prueba2['calificacion_cuatro'],'L,R',0,'C');
// $pdf->Cell(18,6,$calificacion_cuatro,'L,R',1,'C');

// $pdf->Cell(5,6,'','L');
// $pdf->Cell(115,6,$prueba2[utf8_decode('red')],'R',0,'L');
// $pdf->Cell(50,6,$prueba2['calificacion_cinco'],'L,R',0,'C');
// $pdf->Cell(18,6,$calificacion_cinco,'L,R',1,'C');

// $pdf->Cell(5,6,'','L');
// $pdf->Cell(115,6,$prueba2[utf8_decode('ingles')],'R',0,'L');
// $pdf->Cell(50,6,$prueba2['calificacion_seis'],'L,R',0,'C');
// $pdf->Cell(18,6,$calificacion_seis,'L,R',1,'C');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(5,6,'','L,B');
$pdf->Cell(110,6,'PROMEDIO: ','B',0,'R');
$pdf->Cell(5,6,'','R,B');
$pdf->Cell(50,6,round(9.8,1),'L,R,B',0,'C');
$pdf->Cell(18,6,'','L,R,B',1,'C');

$pdf->SetFont('Arial','',7);
$pdf->Cell(18,4,'U: Unidad',0,1,'L');
$pdf->Cell(18,4,'O: Ordinario',0,1,'L');
$pdf->Cell(18,4,'G: Global',0,1,'L');
$pdf->Cell(18,4,'R: Remedial',0,1,'L');
$pdf->Cell(18,4,'E: Especial',0,1,'L');

$pdf->SetFont('Arial','',7);
$pdf->Cell(0,5,'F-UTC-SES-18/V04',0,1,'R');

$pdf->Output(); 



    }





}
// Fin de la clase



