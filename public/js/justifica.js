new Vue({
	el:"#justificacion",
	data:{
		fechas:[],
		unaFecha:''
	},

	methods:{

		addFecha:function()
		{
			
			var mifecha=this.unaFecha;

			if(mifecha){
				this.fechas.push({fecha:mifecha});
			}
		},

		delFecha:function(indice){
			this.fechas.splice(indice,1);
			//alert(indice);
		}


	}
})