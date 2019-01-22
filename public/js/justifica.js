function init(){

moment.locale('es'); // Se especifica que las fechas de moment son en español

var $route = document.querySelector("[name=route]").value;

var url='http://localhost/tutoria/apiJustificaciones'; //referencia a la api
var urlAlumnos = "http://localhost/tutoria/apiAlumnos";

new Vue({
	
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value'),
			'Content-Type':'aplication/pdf'
		}
	},
	props: ['currentUser'],
	el:"#justificacion",
	

	created:function(){
		//this.getAlumnos();
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
			id_motivo:'',
			fecha_solicitud:moment().,
			num_dias:'',
			id_tutor:'',
			comentario:'',
			fechas:[],
			modulos:''
			}
	},

	
  

	methods:{

		addFecha:function()
		{
			
			var mifecha=this.unaFecha;
			var mifecha2 = moment(mifecha).format('DD/MMM/YYYY');
			if(mifecha){
				this.fechas.push({fecha:mifecha});
				this.fechasM.push({fecha:mifecha2})
				this.unaJustifica.fechas=this.fechas;
			}
		},

		delFecha:function(indice){

			this.fechas.splice(indice,1);
			this.fechasM.splice(indice,1);
			//alert(indice);
		},

		showModal:function(id){
			
			var a = this.unaJustifica.folio='2018C' + moment().format('hmmss');
			this.unaJustifica.folio=a;

			//alert(a);
			$('#add_just').modal('show');
		},

		getAlumnos:function(){

			this.$http.get($route + '/apiAlumnos').then
			(function(response){
				console.log(response);
				this.alumnos = response.data;
			});


		}


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