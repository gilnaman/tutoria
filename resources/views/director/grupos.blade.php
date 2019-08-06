@extends('layouts.director')
@section('titulo','Grupos')
@section('contenido')
<div id="grupos">
	<div class="box box-info container">
		<div class="row">

			
			<div class="col-xs-6">
				<br>
				<div class="form-group" hidden="">
					<label>Periodo</label>
					<select class="form-control">
						<option disabled="">Elija un periodo</option>

						<option value="2019B">2019B</option>
					</select>
				</div>

				<span class="fa fa-plus btn btn-default" v-on:click="showModal()"></span><hr>
				<div class="form-group" >
					
					<label class="label-control">Carrera</label>

					<select class="form-control" @change="getGrupos">
						<option value="ini" disabled="">Elija una carrera</option>
						<option v-for="carr in carreras" v-bind:value="carr.idcarrera">@{{carr.nombre}}</option>
					</select>
					

				</div>



				<table class="table table-striped table-hover">
					<thead>
						<th>CLAVE</th>
						<th>GRADO</th>
						<th>GRUPO</th>
						<th>PLAN</th>

					</thead>
					<tbody>
						<tr v-for="grup in grupos">
							<td>@{{grup.clavegrupo}}</td>
							<td>@{{grup.grado}}</td>
							<td>@{{grup.grupo}}</td>
							<td>@{{grup.claveplan}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	


{{-- Inicia ventana MODAL --}}
<div class="modal fade" id="addGrupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
        	<strong>AGREGAR GRUPO<br> 
        </strong>
    </h4>
       
      </div>
      {{-- Inicio Body Modal --}}
      <div class="modal-body">


			
	      	<div class="row">
				
						<div class="form-group">
						<label class="control-label col-md-2">Carrera</label>
						<div class="col-md-4">
							<select class="form-control">
								<option value="ini" disabled="">Elija una carrera</option>
								<option v-for="carr in carreras" v-bind:value="carr.idcarrera">@{{carr.nombre}}</option>
							</select>
						</div>
						</div>	

						


				

			</div><br>

			<div class="row form-group">
							<label class="control-label col-md-2">Plan</label>
							<div class="col-sm-4">
							<select class="form-control">
								<option ></option>
							</select>
							</div>
			</div>


			<div class="row">
				<div class="form-group">
					<label class="control-label col-sm-2">Grado</label>
					<div class="col-sm-4">
					<select class="form-control">
						<option v-for="n in 11" v-bind:value="n">@{{n}}</option>
					</select>
					</div>
				</div>
			</div><br>

			<div class="row form-group">
					<label class="control-label col-sm-2">Grupo</label>
					<div class="col-sm-4">
					<select class="form-control">
						<option v-for="let in letras">@{{let}}</option>
					</select>
					</div>
			</div>


			





			
        	
      </div><br>
      {{-- Fin del Body MODAL --}}
      <div class="modal-footer">
     	<button>Guardar</button>
      </div>
    </div>
  </div>
</div>
{{-- FIN DEL MODAL --}}
</div> {{-- Fin del VUE --}}
@endsection

@push('scripts')
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/api/director/grupo.js')}}"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">