@extends('layouts.adminlte')
@section('contenido')
	
<div id="justificacion">

   
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de tutorados  </h3> <span 
              class="glyphicon glyphicon-print btn btn-sm btn-success" v-on:click="showLista()">
                
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed table-bordered" >
                <tr>
                  <th style="width: 10px">Matricula</th>
                  <th style="width: 60px">Alumno </th>
                  <th style="width: 40px">Operaciones</th>
                </tr>
                
                <tr v-for="(alumno,index) in alumnos">
                  <td>@{{alumno.matricula}}</td>
                  <td>@{{alumno.apellidop}} @{{alumno.apellidom}} @{{alumno.nombre}}</td>
                  <td>
                  	{{-- <a href="" data-toggle="tooltip" title="Ver ficha"><button type='button' class="btn btn-default btn-sm">
                      <span class='glyphicon glyphicon-pencil'></span>
                    </button></a> --}}
						
						
                      <button class="btn btn-default btn-sm" v-on:click="showModal(index)">
                        <span class="glyphicon glyphicon-heart-empty"></span>
                      </button>          
                      
                      

                    <a href="" target="_blank" data-toggle="tooltip" title="Imprimir ficha">
                      <button type='button' class="btn btn-default btn-sm" v-on:click="printCardex(alumno.matricula)"><span class='glyphicon glyphicon-print'></span></button>

                    </a>

                    

                  </td>
                </tr>
              
                
                
                
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>



{{-- Inicio del modal  --}}

<div class="modal fade" id="modal_justifica" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <strong>Justificacion: @{{unaJustifica.matricula}}  @{{unaJustifica.ncompleto}}<br></strong>
                    <strong>Tutor: @{{unaJustifica.tutor}} </strong><br>
                    
                    <div hidden="">
                    
                    @{{unaJustifica.periodo="{!!Session::get('periodo')!!}"}}
                    @{{unaJustifica.grupo="{!!Session::get('grupo')!!}"}}
                    @{{unaJustifica.id_carrera="{!! substr(Session::get('grupo'),0,3)!!}"}}
                    @{{unaJustifica.id_tutor="{!! Session::get('cedula') !!}"}}
                    @{{unaJustifica.tutor="{!! Session::get('usuario') !!}"}}
                    
                    </div>

                     <strong>Folio: 
                      {{-- <label class="label label-primary" v-bind:currentUser='{!!substr(uniqid(),0,8)!!}'> 
                      </label>
                        --}}
                      
                     <label class="label label-primary"> 
                       {{--   @{{unaJustifica.folio="{!!Session::get('periodo').'-'.substr(uniqid(),0,8).date("H:s")!!} "}} --}}
                      @{{unaJustifica.folio}}
                      {{-- date("Ymd H:i:s");  --}}
                      </label>
                    </strong>
         
                </h4>

            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <div class="panel form-horizontal">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Motivo</label>
                    <div class="col-sm-10">
                        <select name="id_motivo" id="" class="form-control" required="required"
                         v-model="unaJustifica.id_motivo">
                          <option value="1" selected="">Salud</option>
                          <option value="2">Personal</option>
                          <option value="3">Académico</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Fecha solicitud</label>
                    <div class="col-sm-10">

                        <input type="date" class="form-control"
                            id="inputPassword3" placeholder="Password"
                            v-model="unaJustifica.fecha_solicitud" v:bind.value="unaJustifica.fecha_solicitud">
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Modulos</label>
                    <div class="col-sm-10">
                        <select name="id_motivo" id="" class="form-control" required="required"
                        v-model.string="unaJustifica.modulos">
                          <option value="Todos" selected>Todos</option>
                          <option value="2">1</option>
                          <option value="3">2</option>
                        </select>
                    </div>
                  </div>

                 <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Fecha solicitada</label>
                    <div class="col-sm-10">
                        
                        <div class="input-group">
                          <input type="date" class="form-control" v-model="unaFecha">
                          
                        <span class="input-group-addon btn btn-sucess" v-on:click="addFecha()">+</span>
                          
                        </div>                    
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Fechas</label>
                    <div class="col-sm-10">
                        
                        <div class="input-group">
                          <div class="alert alert-sucess">
                            <button class="btn btn-primary btn-sm" v-for="(dato,indice) of fechasM" v-on:click="delFecha(indice)" 
                            style="margin-left: 2px">
                              <span class="pull-right clickable close-icon" style="margin-left:2px" data-effect="fadeOut"> <i class="fa fa-times"> </i></span> 
                              @{{dato.fecha }}
                         </button>
                              
                        </div>
                          
                        </div>                    
                    </div>
                  </div>
            </div>
                
          
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                 
                
            <div class="alert alert-danger" v-if="erroresJust.length">
              <ul>
                <li v-for="error in erroresJust">@{{error.mensaje}}</li>
              </ul>
          
            </div>
                
                {{-- @{{fechas}} --}}
                
              
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Cerrar
                </button>                                                 
                <button type="button" class="btn btn-primary" v-on:click="guardarJustifica()">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>


{{-- Fin del modal --}}
</div> {{-- Fin del VUE --}}



<!-- Modal -->

@endsection

@push('scripts')
    <script type="text/javascript" src="{{asset('js/moment-with-locales.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
    <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>

    <script type="text/javascript" src="{{asset('js/api/justifica.js')}}"></script>
@endpush
<input type="hidden" name="route" value="{{url('/')}}">