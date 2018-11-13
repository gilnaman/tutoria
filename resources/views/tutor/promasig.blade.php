<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          
          ['Asignaturas','U1','U2','U3','U4','U5','U6'],
          
          
          @foreach($promedios as $promedio)

            ['{{$promedio->materia}}',{{$promedio->U1}},{{$promedio->U2}},{{$promedio->U3}},{{$promedio->U4}},{{$promedio->U5}},],
          @endforeach
          
          
        ]);

        var options = {
          chart: {
            title: 'PROMEDIO POR ASIGNATURA',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
  </body>
</html>