@extends('layouts.app')
@section('contenido')
	<div class="col-md-8 col-md-offset-2">
		
		
		<div class="alert alert-success">
			<h1>Bienvenido ALUMNO :{{Session::get('usuario')}}</h1>
			<p><strong>Fecha : <h2>{{date('d-m-Y')}}	</h2></strong></p> 
			<p><strong>Período :</strong>{{Session::get('periodo')}}</p>			
		</div>
		<div class="alert alert-info">
			<span class="label label-info">Notificaciones: 0</span>
		</div>
	</div>
@endsection