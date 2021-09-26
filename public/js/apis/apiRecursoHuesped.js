//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var apiRecursoH = ruta + '/apiRecursoH';


var apiCategoriaProduct= ruta + '/CategoriaProducto';

let apiAlmacenH= ruta + '/apiAlmacenRH';

new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },


	el:'#recurso',
	data:{
		prueba:'hola',
		recursosH:[],
		nombre:'',
		id_categoriaPro:'',
		id_AlmacenRHuesped:'',
		categoriasPro:[],
		almcenesH:[],
		categoria:'',
		almacen:'',
		bandera:true,
		//variable que almacena el id 
		id_recurso:'',
		buscar:'',
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true

	},
	created(){
		this.tablaRH();
		this.traerCategorias();
		this.traerAlmacenes();
	},
	methods:{
		tablaRH(){
			this.$http.get(apiRecursoH).then(function(json){
				this.recursosH=json.data;
			});
		},
		ActivarModal(){
			this.bandera=true;
			$('#ModalRecurso').modal('show');
				this.nombre='';
				this.id_AlmacenRHuesped='';
				this.id_categoriaPro='';
		},

		traerCategorias(){
			this.$http.get(apiCategoriaProduct).then(function(json){
				this.categoriasPro=json.data;
			}).catch(function(json){
				console.log(json);
			});
		},
		traerAlmacenes(){
			this.$http.get(apiAlmacenH).then(function(json){
				this.almcenesH=json.data;
			});
		},

		GuardarRecurso(){
			var DatosNuevo={
				nombre:this.nombre,
				id_categoriaPro:this.id_categoriaPro,
				id_AlmacenRHuesped:this.id_AlmacenRHuesped
			};

			this.$http.post(apiRecursoH, DatosNuevo).then(function(json){
				$('#ModalRecurso').modal('hide');
				this.tablaRH();
				this.nombre='';
				this.id_AlmacenRHuesped='';
				this.id_categoriaPro='';

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);

			});
		},
		EliminarRecursoH(id){
			
			var confir= confirm("Estas seguro de eliminar?");
			
			if(confir){
				this.$http.delete(apiRecursoH + '/' + id).then(function(json){
					this.tablaRH();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);
				});
			}
			
			//console.log(id);
		},


		EditarRecurso(id){

			this.id_recurso=id;

			this.$http.get(apiRecursoH +'/' + id).then(function(json){
				$('#ModalRecurso').modal('show');
				this.bandera=false;
				//traera los datos del producto
				this.nombre=json.data.nombre;
				this.id_categoriaPro=json.data.id_categoriaPro;
				this.id_AlmacenRHuesped=json.data.id_AlmacenRHuesped;
			});
			//console.log(this.id_producto);
		},
		ActualizarRecurso(){

			var DatosAct={
				nombre:this.nombre,
				id_categoriaPro:this.id_categoriaPro,
				id_AlmacenRHuesped:this.id_AlmacenRHuesped
			};

			this.$http.patch(apiRecursoH + '/' + this.id_recurso,DatosAct).then(function(){
				$('#ModalRecurso').modal('hide');
				this.tablaRH();

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
		filtrarRecurso:function(){
		return this.recursosH.filter((recurso)=>{
			return recurso.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) 
		});
	},
	}
});