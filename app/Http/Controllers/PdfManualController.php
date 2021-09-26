<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;


class PdfManualController extends Controller
{
        public function manual(Request $request){

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


        $pdf->ln(7);


        //fin de la zona fecha-----

        $pdf->SetFont('Arial','',16,6);

        $pdf->image(public_path().'/images/Grupo-izamal-1024x589.png', 90,5,25,25);

        $pdf->ln(15);

        $pdf->Cell(188,7, utf8_decode('Manual del sistema ItzmalGroup'),'B',1,'C',1);


        //---------------------FIn del encabezado-------------------------------


        ///-----------------------------------lista de informacion personal--------------------------------------
        $pdf->SetFont('Arial','',14,6);
        //----------------------------------Informacion del hotel---------------------------------------
        //Informacion del hotel
        $pdf->ln(3);
        $pdf->Cell(50,7,'',0,0,'C');
        $pdf->Cell(7,7,'',0,0,'L');
        $pdf->Cell(70,7,'"Grupo Izamal"',0,0,'C');

        $pdf->ln(7);
        $pdf->SetFont('Arial','',10,6);
        $pdf->Cell(50,7,'',0,0,'C');
        $pdf->Cell(7,7,'',0,0,'L');
        $pdf->Cell(70,7,'WebInv Itzmal Group es un software de inventario para la empresa Grupo Izamal que es desarrollado',0,1,'C');
        $pdf->ln(1);
        $pdf->Cell(50,0,'',0,0,'C');
        $pdf->Cell(7,0,'',0,0,'L');
         $pdf->Cell(70,0,'WebInv Itzmal Group es un software de inventario para la empresa Grupo Izamal que es desarrollado',0,0,'C');
        //espacio de fecha a fecha
   
   

    



        $pdf->Output();
        exit();


    }
}
