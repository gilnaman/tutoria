
function init()
{

var route = document.querySelector("[name=route]").value;
var urlRepro= route + '/vrepro';
var urlReproIndividual = route + '/reproPorAlumno/'

new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el: '#paselista',

	

	created:function()
	{
		
	},
	data:{
		nombre:'GILBERTO',
		alumnos:[
				{matricula:'1720001',nombre:'Juan Perez Sosa Mendez'},
				{matricula:'1720002',nombre:'José López Pérez'},
				{matricula:'1720003',nombre:'María José Can Tun'}
				],
		valores:['I','I','I','I','I','I','I','I']
		
	},

	methods:{
		
		cambiarValor(index){
				
			var valor = this.valores[index];
			// alert(valor);
			
			

			var nuevoValor='';
			switch (valor){
				case 'I': 
						nuevoValor='A';
						break;
				case 'A': 
						nuevoValor='R';
						break;
				case 'R': 
					nuevoValor='I';
					break;

			}
			this.valores[index]=nuevoValor;

			
			console.log(this.valores);

			
			
			
			},

			getValue(e){
				 var valor = e.target.value;
				// var valor = e.textContent || e.innerText;
				// alert(valor);

				if(valor=='A')
					e.target.value='R';

				if(valor=='R')
					e.target.value='I';

				if(valor=='I')
					e.target.value='A';
			}
	
		

		
		
	},
	// Fin de metodos

	computed:{



    	}



	

	
	
});

}
window.onload = init;

