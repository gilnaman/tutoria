@extends('layouts.coordinador')
@section('contenido')

	<h3>Listas grupales </h3>
	<div class="box box-info">
		<div id="listasCoordi">
		
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

			<div class="col-md-2" align="center">
				<span class="btn btn-primary glyphicon glyphicon-print" v-on:click="showLista()"></span>
			</div>
			<br><br>
		</div>
			{{-- @{{id_carrera}}
			@{{grupos}}
		 --}}
		</div>
		
	</div>

@endsection

@push('scripts')
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/api/listasCoordi.js')}}"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">