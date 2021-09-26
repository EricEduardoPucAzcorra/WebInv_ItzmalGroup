//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

//area para definir apis
var apiProducto= ruta +'/apiProducto';

var apiCategoriaProduct= ruta + '/CategoriaProducto';

var apiAlmacenPro= ruta + '/almacenes';

//inicio logico de vue

new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#productos',
	data:{
		prueba:'productos Crud',
		productos:[],
		//variables de cada input
		nombre:'',
		precio:'',
		descripcion:'',
		id_categoriaPro:'',
		id_almacenPro:'',
		//variable para las categorias 
		categoriasPro:[],
		almacenes:[],
		bandera:true,
		//variable para capturrar el identificador del producto
		id_producto:'',
		categoria:'',
		almacen:'',
		//variable para el filtro 
		buscar:'',
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true



	},

	created(){
		this.TablaProductos();
		this.traerCategorias();
		this.traerAlmacen();
	},

	methods:{
		TablaProductos(){
			this.$http.get(apiProducto).then(function(json){
				this.productos=json.data;
				//console.log(this.productos);
			}).catch(function(json){
				console.log(json);
			});
		},
		ActivarModal(){
			this.bandera=true;
			$('#ModalProducto').modal('show');
				this.nombre='';
				this.precio='';
				this.descripcion='';
				this.id_categoriaPro='';
				this.id_almacenPro='';
		},
		traerCategorias(){
			this.$http.get(apiCategoriaProduct).then(function(json){
				this.categoriasPro=json.data;
			}).catch(function(json){
				console.log(json);
			});
		},

		traerAlmacen(){
			this.$http.get(apiAlmacenPro).then(function(json){
				this.almacenes=json.data;
			}).catch(function(json){
				console.log(json);
			});
		},

		GuardarProducto(){
			var DatosNuevo={
				nombre:this.nombre,
				precio:this.precio,
				descripcion:this.descripcion,
				id_categoriaPro:this.id_categoriaPro,
				id_almacenPro:this.id_almacenPro
			};

			this.$http.post(apiProducto, DatosNuevo).then(function(json){
				$('#ModalProducto').modal('hide');
				this.TablaProductos();
				this.nombre='';
				this.precio='';
				this.descripcion='';
				this.id_categoriaPro='';
				this.id_almacenPro='';

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);

			});
			
		},

		EliminarProducto(id){
			//var confirm = confirm("Estas seguro de eliminar?");

			var confir= confirm("Estas seguro de eliminar?");
			
			if(confir){
				this.$http.delete(apiProducto + '/' + id).then(function(json){
					this.TablaProductos();
					
					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);

				});


			}
			
			

		},

		EditarProducto(id){

			this.id_producto=id;

			this.$http.get(apiProducto +'/' + id).then(function(json){
				$('#ModalProducto').modal('show');
				this.bandera=false;
				//traera los datos del producto
				this.nombre=json.data.nombre;
				this.precio=json.data.precio;
				this.descripcion=json.data.descripcion;
				// this.categoria=json.data.categoria.categoria;
				this.id_categoriaPro=json.data.id_categoriaPro;
				// this.almacen=json.data.almacen.nombre;
				this.id_almacenPro=json.data.id_almacenPro;


			});

			//console.log(this.id_producto);

		},

		ActualizarProducto(){

			var DatosAct={
				nombre:this.nombre,
				precio:this.precio,
				descripcion:this.descripcion,
				id_categoriaPro:this.id_categoriaPro,
				id_almacenPro:this.id_almacenPro
			};

			this.$http.patch(apiProducto + '/' + this.id_producto,DatosAct).then(function(){
				$('#ModalProducto').modal('hide');
				this.TablaProductos();	
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

	filtrarProducto:function(){
		return this.productos.filter((producto)=>{
			return producto.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) ||
			       producto.descripcion.toLowerCase().match(this.buscar.toLowerCase().trim())
		});
	},
	}
});