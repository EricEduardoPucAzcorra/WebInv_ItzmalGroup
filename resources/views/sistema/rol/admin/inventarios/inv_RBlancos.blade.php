@extends('sistema.layout.index')

@section('title', 'Inventario Blancos')

@section('contenido')

<div id="Apiblancos" v-cloak>

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

       <p>    
                <button @click="ActivarModal()" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Nuevo</button>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> 
                Generar Reporte
            </a> -->
       </p>


         <div class="container">
        <div class="card-tools">
               <div class="col-8">  
                 <form method="post" action="{{url('InventarioBlancos/pdf')}}">
                              {{ csrf_field() }}

                              <div class="card-tools">
                                  <div class="input-group input-group-sm" >
                                  <div class="input-group col-lg-4 date js-date">
                                        <input type="text" class="form-control" name="fecha1" placeholder="Fecha" required >
                                        <button class="btn btn-secondary" hidden=""></button>
                                  </div>
                                  <span>A</span>
                                   <div class="input-group col-lg-4 date js-date">
                                        <input type="text" class="form-control" name="fecha2" placeholder="Fecha" required>
                                        <button class="btn btn-secondary" hidden=""></button>
                                  </div>
                                       
                                  <!--   <div class="input-group-append"> -->
                                      <button type="submit" class="btn btn-danger"><i class="fas fa-file-pdf"></i></button>
                                  <!--   </div> -->

                                   <a class="btn btn-info" href="{{route('Inventario/R_blancos_unitario')}}" style="margin-left: 10px;">Reporte unitario</a>
                                   
                                  </div>
                              </div>
                  </form>     
                  <br>       
              </div>
          </div>
      </div>

   <div class="">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <!--   <h3 class="card-title">Responsive Hover Table</h3> -->

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar" v-model="buscar" >
<!-- 
                    <div class="input-group col-lg-12 date Piker">
                      <input type="text" v-model="buscar" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
 -->                    
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                     <th hidden="">id_inventario</th>
                      <th>Recurso</th>
                      <th>Fecha ejecutada</th>
                      <th>Stock inicial</th>
                      <th>Entradas</th>
                      <th>Salidas</th>
                     
                      <th>Descripcion</th>
                      <th>Disponible</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="invB in filtrarInventarioB">
                     <td hidden="">@{{invB.id_inventarioDep}}</td>
                      <td>@{{invB.recursos_dep.nombre}}</td>
                      <td>@{{invB.fecha_alta}}</td>
                      <td>@{{invB.cantidad_inicial}}</td>
                      <td><span class="tag tag-success">@{{invB.entrada}}</span></td>
                      <td>@{{invB.salida}}</td>
                    
                      <td>@{{invB.descripcion}}</td>
                      <td><span class="badge badge-success ">@{{invB.total_disponible}}</span></td>
                     
                      <td><button class="btn btn-info btn-sm" @click="EditarInvB(invB.id_inventarioDep)" ><i class="fas fa-edit"></i></button> 
                        <button class="btn btn-danger btn-sm" @click="eliminarInvB(invB.id_inventarioDep)"><i class="fas fa-trash-alt"></i></button></td>
                      
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
    <div class="modal fade" id="ModalInvB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="bandera==true">Nuevo inventario de recursos de huespedes</h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-if="bandera==false">Editando inventario</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
             
                  <div class="card-body">
                   <form role="form">

                     <div class="row">
                       <div class="col-sm-6">
                         <!-- text input -->
                         <div class="form-group">
                           <label>Selecionar Recurso</label>
                           <select class="form-control" v-model="id_recursoDep" >
                             <option disabled="">Recursos blancos</option>
                             <option v-bind:value="blanco.id_recursoDep"  v-for="blanco in blancos">@{{blanco.nombre}}</option>
                           </select>
                         </div>
                       </div>
                       <div class="col-sm-6">
                         <div class="form-group">
                           <label>Fecha de alta</label>
                           <input type="text" class="form-control" placeholder="Ingrese la cantidad"  v-if="bandera==true" disabled="" v-model="fecha" >
                           <input type="text" class="form-control" placeholder="10/07/2021"  disabled="" v-model="edit_fecha" v-if="bandera==false">
                         </div>
                       </div>
                     </div>

                     <div class="row">
                       <div class="col-sm-6">
                         <!-- text input -->
                         <div class="form-group">
                           <label>Cantidad inicial</label>
                           <input type="number" class="form-control" placeholder="Ingrese la cantidad" v-model="cantidad_inicial">
                         </div>
                       </div>

                       <div class="col-sm-6">
                         <div class="form-group">
                           <label>Entradas</label>
                           <input type="number" class="form-control" placeholder="Ingrese la cantidad" v-model="entrada" >
                         </div>
                       </div>
                     </div>

                      <div class="row">
                       <div class="col-sm-6">
                         <!-- text input -->
                         <div class="form-group">
                           <label>Salidas</label>
                           <input type="number" class="form-control" placeholder=" Ingrese la cantidad" v-model="salida">
                         </div>
                       </div>
                       <div class="col-sm-6" hidden="">
                         <!-- <div class="form-group">
                           <label>Ventas</label>
                           <input type="number" class="form-control" placeholder="Ingrese la cantidad"  >
                         </div> -->
                       </div>
                     </div>
                     <div class="row">
                       <div class="col-sm-12">
                         <div class="form-group">
                           <label>Descripcion</label>
                           <textarea  class="form-control" rows="3" placeholder="Escribir..."  v-model="descripcion"></textarea >
                         </div>
                       </div>
                      
                     </div>

                     <div class="row" v-if="bandera==false">
                       <div class="col-sm-12">
                         <div class="form-group">
                           <label>Cantidad de 
                           recursos disponible</label>
                           <input type="text"  name="" v-model="total" class="form-control" disabled="">
                         </div>
                       </div>
                      
                     </div>


                   </form>
                 </div>



                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary"  v-if="bandera==true" @click="RegistrarInvB()">Guardar</button>
                    <button class="btn btn-primary" v-if="bandera==false" @click="ActualizarInvB()" >Actualizar</button>
                </div>
            </div>
        </div>
    </div>
           
</div>

@endsection

@push('js')
 <script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/apis/inventarios/apiInv_Blancos.js')}}"></script>
@endpush

<!-- se define este elemento inpunt con el fin de consumir la api en cualquier ruta o en cualquier equipo -->
<input type="hidden" name="route" value="{{url('/')}}">
<!-- y dentro del archivo scrip se define el codigo correspondiente para localizar o leer de que la aplicacion 
podria ser consumida o ejecutada desde cualquier medio -->