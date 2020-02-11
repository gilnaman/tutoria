<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ponderacion;
use DB;
class ApiPonderacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ponderacion::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pondera = new Ponderacion;

        $valores=$request->get('valores');
        $tipos=$request->get('tipos');
        $entregas=$request->get('fechas_planificadas');
        $unidades=$request->get('unidades');
        
       // return $valores;
        $records = [];


        for ($i=0; $i <count($tipos) ; $i++) { 
            $records[] = [
                    'id_ponderacion'=>'2019C'.'-'.$request['clavegrupo'].'-'.$request['idasignatura'].'-'. $request['cedula'].'-'.$unidades[$i],
                    'idasignatura' => $request['idasignatura'],
                    'idperiodo' => '2019C',
                    'clavegrupo'=>$request['clavegrupo'],
                    'cedula' => $request['cedula'],
                    'unidad' =>$unidades[$i],
                    'porcentaje'=>$valores[$i],
                    'tipounidad' => $tipos[$i],
                    'fecha_planificada' => $entregas[$i]
                    
                ];
            }
        $pondera->insert($records);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $pondera=Ponderacion::find($id);
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

    public function getPondera($periodo,$grupo,$asignatura,$cedula)
    {

        $ponderacion = DB::select("SELECT * from ponderaciones WHERE idperiodo='$periodo' AND 
            clavegrupo='$grupo' AND 
            idasignatura='$asignatura' AND 
            cedula='$cedula'");
        return $ponderacion;

       
    }
}
