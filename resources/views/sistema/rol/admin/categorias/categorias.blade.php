@extends('sistema.layout.index')

@section('title', 'Categorias')

@section('contenido')


<div id="Categoria" v-cloak>
<!--   <h1>@{{prueba}}</h1> -->
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
<!-- 
                   <div class="alert alert-primary col-3"v-if="alert==false" role="alert" style="margin-left: 75%;"  id="guardar">
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
                <button @click="ActivarModal()" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Nuevo</button>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> 
                Generar Reporte
                </a> -->
            </p>
         

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text"  class="form-control float-left" placeholder="Buscar categorias" v-model="buscar">
                  </div>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th hidden="">ID</th>
                      <th>Categoria</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr v-for="categoria in filtrarCat" >
                      <td hidden="">@{{categoria.id_categoriaPro}}</td>
                      <td>@{{categoria.categoria}}</td>
                      <td><button class="btn btn-info btn-sm" @click="EditarCategoria(categoria.id_categoriaPro)"><i class="fas fa-edit"></i></button> 
                        <button class="btn btn-danger btn-sm" @click="eliminarCat(categoria.id_categoriaPro)"><i class="fas fa-trash-alt"></i></button></td>
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
    <div class="modal fade" id="ModalCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="bandera==true">Nueva categoria</h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-if="bandera==false">Editando categoria</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
             
                    <div class="card-body">
                      <form>
                        <div class="form-group">
                          <label for="">Categoria</label>
                          <input required="" type="text"  class="form-control" maxlength="50" id="" 
                          placeholder="Escriba la categoria" v-model="categoria">
                        </div>
                      </form>

                    </div> 
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" v-if="bandera==true" @click="NuevaCategoria()">Guardar</button>
                    <button class="btn btn-primary" v-if="bandera==false"@click="ActualizarCat()" >Actualizar</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')
 <script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/apis/categoria/apiCategoria.js')}}"></script>
@endpush

<!-- se define este elemento inpunt con el fin de consumir la api en cualquier ruta o en cualquier equipo -->
<input type="hidden" name="route" value="{{url('/')}}">
<!-- y dentro del archivo scrip se define el codigo correspondiente para localizar o leer de que la aplicacion 
podria ser consumida o ejecutada desde cualquier medio -->