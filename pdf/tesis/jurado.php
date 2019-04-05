<?php

require '../FPDF/fpdf.php';

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B','10');
    $pdf->Cell(100,10,'Yonathan',1,1,'C');
    $pdf->Cell(100,10,'wwwwwwwwwww - wwwwwwwwwww - wwwwwwwwwww',1,1,'C');



    $pdf->Output();