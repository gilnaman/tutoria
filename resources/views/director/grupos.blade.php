@extends('layouts.coordinador')
@section('titulo','Gestión de grupos')
@section('contenido')
<div id="apiGrupo" class="container">
	
	<div class="row">
		<div class="col-md-6 xs-12">
			<div class="form-group form-row">
				<label class="col-xs-2">Carreras</label>
				<select class="form-control col-xs-6">
					<option value="Todos">Todos</option>
					<option v-for="c in carreras" :value="c.idcarrera">@{{c.nombre}}</option>
					
				</select>
			</div>
		</div>

		<div class="col-md-6 col-xs-12">
			<button class="btn btn-primary">Nuevo grupo</button>
			
		</div>


	</div>



	<br>
	<div class="row">
		<div class="box box-primary col-xs-10">
			@{{grupos}}
		</div>
	</div>
</div>

@endsection


@push('scripts')
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/toastr.min.js')}}"></script>
	<script src="{{asset('js/api/grupos.js')}}"></script>
	
	
	
@endpush

<input type="hidden" name="route" value="{{url('/')}}">