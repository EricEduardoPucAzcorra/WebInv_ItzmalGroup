@extends('sistema.layout.index')

@section('title', 'Productos')

@section('contenido')

<div id="productos" v-cloak>
	<!-- <h1>@{{productos}}</h1> -->
           <!-- /.row -->

                <div class="alert alert-primary alert-dismissible fade show collapse" style="display:none;" role="alert" id="guardar">
                      <strong >Guardado con exito</strong> 
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                   <div v-if="" class="alert alert-danger alert-dismissible fade show collapse" style="display:none;" role="alert" id="eliminado" >
                      <strong>Eliminacion exitosa</strong> 
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="alert alert-info alert-dismissible fade show collapse" style="display:none;" role="alert" id="actualizado" >
                      <strong>Actualizacion exitosa</strong> 
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                 <!--  <div class="alert alert-primary col-3"v-if="alert==false" role="alert" style="margin-left: 75%;"  id="guardar">
                        Guardado con exito.
                  </div>       

   
                  
                   <div class="alert alert-danger col-3" v-if="eliminado==false" role="alert" style="margin-left: 75%;"  id="eliminado">
                        Eliminacion exitoso.
                   </div>
                     



                    <div class="alert alert-success col-3" v-if="actualizado==false" role="alert" style="margin-left: 75%;"  id="actualizado">
                        Actualizado con exito
                   </div>    -->
    
        <div class="">
          <div class="col-12">
            <div class="card">
            <div class="card-header">
             <!--    <h3 class="card-title">Fixed Header Table</h3> -->
             <p>    
                <button @click="ActivarModal()" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Nuevo</button>
                <a href="{{url('Pdf-productos')}}" class=" d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> 
                Generar Reporte
            </a>
            </p>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text" v-model="buscar" class="form-control float-left" placeholder="Buscar productos">
                  </div>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th hidden="">ID</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Descripcion</th>
                      <th>Categoria</th>
                      <th>Almacen</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr v-for="producto in filtrarProducto" >
                      <td hidden="">@{{producto.id_producto}}</td>
                      <td>@{{producto.nombre}}</td>
                      <td> $ @{{producto.precio}}</td>
                      <td><span class="tag tag-success">@{{producto.descripcion}}</span></td>
                      <td>@{{producto.categoria.categoria}}</td>
                      <td>@{{producto.almacen.nombre}}-@{{producto.almacen.ubicacion}}</td>
                      <td><button class="btn btn-info btn-sm" @click="EditarProducto(producto.id_producto)"><i class="fas fa-edit"></i></button> 
                        <button class="btn btn-danger btn-sm" @click="EliminarProducto(producto.id_producto)"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>  

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


        <!-- Modal para nuevo productos y edicion-->
    <div class="modal fade" id="ModalProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="bandera==true">Nuevo Producto</h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-if="bandera==false">Editando Producto</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
             
                    <div class="card-body">
                      <form>
                      <div class="form-group">
                        <label for="">Nombre del producto</label>
                        <input required="" type="text" v-model="nombre" class="form-control" maxlength="30" id="" 
                        placeholder="Nombre">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Precio</label>
                        <input type="number" required="" v-model="precio" class="form-control" id="" placeholder="Precio">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea class="form-control" required="" v-model="descripcion" placeholder="Escribir descripcion"></textarea>
                      </div>

                       <div class="form-group">
                        <label for="" v-if="bandera==true">Categoria</label>
                        <!--  <label for="" v-if="bandera==false">Su categoria del producto es @{{categoria}}</label> -->

                        <select class="form-control" required="" v-model="id_categoriaPro">
                            <option disabled="">Elija una categoria</option>
                            <option v-bind:value="categoria.id_categoriaPro" v-for="categoria in categoriasPro">@{{categoria.categoria}}</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="" v-if="bandera==true">Almacen</label>
                         <!--   <label for="" v-if="bandera==false"> Su almacen es @{{almacen}}</label> -->
                        <select class="form-control" required="" v-model="id_almacenPro">
                            <option disabled="">Elija un almacen</option>
                            <option v-for="almacen in almacenes" v-bind:value="almacen.id_almacenPro"> Alm- @{{almacen.nombre}} de @{{almacen.ubicacion}}</option>
                           
                        </select>
                      </div>

                      </form>

                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" v-if="bandera==true" @click="GuardarProducto()">Guardar</button>
                    <button class="btn btn-primary" v-if="bandera==false"@click="ActualizarProducto()" >Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    
</div>



@endsection

@push('js')
 <script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/apis/apiProducto.js')}}"></script>

@endpush

<!-- se define este elemento inpunt con el fin de consumir la api en cualquier ruta o en cualquier equipo -->
<input type="hidden" name="route" value="{{url('/')}}">
<!-- y dentro del archivo scrip se define el codigo correspondiente para localizar o leer de que la aplicacion 
podria ser consumida o ejecutada desde cualquier medio -->