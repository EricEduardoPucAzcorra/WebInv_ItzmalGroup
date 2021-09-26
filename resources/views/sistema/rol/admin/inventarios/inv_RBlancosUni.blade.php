@extends('sistema.layout.index')

@section('title', 'Inventario unitariorecursos blancos')

@section('contenido')

<div class="">
 <div class="col-auto ">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('ReporteBlanco/unitario')}}" method="POST" >

              	  {{ csrf_field() }}
  			
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Producto de eleccion</label>
                    
                    <select class="form-control" name="id_inventarioDep">	
                    	
                      <option disabled="">Elige el producto</option>
                    @foreach($recursoD as $RB)
                    	<option value="{{$RB->id_recursoDep}}">{{$RB->nombre}}</option>
                    @endforeach
                    </select>
                
                  </div>
                  <div class="form-group date js-date">
                    <label for="exampleInputPassword1">Fecha inicial</label>
                   <input class="form-control" type="text" placeholder="Fecha1" name="fecha1" required="">
                   <button class="btn btn-secondary" hidden=""></button>
                  </div>
                  <div class="form-group date js-date">
                    <label for="exampleInputPassword1">Fecha final</label>
                   <input class="form-control" type="text" placeholder="Fecha2" name="fecha2" required="">
                   <button class="btn btn-secondary" hidden=""></button>
                  </div>
                </div>
                <!-- /.card-body -->

                <center><div class="card-footer ">
                  <button type="submit" class="btn btn-warning">Extraer reporte</button>
                </div></center>
              </form>
            </div>
            <!-- /.card -->
    </div>
 </div>


@endsection