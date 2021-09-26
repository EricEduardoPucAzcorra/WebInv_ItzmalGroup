//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var apiRecursoLavanderia= ruta + '/apiRecursosL';

var apiCategoriaProduct= ruta + '/CategoriaProducto';

let AlmacenLavanderia = ruta + '/apiAlmacenL';
new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#recurso_Lavanderia',
	data:{
		prueba:'hola mundo cruel',
		recursosL:[],
		categoriasPro:[],
		almacenesLav:[],
		//variables para validar los campos 
		nombre:'',
		id_AlmacenLavado:'',
		id_categoriaPro:'',
		bandera:true,
		id_recursoL:'',
		buscar:'',
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true

	},
	created(){
		this.tablaLavanderia();
		this.traerCategorias();
		this.traerAlmacen();
	},
	methods:{
		tablaLavanderia(){
			this.$http.get(apiRecursoLavanderia).then(function(json){
				
				this.recursosL=json.data;

			});
		},
		ActivarModal(){
			this.bandera=true;
			$('#ModalR_L').modal('show');
			this.nombre='';
			this.id_categoriaPro='';
			this.id_AlmacenLavado='';
		},
		traerCategorias(){
			this.$http.get(apiCategoriaProduct).then(function(json){
				this.categoriasPro=json.data;
			});
		},
		traerAlmacen(){
			this.$http.get(AlmacenLavanderia).then(function(json){
				this.almacenesLav=json.data;
			});
		},
		RegistrarR_L(){

			let Recurso_Nuevo={
				nombre:this.nombre,
				id_categoriaPro:this.id_categoriaPro,
				id_AlmacenLavado:this.id_AlmacenLavado
			};

			this.$http.post(apiRecursoLavanderia, Recurso_Nuevo).then(function(json){
				$('#ModalR_L').modal('hide');
				this.tablaLavanderia();
				this.nombre='';
				this.id_categoriaPro='';
				this.id_AlmacenLavado='';

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);
			});
		},
		EliminarRL(id){

			let alert = confirm("Estas seguro de eliminar");
			if (alert) {
				this.$http.delete(apiRecursoLavanderia + '/' + id).then(function(json){
					this.tablaLavanderia();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);
				});
			}
		},

		EditarRL(id){
			this.id_recursoL=id;

			this.$http.get(apiRecursoLavanderia + '/' + id).then(function(json){
				this.bandera=false;
				$('#ModalR_L').modal('show');
				this.nombre=json.data.nombre;
				this.id_categoriaPro=json.data.id_categoriaPro;
				this.id_AlmacenLavado=json.data.id_AlmacenLavado;
			});

		},

		ActualizarRL(){

			let RecursoLAct={
				nombre:this.nombre,
				id_categoriaPro:this.id_categoriaPro,
				id_AlmacenLavado:this.id_AlmacenLavado
			};

			this.$http.put(apiRecursoLavanderia + '/' + this.id_recursoL, RecursoLAct).then(function(json){
				$('#ModalR_L').modal('hide');
				this.tablaLavanderia();

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
	filtrarRecursoL:function(){
		return this.recursosL.filter((recursoL)=>{
			return recursoL.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) 
		});
	},
	}
});