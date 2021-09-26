@extends('sistema.layout.index')

@section('title', 'Mensajes')
@section('contenido')

<a href="{{route('Email/create')}}" class="btn btn-info" style="margin-bottom: 10px;">Regresar</a>
<div class="col-12" style="display">
<ul class="list-group">
@foreach($mensajes as $mensaje)
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <p hidden="">{{$mensaje->id_mensaje}}</p>
    Para: {{$mensaje->email}}   
    <br> 
    Asunto: {{$mensaje->asunto}} 
    <br>
    Mensaje: {{$mensaje->mensaje}}
    <br>
    <strong>Archivo de envio : <a href="{{asset('storage'.'/'.$mensaje->archivo)}}">Ver</a></strong>
    <form method="POST" action="{{url('eliminarMensaje').'/'.$mensaje->id_mensaje}}">
     {{ csrf_field() }}
     {{ method_field('delete')}}
                              
    <span class="badge badge-pill"><button type="submit" class="btn btn-danger" 
    	onclick="return confirm('Decea eliminar el mensaje?');"
    	><i class="fas fa-trash"></i></button></span>

	</form>
  </li><br>

 @endforeach
</ul>
</div>
@endsection