@extends('sistema.layout.index')

@section('title', 'Ajustes del perfil')

@section('contenido')

 <form role="form" method="post" action="{{url('perfil/'.$usuario->id)}}" enctype="multipart/form-data">

  {{ csrf_field() }}
  {{ method_field('PATCH') }}

         <center><div class="col-sm-4 text-center"><br>
              <img class="rounded-circle"  src="{{asset('storage'.'/'.$usuario->avatar)}}" alt="" width="75px" height="75px">
          </div></center>
<br><br>
                     <div class="row">
                       <div class="col-sm-6">
                         <!-- text input -->
                         <div class="form-group">
                           <label>Nombre</label>
                           <input type="text" name="name" value="{{$usuario->name}}" class="form-control" placeholder="Nombre">
                         </div>
                       </div>
                       <div class="col-sm-6">
                         <div class="form-group">
                           <label>Apellidos</label>
                           <input type="text" class="form-control" name="apellidos"  placeholder="Apellidos" value="{{$usuario->apellidos}}">
                          
                         </div>
                       </div>
                     </div>

                     <div class="row">
                       <div class="col-sm-6">
                         <!-- text input -->
                         <div class="form-group">
                           <label>Telefono</label>
                           <input type="text" class="form-control" maxlength="10" placeholder="Telefono" name="telefono" value="{{$usuario->telefono}}">
                         </div>
                       </div>

                       <div class="col-sm-6">
                         <div class="form-group">
                           <label>Email</label>
                           <input type="email" name="email" class="form-control"  placeholder="Ingrese su correo" value="{{$usuario->email}}" >
                         </div>
                       </div>
                     </div>

                  <!--     <div class="row">
                       <div class="col-sm-6">
                        
                         <div class="form-group">
                           <label>Username</label>
                           <input type="text" class="form-control" placeholder="Username" name="username" value="{{$usuario->username}}" disabled="">
                         </div>
                       </div>

                       <div class="col-sm-6">
                         <div class="form-group">
                           <label>Password</label>
                           <input type="password" name="password" class="form-control"  placeholder="No puedes ver la contraseña , ni actualizarlo acude con el administrador de la BD" value="" disabled="">
                         </div>
                       </div>
                     </div> -->

                    <div class="row">
                      <div class="col-sm-6">
                        <a href="{{url('configurarSession')}}" class="btn btn-danger">Cambiar usuario y password</a>
                      </div>
                     </div>
    
                      <div class="form-group">
                      <label for="exampleInputFile">Agregar Avatar</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" name="avatar" >
                          <label class="custom-file-label" for="exampleInputFile">Examinar..</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Imagen</span>
                        </div>
                      </div>
                    </div>

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                   </form>

@endsection

@push('js')
 <script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>

@endpush