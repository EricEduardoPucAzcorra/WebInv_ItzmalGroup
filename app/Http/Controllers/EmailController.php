<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//librerias 
use App\Mail\MensajeRecibido;
//use Email
use Illuminate\Support\Facades\Mail;
//modelo
use App\Models\MensajeEmail;
//storage
use Illuminate\Support\Facades\Storage;

use DB;

class EmailController extends Controller
{
    //
    //clase para implemenetar el envio de gmail
    public function vista(){
         return view('sistema.rol.admin.email.enviarEmail');
    }
    //
    //clase para implemenetar el envio de gmail
    public function store(Request $request){
        //controler
        $message = array(

            'email'=>$request->input('email'),
            'asunto'=>$request->input('asunto'),
            'mensaje'=>$request->input('mensaje'),
            'archivo'=>$request->file('archivo')

        );

        $email=$request->input('email');
        $asunto=$request->input('asunto');
        $mensaje=$request->input('mensaje');
        $archivo;

        if( $request -> hasfile('archivo')){
            // le estoy diciendo que la imagen va hacer igual al request y que guarde la imagen en una carpta..
            $archivo = $request -> file('archivo') -> store('archivos','public');
            // luego procedo a irme en storaje ->app->public-> y creo la carpeta para guardar la imagen
        }else{
            // si no le stoy mandando imagen
        $imagen ="";
        }
        DB::insert("INSERT INTO mensaje_emails(email, asunto, mensaje, archivo) VALUES('$email','$asunto','$mensaje','$archivo')");

        Mail::to($message['email'])->send(new MensajeRecibido($message));

        return back()->withErrors(['exito'=>'Se envio con exito.']);

        return redirect()->route('Email/create');
        

    }

    public function historialMensajes()
    {
         $mensajes=MensajeEmail::orderBy('id_mensaje','desc')->get();

          return view('sistema.rol.admin.email.historial_emails', compact('mensajes'));
    }

    public function eliminarMensaje($id){
        // dd($id);

        //eliminar usuarios.
        $archivo = DB::select("SELECT archivo FROM mensaje_emails WHERE id_mensaje='$id'");

        if( $archivo[0] ->archivo ==""){
            
        DB::delete("DELETE FROM mensaje_emails WHERE id_mensaje='$id'");

        }else{
            // borra de un VEZ La imagen que el usuario tiene asociada
            storage::delete('public/'.$archivo[0]->archivo);

            DB::delete("DELETE FROM mensaje_emails WHERE id_mensaje='$id'");
        }

        
        return redirect()->route('Email-history');
    }
}
