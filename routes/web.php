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
Route::get('reporte', 'TutoriaController@pdf')->name('products.pdf');

Route::get('/', function () {
    return view('login.login');
});

Route::get('repro','TutoriaController@reprobados');
Route::get('justifica',function()
{
	return view('tutor.fjustificaciones');
});

Route::get('tutor','TutoriaController@index');

//Route::get('tutoria','AccesoController@logear');
Route::get('logout','AccesoController@salir');
Route::post('validar','AccesoController@validar');
Route::get('cardex/{matricula}','AlumnosController@cardex');
Route::resource('acceso','AccesoController');
Route::resource('alumnos','AlumnosController');
