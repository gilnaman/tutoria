@extends('layouts.app')

@section('contenido')
<div class="col-md-8 col-md-offset-2">
	
	
	<div class="alert alert-success">
		<h1>Bienvenido ADMINISTRADOR :{{Session::get('usuario')}}</h1>
		<p><strong>Fecha :</strong>{{date('d-m-Y')}}</p>	
		<p><strong>Período :</strong>{{Session::get('periodo')}}</p>			
	</div>
	<div class="alert alert-info">
		<span class="label label-info">Notificaciones: 0</span>
	</div>
</div>

@endsection