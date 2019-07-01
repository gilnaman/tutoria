@extends('layouts.servicios')
@section('contenido')
<div id="apiGrupo">
	@{{nombre}}
	<h3>Gestión de grupos - <small></small> </h3>
	<div class="row">
						<div class="col-md-2">
							<label>Buscar</label>
						</div>
						<div class="col-md-8">
							
							<input type="text" 
							placeholder="Escriba el grupo a localizar"
							class="form-control">

						</div>
	</div><br>

	<div class="box box-info">
		
			

			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-responsive">
						<thead>
							<th>CLAVE</th>
							<th>GRADO</th>
							<th>GRUPO</th>
							<th>CARRERA</th>
							
						</thead>

						<tbody>
							<tr v-for="grupo in grupos">
								<td>@{{grupo.clavegrupo}}</td>
								<td>@{{grupo.grado}}</td>
								<td>@{{grupo.grupo}}</td>
								<td>
									<span class="btn btn-sm btn-primary glyphicon glyphicon-print" 
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
	<script src="{{asset('js/api/grupos.js')}}"></script>
	
@endpush

<input type="hidden" name="route" value="{{url('/')}}">