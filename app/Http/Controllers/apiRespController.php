<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respuesta;
use App\Comentario;
use App\User;
class apiRespController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 'hola';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        
        $resp1=$request->get('resp1');
        $resp2=$request->get('resp2');
        $resp3=$request->get('resp3');
        $resp4=$request->get('resp4');
        $resp5=$request->get('resp5');
        $resp6=$request->get('resp6');
        $resp7=$request->get('resp7');
        $resp8=$request->get('resp8');
        $resp9=$request->get('resp9');
        $resp10=$request->get('resp10');
        $resp11=$request->get('resp11');
        $resp12=$request->get('resp12');
        $resp13=$request->get('resp13');
        $resp14=$request->get('resp14');
        $resp15=$request->get('resp15');
        $resp16=$request->get('resp16');
        $resp17=$request->get('resp17');
        $resp18=$request->get('resp18');
        $resp19=$request->get('resp19');
        $resp20=$request->get('resp20');
        $resp21=$request->get('resp21');
        $comentarios=$request->get('comments');
        
        $profes=$request->get('cedula');
        $asigs=$request->get('claveasig');
        
        
        
        
        $records = [];

        //GENERAR INSERTS DE RESPUESTA 1 
        for ($i=0; $i <count($resp1) ; $i++) { 
        
          

            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>1,
                    'valor' => $resp1[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
        
        }

        //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 2

          for ($i=0; $i <count($resp2) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>2,
                    'valor' => $resp2[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

        //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 3

          for ($i=0; $i <count($resp3) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>3,
                    'valor' => $resp3[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }
        //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 4

          for ($i=0; $i <count($resp4) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>4,
                    'valor' => $resp4[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

        //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 5

          for ($i=0; $i <count($resp5) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>5,
                    'valor' => $resp5[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }
        //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 6

          for ($i=0; $i <count($resp6) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>6,
                    'valor' => $resp6[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

        //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 7

          for ($i=0; $i <count($resp7) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>7,
                    'valor' => $resp7[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

        //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 8

          for ($i=0; $i <count($resp8) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>8,
                    'valor' => $resp8[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

        //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 9

          for ($i=0; $i <count($resp9) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>9,
                    'valor' => $resp9[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

             //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 10

          for ($i=0; $i <count($resp10) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>10,
                    'valor' => $resp10[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

         //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 11

          for ($i=0; $i <count($resp11) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>11,
                    'valor' => $resp11[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

     //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 12

          for ($i=0; $i <count($resp12) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>12,
                    'valor' => $resp12[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

         //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 13

          for ($i=0; $i <count($resp13) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>13,
                    'valor' => $resp13[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

         //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 14

          for ($i=0; $i <count($resp14) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>14,
                    'valor' => $resp14[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

         //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 15

          for ($i=0; $i <count($resp15) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>15,
                    'valor' => $resp15[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }
         //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 16

          for ($i=0; $i <count($resp16) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>16,
                    'valor' => $resp16[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

         //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 17

          for ($i=0; $i <count($resp17) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>17,
                    'valor' => $resp17[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }
         //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 18

          for ($i=0; $i <count($resp18) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>18,
                    'valor' => $resp18[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }
         //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 19

          for ($i=0; $i <count($resp19) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>19,
                    'valor' => $resp19[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

         //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 20

          for ($i=0; $i <count($resp20) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>20,
                    'valor' => $resp20[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

         //GENERAR INSERTS DE RESPUESTAS A PREGUNTA 9

          for ($i=0; $i <count($resp21) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>21,
                    'valor' => $resp21[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }

       Respuesta::insert($records);
     //    //return $records;


         //GENERAR INSERTS DE COMENTARIOS
        $records = [];

        for ($i=0; $i <count($comentarios) ; $i++) { 
            $records[] = [
                    'cedula' => $profes[$i],
                    'matricula' => $request->get('matricula'),
                    'claveasig' => $asigs[$i],
                    'id_preg' =>22,
                    'comentario' => $comentarios[$i], 
                    'clavegrupo' => $request->get('clavegrupo'),
                    'periodo' => $request->get('periodo')                    
                ];
            }
        
        
        //    return $records;
     Comentario::insert($records);

      $matricula = $request->get('matricula');
      //return $matricula;

      $user = User::find($matricula);
      $user->presento=1;
      $user->update();
      
      return 'TODO BIEN';



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
