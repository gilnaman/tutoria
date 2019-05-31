@extends('layouts.adminprofe')
@section('contenido')
	<h3>DESGLOSE DE UNIDADES ACADÉMICAS</h3>
	<div class="box box-info">
		<div id="cargasPondera">
		
		
		<div hidden="">
			@{{cedula="{!!Session::get('cedula')!!}"}}
		</div>
		
		<div class="row">
			<br>
			<div class="col-md-8">
				
				<table class="table table-bordered">
					<thead>
						<th>Grupo</th>
						<th>Clave</th>
						<th>Asignatura</th>
						<th></th>
						{{-- <th></th> --}}
					</thead>

					<tbody>
						<tr v-for="(carga,index) in cargas">
							<td>@{{carga.ClaveGrupo}}</td>
							<td>@{{carga.ClaveAsig}}</td>
							<td>@{{carga.Asignatura}}</td>
							<td>
								{{-- <span class="glyphicon glyphicon-cog btn btn-sm"v-on:click="asigSelected(index)"></span> --}}

								<span class="glyphicon glyphicon-plus btn btn-sm"v-on:click="addPondera(index)"></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			
		</div>

{{-- Inicia ventana MODAL --}}

<div class="modal fade" id="config_pondera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
        	<strong>CAPTURA DE DESGLOSE DE UNIDADES  {{-- <br> Cuantas unidades tiene? :
				<input class="form-control" v-model="numUnidades" v-on:change="dimensionar" >--}}
        </strong>
    </h4>
       
      </div>
      {{-- Inicio Body Modal --}}
      <div class="modal-body">
			
      	<div class="col-md-12">
				<div class="alert alert-danger" v-if="errorPondera.length">
					<ul>
						<li v-for="error in errorPondera">@{{error.mensaje}}</li>
					</ul>
					
				</div>
				<table class="table table-bordered table-condensed">
					
					<thead>
						<tr style="background: #ffff66">
							<th colspan="5">Grupo: @{{claveGrupo}} Asignatura : (@{{claveElegida}}) @{{asigElegida}} </th>
						</tr>	
						<tr>
							<th>Unidad</th>
							<th>Valor de la UA</th>
							<th>Tipo de UA</th>
							<th>Fecha de entrega</th>
							<th></th>
						</tr>
					</thead>

				

				<div v-if="capturado"> 
					<tbody>
					<tr v-for="(pondera,index) in ponderaciones">
						<td>@{{index+1}}</td>
						<td>
							<input type="text" v-model.number="valores[index]" class="form-control">
						</td>
						<td>
							<select  class="form-control" v-model.string="tipos[index]" required="">
							<option disabled value="">Elija una opcion</option>
							<option value="C">C</option>
							<option value="I">I</option>
							</select>
						</td>

						<td>
							<input type="date" v-model="entregas[index]">

						</td>
						<td>
							<span class="glyphicon glyphicon-minus btn btn-sm"
							v-on:click="eliminar(index)">
								
							{{-- </span>
							<span class="glyphicon glyphicon-plus-sign btn btn-sm"></span> --}}
						</td>
					</tr>
				</tbody>
				
				</div> 
				{{-- DIV en caso que el profesor aun no haya guardado --}}
				
				</table>
				<h3>Puntaje total: @{{sumarPonderacion}}<br></h3>
				
				<button class="btn btn-success btn-block" v-on:click="guardarPonderacion()">Guardar ponderacion</button>
				
				
				
				{{-- Valores: @{{valores}}<br>
				Tipos: @{{tipos}}<br>
				entregas:@{{entregas}}<br>
				@{{ponderaciones}} --}}
			</div>
        	
      </div>
      {{-- Fin del Body MODAL --}}
      <div class="modal-footer">

      	{{-- <span class="btn btn-default glyphicon glyphicon-circle-arrow-left"
      	data-dismiss="modal"></span> --}}

       {{--  <button type="button" class="btn btn-default" data-dismiss="modal" @click="edit=false">Cancelar</button> --}}
        
        {{-- <span class="btn btn-default glyphicon glyphicon-floppy-disk" type="submit"  >
        	
        </span> --}}

        {{-- <span class="btn btn-default glyphicon glyphicon-floppy-saved" type="submit" ></span> --}}

      </div>
    </div>
  </div>
</div>

{{-- FIN DEL MODAL --}}

{{-- Inicia ventana MODAL DESGLOCE --}}

<div class="modal fade" id="detalle_desgloce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">DESGLOSE DE UNIDADES <strong>(ENTREGADO) </strong></h4>
       
      </div>
      {{-- Inicio Body Modal --}}
      <div class="modal-body">
			
      	<div class="col-md-12">
				
				<table class="table table-bordered table-condensed">
					
					<thead>
						<tr style="background: #ffff66">
							<th colspan="5">Grupo: @{{claveGrupo}} Asignatura : (@{{claveElegida}}) @{{asigElegida}} </th>
						</tr>	
						<tr>
							<th>Unidad</th>
							<th>Valor de la UA</th>
							<th>Tipo de UA</th>
							<th>Fecha de entrega</th>
							
						</tr>
					</thead>

				

				
					<tbody>
					<tr v-for="des in desgloce">
						<td>@{{des.unidad}}</td>
						<td>@{{des.porcentaje}}</td>
						<td>@{{des.tipounidad}}</td>
						<td>@{{des.fecha_planificada}}</td>
					</tr>
				</tbody>
				
				
				{{-- DIV en caso que el profesor aun no haya guardado --}}
				
				</table>

				
				
				
			</div>
        	
      </div>
      {{-- Fin del Body MODAL --}}
      <div class="modal-footer">

      	

      </div>
    </div>
  </div>
</div>

{{-- FIN DEL MODAL  DESGLOCE--}}




		</div>
		{{-- Fin del VUE --}}
	</div>

@endsection

@push('scripts')
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/api/cargasPondera.js')}}"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">