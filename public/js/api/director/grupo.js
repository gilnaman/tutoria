var route = document.querySelector("[name=route]").value;
var urlCarreras = route + '/apiCarrera';
var urlGrupo = route + '/listaGrupos';
new Vue({
	el:'#grupos',
	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

    created:function(){
        this.getCarreras();
    },

    data:{
    	carreras:[],
        grupos:[],
        letras:['A','B','C','D','E','F']
    },

    methods:{
        getCarreras:function(){
            this.$http.get(urlCarreras).then(function(response){
                this.carreras=response.data;
                console.log(response)
            }).catch(function(response){
                console.log(response);
            })

        },

        getGrupos(event){
            //console.log(event.target.value)
            var carrera= event.target.value
            var param={periodo:'2019B',idcarrera:carrera}
            //alert(grup);
            this.$http.post(urlGrupo,param).then
            (function(response){
                this.grupos = response.data
                console.log(response)
            })
        },

        showModal:function(){
            $('#addGrupo').modal('show');
            
        }
    }     // Fin de methds

});

	