@extends('layouts.adminprofe')
@section('contenido')
	<div class="box box-info">
		<div id="cargasPondera">
		

		<div class="row">
			<br>
			<div class="col-md-6">
				
				<table class="table table-bordered">
					<thead>
						<th>Grupo</th>
						<th>Clave</th>
						<th>Asignatura</th>
						<th></th>
						<th></th>
					</thead>

					<tbody>
						<tr v-for="(carga,index) in cargas">
							<td>@{{carga.ClaveGrupo}}</td>
							<td>@{{carga.ClaveAsig}}</td>
							<td>@{{carga.Asignatura}}</td>
							<td><span class="glyphicon glyphicon-cog btn btn-sm"v-on:click="asigSelected(index)"></span></td>
							<td>
								<div class="btn-group">
  									<button type="button" class="btn btn-default dropdown-toggle"
          							data-toggle="dropdown">

          							Listas 
          							<span class="caret"></span>
  								</button>

							  <ul class="dropdown-menu" role="menu">
							  	{{-- <a href="{{url('anexaradultos', ['idguest' => $idguest->id, 'idbook' => $idbook->id, 'idroom' => $idroom->id])}}">Agregar adultos</a> --}}
									
							    <li>
							    	<a href="{{url('listar',['claveasig'=>'TTS-4A','unidad'=>1])}}" target="_blank">
							    	Unidad 1
									</a>
							    </li>
							    <li><a href="#">Unidad 2</a></li>
							    <li><a href="#">Unidad 3</a></li>
							    <li><a href="#">Unidad 4</a></li>
							    <li><a href="#">Unidad 5</a></li>
							    <li><a href="#">Unidad 6</a></li>
							    <li><a href="#">Unidad 7</a></li>
							    
							  </ul>
							</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="col-md-6">
				<div class="alert alert-danger" v-if="errorPondera.length">
					<ul>
						<li v-for="error in errorPondera">@{{error.mensaje}}</li>
					</ul>
					
				</div>
				<table class="table table-bordered table-condensed">
					
					<thead>
						<tr style="background: #ffff66">
							<th colspan="5">ASIGNATURA : @{{claveElegida}} @{{asigElegida}}</th>
						</tr>	
						<tr>
							<th>Unidad</th>
							<th>Ponderacion</th>
							<th>Tipo</th>
							<th>Entrega</th>
							<th></th>
						</tr>
					</thead>

				<tbody>
					<tr v-for="(pondera,index) in ponderaciones">
						<td>@{{index+1}}</td>
						<td>
							<input type="text" v-model.number="valores[index]" 
							class="form-control">
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
				</table>

				
				<button class="btn btn-success btn-block">Guardar ponderacion</button>
				@{{sumarPonderacion}}<br>
				Valores: @{{valores}}<br>
				Tipos: @{{tipos}}<br>
				entregas:@{{entregas}}<br>
				@{{ponderaciones}}
			</div>
		</div>
		</div>
	</div>

@endsection

@push('scripts')
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/api/cargasPondera.js')}}"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">