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

// ZONA TUTOR 

Route::prefix('tutor')->group(function () {
    Route::get('tutorados','TutoriaController@index')->middleware('esTutor');
    // Route::get('/','TutoriaController@index')->middleware('esTutor');
    Route::get('justifica','JustiController@index');
    Route::get('/','TutoriaController@promediosjs');

    Route::get('repro',function(){
        return view('tutor.v-reprobados');
    });
    // Route::get('repro','TutoriaController@reprobados');
    Route::get('avance','TutoriaController@avance');

});

// Estadistica de reprobacion

Route::get('vrepro','Apis\ApiTutoriaController@reprobados');





Route::get('justifica',function()
{
	return view('tutor.fjustificaciones');
});

Route::get('promasig','TutoriaController@promediosgrupo');
Route::get('promjs','TutoriaController@promediosjs');

// RUTAS SERVICIOS ESCOLARES
Route::get('servicios',function(){
    return view('layouts.servicios');
});

Route::get('servicios/alumnado',function(){
    return view('servicios.alumnado');
});



// FIN DE SERVICIOS ESCOLARES


Route::get('coordinador','CoordinadorController@index');

// RUTAS DE COORDINADOR

Route::get('entregaDesglose','CoordinadorController@entregaDesglose');

// FIN RUTAS COORDINADOR
//Route::get('tutoria','AccesoController@logear');
Route::get('logout','AccesoController@salir');
Route::post('validar','AccesoController@validar');
Route::get('cardex/{matricula}','AlumnosController@cardex');
Route::get('cardex2','TutoriaController@cardex');
Route::resource('acceso','AccesoController');
Route::resource('alumnos','AlumnosController');


// RUTAS DE PRUEBA EXCEL

Route::get('excel', 'ExcelController@getExcel');
Route::post('import-excel', 'ExcelController@importExcel');
Route::get('download-excel/{type}', 'ExcelController@downloadExcel');


//RUTAS FPDF
Route::get('ficha/{id}','TutoriaController@show');
Route::get('justificacion','ApiJustificacionController@imprimir');
//->name('products.pdf');


// Acceso a la APi del avance de asignatura
Route::apiResource('apiAvance','AvanceController');


Route::get('detalle','AvanceController@detalle');

Route::get('resumen','TutoriaController@resumen');

// EVALUACION DOCENTE 

Route::apiResource('apiEval','EvaluacionController');
Route::get('evaldoc',function(){
	return view('profesor.evaluacion');
});




// RUTAS DE APIS

Route::apiResource('apiAlumnos','Apis\ApiAlumnoController');
Route::apiResource('apiAlumnado','Apis\ApiAlumnadoGralController');
Route::apiResource('apiJustificaciones','ApiJustificacionController');
Route::apiResource('apiResumen','ApiResumenController');
Route::apiResource('apiRespuestas','apiRespController');
Route::apiResource('apiCargas','ApiAsigsPorGrupo');
Route::apiResource('apiPonderacion','Apis\ApiPonderacionController');
Route::apiResource('apiCarrera','ApiCarreraController');
Route::apiResource('apiGrupo','Apis\ApiGruposController');
Route::apiResource('apiEntregas','Apis\ApiEntregaController');
Route::apiResource('apiActa','ActaEntregaController');





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

Route::get('tutor2',function(){
	return view ('tutor.panel_tutor2');
});


// PROFESORES

Route::get('profesor',function(){
	return view('layouts.adminprofe');
});

//LISTAS
Route::get('profesor/listas','Profesor\ProfesorController@index');






// RUTAS PARAMETRIZADAS

Route::get('listar/{asignatura}/{grupo}/{unidad}', [
    'as' => 'listar',
    'uses' => 'Profesor\ProfesorController@imprimir_lista',
]);


// PARAMETRIZADAS POR TUTOR
Route::get('reproPorAlumno/{matricula}/{periodo?}', [
    'as' => 'reproPorAlumno',
    'uses' => 'Apis\ApiTutoriaController@reproPorAlumno',
]);


Route::get('getBoletas/{grupo}/{matricula}', [
    'as' => 'getBoletas',
    'uses' => 'AlumnosController@getBoletas',
]);


Route::get('boleta/{grupo}/{matricula}', [
    'as' => 'boleta',
    'uses' => 'AlumnosController@boleta',
]);

Route::get('imprimir/{folio}', [
    'as' => 'imprimir',
    'uses' => 'ApiJustificacionController@imprimir',
]);

Route::get('getAlumnoToCedula','Apis\ApiCedulaController@getAlumnoToCedula');

// getAlumnoToCedula

// Ruta para imprimir listas grupales, solicitud del coordinador
Route::get('listaGrupo/{grupo}', [
    'as' => 'listaGrupo',
    'uses' => 'CoordinadorController@listaGrupo',
]);

Route::get('resumenGrupo/{grupo}/{periodo}', [
    'as' => 'resumenGrupo',
    'uses' => 'CoordinadorController@resumenGrupo',
]);

Route::get('getPonderacion/{asig}', [
    'as' => 'getPonderacion',
    'uses' => 'AvanceController@getPonderacion',
]);


// Permite obtener el desgloce de unidades 
Route::get('getPondera/{periodo}/{grupo}/{asignatura}/{cedula}', [
    'as' => 'getPondera',
    'uses' => 'Apis\ApiPonderacionController@getPondera',
]);




Route::get('profesor/cargas',function(){
	return view('profesor.cargas');
});

Route::get('entregas',function(){
    return view('coordinador.entregas');
});


Route::get('listaCo','CoordinadorController@index');



Route::get('evento','TutoriaController@regsEvento');

Route::get('export', 'ExcelController@export')->name('export');
Route::get('importExcel', 'ExcelController@importExportView');
Route::post('import', 'ExcelController@importExcel')->name('import');
Route::get('acuse','Profesor\AcuseController@acuse');


//route::get('boleta','AlumnosController@boleta'); Se parametrizó

Route::get('grupo',function(){
    return view('grupos.grupos');
});

Route::get('cedula',function(){
    return view('alumnos.cedula');
});