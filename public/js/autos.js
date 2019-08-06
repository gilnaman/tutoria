new Vue({
	el:'#autos',
	
	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	data:{
		nombre:'HOLA MUNDO',
		autos:[],
		placa:'',
		modelo:'',
		precio:0,
		editando:false,
	},

	created:function(){
		this.getAutos()
	},

	methods:{
		getAutos:function(){
			this.$http.get('http://localhost/tutoria/apiAuto')
			.then(function(json){
				this.autos=json.data
			});
		},

		showAuto:function(id){
			this.$http.get('http://localhost/tutoria/apiAuto/' + id)
			.then(function(json){
				this.placa=json.data.placa;
				this.modelo=json.data.modelo;
				this.precio=json.data.precio;
				this.editando=true;
			})
		},

		eliminarAuto:function(id){
			var resp=confirm("Esta seguro de eliminar el auto?");

			if(resp==true)
			{
				this.$http.delete('http://localhost/tutoria/apiAuto/' + id)
				.then(function(json){
					this.getAutos();
				});
			}
		},

		updateAuto:function(id){
			//Crear un json
			var auto={placa:this.placa,
					  modelo:this.modelo,
					  precio:this.precio}

			this.$http.patch('http://localhost/tutoria/apiAuto' + '/'+ id,auto)
			.then(function(json){
				this.getAutos();
				this.limpiar();
			})
		},

		limpiar:function(){
			this.placa='';
			this.modelo='';
			this.precio='';
			this.editando=false;
		}


	}
});