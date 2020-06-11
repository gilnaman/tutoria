
function init(){
var route = document.querySelector("[name=route]").value;


// var urlRoles =  'http://localhost/tutoria/public/getRoles';
var urlRoles =  route + '/getRoles';

new Vue({
	el: '#panel',
	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },


	mounted:function(){

	},

	data:{
		roles:[],
		nombre:'GIL',
		cedula:'',
		docente:'',
		periodo:'',
	},

	mounted:function(){
		this.getRoles();
	},


	methods:{

		getRoles:function(){
			var datos = {id:this.cedula};
			

			this.$http.post(urlRoles,datos).then(function(json){
				console.log(json);
				this.roles=json.data;
			});



		}
	}
});
}
window.onload = init;