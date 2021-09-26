<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RecursosDepartamentales;

use Codedge\Fpdf\Fpdf\Fpdf;

use Carbon\Carbon;

class RecursosDepartamentalesController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vistaBlancos()
    {
         return view('sistema.rol.admin.recursos.R_blancos.recursos_blancos');
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $R_D = RecursosDepartamentales::all();

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
        $R_D = new RecursosDepartamentales();
        $R_D->nombre= $request->get('nombre');
        $R_D->descripcion= $request->get('descripcion');
        $R_D->id_almacenDep= $request->get('id_almacenDep');
        $R_D->id_categoriaPro= $request->get('id_categoriaPro');
        $R_D->save();
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
        return $R_D = RecursosDepartamentales::find($id);
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
         $R_D = RecursosDepartamentales::find($id);
         $R_D->nombre= $request->get('nombre');
         $R_D->descripcion= $request->get('descripcion');
         $R_D->id_almacenDep= $request->get('id_almacenDep');
         $R_D->id_categoriaPro= $request->get('id_categoriaPro');
         $R_D->update();
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
           $R_D = RecursosDepartamentales::find($id);
           $R_D->delete();
    }

    public function PdfR_Blancos(){

        $R_D = RecursosDepartamentales::all();
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

        $pdf->Cell(188,7, utf8_decode('Lista de recursos blancos'),'B',1,'C',1);


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
        $pdf->Cell(175, 7 , "Listado de recursos blancos", 1, 1,'C',1);
        //MARGEN INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(45, 7 , 'Recurso', 1, 0,'C');
        $pdf->Cell(50, 7 , 'Descripcion', 1, 0,'C');
        $pdf->Cell(30, 7 , 'Categoria', 1, 0,'C');
        $pdf->Cell(50, 7 , 'Almacen', 1, 1,'C');
        //$pdf->Cell(24, 7 , 'Total de hrs', 1, 1,'C');


        //---------------------------------fin de encabezado superior-------------------------

        $alt=7;

        $signo="$";
        //-------------------------------tabla de dat0s---------------------------------------
        //datos de la lista de asistencia

        $pdf->SetFont('Arial','',8,6);

       foreach ($R_D as $recursoB) {
        $pdf->Cell(10,$alt,'',0,0);

        //$pdf->Cell(15,$alt,$pro->nombre,1,0,'C');
        $pdf->Cell(45,$alt,utf8_decode($recursoB->nombre),1,0,'C');
        $pdf->Cell(50,$alt,utf8_decode($recursoB->descripcion),1,0,'C');
        $pdf->Cell(30,$alt,$recursoB->CategoriaDep->categoria,1,0,'C');
        $pdf->Cell(50,$alt,utf8_decode($recursoB->AlmacenDep->nombre),1,1,'C'); 
        }

        ///-----------------------------fin de la tabla de asistencia------------------------------------------



        $pdf->Output('I', 'Blancos.pdf');
        exit();
    }
}
