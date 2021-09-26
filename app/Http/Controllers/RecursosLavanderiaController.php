<?php

namespace App\Http\Controllers;

use App\Models\RecursosLavanderia;
use Illuminate\Http\Request;

// use App\Models\RecursosLavanderia;


use Codedge\Fpdf\Fpdf\Fpdf;

use Carbon\Carbon;

class RecursosLavanderiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vistaRL()
    {
          return view('sistema.rol.admin.recursos.R_lavanderia.recursos_lavanderia');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $R_L = RecursosLavanderia::all();
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
        $R_L = new RecursosLavanderia();
        $R_L->nombre= $request->get('nombre');
        $R_L->id_AlmacenLavado= $request->get('id_AlmacenLavado');
        $R_L->id_categoriaPro= $request->get('id_categoriaPro');
        $R_L->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecursosLavanderia  $recursosLavanderia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $R_L=RecursosLavanderia::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecursosLavanderia  $recursosLavanderia
     * @return \Illuminate\Http\Response
     */
    public function edit(RecursosLavanderia $recursosLavanderia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecursosLavanderia  $recursosLavanderia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $R_L=RecursosLavanderia::find($id);
        $R_L->nombre= $request->get('nombre');
        $R_L->id_AlmacenLavado= $request->get('id_AlmacenLavado');
        $R_L->id_categoriaPro= $request->get('id_categoriaPro');
        $R_L->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecursosLavanderia  $recursosLavanderia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $R_L=RecursosLavanderia::find($id);
        $R_L->delete();
    }

    public function PDF_RecursosLavado()
    {
        $R_L = RecursosLavanderia::all();
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

        $pdf->Cell(188,7, utf8_decode('Lista de recursos lavanderia'),'B',1,'C',1);


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
        $pdf->Cell(175, 7 , "Listado de recursos de lavanderia", 1, 1,'C',1);
        //MARGEN INVISIBLE
        $pdf->Cell(10, 7 , '', 0, 0,'C');
        $pdf->Cell(50, 7 , 'Recurso', 1, 0,'C');
        $pdf->Cell(45, 7 , 'Categoria', 1, 0,'C');
        $pdf->Cell(80, 7 , 'Almacen', 1, 1,'C');
    


        //---------------------------------fin de encabezado superior-------------------------

        $alt=7;

        $signo="$";
        //-------------------------------tabla de dat0s---------------------------------------
        //datos de la lista de asistencia

        $pdf->SetFont('Arial','',8,6);

       foreach ($R_L as $RecursoL) {
        $pdf->Cell(10,$alt,'',0,0);

        //$pdf->Cell(15,$alt,$pro->nombre,1,0,'C');
        $pdf->Cell(50,$alt,utf8_decode($RecursoL->nombre),1,0,'C');
        $pdf->Cell(45,$alt,$RecursoL->CategoriaLav->categoria,1,0,'C');
        $pdf->Cell(80,$alt,$RecursoL->AlmacenLav->nombre,1,1,'C');

        }

        ///-----------------------------fin de la tabla de asistencia------------------------------------------



        $pdf->Output('I', 'RecursosLavanderia.pdf');
        exit();
    }
}
