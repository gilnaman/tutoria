<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login.login');
});

Route::get('tutoria','AccesoController@logear');
Route::get('logout','AccesoController@salir');
Route::post('validar','AccesoController@validar');
Route::get('cardex/{matricula}','AlumnosController@cardex');

Route::resource('alumnos','TutoriaController');