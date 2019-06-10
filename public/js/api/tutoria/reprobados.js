
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

	el: '#reprobados',
	created:function()
	{
		this.getReprobadas();
	},
	data:{
		nombre:'GILBERTO',
		reprobados:[],
		reprobadosIndividual:[],
		matriculaSel:'',
		alumnoSel:''
	},

	methods:{
		getReprobadas:function(){
			this.$http.get(urlRepro).then(function(response){
				this.reprobados=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		getReproIndividual:function(matricula){
			this.$http.get(urlReproIndividual + matricula).then(function(response){
				this.reprobadosIndividual=response.data;
			}).catch(function(response){
				console.log(response);
			})
		},

		showReproIndividual:function(matricula,index){
			this.matriculaSel = this.reprobados[index].matricula;
			this.alumnoSel=this.reprobados[index].alumno;
			this.getReproIndividual(matricula);
			$("#info_repro").modal('show');
		}
	},
	// Fin de metodos

	computed:{

		totalPorAlumno(){
	        return (id) => {
	        	var sum=0;
		    	if (this.reprobados!=null)
	        	{
	            	sum = this.reprobados[id].u1 + this.reprobados[id].u2 + this.reprobados[id].u3 + 
	        		this.reprobados[id].u4 + this.reprobados[id].u5 + this.reprobados[id].u6;
	        	}
	        	return sum;
	        }
    	},

    	totalPorUnidad:function(){
    		var u1=0;
    		var u2=0;
    		var u3=0;
    		var u4=0;
    		var u5=0;
    		var u6=0;

    		

    		for (var i = 0; i < this.reprobados.length; i++) {
    			u1= u1+ this.reprobados[i].u1;
    			u2= u2+ this.reprobados[i].u2;
    			u3= u3+ this.reprobados[i].u3;
    			u4= u4+ this.reprobados[i].u4;
    			u5= u5+ this.reprobados[i].u5;
    			u6= u6+ this.reprobados[i].u6;
    		}

    		var totales={tu1:u1,tu2:u2,tu3:u3,tu4:u4,tu5:u5,tu6:u6};

    		return totales;

    	}



	}

	
	
});

}
window.onload = init;

