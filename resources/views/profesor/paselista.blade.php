@extends('layouts.adminprofe')
@section('contenido')
	<div class="box box-info">
		<div id="paselista">
		
			<h5>PASE DE LISTA</h5>
			<input type="button" name="" value="I" @click="getValue" class="btn btn-primary">

			{{-- <button  value="HOLA"></button> --}}
			
			<table class="table table-bordered">
				<thead>
					<th>No</th>
					<th>Matricula</th>
					<th>Alumno</th>
					
					<th>Asistencia</th>
				</thead>
				<tbody>
					<tr v-for="(alumno,index) in alumnos">
						<td>@{{index+1}}</td>
						<td>@{{alumno.matricula}}</td>
						<td>@{{alumno.nombre}}</td>
						<td>



						<input type="button" @click="cambiarValor(index)"  :value="valores[index]">

							
						</td>
					</tr>
				</tbody>
			</table>
			@{{valores}}
			
		</div>
	</div>
	</div>

@endsection

@push('scripts')
	
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/api/profesor/paselista.js')}}"></script>

@endpush

<input type="hidden" name="route" value="{{url('/')}}">