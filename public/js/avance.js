
function init()
{

var $route = document.querySelector("[name=route]").value;
//var urlUser='http://localhost/tutoria/apiAvance';

new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el: '#avance',
	created:function()
	{
		this.getAsignaturas();
		//this.showDetalles(1);
	},
	data:{
		asignaturas:[],
		detalles:[],
		nombre:'Gilberto',
		asigSelected:'',
		profeSelected:'',
		puntajeAcum:0,
		success: false,
		edit:false,
		class:''
	},

	methods:{
		getAsignaturas:function()
		{

			this.$http.get($route + '/apiAvance').then
			(	function(response){
				console.log(response);
				this.asignaturas=response.data;
			});

		},		

		showDetalles: function(indice)
		{	
			//this.edit = true
			var asig = this.asignaturas[indice].clave;
			//alert(asig);
			this.asigSelected = this.asignaturas[indice].asignatura;
			this.profeSelected = this.asignaturas[indice].tratamiento + ' ' + this.asignaturas[indice].docente;
			this.puntajeAcum = this.asignaturas[indice].avance;
			this.$http.get($route +'/apiAvance/' + asig).then
			(function (response){
				console.log(response);
				if(response.data.length)
					this.detalles=response.data;
				else
					alert('No data');

			});
		},
	}
	/*
	methods:{
		
		getAutos: function () {
			this.$http.get(urlUser).then
			(function(response)
			{
				console.log(response);
				this.autos = response.data;
			});
		},

		addAuto:function()
		{
			// User input
			var auto = this.newAuto

			// Clear form input
			this.newAuto = { placa:'', modelo:'', anio_fabricacion:'',costo:'',imagen:'' }

			// Send post request
			this.$http.post(urlUser, auto).then
			(function(data){
				this.getAutos()	
			})

			

			// Reload page
			
		},

		delAuto:function(id)
		{
			var ConfirmBox = confirm("Esta seguro de eliminar el auto?")

			if(ConfirmBox) 
			{
				this.$http.delete(urlUser + '/' + id).then
				(function(data)
				{
					this.getAutos();
				});

				

				this.getAutos();
			}

		},

		showAuto: function(id)
		{	
			this.edit = true
			this.$http.get(urlUser +'/' + id + '/edit').then
			(function (response){
			
			
			this.newAuto.placa=  response.data.placa
			this.newAuto.modelo=response.data.modelo
			this.newAuto.anio_fabricacion= response.data.anio_fabricacion
			this.newAuto.costo=response.data.costo
			this.newAuto.imagen=response.data.foto
			});
		},

		upAuto: function(id)
		{
			var auto = this.newAuto

			this.newAuto = { placa: '', modelo: '', anio_fabricacion: '', costo: '',imagen:''}

			this.$http.patch(urlUser + '/'+ id,auto).then 
			(function (response) {
				this.getAutos()
			}).then(function(response){
				console.log(response)
			});

			this.getAutos()

			this.edit = false
						
		}



		
		
	}, //Fin de metodos
	*/
	
});

}
window.onload = init;

