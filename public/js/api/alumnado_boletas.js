function init(){

var route = document.querySelector("[name=route]").value;

var urlAlumnos = route + '/apiAlumnado';

new Vue({
	
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
			
		}
	},
	
	el:"#alumnado_boletas",
	
	created:function(){
		this.getAlumnos();
	},

	data:{
		nombre:'Gilberto',
		alumnos:[],
		search:''
		
		
	},

	
  

	methods:{
				
		getAlumnos:function(){
			this.$http.get(urlAlumnos).then
			(function(response){
				this.alumnos=response.data;
				console.log(response.data);
			});

		},

		imprimirBoleta:function(grupo,matricula){
			//alert('imprimiendo boleta' + grupo + matricula);

			//http://localhost/tutoria/boleta/TGA-2C/18311627
			window.open(route + '/boleta/' + grupo + '/' + matricula,'_blank');
		}
	},
	// Fin de metodos

	// Inico de computed

	computed:{
		filtroAlumnos:function(){
			return this.alumnos.filter((alumno)=>{
				return alumno.apellidop.toLowerCase().match(this.search.toLowerCase().trim()) ||
				alumno.apellidom.toLowerCase().match(this.search.toLowerCase().trim()) ||
				alumno.nombre.toLowerCase().match(this.search.toLowerCase().trim()) ||
				alumno.clave_grupo.toLowerCase().match(this.search.toLowerCase().trim())

			});
		},


	},

	totalAlumnos:function(){
			return	this.alumnos.length();
	}

	// Fin de computed

	
})

}
window.onload=init;
