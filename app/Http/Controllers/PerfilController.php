<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use DB;

class PerfilController extends Controller
{
    //
    public function perfil($id)
    {
        //dd($id);

        $usuario = User::find($id);

        //dd($nombre);
        return view('sistema.rol.admin.perfil.perfil', compact('usuario'));
    }

      public function update(Request $request, $id)
    {
        $user= User::find($id);

        $name = $request -> input('name');
        $apellidos = $request -> input('apellidos');
        $telefono = $request -> input('telefono');
        $email = $request -> input('email');
        //$username = $request -> input('username');
        //$password = Hash::make($request -> input('password'));

        
        $avatar='';

        // para editar imagen
        if( $request -> hasfile('avatar')){
            // necesito 
            // 1. varible que almacene la imagen antigua.
            // 2.eliminar la imagen antigua.
            // 3.insertar la nueva imagen en storage.
            // 4.hacer el update

            // ------------para traer a la imagen
            $imagen_antigua = DB::select("SELECT avatar FROM users WHERE id='$id'");
            // para borrar la imagen
            storage::delete('public/'.$imagen_antigua[0]->avatar);
            //para guardar la imagen en la BD
            $avatar = $request -> file('avatar') -> store('perfils','public');


             //actualiza la BD cuando el usuario agregue una imagen 
            DB::update(" UPDATE users SET name= '$name', apellidos= '$apellidos', telefono= '$telefono', email= '$email', avatar='$avatar' WHERE id='$id'");

            return redirect('index');          
        }

         DB::update(" UPDATE users SET name= '$name', apellidos= '$apellidos', telefono= '$telefono', email= '$email' WHERE id='$id'");

          return redirect('index'); 


       
    }

    public function vista_actualizarPassword()
    {
        // dd($id);
        //$user = User::find($id);

        $user= Auth::id();

        //dd($user);
        return view('sistema.rol.admin.perfil.update_password');

    }

    public function Actualizarpassword(Request $request)
    {
        // code...

        //conectar con imputs

        $inputs = [
            'username' => 'required',
            'mypassword' => 'required|confirmed|min:6|max:10',
            'password' => 'required',
            'confirmar_password'=>'required'
        ];
        //valido
        $validacion = Validator($inputs);
        //si la validacion falla
        if ($validacion->fails()) {
            
             return back()->withErrors(['error1'=>'Rellene los campos']);

             return redirect('configurarSession');

        }else{//de lo contrario
            //si los datos que fueron enviados por el usuario
            if (Hash::check($request->mypassword, Auth::user()->password)) {
                //instancia de user
                $user = new User;
                
                $user->where('email','=', Auth::user()->email)
                ->update([
                    'username'=>$request->username,
                    'password'=>bcrypt($request->password) 
                ]);

                return redirect('configurarSession')->with('exito', 'Actualizacion exitosa');
               
               }else{

                return redirect('configurarSession')->with('message', 'Credenciales inconrectas');
               
               }
        }

    }


}
