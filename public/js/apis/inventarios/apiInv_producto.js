//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var apiInvProductos = ruta + '/apiInvProducto';

var apiProducto= ruta + '/apiProducto';

new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#invP',
	data:{
		inv_productos:[],
		productos:[],
		//variables de cada control
		id_producto:'',
		fecha:'',
		edit_fecha:'',
		cantidad_inicial:'',
		entrada:'',
		salida:'',
		venta:0,
		descripcion:'',
		total:'',
		bandera:true,
		id_inventario:'',
		totalEdit:'',
		buscar:'',
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true



	},
	created(){
		this.fechaActual();
		this.traerInventario();
		this.traerProductos();
		//this.RegistrarInvP();
		//this.ActualizarInventario();
	},
	methods:{
		fechaActual(){
			var dat= new Date();
			var mes=dat.getMonth() + 1;
			this.fecha= dat.getFullYear()+ '-' + mes  + '-' + dat.getDate() ;
		},
		traerInventario(){
			this.$http.get(apiInvProductos).then(function(json){
				this.inv_productos=json.data;
			});
		},
		traerProductos(){
			this.$http.get(apiProducto).then(function(json){
				this.productos=json.data;
			});
		},
		ActivarModal(){
			$('#ModalInv').modal('show');
			this.bandera=true;
			this.id_producto='';
				this.cantidad_inicial='';
				this.entrada='';
				this.salida='';
				
				this.descripcion='';
				this.total='';
		},
		RegistrarInvP(){

			this.total = parseFloat(this.cantidad_inicial) + parseFloat(this.entrada) - parseFloat(this.salida) - parseFloat(this.venta);

			var NuevoInvP={
				id_producto:this.id_producto,
				fecha_alta:this.fecha,
				cantidad_inicial:this.cantidad_inicial,
				entrada:this.entrada,
				salida:this.salida,
				venta:this.venta,
				descripcion:this.descripcion,
				total:this.total
			};

			this.$http.post(apiInvProductos, NuevoInvP).then(function(json){
				this.id_producto='';
				this.cantidad_inicial='';
				this.entrada='';
				this.salida='';
				this.venta='';
				this.descripcion='';
				this.total='';
				$('#ModalInv').modal('hide');

				this.traerInventario();

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);

			});
		},
		EliminarInvP(id){
			var mensaje=confirm("Estas seguro de eliminar el inventario?");

			if (mensaje) {
				this.$http.delete(apiInvProductos + '/' + id).then(function(json){
					this.traerInventario();


					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);
				});
			}
			
		},
		EditarInvP(id){
			
			this.id_inventario=id;

			this.$http.get(apiInvProductos + '/' + id).then(function(json){
				$('#ModalInv').modal('show');
				this.bandera=false;
				this.id_producto=json.data.id_producto;
				this.edit_fecha=json.data.fecha_alta;
				this.cantidad_inicial=json.data.cantidad_inicial;
				this.entrada=json.data.entrada;
				this.salida=json.data.salida;
				this.venta=json.data.venta;
				this.descripcion=json.data.descripcion;
				this.total=json.data.total;
			});
		},
		ActualizarInventario(){
			this.total = parseFloat(this.cantidad_inicial) + parseFloat(this.entrada) - parseFloat(this.salida) - parseFloat(this.venta);

			var ActualizarInv={
				id_producto:this.id_producto,
				fecha_alta:this.edit_fecha,
				cantidad_inicial:this.cantidad_inicial,
				entrada:this.entrada,
				salida:this.salida,
				venta:this.venta,
				descripcion:this.descripcion,
				total:this.total
			};

			this.$http.put(apiInvProductos + '/' + this.id_inventario,ActualizarInv).then(function(json){
				$('#ModalInv').modal('hide');
				this.traerInventario();

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

	filtrarInventarioP:function(){
		return this.inv_productos.filter((inv)=>{
			return inv.productos.nombre.toLowerCase().match(this.buscar.toLowerCase().trim())
		});
	}

	}

});
