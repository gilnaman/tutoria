<html>
<head>
	<meta charset="UTF-8">
	<title>Evaluacion docente | {{Session::get('usuario')}}</title>
	<meta name="token" id="token" value="{{ csrf_token() }}">

	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	
	
	<script src="{{asset('js/vue.min.js')}}"></script>
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
</head>
<body>
	<div class="container">
		<div  id="evaldoc">
			<div hidden="">
				@{{matricula="{!!Session::get('matricula')!!}"}}
				@{{grupo="{!!Session::get('grupo')!!}"}}
				@{{periodo="{!!Session::get('periodo')!!}"}}
				@{{presento="{!!Session::get('presento')!!}"}}
			</div>
			{{-- <h3>@{{matricula}}</h3>
			<h3>@{{grupo}}</h3>
			<h3>@{{periodo}}</h3> 
			<h3>@{{presento}}</h3> 
			--}}
			<h4>AGRADECEMOS TU PARTICIPACIÓN : <strong>{{Session::get('usuario')}}</strong></h4>
		

<div v-if="presento==false">

<div v-if="ok==false">


			{{-- Inicio instrucciones --}}
	
	<div v-show="pagAct==0">
		 <h4><strong>DESCRIPCIÓN</strong></h4><hr>
			
			<p align="justify"> Esta es una encuesta para conocer tu opinión de la calidad en el proceso de enseñanza-aprendizaje de tus docentes durante el cuatrimestre enero-abril 2020. Los resultados se utilizarán para mejorar el servicio educativo que reciben los estudiantes. Las respuestas de tu encuesta serán confidenciales por lo que siente en la libertad de expresar tus comentarios en la mejora del servicio educativo.</p>

			
		<h4><b>INSTRUCCIONES </b></h4>
		<P align="justify">Instrucciones: Indica en cada una de las preguntas planteadas la escala que mejor refleje tu opinión con respecto a la labor 
		desempeñada por cada docente</P>
			
			
	</div>
		{{-- Fin de Instrucciones --}}

			







		<div v-show="pagAct==1">
		 <h4><strong>1.-Demuestra conocimientos sobre el contenido de la asignatura que imparte.
 </strong></h4><hr>

		 <div class="row">
			<br>
			<div class="col-md-10" v-if="error==true">
				
				<div id="alert" class="alert alert-danger" > 
    			<a class="close" v-on:click="error=false">×</a>  
    				<strong>Precaución  </strong> Revise los siguientes errores:
    				<ul>
    					<li v-for="error in errores">@{{error.mensaje}}</li>
    				</ul>
				</div>

				
			
			</div>

			<div class="col-md-10" v-if="ok==true">
				
				<div id="alert" class="alert alert-success" > 
    			<a class="close">×</a>  
    				<strong> ¡ GRACIAS POR TUS RESPUESTAS !  </strong> 
    				
				</div>

				
			
			</div>

			<div class="col-md-10" v-if="presento==true">
				
				<div id="alert" class="alert alert-success" > 
    			<a class="close">×</a>  
    				<strong> TU YA HAS PRESENTADO LA EVALUACIÓN  </strong> 
    				
				</div>

				
			
			</div>
		</div>
		 		
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td><strong>@{{dato.asignatura}}</strong></td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td><strong>@{{dato.profesor}}</strong></td>
						<td>
							<select  class="form-control" v-model.number="resp1[index]" required="">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp1}}</h3> --}}

		</div>
			
		{{-- Pregunta 2 --}}
	
	<div v-show="pagAct==2">
		 <h4><strong>2.- Inicia y termina sus clases de acuerdo con el horario establecido
 </strong></h4><hr>
			<table class="preg1 table table-bordered" transition="fadeInLeft">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp2[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp2}}</h3> --}}
	</div>
		{{-- Fin de pregunta 2 --}}

		<div v-if="pagAct==3">
		 <h4><strong>3.- Presenta materiales de apoyo que estuvieron acordes a los temas
</strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp3[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp3}}</h3> --}}
		</div>

		{{-- Pregunta 4 --}}
		<div v-if="pagAct==4">
		 <h4><strong>4.-Responde de manera clara, respetuosa  y asertiva las inquietudes y/o dudas de los alumnos
. </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp4[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp4}}</h3> --}}
		</div>

	{{-- Pregunta 5 --}}
		<div v-if="pagAct==5">
		 <h4><strong>5.- Relaciona los contenidos de la asignatura con conocimientos previos del grupo o ejemplos cotidianos
.</strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp5[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp5}}</h3> --}}
		</div>
	{{-- Fin del Preg 5 --}}


	{{-- Pregunta 6 --}}
		<div v-if="pagAct==6">
		 <h4><strong>6.- Anima a los estudiantes a participar activamente (compartir conocimientos, ideas, dudas, discuciones, etc)
.</strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp6[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp6}}</h3> --}}
		</div>
	{{-- Fin del Preg 6 --}}


	{{-- Pregunta 7 --}}
		<div v-if="pagAct==7">
		 <h4><strong>7.- Establece los criterios de evaluación y fue justo a la hora de calificar 
. </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp7[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp7}}</h3> --}}
		</div>
	{{-- Fin del Preg 7 --}}

	{{-- Pregunta 8 --}}
		<div v-if="pagAct==8">
		 <h4><strong>8.- Otorga calificaciones justas y sin favoritismo durante el cuatrimestre
</strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp8[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp8}}</h3> --}}
		</div>
	{{-- Fin del Preg 8 --}}
	
	{{-- Pregunta 9 --}}
		<div v-if="pagAct==9">
		 <h4><strong>9.-Retroalimenta los trabajos entregados y los resultados de evaluaciones de los alumnos en tiempo y forma
 </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp9[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp9}}</h3> --}}
		</div>
	{{-- Fin del Preg 9 --}}

	{{-- Pregunta 10 --}}
		<div v-if="pagAct==10">
		 <h4><strong>10.-  Promueve el aprendizaje mediante el uso y manejo de las TIC´s
</strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp10[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp10}}</h3> --}}
		</div>
	{{-- Fin del Preg 10 --}}

	{{-- Pregunta 11 --}}
		<div v-if="pagAct==11">
		 <h4><strong>11.- Emplea tareas, ejercicios y casos prácticos a situaciones reales y/o cotidianas
 </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp11[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp11}}</h3> --}}
		</div>
	{{-- Fin del Preg 11 --}}

	{{-- Pregunta 12 --}}
		<div v-if="pagAct==12">
		 <h4><strong>12.- Es amable y accesible cuando se le solicita ayuda o asesoría
</strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp12[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp12}}</h3> --}}
		</div>
	{{-- Fin del Preg 12 --}}


	{{-- Pregunta 13 --}}
		<div v-if="pagAct==13">
		 <h4><strong>13.- Se caracteriza por ser respetuoso(a) contigo y tus compañer@s de salón 
. </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp13[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp13}}</h3> --}}
		</div>
	{{-- Fin del Preg 13 --}}

	{{-- Pregunta 14 --}}
		<div v-if="pagAct==14">
		 <h4><strong>14.- Demuestra interés en el aprendizaje grupal e individual de l@s alumn@s
.</strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp14[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp14}}</h3> --}}
		</div>
	{{-- Fin del Preg 14 --}}

		{{-- Pregunta 15 --}}
		<div v-if="pagAct==15">
		 <h4><strong>15.- Incentiva la búsqueda de información por parte de los alumnos, para la contrucción y desarrollo de los temas
</strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp15[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp15}}</h3> --}}
		</div>
	{{-- Fin del Preg 15 --}}

	{{-- Pregunta 16 --}}
		<div v-if="pagAct==16">
		 <h4><strong>16.- Informa al inicio del curso de manera clara y oportuna, los objetivos de aprendizaje y criterios de evaluación
. </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp16[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp16}}</h3> --}}
		</div>
	{{-- Fin del Preg 16 --}}

	{{-- Pregunta 17 --}}
		<div v-if="pagAct==17">
		 <h4><strong>17.- Explica con claridad con las indicaciones en las actividades de aprendizaje
 </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp17[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp17}}</h3> --}}
		</div>
	{{-- Fin del Preg 17 --}}

	{{-- Pregunta 18 --}}
		<div v-if="pagAct==18">
		 <h4><strong>18.- Tiene interés para que yo aprenda 
 </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp18[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp18}}</h3> --}}
		</div>
	{{-- Fin del Preg 18 --}}

	{{-- Pregunta 19 --}}
		<div v-if="pagAct==19">
		 <h4><strong>19.- Aprendo con la foma de enseñanza de mi maestr@
. </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp19[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp19}}</h3> --}}
		</div>
	{{-- Fin del Preg 19 --}}

	{{-- Pregunta 20 --}}
		<div v-if="pagAct==20">
		 <h4><strong>20.- Me gustaría volver a tomar clases con este(a) maestr@
. </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp20[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp20}}</h3> --}}
		</div>
	{{-- Fin del Preg 20 --}}



	{{-- Pregunta 21 --}}
<!-- 		<div v-if="pagAct==21">
		 <h4><strong>21.- El método de evaluación es justo. </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Respuesta</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<select  class="form-control" v-model.number="resp21[index]">
							<option disabled value="">Elija una respuesta</option>
							<option v-for="(opcion,index) in opciones"  
								v-bind:value="opcion.clave"
								>
									@{{opcion.nombre}}
							</option>
							</select>

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{resp21}}</h3> --}}
		</div>
 -->	{{-- Fin del Preg 21 --}}

	{{-- Pregunta 22 --}}
		<div v-if="pagAct==21">
		 <h4><strong>Escribe un comentario </strong></h4><hr>
			<table class="preg1 table table-bordered">
				<thead>
					<th hidden="">Clave</th>
					<th>Asignatura</th>
					<th hidden="">Cedula</th>
					<th>Profesor</th>
					<th>Comentario</th>
					
				</thead>

				<tbody>
					<tr v-for="(dato,index) of datos">
						<td hidden="">@{{dato.ClaveAsig}}</td>
						<td>@{{dato.asignatura}}</td>
						<td hidden="">@{{dato.Cedula}}</td>
						<td>@{{dato.profesor}}</td>
						<td>
							<input class="form-control" type="text" v-model.string="comentarios[index]">

						</td>
						
					</tr>
				</tbody>
				
			</table>
			
			{{-- <h3>@{{comentarios}}</h3> --}}
		</div>
	{{-- Fin del Preg 22 --}}

		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-primary" v-on:click="pagAct=0">Instrucciones</button>
				<button class="btn btn-primary" v-on:click="pagAct=1">1</button>
				<button class="btn btn-primary" v-on:click="pagAct=2">2</button>
				<button class="btn btn-primary" v-on:click="pagAct=3">3</button>
				<button class="btn btn-primary" v-on:click="pagAct=4">4</button>
				<button class="btn btn-primary" v-on:click="pagAct=5">5</button>
				<button class="btn btn-primary" v-on:click="pagAct=6">6</button>
				<button class="btn btn-primary" v-on:click="pagAct=7">7</button>
				<button class="btn btn-primary" v-on:click="pagAct=8">8</button>
				<button class="btn btn-primary" v-on:click="pagAct=9">9</button>
				<button class="btn btn-primary" v-on:click="pagAct=10">10</button>
				<button class="btn btn-primary" v-on:click="pagAct=11">11</button>
				<button class="btn btn-primary" v-on:click="pagAct=12">12</button>
				<button class="btn btn-primary" v-on:click="pagAct=13">13</button>
				<button class="btn btn-primary" v-on:click="pagAct=14">14</button>
				<button class="btn btn-primary" v-on:click="pagAct=15">15</button>
				<button class="btn btn-primary" v-on:click="pagAct=16">16</button>
				<button class="btn btn-primary" v-on:click="pagAct=17">17</button>
				<button class="btn btn-primary" v-on:click="pagAct=18">18</button>
				<button class="btn btn-primary" v-on:click="pagAct=19">19</button>
				<button class="btn btn-primary" v-on:click="pagAct=20">20</button>
				<button class="btn btn-primary" v-on:click="pagAct=21">21</button><!-- 
				<button class="btn btn-primary" v-on:click="pagAct=22">22</button> -->
			</div>
		</div><br>

		<div class="row">
			<div class="col-md-6">
				<button class="btn  btn-success btn-block" v-on:click="enviarRespuestas()">Enviar respuestas</button>
			</div>
		</div>


	</div> {{--  FIN DEL TODAS LAS PREGUNTAS --}}
</div> 
{{-- Fin cuando no ha presentado el examen --}}
</div> 	{{-- Fin del vue --}}
</div> 	{{-- Fin del container --}}

	<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>

	<script src="{{asset('js/evaldoc.js')}}"></script>
	<input type="hidden" name="route" value="{{url('/')}}">
</body>
</html>