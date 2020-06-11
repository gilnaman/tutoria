<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Periodo;
use Session;


class AccesoUnificadoController extends Controller
{




	public function  getAccess(Request $req)
	{
    	if($req)
		 	{
		 		$user=$req->get('login');
		 		$pass=$req->get('contra');


		 		$datos = DB::select("SELECT profesores.cedula,
CONCAT(profesores.tratamiento,' ',profesores.nombre, ' ', profesores.apellidop,' ',profesores.apellidom) as docente

FROM users INNER JOIN profesores ON profesores.cedula=users.clave
WHERE users.login='german' AND users.pass='castellanos' LIMIT 1" );

		 		// return $datos;

		 		

		 		if(!empty($datos))

		 			// SE TIENE LA CERTEZA DEL ACCESO DE UN ROL AUTORIZADO
		 		{
			 		
			 		// $roles=[];

			 		// foreach ($datos as $dat) {
			 		// 	$roles[]=[
			 		// 		'idrol'=>$dat->idrol,
			 		// 		'rol'=>$dat->rol
			 		// 	];
			 		// }

			 		// $acceso[]=[
			 		// 	'cedula'=>$datos[0]->cedula,
			 		// 	'docente'=>$datos[0]->docente,
			 		// 	'roles'=>$roles
			 				
			 		// 	];

			 		// Session::put('roles',json_encode($roles));
			 		// $product = collect([1,2,3,4]);
					// Session::push('cart', $product);

			 		// return $acceso[0];
			 		
			 		

			 		//OBTENGO EL PERIODO ACTIVO
	 			$periodo=Periodo::where('activo','=',1)
	 			->first();

	 			Session::put('periodo',$periodo->claveperiodo);
	 			Session::put('cedula',$datos[0]->cedula);
	 			Session::put('docente',$datos[0]->docente);
	 			

	 			return Redirect::to('panel_unificado');
	 			
		 		}
		 		else
		 		 return 'USUARIO O CONTRASEÑA INCORRECTA';


		 		


		 	




		 }
	 }

	 // FIN DE METODO GETACCESS

	 public function getRoles(Request $request)
	 {

	 	$id=$request->get('id');

	 	$roles = DB::select("SELECT roles.rol
					
					FROM (roles INNER JOIN users ON roles.idrol=users.idrol)
					INNER JOIN profesores ON profesores.cedula=users.clave
					WHERE profesores.cedula=$id");

	 	$rols=[];

	 // for ($i=0; $i < count($roles); $i++) { 
	 	
	 // }

	 foreach ($roles as $rol) {
	 	$rols[] = $rol->rol;
	 }

	 	return $rols;



	 }
}
