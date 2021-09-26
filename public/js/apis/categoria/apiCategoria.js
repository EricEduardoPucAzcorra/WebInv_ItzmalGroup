//la variable ruta se define con el fin de leer el name que fue definido en la vista para la lograr interactuar con
//la aplicacion desde cualquier medio. 
var ruta = document.querySelector("[name=route]").value;
//al definir la variable podemos definir el nombre de la ubicacion "ruta + concatenar + 'apiController';" 

// defino la variable que obtiene el valor de la api

var apiCategoria= ruta + '/CategoriaProducto';

new Vue({

	//se define el codigo para ubicar la el token de las vistas
	http: {
		headers: {
		  'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	  },

	el:'#Categoria',
	data:{
		prueba:'hola',
		categorias:[],
		categoria:'',
		bandera:true,
		id_categoria:'',
		buscar:'',
		hora:'',
		//variables alerts
		alert:true,
		eliminado:true,
		actualizado:true

	},
	created(){
		this.tablaCat();
	},
	methods:{
		tablaCat(){
			this.$http.get(apiCategoria).then(function(json){
				this.categorias=json.data;
			});
		},
		ActivarModal(){
			$('#ModalCat').modal('show');
			this.hora=new Date();
			this.bandera=true;
			this.categoria='';
		},
		NuevaCategoria(){
			var N_Cat={
				categoria:this.categoria
			};

			this.$http.post(apiCategoria, N_Cat).then(function(json){
				$('#ModalCat').modal('hide');
				this.categoria='';
				this.tablaCat();

				//alerta
				this.alert=false;
				

				$('#guardar').fadeIn();  


			    setTimeout(function() {
				 $('#guardar').fadeOut(1500);
				}, 3000);

			});
		},
		eliminarCat(id){
			var mensaje = confirm("Estas seguro de eliminar?");

			if (mensaje) {
				this.$http.delete(apiCategoria + '/' + id).then(function(json){
					this.tablaCat();

					//alerta
					this.eliminado=false;
					
					$('#eliminado').fadeIn();  

				    setTimeout(function() {
					 $('#eliminado').fadeOut(1500);
					}, 3000);

				});
			}
		},

		EditarCategoria(id){
			this.id_categoria=id;

			this.$http.get(apiCategoria + '/' + id).then(function(json){
				$('#ModalCat').modal('show');
				this.bandera=false;
				this.categoria=json.data.categoria;
			});
		},
		ActualizarCat(){
			let ActualizarCat={
				categoria:this.categoria
			};
			this.$http.put(apiCategoria + '/' + this.id_categoria,ActualizarCat ).then(function(json){
			   $('#ModalCat').modal('hide');
			   this.tablaCat();

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

	filtrarCat:function(){
		return this.categorias.filter((cat)=>{
			return cat.categoria.toLowerCase().match(this.buscar.toLowerCase().trim())
		});
	},
	}
});