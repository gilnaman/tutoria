@extends('layouts.adminlte')
@section('contenido')

<div id="avance"> {{-- Inicio de VUE --}}

	<div class="row">

		<div class="col-md-8">

			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Asignaturas</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
                	
                	{{-- Inicio de tabla --}}
                  
                        <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Clave</th>
                    <th>Asignatura</th>
                    <th>Entregadas</th>
                    <th>Avance</th>
                    <th>Opciones</th>
                  </tr>

                  </thead>
                  <tbody>
                  <tr v-for="(asig,indice) of asignaturas">
                    <td><small>@{{asig.clave}}</small></a></td>
                    <td><strong>@{{asig.asignatura}} <br> <small>
                      <p class="text-success">@{{asig.tratamiento}}  @{{asig.docente}}</small></p></strong></td>
                    <td>@{{asig.entregadas}}</td>
                    <td>
                      @{{asig.avance}}
                    </td>
                    <td>
                      
                        <span class="btn btn-sm btn-default glyphicon glyphicon-search"
                        v-on:click="showDetalles(indice)"
                        data-toggle="tooltip" title="ver detalle"></span>
                      
                   </td>
                  </tr>
     
                  </tbody>
                </table>
                  
                  
                	{{-- Fin de tabla --}}
              
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body 
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
             /.box-footer -->
      </div> {{-- Fin del box.info --}}
      



		</div> {{-- Fin del Columna MD 6 --}}
	</div> {{-- Fin del ROW --}}

<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Detalle de asignatura : <strong>@{{asigSelected}} - @{{profeSelected}}</strong> Acumulado : <strong>@{{puntajeAcum}}</strong></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table no-margin table-responsive table-bordered">
                    <thead>
                    <tr>
                      <th>Matricula</th>
                      <th>Alumno</th>
                      <th>U1</th>
                      <th>U2</th>
                      <th>U3</th>
                      <th>U4</th>
                      <th>U5</th>
                      <th>U6</th>
                      <th>Acumulado</th>
                      <th>Promedio ponderado</th>
                    </tr>
                  </thead>
                  <tbody >
                    <tr v-for="det in detalles">
                      <td>@{{det.matricula}}</td>
                      <td>@{{det.Alumno}}</td>
                      <td>@{{det.U1}}</td>
                      <td>@{{det.U2}}</td>
                      <td>@{{det.U3}}</td>
                      <td>@{{det.U4}}</td>
                      <td>@{{det.U5}}</td>
                      <td>@{{det.U6}}</td>
                      <td>@{{det.acumulado}}</td>
                      <td><strong>@{{det.promedio}}</strong></td>
                    </tr>
                  </tbody>
                  </table>
                  
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                 
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



 




</div> {{-- Fin de VUE --}}



@endsection


@push('scripts')
	{{-- <script src="{{asset('adminlte/js/adminlte.min.js')}}"></script> --}}
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/avance.js')}}"></script>
@endpush
<input type="hidden" name="route" value="{{url('/')}}">

