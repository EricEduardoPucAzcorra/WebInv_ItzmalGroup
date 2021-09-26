//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var apiInvRB= ruta + '/apiInvBlancos';
 
 var apiRecursoD= ruta + '/apiRecursoD';
new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#Apiblancos', 
	data:{
		prueba:'hola',
		invBlancos:[],
		blancos:[],
		fecha:'',
		id_recursoDep:'',
		// fecha_alta:'',
		cantidad_inicial:'',
		entrada:'',
		salida:'',
		descripcion:'',
		total:'',
		bandera:true,
		edit_fecha:'',
		id_inventarioB:'',
		buscar:'',
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true
	},
	created(){
		this.traerInventarioB();
		this.traerRecursos();
		this.fechaActual();

	},
	methods:{
		fechaActual(){
			var dat= new Date();
			var mes=dat.getMonth() + 1;
			this.fecha= dat.getFullYear()+ '-' + mes  + '-' + dat.getDate() ;
		},
		traerInventarioB(){
			this.$http.get(apiInvRB).then(function(json){
				this.invBlancos=json.data;
			});
		},

		traerRecursos(){
			this.$http.get(apiRecursoD).then(function(json){
				this.blancos=json.data;
			});
		},

		ActivarModal(){
			$('#ModalInvB').modal('show');
			this.bandera=true;
			this.id_recursoDep='';
			this.cantidad_inicial='';
			this.entrada='';
			this.salida='';
			this.descripcion='';
		},

		RegistrarInvB(){

			this.total= parseFloat(this.cantidad_inicial) + parseFloat(this.entrada) - parseFloat(this.salida);

			var NuevoInvB={
				id_recursoDep:this.id_recursoDep,
				fecha_alta:this.fecha,
				cantidad_inicial:this.cantidad_inicial,
				entrada:this.entrada,
				salida:this.salida,
				descripcion:this.descripcion,
				total_disponible:this.total
			};

			this.$http.post(apiInvRB, NuevoInvB).then(function(json){
				this.id_recursoDep='';
				this.cantidad_inicial='';
				this.entrada='';
				this.salida='';
				this.descripcion='';
				$('#ModalInvB').modal('hide');
				this.traerInventarioB();

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);
			});
		},

		eliminarInvB(id){
			let mensaje=confirm("Estas seguro de eliminar el inventario?");

			if (mensaje) {
				this.$http.delete(apiInvRB + '/' + id).then(function(json){
					this.traerInventarioB();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);

				});
			}
		},

		EditarInvB(id){
			this.id_inventarioB=id;

			this.$http.get(apiInvRB + '/' + id).then(function(json){

				$('#ModalInvB').modal('show');

				this.bandera=false;
				this.id_recursoDep=json.data.id_recursoDep;
				this.edit_fecha=json.data.fecha_alta;
				this.cantidad_inicial=json.data.cantidad_inicial;
				this.entrada=json.data.entrada;
				this.salida=json.data.salida;
				this.descripcion=json.data.descripcion;
				this.total=json.data.total_disponible;
			});
		},

		ActualizarInvB(){
			this.total = parseFloat(this.cantidad_inicial) + parseFloat(this.entrada) - parseFloat(this.salida);

			var ActualizarInvB={
				id_recursoDep:this.id_recursoDep,
				fecha_alta:this.edit_fecha,
				cantidad_inicial:this.cantidad_inicial,
				entrada:this.entrada,
				salida:this.salida,
				descripcion:this.descripcion,
				total_disponible:this.total
			};

			this.$http.put(apiInvRB + '/' + this.id_inventarioB,ActualizarInvB).then(function(json){
				$('#ModalInvB').modal('hide');
				this.traerInventarioB();

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

		filtrarInventarioB:function(){
		return this.invBlancos.filter((inv)=>{
			return inv.recursos_dep.nombre.toLowerCase().match(this.buscar.toLowerCase().trim())
		});
		}
	}
});