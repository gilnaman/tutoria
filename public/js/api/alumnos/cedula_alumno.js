var route = document.querySelector("[name=route]").value;

var getCedula =  route + '/getAlumnoToCedula';
var urlSangre = route  + '/apiSangre'
var urlMunicipio = route  + '/apiMunicipio'
var urlBeca = route + '/apiBeca';
var urlVilla = route + '/apiVilla';
var urlCarrera = route + '/apiCarrera';
var urlPeriodo = route + '/apiPeriodo';
var urlProfesor = route + '/apiProfesor';
var urlEscuela = route + '/apiEscuela';
var urlAlumnos = route + '/apiCedula';

new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#cedula",

data :{
	nombre:'GILBERTO BALAM',
	sangres:[],
	municipios:[],
	becas:[],
	villas:[],
	periodos:[],
	tutores:[],
	escuelas:[],
	alumno:[],
	carreras:[],
	
	tiene_beca:'No',
	tiene_villa:'No',
	trabaja:'',
	
	anio:'2019',
	matricula:'',
	nombre:'',
	apellidop:'',
	apellidom:'',
	l_procedencia:'',
	celular:'',
	email:'',
	calle:'',
	cruzamiento:'',
	curp:'',
	tel_casa:'',
	lugar_nac:'',
	edad:'',
	padre:'',
	madre:'',
	dl_empresa:'',
	dl_direccion:'',
	dl_depto:'',
	dl_telefono:'',
	dl_jefe:'',
	dl_horario:'',
	dl_puesto:'',
	nss:'',
	tel_contacto:'',
	localidad:'',
	pade_fisico:'',
	enfermedad:'',
	alergia:'',
	plantel_procedencia:'',
	foto:'',
	id_villa:'ini',
	id_tipo_sangre:'ini',
	id_escuela:'',
	idcarrera:'',
	id_municipio:'ini',
	id_beca:'ini',
	claveperiodo:'',
	cedula:'',
	gradoactual:'',
	grupoactual:'',
	fecha_nac:'',
	contacto:'',
	url:'',
	file:'' // Foto nueva








	

},

created:function(){
	this.getSangre();
	this.getMunicipios();
	this.getBecas();
	this.getVillas();
	this.getPeriodo();
	this.getTutores();
	this.getEscuelas();
	this.getCarreras();
	
},
mounted:function(){
	this.getAlumno();
},

methods:{
	getSangre:function(){
		this.$http.get(urlSangre).then(function(response){
			this.sangres=response.data;
		}).catch(function(response){
			console.log(response);
		});
	},

	getCarreras:function(){
		this.$http.get(urlCarrera).then(function(response){
			this.carreras=response.data;
			console.log(response);
		}).catch(function(response){
			console.log(response);
		});	
	},

	getMunicipios:function(){
		this.$http.get(urlMunicipio).then(function(response){
			this.municipios=response.data;
		}).catch(function(response){
			console.log(response);
		})
	},

	getBecas:function(){
		this.$http.get(urlBeca).then(function(response){
			this.becas=response.data;
		}).catch(function(response){
			console.log(response);
		})
	},

	getVillas:function(){
		this.$http.get(urlVilla).then(function(response){
			this.villas=response.data;
		})
	},

	getPeriodo:function(){
		this.$http.get(urlPeriodo).then(function(response){
			this.periodos=response.data;
		}).catch(function(response){
			console.log(response);
		})
	},

	getTutores:function(){
		this.$http.get(urlProfesor).then(function(response){
			this.tutores=response.data;
			console.log(response);
		}).catch(function(response){
			console.log(response);
		})
	},

	getEscuelas:function(){
		this.$http.get(urlEscuela).then(function(response){
			this.escuelas=response.data;
		}).catch(function(response){
			console.log(response);
		})
	},

	getAlumno:function(){
		this.$http.get(urlAlumnos + '/' +this.matricula).then(function(response){
			console.log(response);
			this.alumno=response.data;
			
			this.claveperiodo=response.data.claveperiodo;
			this.cedula=response.data.cedula;
			this.gradoactual=response.data.gradoactual;
			this.grupoactual=response.data.grupoactual;
			this.id_escuela=response.data.id_escuela;
			this.plantel_procedencia=response.data.plantel_procedencia;
			this.curp=response.data.curp;
			this.nombre=response.data.nombre;
			this.apellidop=response.data.apellidop;
			this.apellidom=response.data.apellidom;
			this.calle=response.data.calle;
			this.cruzamiento=response.data.cruzamiento;
			this.id_municipio=response.data.id_municipio;
			this.localidad=response.data.localidad;
			this.tel_casa=response.data.tel_casa;
			this.celular=response.data.celular;
			this.email=response.data.email;
			this.lugar_nac=response.data.lugar_nac;
			this.fecha_nac=response.data.fecha_nac;
			this.edad=response.data.edad;
			this.tiene_beca=response.data.tiene_beca;
			this.id_beca=response.data.id_beca;
			this.tiene_villa=response.data.tiene_villa;
			this.id_villa=response.data.id_villa;
			this.padre=response.data.padre;
			this.madre=response.data.madre;
			this.tel_contacto=response.data.tel_contacto;
			this.contacto=response.data.contacto;
			this.id_tipo_sangre=response.data.id_tipo_sangre;
			this.nss=response.data.nss;
			this.pade_fisico=response.data.pade_fisico;
			this.enfermedad=response.data.enfermedad;
			this.alergia=response.data.alergia;
			this.trabaja=response.data.trabaja;
			this.dl_empresa=response.data.dl_empresa;
			this.dl_direccion=response.data.dl_direccion;
			this.dl_depto=response.data.dl_depto;
			this.dl_telefono=response.data.dl_telefono;
			this.dl_jefe=response.data.dl_jefe;
			this.dl_horario=response.data.dl_horario;

			this.dl_puesto=response.data.dl_puesto;
			this.idcarrera=response.data.idcarrera;
			this.foto=response.data.foto;
		})


	},

	onFileChange(e) {
      this.file = e.target.files[0];
      this.url = URL.createObjectURL(this.file);
      //this.foto= e.tarjet.files[0];
    },

    actualizarCedula:function(){


    	let data = new FormData();
			    
    			// inicio
    		data.append('matricula',this.matricula);
   	    	data.append('claveperiodo',this.claveperiodo);
		 	data.append('cedula',this.cedula);
			data.append('gradoactual',this.gradoactual);
			data.append('grupoactual',this.grupoactual);
			data.append('id_escuela',this.id_escuela);
			data.append('plantel_procedencia',this.plantel_procedencia);
			data.append('curp',this.curp);
			data.append('nombre',this.nombre);
			data.append('apellidop',this.apellidop);
			data.append('apellidom',this.apellidom);
			data.append('calle',this.calle);
			data.append('cruzamiento',this.cruzamiento);
			data.append('id_municipio',this.id_municipio);
			data.append('localidad',this.localidad);
			data.append('tel_casa',this.tel_casa);
			data.append('celular',this.celular);
			data.append('email',this.email);
			data.append('lugar_nac',this.lugar_nac);
			data.append('fecha_nac',this.fecha_nac);
			data.append('edad',this.edad);
			
			data.append('tiene_beca',this.tiene_beca);
			
			if(this.tiene_beca=='Si')
				data.append('id_beca',this.id_beca);
			else
				data.append('id_beca','');

			data.append('tiene_villa',this.tiene_villa);
			
			if(this.tiene_villa=='Si')
				data.append('id_villa',this.id_villa);
			else
				data.append('id_villa','');


			data.append('padre',this.padre);
			data.append('madre',this.madre);
			data.append('tel_contacto',this.tel_contacto);
			data.append('contacto',this.contacto);
			data.append('id_tipo_sangre',this.id_tipo_sangre);
			data.append('nss',this.nss);
			data.append('pade_fisico',this.pade_fisico);
			data.append('enfermedad',this.enfermedad);
			data.append('alergia',this.alergia);
			data.append('trabaja',this.trabaja);
			data.append('anio',this.anio);
			data.append('idcarrera','');

			if (this.trabaja=='Si')
			{
				data.append('dl_empresa',this.dl_empresa);
				data.append('dl_direccion',this.dl_direccion);
				data.append('dl_depto',this.dl_depto);
				data.append('dl_telefono',this.dl_telefono);
				data.append('dl_jefe',this.dl_jefe);
				data.append('dl_horario',this.dl_horario);

				data.append('dl_puesto',this.dl_puesto);
				data.append('idcarrera',this.idcarrera);
			}
			else
			{
				this.dl_empresa='';
				this.dl_direccion='';
				this.dl_depto='';
				this.dl_telefono='';
				this.dl_jefe='';
				this.dl_horario='';
				this.dl_puesto='';

				data.append('dl_empresa','');
				data.append('dl_direccion','');
				data.append('dl_depto','');
				data.append('dl_telefono','');
				data.append('dl_jefe','');
				data.append('dl_horario','');

				data.append('dl_puesto','');
				

			}
		


    			// Fin
			if (this.file)
				data.append('foto', this.file); 
			else
				data.append('foto', this.foto); 
			
			    let config = {
			      header : {
			        'Content-Type' : 'image/jpg'
			      }
			    }

			

			this.$http.post(urlAlumnos, data,config).then
				(function(data){
					alert('Tus datos fueron actualizados, GRACIAS');
				});
    }
  
}
});