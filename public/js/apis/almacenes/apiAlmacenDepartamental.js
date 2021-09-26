//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var ApiDepartamental = ruta + '/apiAlmacenD';

new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#AlmacenD',
	data:{
		prueba:'hola',
		R_departamentales:[],
		form:true,
		nombre:'',
		ubicacion:'',
		id_almacenD:'',
		submit:true,
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true




	},
	created(){
		this.tablaAlmacenD();
	},
	methods:{
		tablaAlmacenD(){
			this.$http.get(ApiDepartamental).then(function(json){
				this.R_departamentales=json.data;
			});
		},
		ActivarForm(){
			this.form=false;
			this.nombre='';
			this.ubicacion='';
		},
		cancelarForm(){
			this.form=true;
		},
		NuevoAlmacenD(){
			let NuevoAlmacenD={
				nombre:this.nombre,
				ubicacion:this.ubicacion
			};

			this.$http.post(ApiDepartamental, NuevoAlmacenD).then(function(json){
				this.nombre='';
				this.ubicacion='';
				this.form=true;
				this.tablaAlmacenD();

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);
			});
		},
		EliminarAlmacenD(id){
			var mensaje = confirm("Estas seguro de eliminar");

			if (mensaje) {
				this.$http.delete(ApiDepartamental + '/' + id).then(function(json){
					this.tablaAlmacenD();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);

				});
			}
		},
		EditarAlmacenD(id){
			this.submit=false;

			this.id_almacenD = id;

			this.$http.get(ApiDepartamental + '/' + id).then(function(json){
				this.form=false;
				this.nombre = json.data.nombre;
				this.ubicacion = json.data.ubicacion;
			});
		},
		ActualizarAlmacenD(){
			let ActualizarAlmacenD={
				nombre:this.nombre,
				ubicacion:this.ubicacion
			};

			this.$http.patch(ApiDepartamental + '/' + this.id_almacenD, ActualizarAlmacenD).then(function(json){
				this.form=true;
				this.tablaAlmacenD();

				//alerta
				this.actualizado=false;
				
				$('#actualizado').fadeIn();

		    	setTimeout(function() {
			        $('#actualizado').fadeOut(1500);
			    }, 3000);
			});

		},



	}
});