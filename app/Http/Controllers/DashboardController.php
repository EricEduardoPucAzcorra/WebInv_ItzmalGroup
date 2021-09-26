<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Producto;

use App\Models\RecursosDepartamentales;

use App\Models\Recurso_huesped;

use Illuminate\Support\Facades\Auth;

//inventarios
use App\models\inv_product;
//inventaruio recursos huespedes
use App\Models\Inv_Recurso_Huesped;
//inventario recursos blancos
use App\Models\inv_RecursoDepartamental;
//invntario recursos lavanderia
use App\Models\InvLavanderia;

use DB;

use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function VistaDashboard(){

        $catP = Producto::count();

        $catRD= RecursosDepartamentales::count();

        $catRH = Recurso_huesped::count();

        $sumaVentaP=inv_product::sum('venta');

        $sumaVentaRH = DB::table("inv__recurso__huespeds")->get()->sum("venta");

        $date = Carbon::now();

        $fecha= $date->format('d-m-Y');

        $fecha2=$date->format('y-m-d');

        $hora=$date->format('H:i A');

         //consulta de graficacion
        $GraficaInvP=inv_product::select(\DB::raw("COUNT(*) as count"))->whereYear('fecha_alta',date('Y'))->groupBy(\DB::raw("Month(fecha_alta)"))->pluck('count');

        //traer datos en la tabla 
        //inventarios productos
        $tablaInvP=inv_product::where('fecha_alta', $fecha2)->get();
        //inventarios recursos huespedes
        $tablaInvH=Inv_Recurso_Huesped::where('fecha_alta', $fecha2)->get();
        //inventarios recursos blancos
        $tablaInvB=inv_RecursoDepartamental::where('fecha_alta', $fecha2)->get();
        //inventarios recursos lavanderia
        $tablaInvL=InvLavanderia::where('fecha_alta', $fecha2)->get();

        return view('sistema.rol.admin.inicio.inicio', compact('catP','catRD','catRH','sumaVentaP', 'sumaVentaRH','fecha','hora','GraficaInvP', 'tablaInvP','tablaInvH','tablaInvB','tablaInvL'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function GraficarInventarioP()
    {
          //consulta de graficacion
        $GraficaInvP=inv_product::select(\DB::raw("COUNT(*) as count"))->whereYear('fecha_alta',date('Y'))->groupBy(\DB::raw("Month(fecha_alta)"))->pluck('count');

          //return view('sistema.rol.admin.graficas.grafica', compact('GraficaInvP'));
    }
}
