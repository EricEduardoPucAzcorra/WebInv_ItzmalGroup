@extends('sistema.layout.index')

@section('title', 'Inventario Productos')

@section('contenido')
<div id="invP">
   <div class="card-header">
                <p class="card-title">Generar inventario de productos</p>
   </div>

  
      <input type="text" name="" v-model="fecha">



      <div class="card">
              <div class="card-body">
                <form role="form">

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Selecionar Producto</label>
                        <select class="form-control">
                          <option>Productos</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Fecha de alta</label>
                        <input type="date" class="form-control" placeholder="Ingrese la cantidad" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Cantidad inicial</label>
                        <input type="number" class="form-control" placeholder="Ingrese la cantidad">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Entradas</label>
                        <input type="number" class="form-control" placeholder="Ingrese la cantidad" >
                      </div>
                    </div>
                  </div>

                   <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Salidas</label>
                        <input type="number" class="form-control" placeholder=" Ingrese la cantidad">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Ventas</label>
                        <input type="number" class="form-control" placeholder="Ingrese la cantidad" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Descripcion</label>
                        <textarea class="form-control" rows="3" placeholder="Escribir..."></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Textarea Disabled</label>
                        <!-- <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea> -->
                        <button>Guardar</button>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
</div>

           
</div>

@endsection

@push('js')
 <script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/apis/inventarios/apiInv_producto.js')}}"></script>
@endpush