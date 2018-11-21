<!doctype html>
<html>
	<head>
		<title>Promedios por asignatura</title>
		<script src="{{asset('js/Chart.min.js')}}"></script>
	</head>
	<body>
		
		<div style="width: 50%">
			<canvas id="canvas" height="450" width="600"></canvas>
		</div>


	<script>

	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
	var ejex={!! json_encode($materias) !!}
	
	
	var barChartData = 
	{
				
		labels: ejex,
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
	</body>
</html>
