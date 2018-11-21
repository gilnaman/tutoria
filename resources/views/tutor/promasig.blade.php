@extends('layouts.adminlte')
  @push('headers')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          
          ['Asignaturas','U1','U2','U3','U4','U5','U6'],
          
          
          @foreach($promedios as $promedio)

            ['{{$promedio->materia}}',{{$promedio->U1}},{{$promedio->U2}},{{$promedio->U3}},{{$promedio->U4}},{{$promedio->U5}},0],
          @endforeach
          
          
        ]);


        var options = {
          chart: {
            title: 'PROMEDIO POR ASIGNATURA',
            subtitle: 'Al segundo corte',
            hAxis:{title:'Year End Figures', titleTextStyle: {color: '#007DB0', fontSize: 8}},
            textStyle:  {fontName: 'TimesNewRoman',fontSize:8,bold: true},
            legend: { position: 'labeled' },
            is3D: true,

          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  @endpush
@section('contenido')
    <div id="columnchart_material" style="width: 98%; height: 80%;"></div>
  </body>
@endsection