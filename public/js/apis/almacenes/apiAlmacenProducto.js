//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

let apiAlmacenP = ruta + '/almacenes';

new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#AlmacenP',
	data:{
		prueba:'hola mundo',
		AlmacenesP:[],
		form:true,
		nombre:'',
		ubicacion:'',
		id_almacenP:'',
		submit:true,
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true
	},
	created(){
		this.tablaAlmacenesP();
	},
	methods:{
		// treaer datos
		tablaAlmacenesP(){
			this.$http.get(apiAlmacenP).then(function(json){
				this.AlmacenesP=json.data;
			});
		},
		//modal
		NuevoAlmacenP(){
			//alert('hola')
			this.form=false;
			this.submit=true;
			this.nombre='';
			this.ubicacion='';
		},
		//cancelar modal
		cancelarP(){
			this.form=true;
		},
		//guardar registro
		GuardarAlmacen(){
			var NuevoAlmacen={
				nombre:this.nombre,
				ubicacion:this.ubicacion
			};
			this.$http.post(apiAlmacenP, NuevoAlmacen).then(function(json){
				this.nombre='';
				this.ubicacion='';
				this.form=true;
				this.tablaAlmacenesP();

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);
			});
		},
		//eliminar registro
		eliminarAlmacenP(id){
			var mensaje = confirm("Estas seguro de eliminar?");

			if (mensaje) {
				this.$http.delete(apiAlmacenP + '/' + id).then(function(json){
					this.tablaAlmacenesP();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);
				});
			}
		},
		//editar
		EditarAlmacenP(id){
			
			this.id_almacenP=id;

			this.form=false;

			this.$http.get(apiAlmacenP + '/' + id).then(function(json){
				this.nombre=json.data.nombre;
				this.ubicacion=json.data.ubicacion;
			});

			this.submit=false;
		},
		
		ActualizarAlmacenP(){

			let ActAlmacenP={
				nombre:this.nombre,
				ubicacion:this.ubicacion
			};

			this.$http.put(apiAlmacenP + '/' + this.id_almacenP, ActAlmacenP).then(function(json){
				this.form=true;
				this.tablaAlmacenesP();

				//alerta
				this.actualizado=false;
				
				$('#actualizado').fadeIn();

		    	setTimeout(function() {
			        $('#actualizado').fadeOut(1500);
			    }, 3000);
			});
		},



	},
	computed:{

	}
});