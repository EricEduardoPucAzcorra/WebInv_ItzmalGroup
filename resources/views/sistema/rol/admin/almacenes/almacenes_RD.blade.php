@extends('sistema.layout.index')

@section('title', 'Almacenes de recursos departamentales')

@section('contenido')


<div id="AlmacenD" v-cloak>
<!--     <p>@{{prueba}}</p> -->

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

                  <!--   <div class="alert alert-primary col-3"v-if="alert==false" role="alert" style="margin-left: 75%;"  id="guardar">
                        Guardado con exito.
                  </div>       

   
                  
                   <div class="alert alert-danger col-3" v-if="eliminado==false" role="alert" style="margin-left: 75%;"  id="eliminado">
                        Eliminacion exitoso.
                   </div>
                     



                    <div class="alert alert-success col-3" v-if="actualizado==false" role="alert" style="margin-left: 75%;"  id="actualizado">
                        Actualizado con exito
                   </div>   -->

<div class="col-12">
    <div>
        <button class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm" @click="ActivarForm()" v-if="form==true" >Nuevo</button> 
       <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generar Reporte
        </a> -->
    </div>
</div><br>
<div class="col-12" v-if="form==false"> 
    <div class="card">
        <div class="card-body">
         <!--    <form> -->
              
             <!--    <legend></legend> -->
                <div class="mb-3">
                  <label for="disabledTextInput" class="form-label">Nombre del almacen</label>
                  <input type="text" id="disabledTextInput" class="form-control" placeholder="Nombre" v-model="nombre">
                  <br>
                   <label>Ubicacion</label>
                   <select class="form-control" v-model="ubicacion">
                       <option>Rinconada</option>
                       <option>Villa san antonio</option>
                       <option>Tuul</option>
                       <option>Zamna</option>
                   </select>
                </div>
                <button  class="btn btn-primary" @click="NuevoAlmacenD()" v-if="submit==true">Guadar</button>
                <button  class="btn btn-info" @click="ActualizarAlmacenD()" v-if="submit==false">Actulizar</button>
                <button  class="btn btn-danger" @click="cancelarForm()">Cancelar</button>

       <!--      </form> -->
        </div>
    </div>

</div>


<br>
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th >ID</th>
                      <th>Nombre</th>
                      <th>Ubicacion</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr v-for="AlmacenD in R_departamentales" >
                      <td >@{{AlmacenD.id_almacenDep}}</td>
                      <td>@{{AlmacenD.nombre}}</td>
                      <td><span class="tag tag-success">@{{AlmacenD.ubicacion}}</span></td>
                      <td><button class="btn btn-info btn-sm" @click="EditarAlmacenD(AlmacenD.id_almacenDep)"><i class="fas fa-edit"></i></button> 
                        <button class="btn btn-danger btn-sm" @click="EliminarAlmacenD(AlmacenD.id_almacenDep)"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>  

                  </tbody>
                </table>
              </div>

</div>



@endsection

@push('js')
 <script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/apis/almacenes/apiAlmacenDepartamental.js')}}"></script>
@endpush

<!-- se define este elemento inpunt con el fin de consumir la api en cualquier ruta o en cualquier equipo -->
<input type="hidden" name="route" value="{{url('/')}}">
<!-- y dentro del archivo scrip se define el codigo correspondiente para localizar o leer de que la aplicacion 
podria ser consumida o ejecutada desde cualquier medio -->