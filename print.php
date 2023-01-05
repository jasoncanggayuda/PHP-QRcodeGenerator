<?php
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->MultiCell(190,10,$pdf->WriteHTML($contents));
$pdf->Output();
?>


