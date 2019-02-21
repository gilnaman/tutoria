@extends('layouts.coordinador')
@section('contenido')
<div id="entregasCoordi">
	<h3>Entrega de calificaciones - <small>formato digital</small> </h3>
	<div class="row">
						<div class="col-md-2">
							<label>Buscar</label>
						</div>
						<div class="col-md-8">
							
							<input type="text" 
							v-model="search" class="form-control" 
							placeholder="Escriba apellido del profesor o asignatura o grupo"
							class="form-control">

						</div>
					</div><br>

	<div class="box box-info">
		
			

			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-responsive">
						<thead>
							<th hidden="">ACTA</th>
							<th>DOCENTE</th>
							<th>GRUPO</th>
							<th>ASIGNATURA</th>
							<th>UNIDAD</th>
							<th>TIPO</th>
							<th>VALOR</th>
							<th></th>

						</thead>

						<tbody>
							<tr v-for="entrega in filtroEntregas">
								<td hidden=""><small>@{{entrega.acta}}</small></td>
								<td>@{{entrega.tratamiento}} @{{entrega.docente}}</td>
								<td>@{{entrega.claveGrupo}}</td>
								<td>@{{entrega.asignatura}}</td>
								<td>@{{entrega.unidad}}</td>
								<td>@{{entrega.tipo_unidad}}</td>
								<td>@{{entrega.ponderacion}} %</td>
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
	<script src="{{asset('js/api/entregasCoordi.js')}}"></script>
	<script src="{{asset('js/session.js')}}"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">