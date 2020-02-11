@extends('layouts.servicios')
@section('contenido')
<div id="alumnado_boletas">
	<h3>ALUMNADO TOTAL : <b>@{{totalAlumnos}}</b> </h3>
	
	
	<div class="row">

			<br>
			<div class="col-md-5">
				<div class="form-group">
					<label  class="col-sm-2 control-label"
                            for="inputEmail3">Carrera
                    </label>

					<div class="col-sm-10">
						<select class="form-control" v-model="id_carrera" @change="getGrupos">
							<option disabled value="">Elija una carrera</option>
							<option v-for="carrera in carreras" v-bind:value="carrera.idcarrera">@{{carrera.nombre}}</option>
						</select>
					</div>					
				</div>
			</div>

				<div class="col-md-5">
				<div class="form-group">
					<label  class="col-sm-2 control-label"
                            for="inputEmail3">Grupo
                    </label>

					<div class="col-sm-10">
						<select class="form-control" v-model="clavegrupo">
							<option disabled value="">Elija el grupo</option>
							<option v-for="grupo in grupos" v-bind:value="grupo.clavegrupo">@{{grupo.clavegrupo}}</option>
						</select>
					</div>					
				</div>
			</div>

			
		</div>
		<br><br>



	<!-- <div class="row">
						<div class="col-md-2">
							<label>Buscar</label>
						</div>
						<div class="col-md-8">
							
							<input type="text" 
							v-model="search" class="form-control" 
							placeholder="Escriba apellido del alumno, nombre o grupo"
							class="form-control">

						</div>
					</div><br>
 -->
	<div class="box box-info">
		
			

			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-responsive">
						<thead>
							<th>GRUPO</th>
							<th>MATRICULA</th>
							<th>ALUMNO</th>
							<th></th>

						</thead>

						<tbody>
							<tr v-for="alumno in filtroAlumnos">
								<td>@{{alumno.clave_grupo}}</td>
								<td>@{{alumno.matricula}}</td>
								<td>@{{alumno.apellidop}} @{{alumno.apellidom}} @{{alumno.nombre}}</td>
								<td>
									<span class="btn btn-sm btn-default glyphicon glyphicon-education" 
									v-on:click="imprimirBoleta(alumno.clave_grupo,alumno.matricula)"
									></span>
								</td>
								
								
								
							</tr>
						</tbody>
					</table>
				</div>
			</div>



			
		
		</div>
		
	</div>

@endsection

@push('scripts')
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/api/servicios/alumnadogral.js')}}"></script>
	
@endpush

<input type="hidden" name="route" value="{{url('/')}}">