
<div class="modal fade" id="add-just-{{$alumno->matricula}}" tabindex="-1" role="dialog" 
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
                    <strong>Tutor: {{Session::get('usuario')}}</strong>
                      
            
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <div class="panel form-horizontal">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Motivo</label>
                    <div class="col-sm-10">
                        <select name="id_motivo" id="" class="form-control" required="required">
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
                            id="inputPassword3" placeholder="Password"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Modulos</label>
                    <div class="col-sm-10">
                        <select name="id_motivo" id="" class="form-control" required="required">
                          <option value="1" selected="">Todos</option>
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
                            <button class="btn btn-primary" v-for="(dato,indice) of fechas" v-on:click="delFecha(indice)" 
                            style="margin-left: 2px">
                              <span class="pull-right clickable close-icon" data-effect="fadeOut"><i class="fa fa-times"> </i></span> 
                              @{{dato.fecha}} 

                            </button>
                            
                        </div>
                          
                        </div>                    
                    </div>
                  </div>


                 
                 
                </div>
                
                
                
                
                
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
              
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





