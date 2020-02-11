<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Evento;
use App\Evento_Grupo;
use DB;
use Session;

class ApiEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodo = Session::get('periodo');
        $eventos = Evento::orderBy('created_at','ASC')->get();

        $estadisticas = DB::select("SELECT tipos_eventos.tipo,count(eventos.id_evento) as cantidad
            FROM eventos INNER JOIN tipos_eventos on tipos_eventos.id_tipo=eventos.id_tipo
            WHERE eventos.periodo='$periodo'
            GROUP BY tipos_eventos.id_tipo");


         return $datos[] = [
                    'eventos' => $eventos,
                    'estadisticas' => $estadisticas,
                    
            ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evento = new Evento;
        $evento->id_evento=$request->get('id_evento');
        $evento->id_tipo=$request->get('id_tipo');
        $evento->fecha_evento=$request->get('fecha_evento');
        $evento->titulo=$request->get('titulo');
        $evento->expositor=$request->get('expositor');
        $evento->periodo=$request->get('periodo');
        $evento->descripcion=$request->get('descripcion');
        
        // GENERAR INSERTS EN DETALLE EVENTOS

        $grupos = $request->get('grupos');
        $id_evento=$request->get('id_evento');

         $records = [];

         for ($i=0; $i <count($grupos) ; $i++) { 
        
          $id_grupo=$grupos[$i]['grupo'];
          
          

            $records[] = [
                    'id_evento' => $id_evento,
                    'id_grupo' => $id_grupo,
                    
            ];
        }

        // return $records;
        $evento->save();
        Evento_Grupo::insert($records);

        

        

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
}
