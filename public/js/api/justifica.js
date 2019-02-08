function init(){

moment.locale('es'); // Se especifica que las fechas de moment son en español

var $route = document.querySelector("[name=route]").value;

var url=route + '/apiJustificaciones'; //referencia a la api
var urlAlumnos = route + '/apiAlumnos';


new Vue({
	
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
			
		}
	},
	props: ['currentUser'],
	el:"#justificacion",
	

	created:function(){
		this.getAlumnos();
	},

	data:{
		alumnos:[],
		fechas:[],
		fechasM:[],
		unaFecha:'',
		unaJustifica:{
			folio:'',
			periodo:'',
			grupo:'',
			id_carrera:'',
			matricula:'',
			ncompleto:'',
			id_motivo:'',
			fecha_solicitud:moment().format('YYYY-MM-DD'),
			num_dias:'',
			id_tutor:'',
			tutor:'',
			comentario:'',
			fechas:[],
			modulos:'Todos'
			},
		errorJust:false,
		erroresJust:[]

	},

	
  

	methods:{

		addFecha:function()
		{
			
			var mifecha=this.unaFecha;
			var mifecha2 = moment(mifecha).format('DD/MMM/YYYY');
			if(mifecha){
				this.fechas.push({fecha:mifecha});
				this.fechasM.push({fecha:mifecha2})
				// this.unaJustifica.fechas=this.fechas;

				this.unaJustifica.num_dias=this.unaJustifica.fechas.length +1;
			}
		},

		delFecha:function(indice){

			this.fechas.splice(indice,1);
			this.fechasM.splice(indice,1);
			//alert(indice);
		},

		showModal:function(id){
			this.errorJust=false;
			this.erroresJust=[];
			$('#modal_justifica').modal('show');
			var miFolio = this.unaJustifica.folio=this.unaJustifica.periodo + moment().format('hmmss');
			this.unaJustifica.matricula=this.alumnos[id].matricula;
			this.unaJustifica.ncompleto = this.alumnos[id].apellidop + ' ' + 
									  this.alumnos[id].apellidom + ' ' + this.alumnos[id].nombre;
		},

		getAlumnos:function(){

			this.$http.get($route + '/apiAlumnos').then
			(function(response){
				console.log(response);
				this.alumnos = response.data;
			});
		},

		guardarJustifica:function(){
			if(this.unaJustifica.id_motivo !='' && 
				this.unaJustifica.fecha_solicitud !='' && 
				this.unaJustifica.modulos !='' && this.fechas.length >=1)
			{


			


			for (var i = this.fechas.length - 1; i >= 0; i--) {
							//alert(this.fechas[i].fecha);
							this.unaJustifica.fechas.push(this.fechas[i].fecha);
							//this.unaJustifica.fechas.$set(i, this.fechas[i].fecha);
			}

			var justificacion = {
				folio:this.unaJustifica.folio,
				periodo:this.unaJustifica.periodo,
				grupo:this.unaJustifica.grupo,
				id_carrera:this.unaJustifica.id_carrera,
				matricula:this.unaJustifica.matricula,
				id_motivo:this.unaJustifica.id_motivo,
				fecha_solicitud:this.unaJustifica.fecha_solicitud,
				periodo:this.unaJustifica.periodo,
				id_tutor:this.unaJustifica.id_tutor,
				modulos:this.unaJustifica.modulos,
				num_dias:this.fechas.length,
				detalles:this.unaJustifica.fechas
			};

			console.log(justificacion);

			this.$http.post($route + '/apiJustificaciones',justificacion).then
			(function(response){
				window.open($route + '/imprimir/' + justificacion.folio,'_blank');
				//window.location.href = $route + '/imprimir/' + justificacion.folio;
				console.log(response);
				$('#modal_justifica').modal('hide');

			});



			this.limpiar();
			this.errorJust=false;
			this.erroresJust=[];
		}
		else
			//alert('FALTAN DATOS');
			{
				this.erroresJust=[];
				if (this.unaJustifica.id_motivo=='')
					this.erroresJust.push({mensaje:'No ha especificado un motivo'});
				
				if (this.unaJustifica.fecha_solicitud=='')
					this.erroresJust.push({mensaje:'No ha definido la fecha de solicitud'});	

				if (this.unaJustifica.modulos=='')
					this.erroresJust.push({mensaje:'No ha definido los modulos'});	

				if (this.unaJustifica.fechas.length <=0)
					this.erroresJust.push({mensaje:'No definido las fechas a justificar'});	



				this.errorJust=true;

			}



		},

		printCardex:function(id){
			//window.location.href = $route + '/alumnos/' + id;
			window.open($route + '/alumnos/' + id,'_blank');
		},

		limpiar:function(){
			
			this.unaJustifica.folio='',
			this.unaJustifica.periodo='',
			this.unaJustifica.grupo='',
			this.unaJustifica.id_carrera='',
			this.unaJustifica.matricula='',
			this.unaJustifica.ncompleto='',
			this.unaJustifica.id_motivo='',
			this.unaJustifica.fecha_solicitud='',
			this.unaJustifica.num_dias='',
			this.unaJustifica.id_tutor='',
			this.unaJustifica.tutor='',
			this.unaJustifica.comentario='',
			this.unaJustifica.fechas=[],
			this.fechas=[],
			this.fechasM=[],
			this.unaJustifica.modulos=''
			
		},

		showLista:function(){
			//window.location.href = $route + '/alumnos/' + id;
			if(this.unaJustifica.periodo && this.unaJustifica.grupo)
			{
				var id= this.unaJustifica.grupo
				window.open($route + '/listaGrupo/' + id,'_blank');

				this.clavegrupo='';
			}
			else
				alert('No ha especificado el grupo');
		},

		


	},

	computed:{
		foliar:function(){
			return moment().format('MMMM Do YYYY, h:mm:ss a');
		},

		ncompleto:function(id){
			return this.alumnos[id].apellidop + ' ' + this.alumnos[id].apellidopm;
		}
	}
})
}
window.onload=init;