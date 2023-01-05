<?php
require('../fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('perangkatcerdas.png',10,10,-300);
$pdf->Output();
?>
