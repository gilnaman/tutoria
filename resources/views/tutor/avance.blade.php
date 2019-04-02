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
                      <th rowspan="2" style="text-align:center">Matricula</th>
                      <th rowspan="2" style="text-align:center">Alumno</th>
                      <th>U1</th>
                      <th>U2</th>
                      <th>U3</th>
                      <th>U4</th>
                      <th>U5</th>
                      <th>U6</th>
                      <th rowspan="2">Acumulado</th>
                      <th rowspan="2">Promedio ponderado</th>
                    </tr>

                    <tr>
                      <th>10</th>
                      <th>20</th>
                      <th>30</th>
                      <th>10</th>
                      <th>20</th>
                      <th>30</th>
                    </tr>
                  </thead>
                  <tbody >
                    <tr v-for="det in detalles">
                      <td>@{{det.matricula}}</td>
                      <td>@{{det.Alumno}}</td>
                      <td>
                        <button v-if="det.U1<7" class="btn btn-danger btn-xs">@{{det.U1}}</button>
                        <p v-else="det.U1>=7"><strong>@{{det.U1}}</strong></p>
                      </td>

                       <td>
                        <button v-if="det.U2 && det.U2<7" class="btn btn-danger btn-xs">@{{det.U2}}</button>
                        <p v-else="det.U2>=7"><strong>@{{det.U2}}</strong></p>
                      </td>
                      
                       <td>
                        <button v-if="det.U3 && det.U3<7" class="btn btn-danger btn-xs">@{{det.U3}}</button>
                        <p v-else="det.U3>=7"><strong>@{{det.U3}}</strong></p>
                      </td>

                       <td>
                        <button v-if="det.U4 && det.U4<7" class="btn btn-danger btn-xs">@{{det.U4}}</button>
                        <p v-else="det.U4>=7"><strong>@{{det.U4}}</strong></p>
                      </td>

                       <td>
                        <button v-if="det.U5 && det.U5<7" class="btn btn-danger btn-xs">@{{det.U5}}</button>
                        <p v-else="det.U5>=7"><strong>@{{det.U5}}</strong></p>
                      </td>

                      
                       <td>
                        <button v-if="det.U6 && det.U6<7" class="btn btn-danger btn-xs">@{{det.U6}}</button>
                        <p v-else="det.U6>=7"><strong>@{{det.U6}}</strong></p>
                      </td>

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

