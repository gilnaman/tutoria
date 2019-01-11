
{{-- -{{$alumno->matricula}} --}}
<div class="modal fade" id="add_just" tabindex="-1" role="dialog" 
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
                    <strong>Justificacion : {{$alumno->matricula}} - {{$alumno->fullname}}<br></strong>
                    <strong>Tutor: {{Session::get('usuario')}}</strong><br>
                    <input type="" name="" value="1" id="matricula" name="matricula">
                    
                    @{{unaJustifica.periodo="{!!Session::get('periodo')!!}"}}
                    @{{unaJustifica.grupo="{!!Session::get('grupo')!!}"}}
                    

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
                         v-model="unaJustifica.motivo">
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
                            v-model="unaJustifica.fecha_solicitud">
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Modulos</label>
                    <div class="col-sm-10">
                        <select name="id_motivo" id="" class="form-control" required="required"
                        v-model.string="unaJustifica.modulos">
                          <option value="Todos" selected>Todos</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
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
                            <button class="btn btn-primary" v-for="(dato,indice) of fechasM" v-on:click="delFecha(indice)" 
                            style="margin-left: 2px">
                              <span class="pull-right clickable close-icon" data-effect="fadeOut"> <i class="fa fa-times"> </i></span> 
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
                @{{unaJustifica}}
                <h3>Motivo : @{{unaJustifica.motivo}}</h3>
              
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Cerrar
                </button>
                <button type="button" class="btn btn-primary">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>





