@extends('layouts.adminlte')
@section('contenido')
	


		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de tutorados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">Matricula</th>
                  <th style="width: 60px">Alumno </th>
                  <th style="width: 40px">Operaciones</th>
                </tr>
                @foreach($alumnos as $alumno)
                <tr>
                  <td>{{$alumno->matricula}}</td>
                  <td>{{$alumno->fullname}}</td>
                  <td>
                  	<a href="{{route('alumnos.edit',$alumno->matricula)}}"><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></span></button></a>
						
						

			  		<a href="" data-target="#modal-delete-{{$alumno->matricula}}" data-toggle="modal"><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></a>
                  </td>
                </tr>
                @endforeach
                
                
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
		{{$alumnos->render()}}
@endsection