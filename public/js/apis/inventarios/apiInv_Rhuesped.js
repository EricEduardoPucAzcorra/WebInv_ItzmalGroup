//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var ApiInvR_huesped = ruta + '/apiInvHuesped';

var apiRecursoH = ruta + '/apiRecursoH';

new Vue({


	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#RHuesped',
	data:{
		prueba:'hola',
		invR_Huespeds:[],
		recursosH:[],
		//variables modal
		id_RHuesped:'',
		fecha:'',
		edit_fecha:'',
		cantidad_inicial:'',
		entrada:'',
		salida:'',
		venta:0,
		descripcion:'',
		total:'',
		bandera:true,
		id_invH:'',
		buscar:'',
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true


	},
	created(){
		this.fechaActual();
		this.traerTablaInvH();
		this.traerRecursosH();
	},
	methods:{
		fechaActual(){
			var dat= new Date();
			var mes=dat.getMonth() + 1;
			this.fecha= dat.getFullYear()+ '-' + mes  + '-' + dat.getDate() ;
		},
		traerTablaInvH(){
			this.$http.get(ApiInvR_huesped).then(function(json){
				this.invR_Huespeds=json.data;
			});
		},
		traerRecursosH(){
			this.$http.get(apiRecursoH).then(function(json){
				this.recursosH=json.data;
			});
		},
		ActivarModal(){
			$('#ModalInvH').modal('show');
			this.bandera=true;
			this.id_RHuesped='';
			this.cantidad_inicial='';
			this.entrada='';
			this.salida='';
			//this.venta='';
			this.descripcion='';
		},
		RegistrarInvH(){
			this.total = parseFloat(this.cantidad_inicial) + parseFloat(this.entrada) - parseFloat(this.salida) - parseFloat(this.venta);

			var NuevoInvH={
				id_RHuesped:this.id_RHuesped,
				fecha_alta:this.fecha,
				cantidad_inicial:this.cantidad_inicial,
				entrada:this.entrada,
				salida:this.salida,
				venta:this.venta,
				descripcion:this.descripcion,
				total_disponible:this.total
			};

			this.$http.post(ApiInvR_huesped, NuevoInvH).then(function(json){
				this.id_RHuesped='';
				this.cantidad_inicial='';
				this.entrada='';
				this.salida='';
				this.venta='';
				this.descripcion='';
				this.total='';
				$('#ModalInvH').modal('hide');

				this.traerTablaInvH();

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);

			});
		},

		EliminarInvH(id){
			var mensaje = confirm("Estas seguro de eliminar el inventario?");

			if (mensaje) {
				this.$http.delete(ApiInvR_huesped + '/' + id).then(function(json){
					this.traerTablaInvH();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);
				});
			}
		},

		EditandoInventarioH(id){
			this.id_invH=id;

			this.$http.get(ApiInvR_huesped + '/' + id).then(function(json){
				$('#ModalInvH').modal('show');
				this.bandera=false;
				this.id_RHuesped=json.data.id_RHuesped;
				this.edit_fecha=json.data.fecha_alta;
				this.cantidad_inicial=json.data.cantidad_inicial;
				this.entrada=json.data.entrada;
				this.salida=json.data.salida;
				this.venta=json.data.venta;
				this.descripcion=json.data.descripcion;
				this.total=json.data.total_disponible;
			});
		},

		ActualizarInvH(){

			this.total = parseFloat(this.cantidad_inicial) + parseFloat(this.entrada) - parseFloat(this.salida) - parseFloat(this.venta);

			var A_InvH={
				id_RHuesped:this.id_RHuesped,
				fecha_alta:this.edit_fecha,
				cantidad_inicial:this.cantidad_inicial,
				entrada:this.entrada,
				salida:this.salida,
				venta:this.venta,
				descripcion:this.descripcion,
				total_disponible:this.total
			};

			this.$http.put(ApiInvR_huesped + '/' + this.id_invH,A_InvH).then(function(json){
				$('#ModalInvH').modal('hide');
				this.traerTablaInvH();

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
		filtrarInventarioH:function(){
		return this.invR_Huespeds.filter((inv)=>{
			return inv.recursos_h.nombre.toLowerCase().match(this.buscar.toLowerCase().trim())
		});
	}
	}
});