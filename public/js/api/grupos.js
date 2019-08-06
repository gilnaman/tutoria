function init(){

var $route = document.querySelector("[name=route]").value;

var urlGrupos = route + '/apiGrupo';

new Vue({
	
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
			
		}
	},
	
	el:"#apiGrupo",
	
	created:function(){
		this.getGrupos();
	},

	data:{
		nombre:'Gilberto',
		grupos:[],
		
		
	},

	
  

	methods:{
				
		getGrupos:function(){
			this.$http.get($route + '/apiGrupo').then
			(function(response){
				this.grupos=response.data;
				console.log(response.data);
			});
		},

		
	}, 	// Fin de methods

	
})

}
window.onload=init;
