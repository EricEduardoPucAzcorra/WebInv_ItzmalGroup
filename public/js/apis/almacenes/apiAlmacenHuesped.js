//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var apiAlmacenH = ruta + '/apiAlmacenRH';

new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#almacenH',
	data:{
		prueba:'hola',
		form:true,
		almacenesH:[],
		nombre:'',
		ubicacion:'',
		submit:true,
		id_almacenH:'',
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true


	}, 
	created:function () {
		this.tablaAlmacenH();
	},
	methods:{
		tablaAlmacenH(){
			this.$http.get(apiAlmacenH).then(function(json){
				this.almacenesH=json.data;
			});
		},

		ActivarForm(){
			this.form=false;
			this.nombre='';
			this.ubicacion='';
			this.submit=true;
		},
		cancelarForm(){
			this.form=true;
		},

		RegistrarAlmacenH(){
			let NuevoAlmacenH={
				nombre:this.nombre,
				ubicacion:this.ubicacion
			};

			this.$http.post(apiAlmacenH, NuevoAlmacenH).then(function(json){
				this.form=true;
				this.nombre='';
				this.ubicacion='';
				this.tablaAlmacenH();

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);
			});
		},
		eliminarAlmacenH(id){
			var mensaje = confirm("Estas seguro de eliminar?");

			if(mensaje){
				this.$http.delete(apiAlmacenH + '/' + id).then(function(json){
					this.tablaAlmacenH();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);
				});
			}
		},
		EditarAlmacenH(id){
			this.id_almacenH=id;

			this.submit=false;

			this.$http.get(apiAlmacenH + '/' + id).then(function(json){

				this.form=false;

				this.nombre = json.data.nombre;

				this.ubicacion = json.data.ubicacion;
			});

		},

		ActualizarAlmacenH(){

			var ActAlmacen={
				nombre:this.nombre,
				ubicacion:this.ubicacion
			};

			this.$http.put(apiAlmacenH + '/' + this.id_almacenH, ActAlmacen).then(function(json){
				this.form=true;
				this.tablaAlmacenH();

				//alerta
				this.actualizado=false;
				
				$('#actualizado').fadeIn();

		    	setTimeout(function() {
			        $('#actualizado').fadeOut(1500);
			    }, 3000);
			});
		}


	}
});