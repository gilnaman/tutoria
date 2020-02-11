@extends('layouts.coordinador')
@section('titulo','Programacion de eventos')
@section('contenido')
	<div id="eventos">
		
		<div hidden="">
			@{{periodo="{!!Session::get('periodo')!!}"}}
		</div>
		<button class="btn btn-primary" @click="showModal()">Agregar evento +</button><br><br>
		
		
		<div class="row">
			<div class="col-md-8">
				
					<div class="box box-primary">
			
						<table class="table table-bordered table-responsive table-sm">
							<thead>
								<th>NO</th>
								<th hidden="">CLAVE</th>
								<th>TIPO</th>
								<th>FECHA</th>
								<th>TITULO</th>
								<th>DESCRIPCION</th>
								<TH>GRUPOS</TH>
								<th>OPCIONES</th>
							</thead>

							<tbody>
								<tr v-for="(ev,index) in eventos">
									<td>@{{index+1}}</td>
									<td hidden="">@{{ev.id_evento}}</td>
									<td><small>@{{ev.tipo.tipo}}</small></td>
									<td><small>@{{ev.fecha_evento}}</small></td>
									<td><small>@{{ev.titulo}}</small></td>
									<td><small>@{{ev.descripcion}}</small></td>
									<td>
										<span class="label label-danger" v-for="grupo in ev.grupos" v-if="grupo.enterado==0"><small>@{{grupo.id_grupo}} </small></span>

										<span class="label label-success" v-for="grupo in ev.grupos" v-if="grupo.enterado==1"><small>@{{grupo.id_grupo}} </small></span>
										
									</td>
									<td>
								
										{{-- Edicion de evento --}}
										<span class="fa fa-pencil btn btn-primary btn-xs"></span>

										{{-- Eliminar evento --}}
										<span class="fa fa-close btn btn-xs btn-warning"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</div>

			<div class="col-md-4">
				
				<div class="box box-warning">
					<h4 align="center"><b>Resumen de eventos</b></h4>
					<table class="table table-bordered">
						<tr v-for="est in estadisticas">
							<th>@{{est.tipo}}</th>
							<td>@{{est.cantidad}}</td>
						</tr>
						<tr>
							<th ><h4><b class="pull-right">TOTAL</b></h4></th>
							<td><h4 align="center"><b>@{{total}}</b></h4></td>
						</tr>
						

					</table>
				</div>
			</div>
		</div>

	
	<!-- Modal -->
		<div class="modal fade" id="addEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title" id="exampleModalLabel" ><strong >Agregando evento | <p class="label label-warning">@{{id_evento}}</p></h4></strong>

		        <div v-if="error==true" id="alert" class="alert alert-danger" > 
    			<a class="close" v-on:click="error=false">×</a>  
    				<strong>Precaución  </strong> Revise los siguientes errores:
    				<ul>
    					<li v-for="error in errores">@{{error.mensaje}}</li>
    				</ul>
				</div>

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button> 
		      </div>
		      <div class="modal-body">
		        
		        
		        	<div class="row">
			        	<div class="col-lg-6">
			        	<label>Tipo</label>	
								<select class="form-control" v-model="id_tipo">
									<option  disabled="">Elija un tipo</option>
									<option v-for="tipo in tipos_eventos" :value="tipo.id_tipo">@{{tipo.tipo}}</option>
								</select>
			        	</div>

			        	<div class="col-lg-6">
			        		<label>Fecha</label>
			        		<input type="date"  class="form-control" v-model="fecha_evento">
			        	</div>
		        	</div>

		        	<div class="row">
		        		<div class="col-md-6">
		        			<label class="control-label">Titulo</label>
		        			<input type="text" placeholder="Taller de prevención del suicidio" class="form-control" v-model.string="titulo" value=""  onkeyup="javascript:this.value=this.value.toUpperCase();">
		        		</div>


		        		<div class="col-md-6">
		        			<label class="control-label">Expositor</label>
		        			<input v-model="expositor" type="text" placeholder="Nombre del expositor" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">
		        		</div>
		        	</div>

		        	<div class="row">
		        		<div class="col-md-6">
		        			<label class="control-label">Descripcion</label>
		        			<textarea class="form-control" rows="3" placeholder="Describa la actividad" v-model="descripcion"></textarea>
		        		</div>


		        		<div class="col-md-6">
		        			<label class="control-label">Grupos</label>
		        			<div class="input-group">
			        			<select class="form-control" v-model="id_grupo">
			        				<option v-for="g in grupos" :value="g.clavegrupo">@{{g.clavegrupo}}</option>
			        			</select>
			        			<span class="input-group-btn">
			        				<button type="button" 
               						 v-on:click="addGrupo()"
                						class="btn btn-primary">Agregar</button>
			        			</span>
		        			</div>
		        		</div>

		        		{{-- asignaciones --}}
		        		
		        		 <div class="input-group">
                          <div class="alert alert-sucess">
                            <button class="btn btn-primary btn-sm" v-for="(dato,indice) of asignaciones" v-on:click="delGrupo(indice)" 
                            style="margin-left: 3px">
                              <span class="pull-right clickable close-icon" style="margin-left:4px" data-effect="fadeOut"> <i class="fa fa-times"> </i></span> 
                               <b>@{{dato.grupo }} </b>
                         </button>

                          
                              
                        </div>
                          
                        </div> 

		        			
		        		{{--  --}}
		        	</div>	
		        
		        

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		        <button type="button" class="btn btn-primary" @click="guardarEvento()">Guardar</button>
		        
		      </div>
		    </div>
		  </div>
		</div>
<!-- Fin de modal -->




	</div> 	{{-- FIN DEL VUE --}}
	
@endsection

@push('scripts')
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/api/coordinador/eventos.js')}}"></script>
	<script src="{{asset('js/toastr.min.js')}}"></script>
	
	<script type="text/javascript" src="{{asset('js/moment-with-locales.min.js')}}"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">