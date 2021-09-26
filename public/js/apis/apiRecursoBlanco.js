//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var apiRecursoD= ruta + '/apiRecursoD';

var apiCategoriaProduct= ruta + '/CategoriaProducto';

var apiAlmacenD= ruta + '/apiAlmacenD';

new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#blancos',
	data:{
		prueba:'hola',
		recursosD:[],
		nombre:'',
		descripcion:'',
		id_categoriaPro:'',
		id_almacenDep:'',

		//variable array para categorias y almacenes
		categoriasD:[],
		almacenesD:[],
		bandera:true,
		id_RD:'',
		//variable filtro
		buscar:'',
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true




	},
	created(){
		this.TablaRD();
		this.traerCategorias();
		this.traerAlmacen();
	},
	methods:{
		TablaRD(){
			this.$http.get(apiRecursoD).then(function(json){
				this.recursosD=json.data;
				//console.log(json.data);
			});
		},
		ActivarModal(){
			this.bandera=true;
			$('#modalRD').modal('show');
			this.nombre='';
			this.descripcion='';
			this.id_categoriaPro='';
			this.id_almacenDep='';
		},
		traerCategorias(){
			this.$http.get(apiCategoriaProduct).then(function(json){
				this.categoriasD=json.data;
			});
		},
		traerAlmacen(){
			this.$http.get(apiAlmacenD).then(function(json){
				this.almacenesD=json.data;
			});
		},
		NuevoRD(){

			let NuevoRD = {
				nombre:this.nombre,
				descripcion:this.descripcion,
				id_categoriaPro:this.id_categoriaPro,
				id_almacenDep:this.id_almacenDep
			};

			this.$http.post(apiRecursoD, NuevoRD).then(function(json){
				$('#modalRD').modal('hide');
				this.nombre='';
				this.descripcion='';
				this.id_categoriaPro='';
				this.id_almacenDep='';
				this.TablaRD();

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);
				
			});
		},

		EliminarRD(id){

			var alert = confirm("Estas seguro de elimnar?");

			if (alert) {
				this.$http.delete(apiRecursoD + '/' + id).then(function(json){
					this.TablaRD();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);

				});
			}
			
		},

		EditarRD(id){

			this.id_RD=id;

			this.$http.get(apiRecursoD +'/' + id).then(function(json){
				$('#modalRD').modal('show');
				this.bandera=false;
				//traera los datos del producto
				this.nombre=json.data.nombre;
				this.descripcion=json.data.descripcion;
				this.descripcion=json.data.descripcion;
				// this.categoria=json.data.categoria.categoria;
				this.id_categoriaPro=json.data.id_categoriaPro;
				// this.almacen=json.data.almacen.nombre;
				this.id_almacenDep=json.data.id_almacenDep;


			});
		},

		ActualizarRD(){

			let ActualizarRD = {
				nombre:this.nombre,
				descripcion:this.descripcion,
				id_categoriaPro:this.id_categoriaPro,
				id_almacenDep:this.id_almacenDep
			};

			this.$http.patch(apiRecursoD + '/' + this.id_RD,ActualizarRD).then(function(){
				$('#modalRD').modal('hide');
				this.TablaRD();
				//alerta
				this.actualizado=false;
				
				$('#actualizado').fadeIn();

		    	setTimeout(function() {
			        $('#actualizado').fadeOut(1500);
			    }, 3000);
			});
		}


	},
	computed:{


	filtrarRD:function(){
		return this.recursosD.filter((recurso)=>{
			return recurso.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) ||
			       recurso.descripcion.toLowerCase().match(this.buscar.toLowerCase().trim())

		});
	},

	}
});