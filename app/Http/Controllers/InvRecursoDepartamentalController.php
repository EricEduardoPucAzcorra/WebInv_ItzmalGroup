<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\inv_RecursoDepartamental;

use Codedge\Fpdf\Fpdf\Fpdf;

use Carbon\Carbon;

class InvRecursoDepartamentalController extends Controller
{
    //
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function VistaInvRB()
    {
      return view('sistema.rol.admin.inventarios.inv_RBlancos');   
    }

    //
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $inventarioB = inv_RecursoDepartamental::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $inventarioB=new inv_RecursoDepartamental();
        $inventarioB->id_recursoDep=$request->get('id_recursoDep');
        $inventarioB->fecha_alta=$request->get('fecha_alta');
        $inventarioB->cantidad_inicial=$request->get('cantidad_inicial');
        $inventarioB->entrada=$request->get('entrada');
        $inventarioB->salida=$request->get('salida');
        $inventarioB->descripcion=$request->get('descripcion');
        $inventarioB->total_disponible=$request->get('total_disponible');
        $inventarioB->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $inventarioB = inv_RecursoDepartamental::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $inventarioB = inv_RecursoDepartamental::find($id);
        $inventarioB->id_recursoDep=$request->get('id_recursoDep');
        $inventarioB->fecha_alta=$request->get('fecha_alta');
        $inventarioB->cantidad_inicial=$request->get('cantidad_inicial');
        $inventarioB->entrada=$request->get('entrada');
        $inventarioB->salida=$request->get('salida');
        $inventarioB->descripcion=$request->get('descripcion');
        $inventarioB->total_disponible=$request->get('total_disponible');
        $inventarioB->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $inventarioB = inv_RecursoDepartamental::find($id);
        $inventarioB->delete();
    }

     public function ReporteBlancos(Request $request){

           //carbon
        $now =  Carbon::now();

        $dia=$now->format('d');

        $mes=$now->format('m');

        $anio=$now->format('y');

        $fecha1 = $request -> input('fecha1');
        $fecha2 = $request -> input('fecha2');

     

        //aplicamos Eloquent
        $inventariob=inv_RecursoDepartamental::where("fecha_alta",">=",$fecha1)
                         ->where("fecha_alta","<=",$fecha2)
                         ->get(); 



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
        $pdf->Cell(175, 7 , "Inventario de recursos blancos de $fecha1  al $fecha2", 1, 1,'C',1);
        //MARGEN INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(40, 7 , 'Recurso', 1, 0,'C');
        $pdf->Cell(30, 7 , 'Fecha alta', 1, 0,'C');
        $pdf->Cell(10, 7 , 'C', 1, 0,'C');
        $pdf->Cell(10, 7 , 'E', 1, 0,'C');
        $pdf->Cell(10, 7 , 'S', 1, 0,'C');
        //$pdf->Cell(10, 7 , 'V', 1, 0,'C');
        $pdf->Cell(10, 7 , 'D', 1, 0,'C');
        $pdf->Cell(65, 7 , 'Descripcion', 1, 1,'C');

        //---------------------------------fin de encabezado superior-------------------------

        $alt=7;

        $hrs="hrs";

        //-------------------------------tabla de dat0s---------------------------------------
        //datos de la lista de asistencia

        $pdf->SetFont('Arial','',8,6);


       foreach ($inventariob as $invb) {

        $pdf->Cell(10,$alt,'',0,0);

        $pdf->Cell(40,$alt,$invb->RecursosDep->nombre,1,0,'C');
        $pdf->Cell(30,$alt,utf8_decode($invb->fecha_alta),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invb->cantidad_inicial),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invb->entrada),1,0,'C');
        $pdf->Cell(10,$alt,utf8_decode($invb->salida),1,0,'C'); 
        //$pdf->Cell(10,$alt,utf8_decode($invp->venta),1,0,'C'); 
        $pdf->Cell(10,$alt,utf8_decode($invb->total_disponible),1,0,'C'); 
        $pdf->Cell(65,$alt,utf8_decode($invb->descripcion),1,1,'C'); 
        }

        ///-----------------------------fin de la tabla de asistencia------------------------------------------



        $pdf->Output();
        exit();


    }
}
