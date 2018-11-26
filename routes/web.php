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

Route::get('foto',function(){
	return view('alumnos.prueba');
});

Route::get('repro','TutoriaController@reprobados');


Route::get('justifica',function()
{
	return view('tutor.fjustificaciones');
});

Route::get('promasig','TutoriaController@promediosgrupo');
Route::get('promjs','TutoriaController@promediosjs');



Route::get('tutor','TutoriaController@index')->middleware('esTutor');

//Route::get('tutoria','AccesoController@logear');
Route::get('logout','AccesoController@salir');
Route::post('validar','AccesoController@validar');
Route::get('cardex/{matricula}','AlumnosController@cardex');
Route::resource('acceso','AccesoController');
Route::resource('alumnos','AlumnosController');


// RUTAS DE PRUEBA EXCEL

Route::get('excel', 'ExcelController@getExcel');
Route::post('import-excel', 'ExcelController@importExcel');
Route::get('download-excel/{type}', 'ExcelController@downloadExcel');


//RUTAS FPDF
Route::get('ficha/{id}','TutoriaController@show');


// Acceso a la APi del avance de asignatura
Route::apiResource('apiAvance','AvanceController');
Route::get('avance','TutoriaController@avance');

Route::get('detalle','AvanceController@detalle');

Route::get('resumen','TutoriaController@resumen');

Route::apiResource('apiEval','EvaluacionController');
Route::get('evaldoc',function(){
	return view('profesor.evaluacion');
});

Route::apiResource('apiJustificaciones','ApiJustificacionController');
Route::apiResource('apiResumen','ApiResumenController');

Route::get('resumen2','TutoriaController@promediosjs');


// Route::get('resumenvue',function(){
// 	return view('tutor.resumenvue');
// });

Route::get('becados','ApiResumenController@becados');
Route::get('listaBecados','ApiResumenController@listaBecados');
Route::get('listaVillas','ApiResumenController@listaVillas');

Route::get('google',function(){
	return view('tutor.google');
});

Route::get('chart','TutoriaController@promediosgrupo');