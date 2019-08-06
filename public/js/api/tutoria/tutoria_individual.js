var search='HOLA MUNDO';
var alumnado=[{nombre:'gil',edad:37}];
var route = document.querySelector("[name=route]").value;
// var urlRepro= route + '/vrepro';
// var urlReproIndividual = route + '/reproPorAlumno/'
var urlAlumnos = route + '/apiAlumnos';

Vue.component('busqueda',{
	template: `<div class="row">
			    	<div class="col-md-8">
			    		<label class="label-control">Buscar</label>
						<input type="text"  placeholder="Escriba apellido paterno o materno" class="form-control"
						v-model="search">
					</div>
					
					{{alumnos}}
				</div>`,

	mounted:function(){
		this.getAlumnos();
	},

	data: function () {
	    return {
	      alumnos:[]
	    }
  	},



	methods:{
		getAlumnos:function(){

			this.$http.get(route + '/apiAlumnado').then
			(function(response){
				console.log(response);
				this.alumnos = response.data;
			});
		},
	}
});

new Vue({ 
	el: '#tutoria_individual',

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    }, 

data: function(){
	nombre:'GILBERTO BALAM'
}


});

Vue.config.devtools = true;
// Vue.component('button-counter', {
//   data: function () {
//     return {
//       count: 0
//     }
//   },
//   template: '<button v-on:click="count++">You clicked me {{ count }} times.</button>'
// });


// new Vue({ el: '#components-demo' });
