<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;

use Codedge\Fpdf\Fpdf\Fpdf;

use Carbon\Carbon;


class ProductoController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function return()
    {
        return view('sistema.rol.admin.recursos.productos.productos');
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retorna los datos 
        return $productos = Producto::all();

         // $productos;
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
        $producto = new Producto();
        $producto->nombre= $request->get('nombre');
        $producto->precio= $request->get('precio');
        $producto->descripcion= $request->get('descripcion');
        $producto->id_categoriaPro= $request->get('id_categoriaPro');
        $producto->id_almacenPro= $request->get('id_almacenPro');
        $producto->save();
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
        return $producto = Producto::find($id);
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
        $producto = Producto::find($id);
        $producto->nombre= $request->get('nombre');
        $producto->precio= $request->get('precio');
        $producto->descripcion= $request->get('descripcion');
        $producto->id_categoriaPro= $request->get('id_categoriaPro');
        $producto->id_almacenPro= $request->get('id_almacenPro');
        $producto->update();
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
        $producto = Producto::find($id);
        $producto->delete();

    }
    
    public function ReporteProductos(){
        
        $productos = Producto::all();
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

        $pdf->Cell(188,7, utf8_decode('Lista de productos'),'B',1,'C',1);


        //---------------------FIn del encabezado-------------------------------

        //Nota
        $pdf->ln(2);
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
        $pdf->Cell(175, 7 , "Listado de productos", 1, 1,'C',1);
        //MARGEN INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        //$pdf->Cell(15, 7 , 'Folio', 1, 0,'C');
        $pdf->Cell(50, 7 , 'Producto', 1, 0,'C');
        $pdf->Cell(20, 7 , 'Precio', 1, 0,'C');
        $pdf->Cell(70, 7 , 'Descripcion', 1, 0,'C');
        $pdf->Cell(35, 7 , 'Almacen', 1, 1,'C');
        //$pdf->Cell(24, 7 , 'Total de hrs', 1, 1,'C');


        //---------------------------------fin de encabezado superior-------------------------

        $alt=7;

        $signo="$";
        //-------------------------------tabla de dat0s---------------------------------------
        //datos de la lista de asistencia

        $pdf->SetFont('Arial','',8,6);

       foreach ($productos as $pro) {
        $pdf->Cell(10,$alt,'',0,0);

        //$pdf->Cell(15,$alt,$pro->nombre,1,0,'C');
        $pdf->Cell(50,$alt,utf8_decode($pro->nombre),1,0,'C');
        $pdf->Cell(20,$alt,utf8_decode("$".$pro->precio),1,0,'C');
        $pdf->Cell(70,$alt,$pro->descripcion,1,0,'C');
        $pdf->Cell(35,$alt,utf8_decode($pro->almacen->nombre),1,1,'C'); 
        }

        ///-----------------------------fin de la tabla de asistencia------------------------------------------



        $pdf->Output('I', 'Productos.pdf');
        exit();

    }
}
