<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;

use App\Models\Recurso_huesped;

use App\Models\RecursosDepartamentales;

use App\Models\RecursosLavanderia;

use App\Models\inv_product;

use App\Models\Inv_Recurso_Huesped;

use App\Models\inv_RecursoDepartamental;

use App\Models\InvLavanderia;

use Codedge\Fpdf\Fpdf\Fpdf;

use Carbon\Carbon;

class Reporte_unitarioController extends Controller
{
    //inventarios productos

    public function returnViewInvP()
    {
        $productos = Producto::all();

        return view('sistema.rol.admin.inventarios.inv_product_reporteUni', compact('productos'));
    }

    public function obtenerReporte(Request $request)
    {
        $id_producto = $_REQUEST['id_producto'];
        $fecha1 = $_REQUEST['fecha1'];
        $fecha2 = $_REQUEST['fecha2'];

        $consultaInv = inv_product::where('id_producto', $id_producto)
        ->where("fecha_alta",">=",$fecha1)
        ->where("fecha_alta","<=",$fecha2)->get();

        $sumaEntrada=$consultaInv->SUM('entrada');

        $sumaSalida=$consultaInv->SUM('salida');

        $sumaVenta=$consultaInv->SUM('venta');

        // dd($sumaVenta);


            //carbon
        $now =  Carbon::now();

        $dia=$now->format('d');

        $mes=$now->format('m');

        $anio=$now->format('y');

        


        $pdf = new Fpdf('P','mm','A4');
        $pdf->AddPage();

             //---------------------------------------------------------------------------------------
        ///-------------------------------------------cuerpo de contenido-------------------------

                
        //-------------------Encabeza-----------------------

        //zona fecha------
        $pdf->SetFont('Arial','',10,6);

        $pdf->Cell(150,1,'',0,0);
    
        //comando para color en la tabla
        $pdf->SetFillColor(244, 168, 61 );

        $pdf->Cell(40,7,'Fecha',1,0,'C',1);

        $pdf->ln(7);
        // tablita de fecha
        //margen 
        $pdf->Cell(150,1,'',0,0);
        $pdf->Cell(13.3,7,"$dia",1,0,'C');
        $pdf->Cell(13.3,7,"$mes",1,0,'C');
        $pdf->Cell(13.3,7,"$anio",1,0,'C');

        //fin de la zona fecha-----

        $pdf->SetFont('Arial','',16,6);

        $pdf->image(public_path().'/images/Grupo-izamal-1024x589.png', 90,5,25,25);

        $pdf->ln(15);

        $pdf->Cell(188,7, utf8_decode('Inventario Grupo Izamal'),'B',1,'C',1);


        //---------------------FIn del encabezado-------------------------------


        ///-----------------------------------lista de informacion personal--------------------------------------
        $pdf->SetFont('Arial','',14,6);
        //----------------------------------Informacion del hotel---------------------------------------
        //Informacion del hotel
        $pdf->ln(3);
        $pdf->Cell(50,7,'',0,0,'C');
        $pdf->Cell(7,7,'',0,0,'L');
        $pdf->Cell(70,7,'"Grupo Izamal"',0,0,'C');
        //espacio de fecha a fecha
        $pdf->ln(9);
        $pdf->Cell(30,7,'',0,0,'C');
        $pdf->Cell(30,7,"De $fecha1  a $fecha2",0,0,'C'); 
        $pdf->Cell(7,7,'',0,0,'L');
        //espacio para definir el nombre del encargado
      
        //Nota
        $pdf->ln(9);
        $pdf->Cell(3.5,7,'',0,0,'C');
        $pdf->Cell(30,7,'Nota:',0,0,'C'); 
        $pdf->Cell(-7,7,'',0,0,'L');
        $pdf->Cell(70,7, utf8_decode('Informacion exportada a travez del sistema.'),0,0,'L');

        //----------------------------------fin de la informacion del hotel----------------------------------

        $pdf->ln(5);
        $pdf->SetFont('Arial','',12,6);
        $pdf->ln(2);



        //-------------------------------tabla de dat0s---------------------------------------

        //------------------------------------Encabezado de la tabla superior------------------------------------
        //MARGEB INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(175, 7 , "Inventario de productos de $fecha1  al $fecha2", 1, 1,'C',1);
        //MARGEN INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(40, 7 , 'Producto', 1, 0,'C');
        $pdf->Cell(30, 7 , 'Fecha alta', 1, 0,'C');
        $pdf->Cell(10, 7 , 'C', 1, 0,'C');
        $pdf->Cell(10, 7 , 'E', 1, 0,'C');
        $pdf->Cell(10, 7 , 'S', 1, 0,'C');
        $pdf->Cell(10, 7 , 'V', 1, 0,'C');
        $pdf->Cell(10, 7 , 'D', 1, 0,'C');
        $pdf->Cell(55, 7 , 'Descripcion', 1, 1,'C');

        //---------------------------------fin de encabezado superior-------------------------

        $alt=7;



        //-------------------------------tabla de dat0s---------------------------------------
        //datos de la lista de asistencia
        $pdf->SetFont('Arial','',8,6);

       foreach ($consultaInv as $invp) {
        $pdf->Cell(10,$alt,'',0,0);

        $pdf->Cell(40,$alt,$invp->productos->nombre,1,0,'C');
        $pdf->Cell(30,$alt,utf8_decode($invp->fecha_alta),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invp->cantidad_inicial),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invp->entrada),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invp->salida),1,0,'C'); 
        $pdf->Cell(10,$alt,utf8_decode($invp->venta),1,0,'C'); 
        $pdf->Cell(10,$alt,utf8_decode($invp->total),1,0,'C'); 
        $pdf->Cell(55,$alt,utf8_decode($invp->descripcion),1,1,'C'); 
        }

        $pdf->SetFillColor(244, 168, 61 );

        $pdf->Cell(10,$alt,'',0,0);
        $pdf->Cell(40,$alt,utf8_decode('Entradas: '.$sumaEntrada),1,0,'C',1);
        $pdf->Cell(40,$alt,utf8_decode('Salidas: '.$sumaSalida),1,0,'C',1); 
        $pdf->Cell(40,$alt,utf8_decode('Ventas: '.$sumaVenta),1,1,'C',1); 

        $pdf->Output();
        exit();

    }

    //inventario recursos 

    public function Inv_RHuespedUni()
    {
        $R_huespeds = Recurso_huesped::all();

        return view('sistema.rol.admin.inventarios.inv_RHuespedesUni', compact('R_huespeds'));
    }

    public function ReporteUnitarioRH(Request $request){
        $id_RHuesped = $_REQUEST['id_RHuesped'];
        $fecha1 = $_REQUEST['fecha1'];
        $fecha2 = $_REQUEST['fecha2'];

        $consultaInv = Inv_Recurso_Huesped::where('id_RHuesped', $id_RHuesped)
        ->where("fecha_alta",">=",$fecha1)
        ->where("fecha_alta","<=",$fecha2)->get();


        $sumaEntrada=$consultaInv->SUM('entrada');

        $sumaSalida=$consultaInv->SUM('salida');

        $sumaVenta=$consultaInv->SUM('venta');

        // dd($sumaVenta);


            //carbon
        $now =  Carbon::now();

        $dia=$now->format('d');

        $mes=$now->format('m');

        $anio=$now->format('y');

        


        $pdf = new Fpdf('P','mm','A4');
        $pdf->AddPage();

             //---------------------------------------------------------------------------------------
        ///-------------------------------------------cuerpo de contenido-------------------------

                
        //-------------------Encabeza-----------------------

        //zona fecha------
        $pdf->SetFont('Arial','',10,6);

        $pdf->Cell(150,1,'',0,0);
    
        //comando para color en la tabla
        $pdf->SetFillColor(244, 168, 61 );

        $pdf->Cell(40,7,'Fecha',1,0,'C',1);

        $pdf->ln(7);
        // tablita de fecha
        //margen 
        $pdf->Cell(150,1,'',0,0);
        $pdf->Cell(13.3,7,"$dia",1,0,'C');
        $pdf->Cell(13.3,7,"$mes",1,0,'C');
        $pdf->Cell(13.3,7,"$anio",1,0,'C');

        //fin de la zona fecha-----

        $pdf->SetFont('Arial','',16,6);

        $pdf->image(public_path().'/images/Grupo-izamal-1024x589.png', 90,5,25,25);

        $pdf->ln(15);

        $pdf->Cell(188,7, utf8_decode('Inventario Grupo Izamal'),'B',1,'C',1);


        //---------------------FIn del encabezado-------------------------------


        ///-----------------------------------lista de informacion personal--------------------------------------
        $pdf->SetFont('Arial','',14,6);
        //----------------------------------Informacion del hotel---------------------------------------
        //Informacion del hotel
        $pdf->ln(3);
        $pdf->Cell(50,7,'',0,0,'C');
        $pdf->Cell(7,7,'',0,0,'L');
        $pdf->Cell(70,7,'"Grupo Izamal"',0,0,'C');
        //espacio de fecha a fecha
        $pdf->ln(9);
        $pdf->Cell(30,7,'',0,0,'C');
        $pdf->Cell(30,7,"De $fecha1  a $fecha2",0,0,'C'); 
        $pdf->Cell(7,7,'',0,0,'L');
        //espacio para definir el nombre del encargado
      
        //Nota
        $pdf->ln(9);
        $pdf->Cell(3.5,7,'',0,0,'C');
        $pdf->Cell(30,7,'Nota:',0,0,'C'); 
        $pdf->Cell(-7,7,'',0,0,'L');
        $pdf->Cell(70,7, utf8_decode('Informacion exportada a travez del sistema.'),0,0,'L');

        //----------------------------------fin de la informacion del hotel----------------------------------

        $pdf->ln(5);
        $pdf->SetFont('Arial','',12,6);
        $pdf->ln(2);



        //-------------------------------tabla de dat0s---------------------------------------

        //------------------------------------Encabezado de la tabla superior------------------------------------
        //MARGEB INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(175, 7 , "Inventario de recursos huespedes de $fecha1  al $fecha2", 1, 1,'C',1);
        //MARGEN INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(40, 7 , 'Producto', 1, 0,'C');
        $pdf->Cell(30, 7 , 'Fecha alta', 1, 0,'C');
        $pdf->Cell(10, 7 , 'C', 1, 0,'C');
        $pdf->Cell(10, 7 , 'E', 1, 0,'C');
        $pdf->Cell(10, 7 , 'S', 1, 0,'C');
        $pdf->Cell(10, 7 , 'V', 1, 0,'C');
        $pdf->Cell(10, 7 , 'D', 1, 0,'C');
        $pdf->Cell(55, 7 , 'Descripcion', 1, 1,'C');

        //---------------------------------fin de encabezado superior-------------------------

        $alt=7;



        //-------------------------------tabla de dat0s---------------------------------------
        //datos de la lista de asistencia
        $pdf->SetFont('Arial','',8,6);

       foreach ($consultaInv as $invRH) {
        $pdf->Cell(10,$alt,'',0,0);

        $pdf->Cell(40,$alt,$invRH->recursos_h->nombre,1,0,'C');
        $pdf->Cell(30,$alt,utf8_decode($invRH->fecha_alta),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invRH->cantidad_inicial),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invRH->entrada),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invRH->salida),1,0,'C'); 
        $pdf->Cell(10,$alt,utf8_decode($invRH->venta),1,0,'C'); 
        $pdf->Cell(10,$alt,utf8_decode($invRH->total_disponible),1,0,'C'); 
        $pdf->Cell(55,$alt,utf8_decode($invRH->descripcion),1,1,'C'); 
        }

        $pdf->SetFillColor(244, 168, 61 );

        $pdf->Cell(10,$alt,'',0,0);
        $pdf->Cell(40,$alt,utf8_decode('Entradas: '.$sumaEntrada),1,0,'C',1);
        $pdf->Cell(40,$alt,utf8_decode('Salidas: '.$sumaSalida),1,0,'C',1); 
        $pdf->Cell(40,$alt,utf8_decode('Ventas: '.$sumaVenta),1,1,'C',1); 

        $pdf->Output();
        exit();


    }

    public function Inv_RBlancosUni(){
        $recursoD = RecursosDepartamentales::all();

       return view('sistema.rol.admin.inventarios.inv_RBlancosUni', compact('recursoD'));
    }

    public function ReporteBuni(Request $request){
        //id_inventarioDep
        $id_inventarioDep = $_REQUEST['id_inventarioDep'];
        $fecha1 = $_REQUEST['fecha1'];
        $fecha2 = $_REQUEST['fecha2'];


        $consultaInv = inv_RecursoDepartamental::where('id_inventarioDep', $id_inventarioDep)
        ->where("fecha_alta",">=",$fecha1)
        ->where("fecha_alta","<=",$fecha2)->get();

        $sumaEntrada=$consultaInv->SUM('entrada');

        $sumaSalida=$consultaInv->SUM('salida');

        //$sumaVenta=$consultaInv->SUM('venta');

        // dd($sumaVenta);


            //carbon
        $now =  Carbon::now();

        $dia=$now->format('d');

        $mes=$now->format('m');

        $anio=$now->format('y');

        


        $pdf = new Fpdf('P','mm','A4');
        $pdf->AddPage();

             //---------------------------------------------------------------------------------------
        ///-------------------------------------------cuerpo de contenido-------------------------

                
        //-------------------Encabeza-----------------------

        //zona fecha------
        $pdf->SetFont('Arial','',10,6);

        $pdf->Cell(150,1,'',0,0);
    
        //comando para color en la tabla
        $pdf->SetFillColor(244, 168, 61 );

        $pdf->Cell(40,7,'Fecha',1,0,'C',1);

        $pdf->ln(7);
        // tablita de fecha
        //margen 
        $pdf->Cell(150,1,'',0,0);
        $pdf->Cell(13.3,7,"$dia",1,0,'C');
        $pdf->Cell(13.3,7,"$mes",1,0,'C');
        $pdf->Cell(13.3,7,"$anio",1,0,'C');

        //fin de la zona fecha-----

        $pdf->SetFont('Arial','',16,6);

        $pdf->image(public_path().'/images/Grupo-izamal-1024x589.png', 90,5,25,25);

        $pdf->ln(15);

        $pdf->Cell(188,7, utf8_decode('Inventario Grupo Izamal'),'B',1,'C',1);


        //---------------------FIn del encabezado-------------------------------


        ///-----------------------------------lista de informacion personal--------------------------------------
        $pdf->SetFont('Arial','',14,6);
        //----------------------------------Informacion del hotel---------------------------------------
        //Informacion del hotel
        $pdf->ln(3);
        $pdf->Cell(50,7,'',0,0,'C');
        $pdf->Cell(7,7,'',0,0,'L');
        $pdf->Cell(70,7,'"Grupo Izamal"',0,0,'C');
        //espacio de fecha a fecha
        $pdf->ln(9);
        $pdf->Cell(30,7,'',0,0,'C');
        $pdf->Cell(30,7,"De $fecha1  a $fecha2",0,0,'C'); 
        $pdf->Cell(7,7,'',0,0,'L');
        //espacio para definir el nombre del encargado
      
        //Nota
        $pdf->ln(9);
        $pdf->Cell(3.5,7,'',0,0,'C');
        $pdf->Cell(30,7,'Nota:',0,0,'C'); 
        $pdf->Cell(-7,7,'',0,0,'L');
        $pdf->Cell(70,7, utf8_decode('Informacion exportada a travez del sistema.'),0,0,'L');

        //----------------------------------fin de la informacion del hotel----------------------------------

        $pdf->ln(5);
        $pdf->SetFont('Arial','',12,6);
        $pdf->ln(2);



        //-------------------------------tabla de dat0s---------------------------------------

        //------------------------------------Encabezado de la tabla superior------------------------------------
        //MARGEB INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(175, 7 , "Inventario de productos de $fecha1  al $fecha2", 1, 1,'C',1);
        //MARGEN INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(40, 7 , 'Producto', 1, 0,'C');
        $pdf->Cell(30, 7 , 'Fecha alta', 1, 0,'C');
        $pdf->Cell(10, 7 , 'C', 1, 0,'C');
        $pdf->Cell(10, 7 , 'E', 1, 0,'C');
        $pdf->Cell(10, 7 , 'S', 1, 0,'C');
        //$pdf->Cell(10, 7 , 'V', 1, 0,'C');
        $pdf->Cell(10, 7 , 'D', 1, 0,'C');
        $pdf->Cell(65, 7 , 'Descripcion', 1, 1,'C');

        //---------------------------------fin de encabezado superior-------------------------

        $alt=7;



        //-------------------------------tabla de dat0s---------------------------------------
        //datos de la lista de asistencia
        $pdf->SetFont('Arial','',8,6);

       foreach ($consultaInv as $invRB) {
        $pdf->Cell(10,$alt,'',0,0);

        $pdf->Cell(40,$alt,$invRB->RecursosDep->nombre,1,0,'C');
        $pdf->Cell(30,$alt,utf8_decode($invRB->fecha_alta),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invRB->cantidad_inicial),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invRB->entrada),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invRB->salida),1,0,'C'); 
        $pdf->Cell(10,$alt,utf8_decode($invRB->total_disponible),1,0,'C'); 
        $pdf->Cell(65,$alt,utf8_decode($invRB->descripcion),1,1,'C'); 
        }

        $pdf->SetFillColor(244, 168, 61 );

        $pdf->Cell(10,$alt,'',0,0);
        $pdf->Cell(40,$alt,utf8_decode('Entradas: '.$sumaEntrada),1,0,'C',1);
        $pdf->Cell(40,$alt,utf8_decode('Salidas: '.$sumaSalida),1,0,'C',1); 
        //$pdf->Cell(40,$alt,utf8_decode('Ventas: '.$sumaVenta),1,1,'C',1); 

        $pdf->Output();
        exit();

    }



    ///reporte de lavanderia


     public function Inv_RLavanderiaUni(){

    $recursosL = RecursosLavanderia::all();
       return view('sistema.rol.admin.inventarios.inv_RlavanderiaUni', compact('recursosL'));
    }


    public function inv_RL(Request $request)
    {
        $id_RLavado = $_REQUEST['id_RLavado'];
        $fecha1 = $_REQUEST['fecha1'];
        $fecha2 = $_REQUEST['fecha2'];


        $consultaInv = InvLavanderia::where('id_RLavado', $id_RLavado)
        ->where("fecha_alta",">=",$fecha1)
        ->where("fecha_alta","<=",$fecha2)->get();


        $sumaEntrada=$consultaInv->SUM('entrada');

        $sumaSalida=$consultaInv->SUM('salida');

        //$sumaVenta=$consultaInv->SUM('venta');

        // dd($sumaVenta);


            //carbon
        $now =  Carbon::now();

        $dia=$now->format('d');

        $mes=$now->format('m');

        $anio=$now->format('y');




        $pdf = new Fpdf('P','mm','A4');
        $pdf->AddPage();

             //---------------------------------------------------------------------------------------
        ///-------------------------------------------cuerpo de contenido-------------------------

                
        //-------------------Encabeza-----------------------

        //zona fecha------
        $pdf->SetFont('Arial','',10,6);

        $pdf->Cell(150,1,'',0,0);
    
        //comando para color en la tabla
        $pdf->SetFillColor(244, 168, 61 );

        $pdf->Cell(40,7,'Fecha',1,0,'C',1);

        $pdf->ln(7);
        // tablita de fecha
        //margen 
        $pdf->Cell(150,1,'',0,0);
        $pdf->Cell(13.3,7,"$dia",1,0,'C');
        $pdf->Cell(13.3,7,"$mes",1,0,'C');
        $pdf->Cell(13.3,7,"$anio",1,0,'C');

        //fin de la zona fecha-----

        $pdf->SetFont('Arial','',16,6);

        $pdf->image(public_path().'/images/Grupo-izamal-1024x589.png', 90,5,25,25);

        $pdf->ln(15);

        $pdf->Cell(188,7, utf8_decode('Inventario Grupo Izamal'),'B',1,'C',1);


        //---------------------FIn del encabezado-------------------------------


        ///-----------------------------------lista de informacion personal--------------------------------------
        $pdf->SetFont('Arial','',14,6);
        //----------------------------------Informacion del hotel---------------------------------------
        //Informacion del hotel
        $pdf->ln(3);
        $pdf->Cell(50,7,'',0,0,'C');
        $pdf->Cell(7,7,'',0,0,'L');
        $pdf->Cell(70,7,'"Grupo Izamal"',0,0,'C');
        //espacio de fecha a fecha
        $pdf->ln(9);
        $pdf->Cell(30,7,'',0,0,'C');
        $pdf->Cell(30,7,"De $fecha1  a $fecha2",0,0,'C'); 
        $pdf->Cell(7,7,'',0,0,'L');
        //espacio para definir el nombre del encargado
      
        //Nota
        $pdf->ln(9);
        $pdf->Cell(3.5,7,'',0,0,'C');
        $pdf->Cell(30,7,'Nota:',0,0,'C'); 
        $pdf->Cell(-7,7,'',0,0,'L');
        $pdf->Cell(70,7, utf8_decode('Informacion exportada a travez del sistema.'),0,0,'L');

        //----------------------------------fin de la informacion del hotel----------------------------------

        $pdf->ln(5);
        $pdf->SetFont('Arial','',12,6);
        $pdf->ln(2);



        //-------------------------------tabla de dat0s---------------------------------------

        //------------------------------------Encabezado de la tabla superior------------------------------------
        //MARGEB INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(175, 7 , "Inventario de recursos lavanderia de $fecha1  al $fecha2", 1, 1,'C',1);
        //MARGEN INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(40, 7 , 'Producto', 1, 0,'C');
        $pdf->Cell(30, 7 , 'Fecha alta', 1, 0,'C');
        $pdf->Cell(10, 7 , 'C', 1, 0,'C');
        $pdf->Cell(10, 7 , 'E', 1, 0,'C');
        $pdf->Cell(10, 7 , 'S', 1, 0,'C');
        //$pdf->Cell(10, 7 , 'V', 1, 0,'C');
        $pdf->Cell(10, 7 , 'D', 1, 0,'C');
        $pdf->Cell(65, 7 , 'Descripcion', 1, 1,'C');

        //---------------------------------fin de encabezado superior-------------------------

        $alt=7;



        //-------------------------------tabla de dat0s---------------------------------------
        //datos de la lista de asistencia
        $pdf->SetFont('Arial','',8,6);

       foreach ($consultaInv as $invRL) {
        $pdf->Cell(10,$alt,'',0,0);

        $pdf->Cell(40,$alt,$invRL->recursosLav->nombre,1,0,'C');
        $pdf->Cell(30,$alt,utf8_decode($invRL->fecha_alta),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invRL->cantidad_inicial),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invRL->entrada),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invRL->salida),1,0,'C'); 
        $pdf->Cell(10,$alt,utf8_decode($invRL->cat_disponible),1,0,'C'); 
        $pdf->Cell(65,$alt,utf8_decode($invRL->descripcion),1,1,'C'); 
        }

        $pdf->SetFillColor(244, 168, 61 );

        $pdf->Cell(10,$alt,'',0,0);
        $pdf->Cell(40,$alt,utf8_decode('Entradas: '.$sumaEntrada),1,0,'C',1);
        $pdf->Cell(40,$alt,utf8_decode('Salidas: '.$sumaSalida),1,0,'C',1); 
        //$pdf->Cell(40,$alt,utf8_decode('Ventas: '.$sumaVenta),1,1,'C',1); 

        $pdf->Output();
        exit();


    }


}
