@extends('admin.master')
@section('contenido')

	<div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de alumnos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table_alumnos" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Matrícula</th>
                  <th>Nombre</th>
                  <th>Apellido paterno</th>
                  <th>Apellido materno</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($alumnos as $alumno)
                <tr>
                  <td>{{$alumno->matricula}}</td>
                  <td>{{$alumno->nombre}}  </td>
                  <td>{{$alumno->apellidop}}</td>
                  <td>{{$alumno->apellidom}}</td>
                  <td>
                  	<a href="#" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Justificaciones"><i class="fa fa-stethoscope"></i></a>
                  	<a href="" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    
                  </td>
                </tr>
               	@endforeach
               </tbody>
              
              {{--
                  <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> 
              --}}

              </table>
            </div>
            <!-- /.box-body -->
          </div>


@stop

@section('encabezado')
 
      <h1>
        Alumnos
        <small>Listado de tutorados</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
 
@stop