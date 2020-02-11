@extends('layouts.adminlte')
@section('titulo','Gestión de eventos')
@section('contenido')
	<div id="eventosTutor">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					
					<table class="table table-bordered table-sm">
						<thead>
							<th>No</th>
							<th>CLAVE</th>
							<th>FECHA</th>
							<th>TITULO</th>
							<th>EXPOSITOR</th>
							<th>OPCIONES</th>
						</thead>

						<tbody>
							<tr v-for="(ev,index) in eventos">
								<td>@{{index+1}}</td>
								<td>@{{ev.id_evento}}</td>
								<td>@{{ev.fecha_evento}}</td>
								<td>@{{ev.titulo}}</td>
								<td>@{{ev.expositor}}</td>
								<td>
									<span class="fa fa-search-plus btn btn-sm btn-default">
										
									</span>
									<button v-if="ev.enterado==0"class="btn btn-warning btn-sm">
										Enterado
									</button>

									<span class="fa fa-arrow-down btn btn-sm btn-default" v-if="ev.enterado==1">
										
									</span>
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
	<script src="{{asset('js/api/tutoria/eventos.js')}}"></script>
	<script src="{{asset('js/toastr.min.js')}}"></script>
	
	{{-- <script type="text/javascript" src="{{asset('js/moment-with-locales.min.js')}}"></script> --}}
@endpush

<input type="hidden" name="route" value="{{url('/')}}">