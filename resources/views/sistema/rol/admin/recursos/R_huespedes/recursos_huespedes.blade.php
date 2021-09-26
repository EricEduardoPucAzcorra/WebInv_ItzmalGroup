@extends('sistema.layout.index')

@section('title', 'Recursos huespedes')

@section('contenido')

<div id="recurso" v-cloak>
<!-- 	<h1>@{{prueba}}</h1> -->
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

                   <!-- <div class="alert alert-primary col-3"v-if="alert==false" role="alert" style="margin-left: 75%;"  id="guardar">
                              Guardado con exito.
                    </div>       

   
                  
                   <div class="alert alert-danger col-3" v-if="eliminado==false" role="alert" style="margin-left: 75%;"  id="eliminado">
                        Eliminacion exitoso.
                   </div>
                     



                    <div class="alert alert-success col-3" v-if="actualizado==false" role="alert" style="margin-left: 75%;"  id="actualizado">
                        Actualizado con exito
                   </div>   -->
        <div class="">
          <div class="col-12">
            <div class="card">
            <div class="card-header">
             <!--    <h3 class="card-title">Fixed Header Table</h3> -->
             <p>    
                <button  class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm" @click="ActivarModal()">
                Nuevo</button>
                <a href="{{url('Pdf-R_Huesped')}}" class=" d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> 
                Generar Reporte
            </a>
            </p>
         

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text"  class="form-control float-left" placeholder="Buscar productos" v-model="buscar">
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
                      <th>Almacen</th>
                      <th>Categoria</th>
                    <!--   <th>Categoria</th>
                      <th>Almacen</th> -->
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr v-for="recursoH in filtrarRecurso" >
                      <td hidden="">@{{recursoH.id_RHuesped}}</td>
                      <td>@{{recursoH.nombre}}</td>
                      <td>@{{recursoH.categoria_r_h.categoria}}</td>
                      <td><span class="tag tag-success">@{{recursoH.almacen_r_h.nombre}}</span></td>
                      <td><button class="btn btn-info btn-sm" @click="EditarRecurso(recursoH.id_RHuesped)"><i class="fas fa-edit"></i></button> 
                        <button class="btn btn-danger btn-sm" @click="EliminarRecursoH(recursoH.id_RHuesped)"><i class="fas fa-trash-alt"></i></button></td>
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
    <div class="modal fade" id="ModalRecurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="bandera==true" id="exampleModalLabel" >Nuevo recurso para el huesped</h5>
                    <h5 class="modal-title" v-if="bandera==false" id="exampleModalLabel">Editando recurso</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
             
                    <div class="card-body">
                      <form>
                      <div class="form-group">
                        <label for="">Nombre del recurso</label>
                        <input required="" type="text"  class="form-control" maxlength="30" id="" 
                        placeholder="Nombre" v-model="nombre">
                      </div>
                      

                       <div class="form-group">
                        <label for="" >Categoria</label>
                         <select class="form-control" required="" v-model="id_categoriaPro">
                            <option disabled="">Elija una categoria</option>
                            <option v-bind:value="categoria.id_categoriaPro" v-for="categoria in categoriasPro">@{{categoria.categoria}}</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="" v-if="">Almacen</label>
                       
                        <select class="form-control" required="" v-model="id_AlmacenRHuesped">
                            <option disabled="" >Elija un almacen</option>
                            <option v-for="almacen in almcenesH" v-bind:value="almacen.id_AlmacenRHuesped"> @{{almacen.nombre}} de @{{almacen.ubicacion}}</option>
                           
                        </select>
                      </div>

                      </form>

                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary"  v-if="bandera==true" @click="GuardarRecurso">Guardar</button>
                    <button class="btn btn-primary" v-if="bandera==false" @click="ActualizarRecurso()" >Actualizar</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')
 <script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/apis/apiRecursoHuesped.js')}}"></script>
@endpush


<!-- se define este elemento inpunt con el fin de consumir la api en cualquier ruta o en cualquier equipo -->
<input type="hidden" name="route" value="{{url('/')}}">
<!-- y dentro del archivo scrip se define el codigo correspondiente para localizar o leer de que la aplicacion 
podria ser consumida o ejecutada desde cualquier medio -->