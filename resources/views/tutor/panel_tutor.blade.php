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
                  	<a href="{{route('alumnos.edit',$alumno->matricula)}}" data-toggle="tooltip" title="Ver ficha"><button type='button' class="btn btn-default btn-sm">
                      <span class='glyphicon glyphicon-pencil'></span>
                    </button></a>
						
						
                    {{--
			  		         <a href="" data-target="#modal-delete-{{$alumno->matricula}}" data-toggle="modal"><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></a>
                    --}}

                    <a href="" data-target="#add-just-{{$alumno->matricula}}" data-toggle="modal" data-toggle="tooltip" title="Otorgar Justificacion"><button type='button' class="btn btn-default btn-sm"><span class='glyphicon glyphicon-file'></span></button></a>

                    <a href="{{route('alumnos.show',$alumno->matricula)}}" target="_blank" data-toggle="tooltip" title="Imprimir ficha">
                      <button type='button' class="btn btn-default btn-sm"><span class='glyphicon glyphicon-print'></span></button>

                    </a>

                    

                  </td>
                </tr>
              @include('tutor.addjustificaciones')
                @endforeach
                
                
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
		{{$alumnos->render()}}

<!-- Modal -->

@endsection