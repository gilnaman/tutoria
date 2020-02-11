var route = document.querySelector("[name=route]").value;
var urlEvento= route + '/apiEvento';
var urlTipoEvento= route + '/apiTipoEvento';
var urlGrupos = route + '/getGrupos'  // Obtiene la lista de grupos del periodo actual
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },


    el:"#eventos",

    created:function(){
    	this.getEventos();
    	this.getTipoEventos();
    	this.getGrupos();
    },

    data:{
    	nombre:'Gil',
    	eventos:[],

    	// DATOS DEL EVENTO
    	id_tipo:'3',
    	fecha_evento:'',
    	titulo:'',
    	expositor:'',
    	id_evento:'',
    	descripcion:'',
    	periodo:'',
    	id_grupo:'',
    	tipos_eventos:[],
    	
    	grupos:[],
    	asignaciones:[],
    	error:false,
    	errores:[],
    	estadisticas:[]


    },

    methods:{
    	getEventos:function(){
    		this.$http.get(urlEvento)
    		.then(function(json){
    			this.eventos= json.data.eventos;
    			this.estadisticas = json.data.estadisticas;
    		})
    	},

    	getTipoEventos:function(){
    		this.$http.get(urlTipoEvento)
    		.then(function(json){
    			this.tipos_eventos=json.data;
    		})
    	},


    	getGrupos:function(){
    		this.$http.get(urlGrupos)
    		.then(function(json){
    			this.grupos=json.data;
    		})
    	},

    	showModal:function(){
    		this.fecha_evento=moment().format('YYYY-MM-DD');

    		this.error=false;
    		this.errores=[];
    		$('#addEvento').modal('show');
    		this.id_evento=this.folio='EV' + "-" + moment().format('YYMMDDhmmss');
    		

    	},


    	addGrupo:function(){
    		this.asignaciones.push({grupo:this.id_grupo})
    		this.id_grupo='';
    	},

    	delGrupo:function(index){
    		this.asignaciones.splice(index,1);
    	},


    	guardarEvento:function(){
    		this.error=false;
    		this.errores=[];
    		

    		if (this.titulo =="") 
    		{
    			this.errores.push({mensaje:'Capture un título'});
    			this.error=true;
    		}
    		if (this.fecha_evento =="") 
    		{	this.errores.push({mensaje:'Capture una fecha de evento'});
    			this.error=true;
    		}
    		if (this.id_tipo =="") 
    			{
    				this.errores.push({mensaje:'Defina un tipo de evento'});
    				this.error=true;
    			}
    		if (this.expositor =="") 
    			{
    				this.errores.push({mensaje:'Capture un expositor'});
    				this.error=true;
    			}
    		if (this.asignaciones.length==0) 
    			{
    				this.errores.push({mensaje:'Especifique al menos un grupo'});
    				this.error=true;

    			}

    		
    		if(this.error==false)
    		{

	    		var evento = {
	    			id_evento:this.id_evento,
	    			fecha_evento:this.fecha_evento,
	    			titulo:this.titulo,
	    			expositor:this.expositor,
	    			descripcion:this.descripcion,
	    			periodo:this.periodo,
	    			id_tipo:this.id_tipo,
	    			grupos:this.asignaciones
	    		}
	    		$('#addEvento').modal('hide');

	    		console.log(evento);

	    		this.$http.post(urlEvento,evento)
	    		.then(function(json){
	    				this.titulo='';
    					this.expositor='';
    					this.id_evento='';
    					this.descripcion='';
    					this.asignaciones=[];
    					toastr.options.closeButton = true;
						toastr.timeOut=200;
						
	    				toastr.success('Estimado','El evento fué agreagado');
	    				this.getEventos();
	    		
	    				
	    				console.log(json);
	    	
	    				
	    		}).catch(function(json){
	    			console.log(json)
	    		});
    		}
    		else
    			// this.errores.push({mensaje:'Capture todos los datos'});
    			this.error=true;
    	}
    }, 

    limpiar:function(){
    	this.id_tipo='3';
    	
    	
    },
    // Fin de metods
    computed:{
    	foliar:function(){
			return moment().format('MMMM Do YYYY, h:mm:ss a');
		},

		total:function(){
			var tot=0;
			for ($i=0;$i<this.estadisticas.length;$i++)
			{
				tot=tot + this.estadisticas[$i].cantidad;
			}
			return tot;
		}
    }
});