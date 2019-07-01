var $route = document.querySelector("[name=route]").value;

//var urlUser='http://localhost/tutoria/apiAvance';
new Vue({
	el:'#resumen',
	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

    created:function()
	{
		this.getDatos();
		//this.showDetalles(1);
	},

    data:{
    	nombre:'BALAM',
    	datos:[],
        etiquetas:["January","February","March","April","May","June","July"],
        dat:['Asignaturas','U1','U2','U3','U4','U5','U6'],
        becados:[],
        materias:['BD','INGLES','FOSO'],
        villas:[]
    },

    methods:{
    	getDatos:function(){
    		this.$http.get($route + '/becados').then
			(function(response)
			{
				console.log(response);
				this.datos = response.data;
			});
    	},

        

        showBecados:function(){
            console.log($route);
            this.$http.get($route + '/listaBecados').then
            (function(response){
                console.log(response);
                this.becados = response.data;
                $('#detalles').modal('show');

            });
            
        },

          showVillas:function(){
            console.log($route);
            this.$http.get($route + '/listaVillas').then
            (function(response){
                console.log(response);
                this.villas = response.data;
                $('#detalles_villas').modal('show');

            });
            
        }
    }

});

	