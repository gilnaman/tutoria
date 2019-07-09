function init(){

//moment.locale('es'); // Se especifica que las fechas de moment son en español

var $route = document.querySelector("[name=route]").value;


new Vue({
	
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
			
		}
	},
	
	el:"#entregasCoordi",
	

	created:function(){
		this.getEntregas();
	},

	data:{
		entregas:[],
		search:''
		
		
	},

	
  

	methods:{
		getEntregas:function(){
			this.$http.get($route + '/apiEntregas').then
			(function(response){
				this.entregas=response.data;
			});
		},

		// getGrupos(event){
		// 	//console.log(event.target.value)
		// 	var grup= event.target.value
		// 	//alert(grup);
		// 	this.$http.get($route + '/apiGrupo/' + grup).then
		// 	(function(response){
		// 		this.grupos = response.data

		// 	})
		// },

		// showLista:function(){
		// 	//window.location.href = $route + '/alumnos/' + id;
		// 	if(this.id_carrera && this.clavegrupo)
		// 	{
		// 		var id= this.clavegrupo
		// 		this.$session.set('grupo',this.clavegrupo);
		// 		window.open($route + '/listaGrupo/' + id,'_blank');

		// 		this.clavegrupo='';
		// 	}
		// 	else
		// 		alert('No ha especificado el grupo');
		// },
		
		
	},

	computed:{
		filtroEntregas:function(){
			return this.entregas.filter((entrega)=>{
				return entrega.docente.toLowerCase().match(this.search.toLowerCase().trim()) ||
				entrega.asignatura.toLowerCase().match(this.search.toLowerCase().trim()) ||
				entrega.claveGrupo.toLowerCase().match(this.search.toLowerCase().trim())

			});
		},


		getStatus(){

	        return (id) => {
	        	var dif=0;
	        	var resp='';

	        		subida = this.entregas[id].fecha_subida;
					planeada= this.entregas[id].fecha_planeada
					
						// resp=dateA.diff(dateB);
						if (subida>planeada)
							resp='Retraso';
						else if(subida<=planeada)
							resp='A tiempo';
						
						return resp;

     
			}


	}
}
// Fin de computeed


	
})

}
window.onload=init;
