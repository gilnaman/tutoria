@extends('alumnos.menualumnos')
@section('contenido')
<div class="container">
 <div class="row">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible custom-success-box" style="margin: 15px;">
          <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>{{session('success')}}</strong>
      </div>
    @endif
  </div>  

<div class="box">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h1 align="center">CÉDULA DE INFORMACIÓN INDIVIDUAL </h1>
      </div>
    </div>
  </div>

<div class="box">



 
  


 
<form role="form" method="POST" action="{{route('alumnos.update',$alumnos->matricula)}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input name="_method" type="hidden" value="PATCH">

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
            <input type="text" class="form-control" id="tutor" value="{{$alumnos->nombrelargo}}" readonly="">
            </div>
           </div>


          <div class="form-row">
          
              <div class="form-group col-md-8">
              <label for="periodo">Periodo</label>
            <select class="form-control" name="id_periodo">
                <option value=""></option>
                
                @foreach($periodos as $periodo)
                  @if($alumnos->id_periodo == $periodo->id_periodo)
                    <option value="{{$periodo->id_periodo}}" selected>{{$periodo->periodo}}</option>
                  @else
                    <option value="{{$periodo->id_periodo}}">{{$periodo->periodo}}</option>
                  @endif
                @endforeach
                
                
            </select>
                    
            </div>


                    
          </div>
            






            <div class="form-group col-md-4">
              <label for="">Año</label>
              <input type="text" class="form-control" id="anio" name="anio" value="{{$alumnos->anio}}">
            </div>
        

        
           <div class="form-row">
            <div class="form-group col-md-12">
              <label >Tutor</label>
            <input type="text" class="form-control" id="tutor" name="tutor" value="{{$alumnos->tutor}}">
            </div>
           </div>


            <div class="form-row">
          
              <div class="form-group col-md-4">
                <label>Grado</label>
                <input type="text" class="form-control" id="grado" value="{{$alumnos->gradoactual}}" readonly="">
              </div>
              
              <div class="form-group col-md-4">
                <label>Grupo</label>
                <input type="text" class="form-control" id="grupo" value="{{$alumnos->grupoactual}}" readonly="">
              </div>

              <div class="form-group col-md-4">
                <label>Turno</label>
                <input type="text" class="form-control" id="turno" value="MATUTINO" readonly="">
              </div>
                </div>
         </div>
    

    <div id="menu1" class="tab-pane fade">
      <h3>GENERALES</h3>
      
      <div class="form-row">
            <div class="form-group col-md-2">
              <div class="form-row">
                <div class="form-group col-md-12">
                 
                  @if($alumnos->foto!=null)
                      <img src="{{asset('imagenes/alumnos/'.$alumnos->foto)}}" class="img-rounded" alt="{{$alumnos->matricula}} Terre" width="180" height="200">
                  @else
                    <img src="{{asset('imagenes/alumnos/no.jpg')}}" class="img-rounded" alt="{{$alumnos->matricula}} Terre" width="180" height="200">
                  @endif
                  
                </div>
              </div>

              

              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="form-control">
                </div>
              </div>
            </div>

            <div class="form-group col-md-10">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Matrícula</label>
                    
                    <input type="text" class="form-control" id="matricula" value="{{$alumnos->matricula}}" readonly="" bold>
                    
                </div>

                <div class="form-group col-md-6">
                  <label>Curp</label>
                  <input type="text" class="form-control" id="curp" name="curp" value="{{$alumnos->curp}}">
                </div>
              </div>
                
              <div class="for-row">
                <div class="form-group col-md-4">
                  <label>Nombre</label>
                  <input type="text" class="form-control" id="nombre" value="{{$alumnos->nombre}}" readonly="">
                </div>

                <div class="form-group col-md-4">
                  <label>Apellido paterno</label>
                  <input type="text" class="form-control" id="apellidop" value="{{$alumnos->apellidop}}" readonly="">
                </div>

                <div class="form-group col-md-4">
                  <label>Apellido materno</label>
                  <input type="text" class="form-control" id="apellidom" value="{{$alumnos->apellidom}}" readonly="">
                </div>
              </div>

              <div class="for-row">
                <div class="form-group col-md-3">
                  <label>Calle</label>
                  <input type="text" class="form-control" id="calle" name="calle" value="{{$alumnos->calle}}" required="true">
                </div>


                <div class="form-group col-md-3">
                  <label>Cruzamiento</label>
                  <input type="text" class="form-control" id="cruzamiento" name="cruzamiento" value="{{$alumnos->cruzamiento}}" required="true">
                </div>

                <div class="form-group col-md-3">
                  <label>Municipio</label>
                  <input type="text" class="form-control" id="municipio" name="municipio" value="{{$alumnos->municipio}}" required="true">
                </div>

                <div class="form-group col-md-3">
                  <label>Localidad</label>
                  <input type="text" class="form-control" id="localidad" name="localidad" value="{{$alumnos->localidad}}" required="true">
                </div>

                
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Tel Domicilio</label>
                  <input type="text" class="form-control" id="tel_caca" name="tel_casa" value="{{$alumnos->tel_casa}}">
                </div>

                <div class="form-group col-md-6">
                  <label>Tel Celular</label>
                  <input type="text" class="form-control" id="celular" name="celular" value="{{$alumnos->celular}}">
                </div>


              </div>


              <div class="form-row">
                
                <div class="form-group col-md-6">
                  <label>Correo electrónico</label>
                  <input type="mail" class="form-control" id="email" name="email" value="{{$alumnos->email}}">
                </div>

                <div class="form-group col-md-6">
                  <label>Lugar de nacimiento</label>
                  <input type="text" class="form-control" id="lugar_nac" name="lugar_nac" value="{{$alumnos->lugar_nac}}">
                </div>
              </div>


              <div class="form-row">
          
                  <div class="form-group col-md-6">
                    <label>Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" value="{{$alumnos->fecha_nac}}">
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label>Edad</label>
                    <input type="text" class="form-control" id="edad" name="edad" value="{{$alumnos->edad}}">
                  </div>
                      </div>

                      <div class="form-row">
                         <div class="form-group col-md-6">
                  <label for="tiene_beca">Beca</label>
                  <select class="form-control" id="tiene_beca" name="tiene_beca">
                    <option value="" selected></option>
                    @if($alumnos->tiene_beca=="Si")
                        <option selected="true">Si</option>
                        <option >No</option>
                      @else
                         <option >Si</option>
                         <option selected="true">No</option>
                      @endif
                      
                   </select>
                    
                </div>

                  <div class="form-group col-md-6">
                    <label for="tipo_beca">Tipo de beca:</label>
                    <select class="form-control" id="tipo_beca" name="tipo_beca">
                      <option>Prospera</option>
                      <option>Pronabes</option>
                      <option>Impulso universitario</option>
                      <option>Otro</option>
                    </select>
                    
                  </div>
                      </div>
              

              <div class="form-row">
                        <div class="form-group col-md-6">
                         <label>Tiene villas 
                    <label class="radio-inline">
                      <input type="radio" name="optradio2" checked="checked">Si
                    </label>

                    <label class="radio-inline">
                      <input type="radio" name="optradio2">No
                    </label>
                    </label>
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label for="sel2">Selecciona villa:</label>
                    <select class="form-control" name="id_villa">
                      
                        <option value="" selected></option>
                      
                      @foreach($villas as $villa)
                  
                          @if($alumnos->id_villa == $villa->id_villa)
                            <option value="{{$villa->id_villa}}" selected>{{$villa->direccion}}</option>
                          @else
                            <option value="{{$villa->id_villa}}">{{$villa->direccion}}</option>
                          @endif
                        
                      @endforeach
                      
                
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
              <input type="text" class="form-control" id="padre2" name="padre2" value="{{$alumnos->padre}}">
            </div>
           

           
            <div class="form-group col-md-6">
              <label >Nombre completo de la madre</label>
              <input type="text" class="form-control" id="madre" name="madre" value="{{$alumnos->madre}}">
            </div>
           </div>


          <div class="form-row">
                                          
                  <div class="form-group col-md-6">
                    <label for="sel2">Contacto:</label>
                    <select class="form-control" id="Contacto" name="contacto">
                      <option selected="">Padre</option>
                      <option>Madre</option>
                      <option>Hermano</option>
                      <option>Otro</option>
                    </select>
                    
                  </div>
          
          <div class="form-row">
              <div class="form-group col-md-6">
                <label >Telefono</label>
                <input type="text" class="form-control" id="tel_contacto" name="tel_contacto" value="{{$alumnos->tel_contacto}}">
              </div>
            </div>


            </div>
           

          <div class="form-row">
                                          
            <div class="form-group col-md-6">
              <label for="sel2">Tipo de sangre:</label>
            <select class="form-control" name="id_tipo_sangre">
                <option value=""></option>
                
                @foreach($sangres as $sangre)
                  @if($alumnos->id_tipo_sangre == $sangre->id_tipo_sangre)
                    <option value="{{$sangre->id_tipo_sangre}}" selected>{{$sangre->tipo}}</option>
                  @else
                    <option value="{{$sangre->id_tipo_sangre}}">{{$sangre->tipo}}</option>
                  @endif
                @endforeach
                
            </select>
                    
            </div>
          
          <div class="form-row">
              <div class="form-group col-md-6">
                <label >NSS</label>
                <input type="text" class="form-control" id="nss" name="nss"  value="{{$alumnos->nss}}">
              </div>
            </div>
            </div>



              <div class="form-row">
                                          
            <div class="form-group col-md-4">
                <label >Padecimiento físico</label>
              <input type="text" class="form-control" id="pade_fisico" name="pade_fisico" value="{{$alumnos->pade_fisico}}">
              
            </div>
          
          
            <div class="form-group col-md-4">
                <label >Enfermedad crónica</label>
                <input type="text" class="form-control" id="enfermedad" name="enfermedad" value="{{$alumnos->enfermedad}}">
            </div>

            <div class="form-group col-md-4">
                <label >Alergia a algún medicamento</label>
                <input type="text" class="form-control" id="alergia" name="alergia" value="{{$alumnos->alergia}}">
            </div>
            
            </div>

            <div class="form-row">
                                          
            <div class="form-group col-md-6">
              <label for="sel2">Escuela de procedencia:</label>
            <select class="form-control" id="escuela">
                <option>Cobay</option>
                <option>Cecyte </option>
                <option>Cbta</option>
                <option>Otro </option>
            </select>
                    
            </div>
          
          <div class="form-row">
              <div class="form-group col-md-6">
                <label >Plantel</label>
                <input type="text" class="form-control" id="plantel_procedencia" name="plantel_procedencia" value="{{$alumnos->plantel_procedencia}}">
              </div>
            </div>
            </div>
    </div>

    <div id="menu3" class="tab-pane fade">
      <h3>LABORALES</h3>
      
        <div class="form-row">
          
              <div class="form-group col-md-6">
                <label>Empresa</label>
                <input type="text" class="form-control" id="dl_empresa" name="dl_empresa" value="{{$alumnos->dl_empresa}}">
              </div>
              
              <div class="form-group col-md-6">
                <label>Dirección</label>
                <input type="text" class="form-control" id="dl_direccion" name="dl_direccion" value="{{$alumnos->dl_direccion}}">
              </div>

              
                </div>

                  <div class="form-row">
          
              <div class="form-group col-md-4">
                <label>Departamento</label>
                <input type="text" class="form-control" id="depto" name="dl_depto" value="{{$alumnos->dl_depto}}">
              </div>
              
              <div class="form-group col-md-4">
                <label>Jefe inmediato</label>
                <input type="text" class="form-control" id="jefe" name="dl_jefe" value="{{$alumnos->dl_jefe}}">
              </div>

              <div class="form-group col-md-4">
                <label>Puesto</label>
                <input type="text" class="form-control" id="puesto" name="dl_puesto" value="{{$alumnos->dl_puesto}}">
              </div>

              
                </div>


                <div class="form-row">
          
              <div class="form-group col-md-6">
                <label>Teléfono de contacto</label>
                <input type="text" class="form-control" id="dl_telefono" name="dl_telefono" value="{{$alumnos->dl_telefono}}">
              </div>
              
              <div class="form-group col-md-6">
                <label>Horario</label>
                <input type="text" class="form-control" id="dl_horario" name="dl_horario" value="{{$alumnos->dl_horario}}">
              </div>

              
                </div>
    </div>
  </div>



  <div class="row">
      <div class="form-group col-md-12">
              <button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
            <br><br>
  </div>
</form>
  </div>

</div>

@endsection