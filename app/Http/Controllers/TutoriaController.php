<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Alumno;
use APP\Grupo;
use Session;



use Barryvdh\DomPDF\Facade;
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
        //
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
        $reprobados = DB::select("SELECT matricula,concat(apellidop,' ',apellidom,' ',nombre) as 'alumno',
            getReprobadas(matricula,1,'2018C','TTS-4A') as u1,
            getReprobadas(matricula,2,'2018C','TTS-4A') as u2,
            getReprobadas(matricula,3,'2018C','TTS-4A') as u3,
            getReprobadas(matricula,4,'2018C','TTS-4A') as u4,
            getReprobadas(matricula,5,'2018C','TTS-4A') as u5,
            getReprobadas(matricula,6,'2018C','TTS-4A') as u6
            FROM alumnos 
            WHERE grupoactual='TTS-4A' and bajadefinitiva=0");

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

        //return $totu1;

        return view('tutor.reprobados')
        ->with('reprobados',$reprobados)
        ->with('totales',$totales);
        
        

    }

    public function pdf()
    {
            
            
            $pdf = \PDF::loadView('tutor.fjustificaciones');
            return $pdf->download('justifica.pdf');
    }
}
