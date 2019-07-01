@extends('layouts.coordinador')

@section('contenido')

<div id="resumen">

  <div class="row">
            
            <div class="form-group">
              <label class="col-md-2">Grupo</label>
              
              <div class="col-md-4">
              <select v-model="grupo" class="form-control">
                <option disabled="">Elije un grupo</option>
                <option v-for="grupo in grupos" v-bind:value="grupo.clavegrupo">@{{grupo.clavegrupo}}</option>
              </select>
              </div>
            </div>

            {{-- <div class="col-xs-4"> --}}
                  <button class="btn btn-primary" v-on:click="getResumen()">Obtener datos</button>
            {{-- </div> --}}
            
      </div>

{{-- Seccion de etiquetas --}}
<div class="row">
  <div  class="col-md-12"> {{-- Inicio de VUE --}}
       <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Portada  </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
        

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            
              {{-- <h3>{{$becados[0]->becados}}</h3> --}}

              <p>Becados</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            {{-- <button class="small-box-footer" v-on:click="showDetalle()">Detalle <span class="fa fa-arrow-circle-right"></span></button> --}}
            <a href="#" class="small-box-footer" v-on:click="showBecados()">Detalle <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
{{--               <h3>{{$villas[0]->villas}}<sup style="font-size: 20px"></sup></h3> --}}

              <p>Villas</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-home"></i>
            </div>
            <a href="#" class="small-box-footer" v-on:click="showVillas()">Detalle <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>0</h3>

              <p>Eventos</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Detalle <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>0</h3>

              <p>Justificaciones</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Detalle<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
              
            </div>
            <!-- /.box-body -->
          </div>



          <div class="modal fade" tabindex="-1" role="dialog" id="detalles">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Listado de Becados</h4>
                        
                    </div>
                    <div class="modal-body">
                        <table class="table table-stripped no-padding" >
                            <thead style="background: #fdff00;">
                              <th>Beca</th>
                              <th>Matricula</th>
                              <th>Beneficiario</th>
                            </thead>
                            <tbody>
                              <tr v-for="beca in becados">
                                <td>@{{beca.tipo_beca}}</td>
                                <td>@{{beca.matricula}}</td>
                                <td>@{{beca.alumno}}</td>
                              </tr>
                            </tbody>
                        </table>
                                
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        {{-- <button type="submit" class="btn btn-primary">Guardar</button> --}}
                         


                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        {{-- MODAL PARA ALUMNOS CON VILLLAS --}}

        <div class="modal fade" tabindex="-1" role="dialog" id="detalles_villas">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Listado alumnos con villa</h4>
                        
                    </div>
                    <div class="modal-body">
                        <table class="table table-stripped table-bordered table-hover" >
                            <thead style="background: #fdff00;">
                              <th>No.</th>
                              <th>Matricula</th>
                              <th>Alumno</th>
                              <th>Direccion</th>
                            </thead>
                            <tbody>
                              <tr v-for="(villa,index) in villas">
                                <td>@{{index}}</td>
                                <td>@{{villa.matricula}}</td>
                                <td>@{{villa.alumno}}</td>
                                <td>@{{villa.direccion}}</td>
                              </tr>
                            </tbody>
                        </table>
                                
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        {{-- <button type="submit" class="btn btn-primary">Guardar</button> --}}
                         


                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        {{-- FIN DE MODAL VILLAS --}}


  </div>
  
</div> 


{{-- Fin de seccion de etiquetas --}}

<section class="content">
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary" hidden>
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- DONUT CHART -->
          <div class="box box-danger" hidden>
            <div class="box-header with-border">
              <h3 class="box-title">Donut Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info" hidden>
            <div class="box-header with-border">
              <h3 class="box-title">Line Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Promedios por asignatura  del grupo  <b>{{$grupo}} </b></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

              <div class="chart">
                <canvas id="barChart" style="height:600px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>

</div> {{-- Fin de VUE --}}
@endsection


@push('scripts')
	
	<script src="{{asset('js/Chart.min.js')}}"></script>
	
	
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/api/coordinador/resumen.js')}}"></script>
	

  <script>
  $(function () {

  
    //-------------
    //- BAR CHART -
    //-------------

 var areaChartData2 = {
      labels  : [<?php foreach($materias as $mat)
          {echo "'$mat',";} ?>],
      
      datasets: [
        {
          label               : 'Unidad 1',
          fillColor           : 'rgba(60,41,288,1)',
          strokeColor         : 'rgba(60,41,288,1)',
          pointColor          : 'rgba(60,41,288,1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php foreach($unidad1 as $u1)
                                  {echo "'$u1',";} ?>]
        },

        {
          label               : 'Unidad 2',
          fillColor           : 'rgba(660,90,88,1)',
          strokeColor         : 'rgba(660,90,88,1)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(660,90,88,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(660,90,88,1)',
          data                : [<?php foreach($unidad2 as $u2)
                                  {echo "'$u2',";} ?>]
        },

        {
          label               : 'Unidad 3',
          fillColor           : 'rgba(255,214,88)',
          strokeColor         : 'rgba(255,214,88)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(255,214,88)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php foreach($unidad3 as $u3)
                                  {echo "'$u3',";} ?>]
        },
        {
        label               : 'Unidad 4',
        fillColor           : 'rgba(214,45,32)',
        strokeColor         : 'rgba(214,45,32)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(214,45,32)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [<?php foreach($unidad4 as $u4)
                                {echo "'$u4',";} ?>]
      },

        {
          label               : 'Unidad 5',
          fillColor           : 'rgba(0,0,0)',
          strokeColor         : 'rgba(0,0,0)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(0,0,0)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php foreach($unidad5 as $u5)
                                {echo "'$u5',";} ?>]
        },
          {
          label               : 'Unidad 6',
          fillColor           : 'rgba(56,7,69)',
          strokeColor         : 'rgba(56,7,69)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(56,7,69)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php foreach($unidad6 as $u6)
                                {echo "'$u6',";} ?>]
        }
      ]
    }



    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData2
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true,

      hover: {
        animationDuration: 2
      },


      
      // tooltipTemplate: "<%= value %>",
      // tooltipFillColor: "rgba(0,0,0,0)",
      // tooltipFontColor: "#444",
      // tooltipEvents: [],
      // tooltipCaretSize: 0,
      // onAnimationComplete: function()
      // {
      //     this.showTooltip(this.datasets[0].bars, true);
      // }

    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>


@endpush
<input type="hidden" name="route" value="{{url('/')}}">