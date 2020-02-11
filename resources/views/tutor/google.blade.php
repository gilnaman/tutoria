<html>
  <head>
    

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>
  <body>
    <div id="chart_div" style="width: 95%; height:80%;"></div>
  

  <script>
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
            title: 'Promedios por asignatura',
            subtitle: 'Al segundo corte',
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          height: 600,
          colors: ['#ec2a15', '#025cd9', '#7570b3']
          
          
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
</body>
</html>