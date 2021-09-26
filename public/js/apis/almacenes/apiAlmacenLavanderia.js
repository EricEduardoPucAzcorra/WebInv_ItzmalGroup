//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var apiAlmacenL= ruta + '/apiAlmacenL';

new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#AlmacenL',
	data:{

		prueba:'hola',
		AlmacenLav:[],
		form:true,
		nombre:'',
		ubicacion:'',
		id_almacenL:'',
		submit:true,
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true
	


	},
	created(){
		this.tablaAlmacenL();
	},
	methods:{

		tablaAlmacenL(){
			this.$http.get(apiAlmacenL).then(function(json){
				this.AlmacenLav=json.data;
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
		GuardarAlmacenL(){
			var NuevoAlmacenL={
				nombre:this.nombre,
				ubicacion:this.ubicacion
			};

			this.$http.post(apiAlmacenL, NuevoAlmacenL).then(function(json){
				this.nombre='';
				this.ubicacion='';
				this.form=true;
				this.tablaAlmacenL();

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);

			});
		},
		EliminarAlmacenL(id){
			
			var mensaje=confirm("Estas seguro de eliminar");

			if (mensaje) {
				this.$http.delete(apiAlmacenL + '/' + id).then(function(json){
					this.tablaAlmacenL();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);

				});
			}
		},
		EditarAlmacenL(id){
			this.id_almacenL=id;
			
			this.$http.get(apiAlmacenL + '/' + id).then(function(json){
				this.form=false;
				this.submit=false;
				this.nombre=json.data.nombre;
				this.ubicacion=json.data.ubicacion;
			});
		},
		ActualizarAlmacenL(){
			var A_AlmacenL={
				nombre:this.nombre,
				ubicacion:this.ubicacion
			};

			this.$http.put(apiAlmacenL + '/' + this.id_almacenL, A_AlmacenL).then(function(json){
				this.form=true;
				this.tablaAlmacenL();

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