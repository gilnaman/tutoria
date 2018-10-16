
function init()
{

var urlUser='http://localhost/blog2/public/apiAutos';

new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el: '#autosVue',
	created:function()
	{
		this.getAutos();
	},
	data:{
		autos:[],
		
		newAuto: {
			placa:'',
			modelo:'',
			anio_fabricacion:'',
			costo:'',
			imagen:'',
			id_fabricante:''

		},
		success: false,
		edit:false,
	},

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

	
});

}
window.onload = init;

