<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

///////////////////////////////////////////login////////////////////////////////////////////
//asigno la ruta dnde estara la visa
Route::get('/login',[App\Http\Controllers\Auth\LoginController::class,'MostrarLogin'])->name('MostrarLogin')->middleware('guest');
//metodo login
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');

Route::post('/salir', [App\Http\Controllers\Auth\LoginController::class,'salir'])->name('salir');

////////////////////////////////////////SESSION PERFIL/////////////////////////////////////////

Route::get('users', function(){
    return App\Models\User::all();
});

Route::get('/perfil/{id}',[App\Http\Controllers\PerfilController::class,'perfil'])->middleware('auth');

Route::PATCH('/perfil/{id}',[App\Http\Controllers\PerfilController::class,'update'])->middleware('auth');

Route::get('/configurarSession',[App\Http\Controllers\PerfilController::class,'vista_actualizarPassword'])->middleware('auth');

Route::put('/update/password',[App\Http\Controllers\PerfilController::class,'Actualizarpassword'])->middleware('auth');

///////////////////////////////////Index Dashboard(////////////////////////////////////)
Route::get('apiProducto', function(){
    return App\Models\inv_RecursoDepartamental::all();
});

Route::get('/index', [ App\Http\Controllers\DashboardController::class, 'VistaDashboard'])->name('index')->middleware('auth');

// Graficas para inventarios

//Route::get('sistema.rol.admin.graficas.grafica', [App\Http\Controllers\DashboardController::class,'GraficarInventarioP'])->name('graficas')->middleware('auth');

///////////////////////areas de apis en productos/////////////////////////
//VISTA
Route::get('/productos', [ App\Http\Controllers\ProductoController::class, 'return'])->name('productos')->middleware('auth');
//API
Route::apiResource('/apiProducto', App\Http\Controllers\ProductoController::class);

Route::get('Pdf-productos',[ App\Http\Controllers\ProductoController::class, 'ReporteProductos'])->middleware('auth');
////////////////////////session Recursos huespedes/////////////////////

//VISTA
Route::get('/recursosHuesped', [ App\Http\Controllers\RecursoHuespedController::class, 'vista'])->name('recursosHuesped')->middleware('auth');
//Api
Route::apiResource('/apiRecursoH', App\Http\Controllers\RecursoHuespedController::class);


Route::get('Pdf-R_Huesped',[ App\Http\Controllers\RecursoHuespedController::class, 'PDFR_Huesped'])->middleware('auth');


////////////////////////////session Recursos Blancos////////////////////////////////////

//vista
Route::get('/recursosBlancos', [ App\Http\Controllers\RecursosDepartamentalesController::class, 'vistaBlancos'])->name('recursosBlancos')->middleware('auth');
//api
Route::apiResource('/apiRecursoD', App\Http\Controllers\RecursosDepartamentalesController::class);

Route::get('Pdf-R_Blancos',[ App\Http\Controllers\RecursosDepartamentalesController::class, 'PdfR_Blancos'])->middleware('auth');

/////////////////////////////////session lavanderia//////////////////////////////
//vista
Route::get('/recursosLavanderia', [ App\Http\Controllers\RecursosLavanderiaController::class, 'vistaRL'])->name('recursosLavanderia')->middleware('auth');
//api
Route::apiResource('/apiRecursosL', App\Http\Controllers\RecursosLavanderiaController::class);

Route::get('Pdf-R_Lavanderia',[ App\Http\Controllers\RecursosLavanderiaController::class, 'PDF_RecursosLavado'])->middleware('auth');

////////////////////////////////sesion almacenes//////////////////////////////////
//almacenes productos vista
Route::get('/almacens_productos', [ App\Http\Controllers\AlmacenProductController::class, 'vista_A_producto'])->name('almacens_productos')->middleware('auth');
//api
//almacen 1
Route::apiResource('/almacenes', App\Http\Controllers\AlmacenProductController::class);

/////////////////////////////almacen Recursos huespedes//////////////////////////////// 
// vista
Route::get('/almacens_huepedes', [ App\Http\Controllers\AlmacenRecursoHuespedController::class, 'vista_RH'])->name('almacens_huepedes')->middleware('auth');
//almacen 2 api
Route::apiResource('/apiAlmacenRH', App\Http\Controllers\AlmacenRecursoHuespedController::class);

/////////////////////////7//almacen recursos departamentales//////////////////////////////////
// vista
Route::get('/almacens_Departamentales', [ App\Http\Controllers\AlmacenRecursosDepartamentalesController::class, 'vista_RD'])->name('almacens_Departamentales')->middleware('auth');
//almacen 3
Route::apiResource('/apiAlmacenD', App\Http\Controllers\AlmacenRecursosDepartamentalesController::class);

///////////////////////////////////////almacenes lavanderia/////////////////////////////////////
// vista
Route::get('/almacens_lavanderia', [ App\Http\Controllers\AlmacenLavanderiaController::class, 'Vista_RL'])->name('almacens_lavanderia')->middleware('auth');
//almacen 4
Route::apiResource('/apiAlmacenL', App\Http\Controllers\AlmacenLavanderiaController::class);

//////////////////////////////////Sesion categorias/////////////////////////////////
//vista
Route::get('/categorias', [ App\Http\Controllers\CategoriaProductController::class, 'CategoriasVista'])->name('categorias')->middleware('auth');
//Api
Route::apiResource('/CategoriaProducto', App\Http\Controllers\CategoriaProductController::class);

/////////////////////////Sesion Inventarios (//////////////////////////////////////////////////)

Route::get('/invP', function(){
    return App\Models\inv_product::all();
});
///////////////////////////////////Session inventarios productos/////////////////////////////
//index
Route::get('/inv_products', [ App\Http\Controllers\InvProductController::class, 'vistaInv'])->name('inv_products')->middleware('auth');
//apiInv
Route::apiResource('/apiInvProducto', App\Http\Controllers\InvProductController::class)->middleware('auth');
//pdf
Route::post('Inventario/pdf', [App\Http\Controllers\InvProductController::class,'ReporteInvP'])->middleware('auth');
//pdf unitario productos
Route::get('Inventario/Product_unitario', [App\Http\Controllers\Reporte_unitarioController::class,'returnViewInvP'])->name('Inventario/Product_unitario')->middleware('auth');

Route::post('ReporteProductos/unitario', [App\Http\Controllers\Reporte_unitarioController::class,'obtenerReporte'])->name('ReporteProductos/unitario')->middleware('auth');

//reporte unitario reportes huespedes
Route::get('Inventario/RHuesped_unitario', [App\Http\Controllers\Reporte_unitarioController::class,'Inv_RHuespedUni'])->name('Inventario/RHuesped_unitario')->middleware('auth');

Route::post('ReporteHuesped/unitario', [App\Http\Controllers\Reporte_unitarioController::class,'ReporteUnitarioRH'])->name('ReporteHuesped/unitario')->middleware('auth');

//reporte unitario inv blancos
Route::get('Inventario/R_blancos_unitario', [App\Http\Controllers\Reporte_unitarioController::class,'Inv_RBlancosUni'])->name('Inventario/R_blancos_unitario')->middleware('auth');

Route::post('ReporteBlanco/unitario', [App\Http\Controllers\Reporte_unitarioController::class,'ReporteBuni'])->name('ReporteBlanco/unitario')->middleware('auth');
//reporte unitario de lavanderia.
Route::get('Inventario/R_lavanderia_unitario', [App\Http\Controllers\Reporte_unitarioController::class,'Inv_RLavanderiaUni'])->name('Inventario/R_lavanderia_unitario')->middleware('auth');
Route::post('ReporteLavanderia/unitario', [App\Http\Controllers\Reporte_unitarioController::class,'inv_RL'])->name('ReporteLavanderia/unitario')->middleware('auth');


/////////////////sesion inventarios recursos Huespedes/////////////////////////////
//vista
Route::get('/inv_R_Huesped', [ App\Http\Controllers\InvRecursoHuespedController::class, 'vistaInvRH'])->name('inv_R_Huesped')->middleware('auth');
//apiInv
Route::apiResource('/apiInvHuesped', App\Http\Controllers\InvRecursoHuespedController::class);

//pdf
Route::post('InventarioHuesped/pdf', [App\Http\Controllers\InvRecursoHuespedController::class,'ReporteInvH'])->middleware('auth');

/////////////////////////////////////7Session inventario blancos///////////////////
//vista
Route::get('/inv_R_Blancos', [ App\Http\Controllers\InvRecursoDepartamentalController::class, 'VistaInvRB'])->name('inv_R_Blancos')->middleware('auth');
//api
Route::apiResource('/apiInvBlancos', App\Http\Controllers\InvRecursoDepartamentalController::class);

//pdf
Route::post('InventarioBlancos/pdf', [App\Http\Controllers\InvRecursoDepartamentalController::class,'ReporteBlancos'])->middleware('auth');


/////////////////////////////////Session inventario lavanderia//////////////////////

//vista
Route::get('/inv_R_lavanderia', [ App\Http\Controllers\InvLavanderiaController::class, 'vistaInvLav'])->name('inv_R_lavanderia')->middleware('auth');
//api
Route::apiResource('/apiInvLavado', App\Http\Controllers\InvLavanderiaController::class);

//pdf
Route::post('InventarioLavanderia/pdf', [App\Http\Controllers\InvLavanderiaController::class,'ReporteInvL'])->middleware('auth');


/////////////////////////////////////////////////////////////////////////////////////////////////
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//////////////////////////////manual//////////////////////////////////////////////////////////////////////

// Route::get('/manual', function(){
//     return dd('Funciona');
// });
//pdf
Route::get('/manual', [App\Http\Controllers\PdfManualController::class,'manual'])->middleware('auth');


//////////////////////////////////Sesion Email//////////////////////////////////////////////////////////////

// Route::get('Email/create', function(){
//     return view('sistema.rol.admin.email.enviarEmail');
// });

Route::get('/Email/create', [ App\Http\Controllers\EmailController::class, 'vista'])->name('Email/create')->middleware('auth');


Route::post('/EnviarEmail', [ App\Http\Controllers\EmailController::class, 'store'])->name('EnviarEmail')->middleware('auth');

Route::get('/Email-history', [ App\Http\Controllers\EmailController::class, 'historialMensajes'])->name('Email-history')->middleware('auth');


Route::delete('/eliminarMensaje/{id}', [ App\Http\Controllers\EmailController::class, 'eliminarMensaje'])->name('eliminarMensaje/{id}')->middleware('auth');
