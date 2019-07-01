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
		
		
	},

	
  

	methods:{
		getCarreras:function(){
			this.$http.get($route + '/apiCarreras').then
			(function(response){
				this.carreras=response.data;
			});
		},

		
		
	},

	
})

}
window.onload=init;
