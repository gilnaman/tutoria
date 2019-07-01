function init(){

//moment.locale('es'); // Se especifica que las fechas de moment son en español

var $route = document.querySelector("[name=route]").value;


new Vue({
	
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
			
		}
	},
	
	el:"#listasCoordi",
	

	created:function(){
		this.getCarreras();
	},

	data:{
		carreras:[],
		grupos:[],
		id_carrera:'',
		clavegrupo:''
		
		
	},

	
  

	methods:{
		getCarreras:function(){
			this.$http.get($route + '/apiCarrera').then
			(function(response){
				this.carreras=response.data;
			});
		},

		getGrupos(event){
			//console.log(event.target.value)
			var grup= event.target.value
			//alert(grup);
			this.$http.get($route + '/apiGrupo/' + grup).then
			(function(response){
				this.grupos = response.data
			})
		},

		showLista:function(){
			//window.location.href = $route + '/alumnos/' + id;
			if(this.id_carrera && this.clavegrupo)
			{
				var id= this.clavegrupo
				window.open($route + '/listaGrupo/' + id,'_blank');

				this.clavegrupo='';
			}
			else
				alert('No ha especificado el grupo');
		},
		
		
	},

	
})

}
window.onload=init;
