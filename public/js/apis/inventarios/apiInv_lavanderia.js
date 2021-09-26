//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var apiInvL= ruta + '/apiInvLavado';

var apiRecursoLavanderia= ruta + '/apiRecursosL';

new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#invlavanderia',
	data:{
		prueba:'hola',
		invlavados:[],
		recursosL:[],
		bandera:true,
		//inputs variables
		id_RLavado:'',
		fecha:'',
		edit_fecha:'',
		cantidad_inicial:'',
		entrada:'',
		salida:'',
		descripcion:'',
		total:'',
		id_inventarioL:'',
		buscar:'',
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true



	},
	created(){
		this.fechaActual();
		this.traerInventarioL();
		this.traerRecursosL();
	},
	methods:{
		fechaActual(){
			var dat= new Date();
			var mes=dat.getMonth() + 1;
			this.fecha= dat.getFullYear()+ '-' + mes  + '-' + dat.getDate() ;
		},
		traerInventarioL(){
			this.$http.get(apiInvL).then(function(json){
				this.invlavados=json.data;
			});
		},
		traerRecursosL(){
			this.$http.get(apiRecursoLavanderia).then(function(json){
				this.recursosL=json.data;
			});
		},

		ActivarModal(){
			$('#ModalInvL').modal('show');
			this.bandera=true;
			this.id_RLavado='';
			this.cantidad_inicial='';
			this.entrada='';
			this.salida='';
			this.descripcion='';
		},

		RegistrarInvL(){

			this.total = parseFloat(this.cantidad_inicial) + parseFloat(this.entrada) - parseFloat(this.salida);

			var NuevoInvL={
				id_RLavado:this.id_RLavado,
				fecha_alta:this.fecha,
				cantidad_inicial:this.cantidad_inicial,
				entrada:this.entrada,
				salida:this.salida,
				descripcion:this.descripcion,
				cat_disponible:this.total
			};


			this.$http.post(apiInvL, NuevoInvL).then(function(json){
				
				$('#ModalInvL').modal('hide');
				this.id_RLavado='';
				this.cantidad_inicial='';
				this.entrada='';
				this.salida='';
				this.descripcion='';
				this.traerInventarioL();

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);
			});
		},

		EliminarInvL(id){
			let mensaje=confirm("Estas seguro de eliminar el inventario?");

			if (mensaje) {
				this.$http.delete(apiInvL + '/' + id).then(function(json){
					this.traerInventarioL();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);


				});
			}
		},

		EditarInvL(id){
			
			this.id_inventarioL=id;

			this.$http.get(apiInvL + '/' + id).then(function(json){
				$('#ModalInvL').modal('show');
				this.bandera=false;
				this.id_RLavado=json.data.id_RLavado;
				this.edit_fecha=json.data.fecha_alta;
				this.cantidad_inicial=json.data.cantidad_inicial;
				this.entrada=json.data.entrada;
				this.salida=json.data.salida;
				this.descripcion=json.data.descripcion;
				this.total=json.data.cat_disponible;
			});
		},
		ActualizarInventario(){
			
			this.total = parseFloat(this.cantidad_inicial) + parseFloat(this.entrada) - parseFloat(this.salida);

			
			var A_invL={
				id_RLavado:this.id_RLavado,
				fecha_alta:this.edit_fecha,
				cantidad_inicial:this.cantidad_inicial,
				entrada:this.entrada,
				salida:this.salida,
				descripcion:this.descripcion,
				cat_disponible:this.total
			};

			this.$http.put(apiInvL + '/' + this.id_inventarioL,A_invL).then(function(json){
				$('#ModalInvL').modal('hide');
				this.traerInventarioL();

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
		filtrarInventarioL:function(){
			return this.invlavados.filter((inv)=>{
				return inv.recursos_lav.nombre.toLowerCase().match(this.buscar.toLowerCase().trim())
			});
		}
	}
});