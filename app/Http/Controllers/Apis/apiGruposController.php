<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grupo;
use DB;
use Session;

class apiGruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return Grupo::where('periodo','=','2020A')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $periodo=Session::get('periodo');
        $periodo='2020A';

        $grupos= DB::table('grupos')
        ->where('periodo','=',$periodo)
        ->where('idcarrera','=',$id)
        ->get();
        return $grupos;


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

    public function listaGrupos(Request $request){
        $periodo=$request->get('periodo');
        return $periodo;
        $grupos=DB::select("SELECT * from grupos where periodo='$periodo'");
        return $grupos;
    }


     public function getGrupos(){
        $periodo=Session::get('periodo');
        // return $periodo;
        $grupos=DB::select("SELECT * from grupos where periodo='$periodo'");
        return $grupos;
    }
}
