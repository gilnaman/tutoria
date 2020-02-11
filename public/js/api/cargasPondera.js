function init(){

//moment.locale('es'); // Se especifica que las fechas de moment son en español

var $route = document.querySelector("[name=route]").value;


var urlPondera = $route + '/apiPonderacion';

new Vue({
	
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
			
		}
	},
	
	el:"#cargasPondera",
	
	
	created:function(){
		this.getCargas();
	},

	data:{
		cargas:[],
		desgloce:[],
		
		ponderaciones:[],
		numUnidades:6,
			// {valor:0,tipo:'C',entrega:''},
			
			
			
			
			
		

		tipos:['C','C','C','C','C','C'],
		valores:[],
		entregas:[],
		errorPondera:[],
		asigElegida:'',
		claveElegida:'',
		periodo:'2020A',
		cedula:'',
		claveGrupo:'',
		capturado:false
		
	},

	
  

	methods:{
		getCargas:function(){
			this.$http.get($route + '/apiCargas').then
			(function(response){
				this.cargas=response.data;
			});
		},

		dimensionar:function(){
			this.valores=[];
			this.entregas=[];
			this.ponderaciones=[];
			for (var i = 0; i < this.numUnidades; i++) {
				this.ponderaciones.push({valor:0,tipo:'C',entrega:''});
			}
		},

		getPondera:function(){
			// this.desgloce=[];

			// var peti = $route + '/getPondera/'+ this.periodo +
			//  '/' + this.claveGrupo + '/' + this.claveElegida + '/' + 
			//  this.cedula;
			//  //alert(peti);

			// this.$http.get(peti).then(function(response){
			//  	this.desgloce=response.data;
			//  	if (this.desgloce.length>0)
			//  	{
			//  		this.capturado=true;
			//  	}
			//  	console.log(response);
			//  }).catch(function(response){
			//  	console.log(response);
			//  })
		},
			

		eliminar:function(id){
			this.ponderaciones.splice(id,1);
			this.tipos.splice(id,1);
			this.valores.splice(id,1);
			this.entregas.splice(id,1);
			this.sumarPonderacion;
		},

		asigSelected:function(id){
			this.asigElegida=this.cargas[id].Asignatura;
			this.claveElegida=this.cargas[id].ClaveAsig;
			this.claveGrupo=this.cargas[id].ClaveGrupo;
		},

		addPondera:function(id)
		{


			this.asigSelected(id);
			
			this.desgloce=[];
			this.ponderaciones=[];
			var peti = $route + '/getPondera/'+ this.periodo +
			 '/' + this.claveGrupo + '/' + this.claveElegida + '/' + 
			 this.cedula;
			 //alert(peti);

			this.$http.get(peti).then(function(response){
			 	this.desgloce=response.data;
			 	if (this.desgloce.length>0)
			 	{
			 		$('#detalle_desgloce').modal('show');
			 	}
			 	else
			 	{
			 		this.dimensionar();
			 		$('#config_pondera').modal('show');
			 	}
			 	console.log(response);
			 }).catch(function(response){
			 	console.log(response);
			 })
			
			

			// $('#config_pondera').modal('show');
			
			// alert('Hola');
		},

		guardarPonderacion:function(){
			//alert('Hola mundo');
			this.errorPondera=[];
			
			if (this.sumarPonderacion<100){
				this.errorPondera.push({mensaje:'Todavía no alcanza el puntaje de 100%'});
			}

			//VERIFICO QUE EXISTA AL MENOS UNA UNIDAD INTEGRADORA
			exisiteInt=false;
			for (var i =0; i < this.tipos.length ; i++) {
				if(this.tipos[i]=='I'){
					exisiteInt=true;
					break;
				}
			}

			// SI NO SE ENCUENTRA AL MENOS UNA UNIDAD INTEGRADORA
			if (exisiteInt==false) {
				this.errorPondera.push({mensaje:'No ha definido al menos una unidad Integradora'});
			}

			// SE VERIFICA QUE LA ASIGNATURA ESTÉ SELECCIONADA
			if (this.asigElegida.length<1){
				this.errorPondera.push({mensaje:'No ha seleccionado la asignatura, a la cual se aplicará la ponderación'})
			}


			// VERIFICA QUE LAS FECHAS ESTÉN CAPTURADAS
			if (this.entregas.length)
			{
				// for (var i=0;i<this.entregas.length;i++){
				// 	if(this.entregas[i]==''){
				// 		alert(this.entregas[i])
				// 		this.errorPondera.push({mensaje:'No ha capturado las fechas de entrega de la unidad : ' + ($i+1)})	
				// 	}
				// }

				if(this.entregas.length==this.valores.length)
				{

					for (var i=0;i<this.entregas.length;i++){
						if(this.entregas[i]==null || this.entregas[i]==""){
							
							this.errorPondera.push({mensaje:'No ha capturado la fecha de entrega de la unidad : ' + (i+1)})	
						}
					}

				}
				else
						this.errorPondera.push({mensaje:'No ha capturado todas las fechas de entrega'});
				
			}
			else
			{
				this.errorPondera.push({mensaje:'No ha capturado las fechas de entrega'});

			}

			//VERIFICO QUE SOLO EXISTA UNA UNIDAD INTEGRADORA
			NoUnidadesIntegra=0;
			for (var i =0; i < this.tipos.length ; i++) {
				if(this.tipos[i]=='I'){
					NoUnidadesIntegra++;					
				}
			}

			//ENVIO DE ERROR CUANDO HAY MAS DE UNA UNIDAD INTEGRADORA
			if(NoUnidadesIntegra>1)
				this.errorPondera.push({mensaje:'Existe más de una unidad integradora'});
			
			//VERIFICA QUE EL PESO DE LA UNIDAD INTEGRADORA SEA DE AL MENOS 35 PUNTOS.
			if(exisiteInt && NoUnidadesIntegra==1)	
			{
				for (var i =0; i < this.tipos.length ; i++) {
					if(this.tipos[i]=='I'){
						if(this.valores[i]<35){
							this.errorPondera.push({mensaje:'El peso de una unidad integradora debe estar entre 35 y 60 %'})
						}
					}
				}

				for (var i =0; i < this.tipos.length ; i++) {
					if(this.tipos[i]=='I'){
						if(this.valores[i]>60){
							this.errorPondera.push({mensaje:'El peso de una unidad integradora de hasta 60%'})
						}
					}
				}

			}

		//SI TODO SALE BIEN GENERAMOS EL ARRAY PARA ENVIAR AL CONTROLADOR

		var auxponder = this.ponderaciones
		var unaPondera = {}
		//this.ponderaciones=[];


		var unidades_pondera=[];

		for (var i = 0;i < auxponder.length; i++) {
			//unaPondera={idasignatura:this.claveElegida,idperiodo:'2019B',cedula:this.cedula,unidad:(i+1),porcentaje:this.valores[i],tipo:this.tipos[i],fecha_planificada:this.entregas[i]}
			unidades_pondera[i]=i+1;	

			//this.ponderaciones.push(unaPondera);
		}
		console.log(unidades_pondera);
		// console.log(this.ponderaciones);


		var ponderacion_final={idasignatura:this.claveElegida,
			idperiodo:'2020A',
			cedula:this.cedula,
			clavegrupo:this.claveGrupo,
			unidades:unidades_pondera,
			valores:this.valores,
			tipos:this.tipos,
			fechas_planificadas:this.entregas}
		// var newponder=[]

		// newponder ={valores:this.valores,
		// 			tipos:this.tipos,
		// 			fentregas:this.entregas,
		// 			claveAsig:this.claveElegida,
		// 			periodo:'2019A'}
		// console.log(newponder);


		// SI NO HAY ERRORES SE ALMACENA
		if (this.errorPondera.length<=0)
		{
			//alert('No hay errores')
			this.$http.post(urlPondera,ponderacion_final).then(function(response){
				console.log(response);
				$('#config_pondera').modal('hide');
				alert('GRACIAS POR SU ENTREGA')
			});
		}
		// else 
			// alert('Hay errores aun')
		

		} // FIN DE GUARDAR PONDERACION
		
	},

	computed:{
		sumarPonderacion:function(){
			var total=0;
			for (var i = 0; i<this.valores.length; i++) {
				total=total+parseInt(this.valores[i]);
			}
			
			if(total>100)
				this.errorPondera.push({mensaje:'Ha excedido el puntaje máximo'});

			else
				this.errorPondera=[];
			return total;
		}
	}
})

}
window.onload=init;
