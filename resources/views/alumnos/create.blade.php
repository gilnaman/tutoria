<html>
<head>
	<meta charset="UTF-8">
	<title>Biblioteca UTC</title>
	@include('layouts.bootstrap')
	<link rel="stylesheet" href="css/table-style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://fonts.googleapis.com/css?family=Raleway:100" rel="stylesheet">
</head>

<body>

<div class="container">
	<div class="row">
		<div class="col-md-12" align="center">
	  		<h2>CÉDULA DE INFORMACIÓN INDIVIDUAL</h2>
	  </div>
	</div>
	  <form action="">
	  	
	    <div class="row">
		
		<div class="col-md-6">
		    
		    <div class="panel panel-primary">
		      <div class="panel-heading">Datos académicos</div>
		      <div class="panel-body">
					<div class="row">
						<div class="col-md-4" >
		      				<img src="{{asset('imagenes/alumnos/imagen1.jpg')}}" class="img-rounded" alt="Cinque Terre" width="120" height="140">
		      			</div>

						<div class="col-md-8">
			      			<div class="form-group">
	    						<label for="">Carrera</label>
	    						<input type="text" class="form-control" id="carrera" placeholder="">
	  						</div>

	  						<div class="form-group">
	    						<label for="exampleInputPassword1">Carrera</label>
	    						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
	  						</div>
						</div>

		      		</div>

		      	

		      		<div class="row">
		      			
		      		</div>
		      </div>
		    </div>
		</div>




		<div class="col-md-6">
		    <div class="panel panel-primary">
		      <div class="panel-heading">Datos generales</div>
		      <div class="panel-body">Panel Content</div>
		    </div>
		</div>
		

	    </div>

	    <div class="row">
		
		<div class="col-md-6">
		    <div class="panel panel-primary">
		      <div class="panel-heading">Datos Familiares</div>
		      <div class="panel-body">Panel Content</div>
		    </div>
		</div>

		<div class="col-md-6">
		    <div class="panel panel-primary">
		      <div class="panel-heading">Datos Laborales</div>
		      <div class="panel-body">Panel Content</div>
		    </div>
		</div>
		

	    </div>

	    <div class="row">
	    	<button type="submit" class="btn btn-primary">Guardar</button>
	   
	 </form>

  
</div>


</body>
</html>
