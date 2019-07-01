@extends('layouts.coordinador')
@section('titulo','Reprobación por grupos');
@section('contenido')
  <div id="reprobados">

    <div class="row">
            
            <div class="form-group">
              <label class="col-md-2">Grupo</label>
              
              <div class="col-md-4">
              <select v-model="grupo" class="form-control">
                <option disabled="">Elije un grupo</option>
                <option v-for="grupo in grupos" v-bind:value="grupo.clavegrupo">@{{grupo.clavegrupo}}</option>
              </select>
              </div>
            </div>

            {{-- <div class="col-xs-4"> --}}
                  <button class="btn btn-primary" v-on:click="getReprobadas()">Obtener datos</button>
            {{-- </div> --}}
            
      </div>
      
	<div class="box">
          
          

          
            <div class="box-header">
              <h3 class="box-title">Reprobados por unidad</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-condensed table-bordered table-hover" >
                <thead>
                  <th width="5%">No</th>
                  <th width="10%">Matricula</th>
                  <th width="30%">Alumno </th>
                  <th width="5%">U1</th>
                  <th width="5%">U2</th>
                  <th width="5%">U3</th>
                  <th width="5%">U4</th>
                  <th width="5%">U5</th>
                  <th width="5%">U6</th>
                  <th width="5%">Total</th>
                </thead>

                <tbody>
                <tr v-for="(repro,index) in reprobados">
                  <td>@{{index+1}}</td>
                  <td>@{{repro.matricula}} </td>
                  <td>@{{repro.alumno}}  <span class="glyphicon glyphicon-search btn btn-xs btn-danger" v-if="totalPorAlumno(index)>0" v-on:click="showReproIndividual(repro.matricula,index)"></span></td>
                  {{-- Unidad 1 --}}
                  <td><b v-if="repro.u1==0">@{{repro.u1}}</b>
                  	<b class="btn btn-danger btn-xs" v-if="repro.u1>=1">
                     @{{repro.u1}} 
                    </b>
                  	
                  </td>
                  
                  {{-- Unidad 2 --}}
                   <td><b v-if="repro.u2==0">@{{repro.u2}}</b>
                    <b class="btn btn-danger btn-xs" v-if="repro.u2>=1">
                     @{{repro.u2}} 
                    </b>
                    
                  </td>

                  <td><b v-if="repro.u3==0">@{{repro.u3}}</b>
                    <b class="btn btn-danger btn-xs" v-if="repro.u3>=1">
                     @{{repro.u3}} 
                    </b>
                  </td>
                  
                   <td><b v-if="repro.u4==0">@{{repro.u4}}</b>
                    <b class="btn btn-danger btn-xs" v-if="repro.u4>=1">
                     @{{repro.u4}} 
                    </b>
                  </td>

                  <td><b v-if="repro.u5==0">@{{repro.u5}}</b>
                    <b class="btn btn-danger btn-xs" v-if="repro.u5>=1">
                     @{{repro.u5}} 
                    </b>
                  </td>
                  
                   <td><b v-if="repro.u6==0">@{{repro.u6}}</b>
                    <b class="btn btn-danger btn-xs" v-if="repro.u6>=1">
                     @{{repro.u6}} 
                    </b>
                  </td>

                  <td>@{{totalPorAlumno(index)}} 
                  </td>
    		
				</tr>
				</tbody>
					
        <tfoot>
    				<tr>
    					
    					<td colspan="3"><h3>TOTALES</h3></td>
    				
    				<td><h3>@{{totalPorUnidad.tu1}}</h3></td>
    				<td><h3>@{{totalPorUnidad.tu2}}</h3></td>
    				<td><h3>@{{totalPorUnidad.tu3}}</h3></td>
    				<td><h3>@{{totalPorUnidad.tu4}}</h3></td>
    				<td><h3>@{{totalPorUnidad.tu5}}</h3></td>
    				<td><h3>@{{totalPorUnidad.tu6}}</h3></td>
            <td style="background: gray"></td>


    				{{--<td class="btn btn-danger"><h4>{{$totales[1]}}</h4></td>
    				<td class="btn btn-danger"><h4>{{$totales[2]}}</h4></td>
    				--}}

    				</tr>
        </tfoot>
			</table>

    		</div>

                
                
                
    </div>
    {{-- Fin del Box --}}



{{-- INICIA VENTANA MODAL --}}
  <div class="modal fade" id="info_repro" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Asignaturas reprobadas de :  <strong>@{{matriculaSel}} - @{{alumnoSel}}</strong></h4>
        </div>
        <div class="modal-body">
          <div class="box box-primary">
        <table class="table table-hover table-striped table-bordered">
                  <thead bgcolor="#fff08e">
                    <th>ASIGNATURA</th>
                    <th>PROFESOR</th>
                    <th>UNIDAD</th>
                    <th>TIPO</th>
                    <th>VALOR</th>
                    <th>CALIFICACION</th>
                    <th>PONDERADO</th>
                    <th>SESIONES</th>
                    <th>INASISTENCIA</th>
                  </thead>

                  <tbody>
                    <tr v-for="rep in reprobadosIndividual">
                      <td>@{{rep.asignatura}}</td>
                      <td>@{{rep.profesor}}</td>
                      <td>@{{rep.unidad}}</td>
                      <td>@{{rep.tipo_unidad}}</td>
                      <td>@{{rep.valor}}</td>
                      <td>@{{rep.calificacion}}</td>
                      <td>@{{rep.total_unidad}}</td>
                      <td>@{{rep.numero_sesiones}}</td>
                      <td>@{{rep.inasistencia}}</td>
                    </tr>
                  </tbody>
              </table>
              
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  {{-- FIN DE VENTANA MODAL --}}
              
  </div>
  {{-- Fin del VUE --}}
@endsection()

@push('scripts')
  
  <script src="{{asset('js/vue-resource.min.js')}}"></script>
  <script src="{{asset('js/api/tutoria/reprobados.js')}}"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">
