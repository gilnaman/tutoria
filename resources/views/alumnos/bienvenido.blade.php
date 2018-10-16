@extends('alumnos.menualumnos')
@section('contenido')

  <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-success">
                  <h1>Bienvenido </h1>
                  <p><strong>Matrícula: {{Session::get('matricula')}}</strong></p>
                  <p><strong>ALUMNO :{{Session::get('usuario')}}</strong></p>
                   <p><strong>Fecha :</strong>{{date('d-m-Y')}}</p>  
                  <p><strong>Período :</strong>{{Session::get('periodo')}}</p>      
                </div>
            <div class="alert alert-info">
                <span class="label label-info">Notificaciones: 0</span>
            </div>
  </div>
  <div class="mensaje">
    
  </div>
@endsection