
function init(){
var $route = document.querySelector("[name=route]").value;	
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:'#evaldoc',

	created:function()
	{
		this.getDatos();
		//this.showDetalles(1);
        
	},
    updated:function(){
        this.getStatus();
    },

	data:{
		datos:[],
		
		opciones:[
		{clave:1,nombre:'NUNCA'},
		{clave:2,nombre:'CON POCA FRECUENCIA'},
		{clave:3,nombre:'OCASIONALMENTE'},
		{clave:4,nombre:'FRECUENTEMENTE'},
		{clave:5,nombre:'SIEMPRE'}
		],
		resp:[],
		resp1:[],
		resp2:[],
		resp3:[],
		resp4:[],
		resp5:[],
		resp6:[],
		resp7:[],
		resp8:[],
		resp9:[],
		resp10:[],
		resp11:[],
		resp12:[],
		resp13:[],
		resp14:[],
		resp15:[],
		resp16:[],
		resp17:[],
		resp18:[],
		resp19:[],
		resp20:[],
		resp21:[],
		comentarios:[],

		picked:'',
		selected:1,
		disp:1,
		pagAct:0,
		errores:[],

		error1:false,
		error2:false,
		error3:false,
		error4:false,
		error5:false,
		error6:false,
		error7:false,
		error8:false,
		error9:false,
		error10:false,
		error11:false,
		error12:false,
		error13:false,
		error14:false,
		error15:false,
		error16:false,
		error17:false,
		error18:false,
		error19:false,
		error20:false,
		error21:false,

		error:false,
		ok:false,
		matricula:'',
		periodo:'',
		grupo:'',
		presento:0

	},

	methods:{
		getDatos:function(){
			this.$http.get($route + '/apiEval').then
			(	function(response){
				console.log(response);
				this.datos=response.data;
			});
		},

        getStatus:function(){
            var mat = this.matricula;
            console.log(mat);
            this.$http.get($route + '/apiEval/' + mat).then
            (function(response){
                this.presento=response.data;
                //console.log('Resultado es: ' + response.data);
                console.log(response.data);
            });
        },

		prueba:function(indice){
			alert(resp[indice]);
		},

		hideAlert:function(){
			$('#alert').alert('hide');
		},

		
        enviar:function(){
        	//alert('Hola');
        	

        	 var allSelect = document.querySelector(".preg1").querySelectorAll("select");
        	 var cont=1;
        	 
        	  allSelect.forEach(function(item) {
				alert(item.value);
				alert(this.datos[0]);
  				});
  				

        },

        enviarRespuestas:function(){
        if(this.presento==0)
        {
        	this.errores=[];
        	var cedulas=[];
        	var asignaturas=[];
        	
        	var cont=0;
        	
        if (this.resp1.length==this.datos.length){
        	for (var i =0;  i < this.resp1.length; i++) {
        		if (this.resp1[i]==null){
        			cont++;
        		}

        	}

        	

        	if (cont !=0){
        		this.error1=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 1 incompletas'});
        	}
        	else
        	{
        		this.error1=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error1=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 1'})
        }

        // Validacion pregunta 2
        cont=0;
        if (this.resp2.length==this.datos.length){
        	for (var i =0;  i < this.resp2.length; i++) {
        		if (this.resp2[i]==null){
        			cont++;
        		}

        	}

        	

        	if (cont !=0){
        		this.error2=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 2 incompletas'});
        	}
        	else
        	{
        		this.error2=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error2=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 2'})
        }

        // VALIDACION PREGUNTA 3
        cont=0;
        if (this.resp3.length==this.datos.length){
        	for (var i =0;  i < this.resp3.length; i++) {
        		if (this.resp3[i]==null){
        			cont++;
        		}

        	}

        	

        	if (cont !=0){
        		this.error3=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 3 incompletas'});
        	}
        	else
        	{
        		this.error3=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error3=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 3'})
        }

        // VALIDACION PREGUNTA 4
         cont=0;
        if (this.resp4.length==this.datos.length){
        	for (var i =0;  i < this.resp4.length; i++) {
        		if (this.resp4[i]==null){
        			cont++;
        		}

        	}

        	

        	if (cont !=0){
        		this.error4=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 4 incompletas'});
        	}
        	else
        	{
        		this.error4=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error4=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 4'})
        }

        // VALIDACION PREGUNTA 5
         cont=0;
        if (this.resp5.length==this.datos.length){
        	for (var i =0;  i < this.resp5.length; i++) {
        		if (this.resp5[i]==null){
        			cont++;
        		}

        	}

        	if (cont !=0){
        		this.error5=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 5 incompletas'});
        	}
        	else
        	{
        		this.error5=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error5=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 5'})
        }

        // VALIDACION PREGUNTA 6
         cont=0;
        if (this.resp6.length==this.datos.length){
        	for (var i =0;  i < this.resp6.length; i++) {
        		if (this.resp6[i]==null){
        			cont++;
        		}

        	}
        	if (cont !=0){
        		this.error6=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 6 incompletas'});
        	}
        	else
        	{
        		this.error6=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error6=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 6'})
        }

        // VALIDACION PREGUNTA 7
         cont=0;
        if (this.resp7.length==this.datos.length){
        	for (var i =0;  i < this.resp7.length; i++) {
        		if (this.resp7[i]==null){
        			cont++;
        		}

        	}

        	

        	if (cont !=0){
        		this.error7=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 7 incompletas'});
        	}
        	else
        	{
        		this.error7=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error7=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 7'})
        }

        //VALIDACION PREGUNTA 8
         cont=0;
        if (this.resp8.length==this.datos.length){
        	for (var i =0;  i < this.resp8.length; i++) {
        		if (this.resp8[i]==null){
        			cont++;
        		}

        	}

        	

        	if (cont !=0){
        		this.error8=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 8 incompletas'});
        	}
        	else
        	{
        		this.error8=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error8=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 8'})
        }

        // VALIDACION PREGUNTA 9

         cont=0;
        if (this.resp9.length==this.datos.length){
        	for (var i =0;  i < this.resp9.length; i++) {
        		if (this.resp9[i]==null){
        			cont++;
        		}

        	}

        	if (cont !=0){
        		this.error9=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 9 incompletas'});
        	}
        	else
        	{
        		this.error9=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error9=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 9'})
        }

        // VALIDACION 10
         cont=0;
        if (this.resp10.length==this.datos.length){
        	for (var i =0;  i < this.resp10.length; i++) {
        		if (this.resp10[i]==null){
        			cont++;
        		}

        	}
        	if (cont !=0){
        		this.error10=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 10 incompletas'});
        	}
        	else
        	{
        		this.error10=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error10=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 10'})
        }

        // VALIDACION 11
         cont=0;
        if (this.resp11.length==this.datos.length){
        	for (var i =0;  i < this.resp11.length; i++) {
        		if (this.resp11[i]==null){
        			cont++;
        		}

        	}
        	if (cont !=0){
        		this.error11=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 11 incompletas'});
        	}
        	else
        	{
        		this.error11=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error11=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 11'})
        }

        // VALIDACION 12
         cont=0;
        if (this.resp12.length==this.datos.length){
        	for (var i =0;  i < this.resp12.length; i++) {
        		if (this.resp12[i]==null){
        			cont++;
        		}

        	}

          	if (cont !=0){
        		this.error12=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 12 incompletas'});
        	}
        	else
        	{
        		this.error12=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error12=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 12'})
        }

        //VALIDACION 13

         cont=0;
        if (this.resp13.length==this.datos.length){
        	for (var i =0;  i < this.resp13.length; i++) {
        		if (this.resp13[i]==null){
        			cont++;
        		}

        	}
        	if (cont !=0){
        		this.error13=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 13 incompletas'});
        	}
        	else
        	{
        		this.error13=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error13=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 13'})
        }

        // VALIDACION 14
         cont=0;
        if (this.resp14.length==this.datos.length){
        	for (var i =0;  i < this.resp14.length; i++) {
        		if (this.resp14[i]==null){
        			cont++;
        		}

        	}
		   	if (cont !=0){
        		this.error14=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 14 incompletas'});
        	}
        	else
        	{
        		this.error14=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error14=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 14'})
        }

        //VALIDACION 15
         cont=0;
        if (this.resp15.length==this.datos.length){
        	for (var i =0;  i < this.resp15.length; i++) {
        		if (this.resp15[i]==null){
        			cont++;
        		}

        	}
        	if (cont !=0){
        		this.error15=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 15 incompletas'});
        	}
        	else
        	{
        		this.error15=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error15=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 15'})
        }

        // VALIDACION 16
         cont=0;
        if (this.resp16.length==this.datos.length){
        	for (var i =0;  i < this.resp16.length; i++) {
        		if (this.resp16[i]==null){
        			cont++;
        		}

        	}
        	if (cont !=0){
        		this.error16=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 16 incompletas'});
        	}
        	else
        	{
        		this.error16=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error16=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 16'})
        }

        //VALIDACION 17
         cont=0;
        if (this.resp17.length==this.datos.length){
        	for (var i =0;  i < this.resp17.length; i++) {
        		if (this.resp17[i]==null){
        			cont++;
        		}

        	}

        	

        	if (cont !=0){
        		this.error17=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 17 incompletas'});
        	}
        	else
        	{
        		this.error17=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error17=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 17'})
        }

        //VALIDACION 18
         cont=0;
        if (this.resp18.length==this.datos.length){
        	for (var i =0;  i < this.resp18.length; i++) {
        		if (this.resp18[i]==null){
        			cont++;
        		}

        	}
        	if (cont !=0){
        		this.error18=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 18 incompletas'});
        	}
        	else
        	{
        		this.error18=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error18=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 18'})
        }

        //VALIDACION 19
         cont=0;
        if (this.resp19.length==this.datos.length){
        	for (var i =0;  i < this.resp19.length; i++) {
        		if (this.resp19[i]==null){
        			cont++;
        		}

        	}

        	

        	if (cont !=0){
        		this.error19=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 19 incompletas'});
        	}
        	else
        	{
        		this.error19=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error19=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 19'})
        }

        // VALIDACION 20
         cont=0;
        if (this.resp20.length==this.datos.length){
        	for (var i =0;  i < this.resp20.length; i++) {
        		if (this.resp20[i]==null){
        			cont++;
        		}

        	}
			if (cont !=0){
        		this.error20=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 20 incompletas'});
        	}
        	else
        	{
        		this.error20=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error20=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 20'})
        }

        // VALIDACION 21
         cont=0;
        if (this.resp21.length==this.datos.length){
        	for (var i =0;  i < this.resp21.length; i++) {
        		if (this.resp21[i]==null){
        			cont++;
        		}

        	}
        	if (cont !=0){
        		this.error21=true;
        		this.errores.push({mensaje:'Respuestas de la pregunta 21 incompletas'});
        	}
        	else
        	{
        		this.error21=false;
        		//this.errores=[];
        	}
        }
        else
        {
        	this.error21=true;
        	this.errores.push({'mensaje':'No has contestado todas las opciones de la pregunta 21'})
        }


        //VALIDACION GLOBAL
        if (this.error1 || this.error2 || this.error3 || this.error4 || this.error5 ||
        this.error6 || this.error7 || this.error8 || this.error9 || this.error10 || this.error11 || 
        this.error12 || this.error13 ||this.error14 || this.error15 ||this.error16 || this.error17 || this.error18 || this.error19 ||
        this.error20 || this.error21)
        	this.error=true;
       	else
       	{
       		this.error=false;
       		this.errores=[];
       	}
        


        	
       	// Se adquieren todas los identificadores del profesor 

        	for (var i = 0; i < this.datos.length; i++) {
        		cedulas.push(this.datos[i].Cedula);
        		asignaturas.push(this.datos[i].ClaveAsig);
        	}
        	//alert(cedulas);

  	     	var resp = {
  	     	cedula:cedulas,

        	matricula:this.matricula,
        	claveasig:asignaturas,
        	//id_preg:'1',

        	resp1:this.resp1,
        	
        	resp2:this.resp2,
        	
        	resp3:this.resp3,
        	resp4:this.resp4,
        	resp5:this.resp5,
        	resp6:this.resp6,
        	resp7:this.resp7,
        	resp8:this.resp8,
        	resp9:this.resp9,
        	resp10:this.resp10,
        	resp11:this.resp11,
        	resp12:this.resp12,
        	resp13:this.resp13,
        	resp14:this.resp14,
        	resp15:this.resp15,
        	resp16:this.resp16,
        	resp17:this.resp17,
        	resp18:this.resp18,
        	resp19:this.resp19,
        	resp20:this.resp20,
        	resp21:this.resp21,
        	comments:this.comentarios,
        	clavegrupo:this.grupo,
        	periodo:this.periodo};

        	//console.log(resp);
        	//Si no se produce algun error

        	if(this.error==false){
        		this.$http.post($route + '/apiRespuestas',resp).then
        		(function(response){
        		console.log(response);
        		this.ok=true;
        		});
        	}
        	else
        		alert('Aun no se envia la encuesta debido a un error, revise la sección de errores');
        } // Fin del caso, cuando no ha presentado
        else
        	alert('El alumno ya presentó la evaluación');
        }, // Fin del método enviar respuestas


	}

	


	});
}
window.onload=init;