<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use biblioUtc\Http\Requests;
use Session;
use Cache;
use Cookie;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
Use Laracasts\Flash\Flash;

//use App\Alumno;
use DB;

class AccesoController extends Controller
{
    //

	public function logear(Request $request)
	{
	  
	  return view('login.login');  	
	 }

	 public function validar(Request $request)
	 {
	 	
	 	if($request)
	 	{
	 		$user=$request->get('login');
	 		$pass=$request->get('contra');

	 		//return 'Hola';

	 		$res=DB::connection('mysql')
	 		->table('users')
	 		->join('roles','users.idrol','=','roles.idrol')
	 		->select('roles.idrol','roles.rol','users.proviene','users.login')
	 		->where('users.login','=',$user)
	 		->where('users.pass','=',$pass)
	 		->first();

	 		
	 		//return response()->json($res);

	 		if(!empty($res))  //Si al consultar en la tabla usuario existe un dato 
	 		{
	 			$rol=$res->rol;
	 			$proviene=$res->idrol;
	 			$login=$res->login;

	 			// SECCION QUE MANEJA EL ACCESO DE LOS ALUMNOS
	 			if($proviene==5)
	 			{
	 				$alumno=DB::connection('mysql')
	 				->table('alumnos')
	 				->select('matricula','nombre','apellidop','apellidom')
	 				->where('matricula','=',$login)
	 				->first();

	 				Session::put('usuario',$alumno->nombre.' '.$alumno->apellidop.' '.$alumno->apellidom);
	 				Session::put('rol',$res->rol);
	 				Session::put('matricula',$login);
	 				//\Flash::success('Esta es una prueba');
	 				return view('alumnos.bienvenido');


	 			}

	 			if($proviene==4)
	 			{
	 				return 'BIENVENIDO PROFESOR'.$user;
	 			}

	 			if($proviene==3)
	 			{ 
	 				return 'BIENVENIDO COORDINADOR '.$user;
	 			}

	 			

	 			//return "El usuario existe, se llama ". $res->nombre.' '.$res->apellidop.' '.$res->apellidom."es un ".$res->rol;;

	 			//if($res->rol=='admin')
	 			//	return view('login.admin'); 
	 			//else
	 			//	return view('login.alumno');


	 			
	 		}
	 		
	 		else
	 			return 'Usuario y/o contraseña incorrecta, o bien ya no es un usuario vigente';
	 			//return Redirect::to('/'); //->with('error',true);
	 	}

	 	
	 }


	 public function salir()
	 {
	 	Session::flush();
		Session::reflash();
		Cache::flush();
		Cookie::forget('laravel_session');
		unset($_COOKIE);
		unset($_SESSION);
		return Redirect::to('/');
	 }


	 public function registrar(Request $request)
	 {

	 	
	 	if($request)
	 	{
	 		$user=$request->get('nick');
	 		$pass=$request->get('password');


	 		$res=DB::connection('escolar')
	 		->table('alumnos')
	 		->select('matricula','nombre','apellidop','apellidom')
	 		->where('matricula','=',$user)
	 		->where('pass','=',$pass)
	 		->first();

	 		if(count($res)>0) 
	 		{
	 			$nomAlumno = 'Bienvenido: ' . $res->nombre.' '.$res->apellidop.' '.$res->apellidom;

	 			flash()->success($nomAlumno);
	 			
	 			DB::table('log_acceso')->insert(['matricula'=> $res->matricula]);
	 		}
	 		else
	 			flash()->warning('ALUMNO NO IDENTIFICADO VERIFICAR USUARIO Y PASSWORD');

	 		return view('registro.acceso');
	 		$nomAlumno='';
	 		

	 		
	 	}
	 	

	 }
	
}    	
