<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
   
  public $rol;
  //contructor del middlware

 public function __construct() {
   $this->middleware('guest', ['only'=>'MostrarLogin']);
 }

  //metodo para no motsrar al usuario autenticado el login
  public function MostrarLogin()
  {
   return view('auth.login');
  }

 //metodo login para el login 
 public function login()
 {
      //validamos los datos del formulario 

      $credenciales = $this->validate(request(), [
        //validamos los datos  
        'username'=>'required|string',
        'password'=>'required|string'

      ]);

    //return $credenciales;

   
    if(Auth::attempt($credenciales)){
     

      return redirect('index');
   
    }
    return back()->withErrors(['Credenciales'=>'Estas credenciales no coiciden con nuestros registros! Inserte datos validos.']);

 }
 //metodo para salir o cerrar session
 public function salir(){
   
  Auth::logout();
   
   return redirect('/login');

 }
}
