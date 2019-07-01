@extends('alumnos.menualumnos')
@section('contenido')
{{-- Inicio del VUE --}}
<div id="cedula">
    <div class="container">
      
 <div class="row">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible custom-success-box" style="margin: 15px;">
          <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>{{session('success')}}</strong>
      </div>
    @endif
  </div>  

  <div hidden="">
    @{{matricula="{!!Session::get('matricula')!!}"}}
  </div>

<div class="box">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h1 align="center">CÉDULA DE INFORMACIÓN INDIVIDUAL </h1>
      </div>
    </div>
  </div>

<div class="box">



 
  


 

      


  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">ACADEMICOS</a></li>
    <li><a data-toggle="tab" href="#menu1">GENERALES</a></li>
    <li><a data-toggle="tab" href="#menu2">FAMILIARES</a></li>
    <li><a data-toggle="tab" href="#menu3">LABORALES</a></li>
   
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>ACADÉMICOS</h3>

      <div class="form-row">
            <div class="form-group col-md-12">
              <label >Carrera</label>
              <select class="form-control" v-model="idcarrera" disabled="">
                <option v-for="carrera in carreras" v-bind:value="carrera.idcarrera">
                @{{carrera.nombrelargo}}
              </option>
              </select>
            </div>
           </div>


          <div class="form-row">
          
              <div class="form-group col-md-8">
              <label for="periodo">Periodo</label>
            <select class="form-control" v-model="claveperiodo">
                <option disabled="">Elija un periodo</option>
                <option v-for="periodo in periodos" v-bind:value="periodo.claveperiodo">@{{periodo.nombregenerico}}</option>
                
               
                
                
            </select>
                    
            </div>


                    
          </div>
            






            <div class="form-group col-md-4">
              <label for="">Año</label>
              <input type="text" class="form-control" disabled="" v-model="anio">
            </div>
        

        
           <div class="form-row">
            <div class="form-group col-md-12">
              <label class="label-control">Tutor</label>
                 <select class="form-control" v-model="cedula">
                   <option value="" disabled="">Elije un tutor</option>
                   <option v-for="tut in tutores" v-bind:value="tut.cedula">
                     @{{tut.tratamiento}} @{{tut.apellidop}} @{{tut.apellidom}} @{{tut.nombre}}
                   </option>
                 </select>
            </div>
           </div>


            <div class="form-row">
          
              <div class="form-group col-md-4">
                <label>Grado</label>
                <select class="form-control" v-model="gradoactual">
                    <option disabled="">Elije un grado</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
              </div>
              
              <div class="form-group col-md-4">
                <label>Grupo</label>
                <select class="form-control" v-model="grupoactual">
                    <option disabled="">Elije un grado</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                </select>
                
              </div>

              <div class="form-group col-md-4">
                <label>Turno</label>
                <input type="text" class="form-control" id="turno" value="MATUTINO" readonly="">
              </div>
                </div>

               <div class="form-row">
                                          
            <div class="form-group col-md-6">
              <label for="sel2">Escuela de procedencia:</label>
            <select class="form-control" v-model="id_escuela">
                <option disabled="">Elija una opción</option>
                <option v-for="esc in escuelas" v-bind:value="esc.id_escuela">@{{esc.nombre}} </option>
                
            </select>
                    
            </div>
          
          <div class="form-row">
              <div class="form-group col-md-6">
                <label >Plantel</label>
                <input type="text" class="form-control" v-model="plantel_procedencia" name="plantel_procedencia" value="">
              </div>
            </div>
            </div>
         </div>
    

    <div id="menu1" class="tab-pane fade">
      <h3>GENERALES</h3>
      
      <div class="form-row">
            <div class="form-group col-md-3">
              <div class="form-row">
                <div class="form-group col-md-12">
                 
                  
                      <img v-if="url" :src="url" class="img-rounded"  width="160" height="200">
                      

                      <img v-if="foto" v-bind:src="`${route}/imagenes/alumnos/${foto}`" class="img-rounded"  width="160" height="200" alt="Actual">
                       <img v-else v-bind:src="`${route}/imagenes/alumnos/no.jpg`" class="img-rounded"  width="160" height="200" alt="Actual">
                    
                    
                  
                  
                </div>

                 <div class="form-group col-md-12">
                  <label for="imagen">Imagen</label>
                        <input type="file"  class="form-control" @change="onFileChange">
                        
                        <br>
                        
                </div>

                

  


              </div>


              

              <div class="form-row">
               
              </div>
            </div>

            <div class="form-group col-md-9">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Matrícula</label>
                    
                    <input type="text" class="form-control" v-model="matricula"  readonly="" bold>
                    
                </div>

                <div class="form-group col-md-6">
                  <label>Curp</label>
                  <input type="text" class="form-control" v-model="curp">
                </div>
              </div>
                
              <div class="for-row">
                <div class="form-group col-md-4">
                  <label>Nombre</label>
                  <input type="text" class="form-control" v-model="nombre" readonly="">
                </div>

                <div class="form-group col-md-4">
                  <label>Apellido paterno</label>
                  <input type="text" class="form-control" v-model="apellidop"  readonly="">
                </div>

                <div class="form-group col-md-4">
                  <label>Apellido materno</label>
                  <input type="text" class="form-control" v-model="apellidom"  readonly="">
                </div>
              </div>

              <div class="for-row">
                <div class="form-group col-md-3">
                  <label>Calle</label>
                  <input type="text" class="form-control" v-model="calle"  required="true">
                </div>


                <div class="form-group col-md-3">
                  <label>Cruzamiento</label>
                  <input type="text" class="form-control" v-model="cruzamiento" name="cruzamiento" value="" required="true">
                </div>

                <div class="form-group col-md-3">
                  <label>Municipio</label>
                 <select v-model="id_municipio" class="form-control">
                   <option disabled="" value="ini">Elija un municipio</option>
                   <option v-for="muni in municipios" v-bind:value="muni.id_municipio">@{{muni.nombre}}</option>
                 </select>
                </div>

                <div class="form-group col-md-3">
                  <label>Localidad</label>
                  <input type="text" class="form-control" v-model="localidad"  required="true">
                </div>

                
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Tel Domicilio</label>
                  <input type="text" class="form-control" v-model="tel_casa">
                </div>

                <div class="form-group col-md-6">
                  <label>Tel Celular</label>
                  <input type="text" class="form-control" v-model="celular">
                </div>


              </div>


              <div class="form-row">
                
                <div class="form-group col-md-6">
                  <label>Correo electrónico</label>
                  <input type="mail" class="form-control" v-model="email">
                </div>

                <div class="form-group col-md-6">
                  <label>Lugar de nacimiento</label>
                  <input type="text" class="form-control" v-model="lugar_nac">
                </div>
              </div>


              <div class="form-row">
          
                  <div class="form-group col-md-6">
                    <label>Fecha de nacimiento</label>
                    <input type="date" class="form-control" v-model="fecha_nac">
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label>Edad</label>
                    <input type="text" class="form-control" v-model="edad" >
                  </div>
                      </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="tiene_beca">Beca</label>
                      <select class="form-control" v-model="tiene_beca">
                             <option >Si</option>
                             <option selected="true">No</option>
                      </select>
                    </div>

                    <div class="form-group col-md-6" v-if="tiene_beca=='Si'">
                      <label for="tipo_beca">Tipo de beca:</label>
                      <select class="form-control" v-model="id_beca">
                        <option disabled="" value="ini">Elija una beca</option>
                        <option v-for="beca in becas" v-bind:value="beca.id_beca">@{{beca.nombre}}</option>
                      </select>
                      
                    </div>
                 </div>
              

              <div class="form-row">
                  

                  <div class="form-group col-md-6">
                      <label for="tiene_villa">Tiene villa</label>
                      <select class="form-control" v-model="tiene_villa">
                             <option value="Si">Si</option>
                             <option selected="true" value="No">No</option>
                      </select>
                  </div>
                  
                  <div class="form-group col-md-6" v-if="tiene_villa=='Si'">
                    <label for="sel2">Selecciona villa:</label>
                    <select class="form-control" v-model="id_villa">
                        <option disabled="" value="ini">Elija una villa</option>
                        <option v-for="villa in villas" v-bind:value="villa.id_villa">
                          @{{villa.nombre}} / @{{villa.direccion}}
                        </option>
                    </select>
                    
                  </div>
                      </div>

              </div>
          </div>
    </div>

    <div id="menu2" class="tab-pane fade">
      <h3>FAMILIARES</h3>
     
     <div class="form-row">
            <div class="form-group col-md-6">
              <label >Nombre completo del padre</label>
              <input type="text" class="form-control" v-model="padre">
            </div>
           

           
            <div class="form-group col-md-6">
              <label >Nombre completo de la madre</label>
              <input type="text" class="form-control" v-model="madre">
            </div>
           </div>


          <div class="form-row">
                                          
                  <div class="form-group col-md-6">
                    <label for="sel2">Contacto:</label>
                    <select class="form-control" v-model="contacto">
                      <option disabled="">Elije un contacto</option>
                      <option value="Padre">Padre</option>
                      <option value="Madre">Madre</option>
                      <option value="Hermano">Hermano</option>
                      <option value="Otro">Otro</option>
                    </select>
                    
                  </div>
          
          <div class="form-row">
              <div class="form-group col-md-6">
                <label >Telefono</label>
                <input type="text" class="form-control" v-model="tel_contacto">
              </div>
            </div>


            </div>
           

          <div class="form-row">
                                          
            <div class="form-group col-md-6">
              <label for="sel2">Tipo de sangre:</label>
            <select class="form-control" v-model="id_tipo_sangre">
                <option disabled="" value="ini">Seleccione una opción</option>
                <option v-for="sangre in sangres" v-bind:value="sangre.id_tipo_sangre">@{{sangre.tipo}}</option>
                
            </select>
            
                    
            </div>
          
          <div class="form-row">
              <div class="form-group col-md-6">
                <label >NSS</label>
                <input type="text" class="form-control" v-model="nss">
              </div>
            </div>
            </div>



              <div class="form-row">
                                          
            <div class="form-group col-md-4">
                <label >Padecimiento físico</label>
              <input type="text" class="form-control" v-model="pade_fisico">
              
            </div>
          
          
            <div class="form-group col-md-4">
                <label >Enfermedad crónica</label>
                <input type="text" class="form-control" v-model="enfermedad">
            </div>

            <div class="form-group col-md-4">
                <label >Alergia a algún medicamento</label>
                <input type="text" class="form-control" v-model="alergia">
            </div>
            
            </div>

           
    </div>

    <div id="menu3" class="tab-pane fade">
      <h3>LABORALES</h3>

        <div class="form-row">
                  

                  <div class="form-group col-md-12">
                      <label >Trabajas</label>
                      <select class="form-control" v-model="trabaja">
                             <option value="Si">Si</option>
                             <option value="No">No</option>
                      </select>
                  </div>
        </div>



        <div v-if="trabaja=='Si'">
        <div class="form-row">
          
              <div class="form-group col-md-6">
                <label>Empresa</label>
                <input type="text" class="form-control" v-model="dl_empresa">
              </div>
              
              <div class="form-group col-md-6">
                <label>Dirección</label>
                <input type="text" class="form-control" v-model="dl_direccion">
              </div>

              
        </div>

        <div class="form-row">
          
              <div class="form-group col-md-4">
                <label>Departamento</label>
                <input type="text" class="form-control" v-model="dl_depto">
              </div>
              
              <div class="form-group col-md-4">
                <label>Jefe inmediato</label>
                <input type="text" class="form-control" v-model="dl_jefe">
              </div>

              <div class="form-group col-md-4">
                <label>Puesto</label>
                <input type="text" class="form-control" v-model="dl_puesto">
              </div>

              
        </div>


        <div class="form-row">
          
              <div class="form-group col-md-6">
                <label>Teléfono de contacto</label>
                <input type="text" class="form-control" v-model="dl_telefono">
              </div>
              
              <div class="form-group col-md-6">
                <label>Horario</label>
                <input type="text" class="form-control" v-model="dl_horario">
              </div>

              
        </div>

  </div>

    </div> 
    {{-- Fin del TAB LABORALES --}}
  </div>



  <div class="row">
      <div class="form-group col-md-12">
              <button class="btn btn-primary" v-on:click="actualizarCedula()">Guardar</button>
              {{-- <button class="btn btn-danger">Cancelar</button> --}}
            </div>
            <br><br>
  </div>

  </div>

</div>
{{-- Fin del container --}}
</div>
{{-- Fin del VUE --}}
@endsection



@push('scripts')
    <script src="{{asset('js/vue-resource.min.js')}}"></script>
    <script src="{{asset('js/api/alumnos/cedula_alumno.js')}}"></script>
@endpush
<input type="hidden" name="route" value="{{url('/')}}">