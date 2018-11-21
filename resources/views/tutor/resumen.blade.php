@extends('layouts.adminlte')
@section('contenido')
	 <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$becados[0]->becados}}</h3>

              <p>Becados</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Detalle <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$villas[0]->villas}}<sup style="font-size: 20px"></sup></h3>

              <p>Villas</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Detalle <i class="fa fa-arrow-circle-right"></i></a>
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

      <div class="row col-md-12">
      		<div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Alumno</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Asignaturas</a></li>

              <li class="pull-left header"><i class="fa fa-inbox"></i> Gráficas</li>
            </ul>

            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
              	hola
              </div>

              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                
                  <div style="width: 50%">
                      <canvas id="canvas" height="450" width="600"></canvas>
                 </div>
                </div>
            </div>
          </div>
      </div>

@endsection

@push('scripts')
   <script src="{{asset('js/Chart.min.js')}}"></script>

   <script>

  var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
  var ejex={!! json_encode($materias) !!}
  
  
  var barChartData = 
  {
        
    labels: ['M1','M2','M3','M4','M5','M6'],
    datasets : [
      {
        label: 'Unidad 1',
        fillColor : "rgba(220,220,220,0.5)",
        strokeColor : "rgba(220,220,220,0.8)",
        highlightFill: "rgba(220,220,220,0.75)",
        highlightStroke: "rgba(220,220,220,1)",
        data : {!! json_encode($u1) !!}
      },

      {
        label: 'Unidad 2',
        fillColor : "rgba(151,187,205,0.5)",
        strokeColor : "rgba(151,187,205,0.8)",
        highlightFill : "rgba(151,187,205,0.75)",
        highlightStroke : "rgba(151,187,205,1)",
        data : {!! json_encode($u2) !!}
      }
    ]


  }

  var optionsPie = {
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: 'rgb(255, 99, 132)'
                }
            }
        }


  window.onload = function(){
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {responsive : true,});

  }



  </script> 
@endpush


