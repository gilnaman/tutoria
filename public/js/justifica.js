function init(){

moment.locale('es'); // Se especifica que las fechas de moment son en español

var url='http://localhost/tutoria/apiJustificaciones'; //referencia a la api
new Vue({
	
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
		}
	},
	props: ['currentUser'],
	el:"#justificacion",
	data:{
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
			fecha_solicitud:'',
			num_dias:'',
			id_tutor:'',
			comentario:''
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
			}
		},

		delFecha:function(indice){

			this.fechas.splice(indice,1);
			this.fechasM.splice(indice,1);
			//alert(indice);
		},

		showModal:function(){
			var a = this.unaJustifica.folio='2018C' + moment().format('hmmss');
			//alert(a);
			$('#add_just').modal('show');
		}


	},

	computed:{
		foliar:function(){
			return moment().format('MMMM Do YYYY, h:mm:ss a');
		}
	}
})
}
window.onload=init;