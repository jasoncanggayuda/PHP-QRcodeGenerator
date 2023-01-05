<?php
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('temp/perangkatcerdas.png',75,60,60,60);
$pdf->Output();
?>
