@extends('sistema.layout.index')

@section('title', 'Enviar reportes')
@section('contenido')

 {!! $errors->first('exito', '
   <div class="alert alert-danger" >:message</div>')!!}
   
<div class="row justify-content-center">
 <div class="col-auto ">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
               <a class="btn btn-danger" href="{{route('Email-history')}}">Mensajes enviados</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('EnviarEmail')}}" method="POST" enctype="multipart/form-data">

              	  {{ csrf_field() }}
  			
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Correo electronico</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email de destino" name="email" value="eduardazcorra21@gmail.com">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Asunto</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Asunto" name="asunto">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mensaje</label>
                   <textarea class="form-control" placeholder="Mensaje" name="mensaje"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Archivo de reporte</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="archivo">
                        <label class="custom-file-label" for="exampleInputFile">Selecione archivo</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Admitir</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <center><div class="card-footer ">
                  <button type="submit" class="btn btn-success">Enviar</button>
                </div></center>
              </form>
            </div>
            <!-- /.card -->
    </div>
 </div>



@endsection