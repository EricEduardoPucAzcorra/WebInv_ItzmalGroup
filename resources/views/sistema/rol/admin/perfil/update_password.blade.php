@extends('sistema.layout.index')

@section('title', 'Actualizar usuario y password')

@section('contenido')
<div class="card">
  <div class="card-body">

    {!! $errors->first('error1', '<div class="alert alert-danger" >:message</div>')!!}

     @if(Session::has('exito'))
    <div class="alert alert-info">{{Session::get('exito')}}</div>
    @endif

    @if(Session::has('message'))
    <div class="alert alert-danger">{{Session::get('message')}}</div>
    @endif
  
  <form role="form" action="{{url('/update/password')}}" method="POST">
  {{ csrf_field() }}
  {{ method_field('PUT') }}

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Usuario</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username" id="inputEmail3" placeholder="" value="{{ Auth::user()->username }}" required="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password actual</label>
    <div class="col-sm-10">
      <!-- <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="mypassword" required=""> -->

      <input type="password" name="mypassword" class="form-control password1" required="" placeholder="Password" />
      <span class="fa fa-fw fa-eye password-icon show-password"></span>

    </div>
  </div>

 <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password nuevo</label>
    <div class="col-sm-10">
      <!-- <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password nuevo"required="">
 -->
        <input type="password" name="password" required="" class="form-control password2"  placeholder="Password nuevo" />
      <span class="fa fa-fw fa-eye password-icon show-password"></span>

    </div>
  </div>

<div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Confirmar password nuevo</label>
    <div class="col-sm-10">
     <!--  <input type="password" name="confirmar_password" class="form-control" id="inputPassword3" placeholder="Confirmar password" required=""> -->

        <input type="password" name="confirmar_password"  required="" class="form-control password3"  placeholder="Confirmar password" />
      <span class="fa fa-fw fa-eye password-icon show-password"></span>

    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-info">Actualizar</button>
    </div>
  </div>
</form>
  </div> 
</div>


@endsection
