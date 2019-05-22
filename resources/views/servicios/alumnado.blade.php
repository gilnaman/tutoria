@extends('layouts.servicios')
@section('contenido')
<div id="alumnado_boletas">
	<h3>ALUMNADO - <small></small> </h3>
	<div class="row">
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
								<td>@{{alumno.grupoactual}}</td>
								<td>@{{alumno.matricula}}</td>
								<td>@{{alumno.apellidop}} @{{alumno.apellidom}} @{{alumno.nombre}}</td>
								<td>
									<span class="btn btn-sm btn-default glyphicon glyphicon-education" 
									v-on:click="imprimirBoleta(alumno.grupoactual,alumno.matricula)"
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
	<script src="{{asset('js/api/servicios/alumnado_boletas.js')}}"></script>
	
@endpush

<input type="hidden" name="route" value="{{url('/')}}">