var route = document.querySelector("[name=route]").value;
var urlEvento= route + '/getEventosTutor';


new Vue({
	el:'#eventosTutor',
	data:{
		nombre:'HOLA',
		eventos:[]
	},

	created:function(){
		this.getEventos();
	},

	methods:{
		getEventos:function(){
			this.$http.get(urlEvento)
			.then(function(json){
				this.eventos=json.data;
			});
		}
	}
});