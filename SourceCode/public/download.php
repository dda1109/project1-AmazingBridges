<?php
require_once('../lib/database.php');
require_once('../lib/initialize.php');
require('../lib/fpdf/fpdf.php');

$bridge = find_bridge_by_id($_GET['id']);

class PDF extends FPDF
{
function Header()
{
    global $bridge;
    $this->SetFont('Arial','B',15);
    $this->Cell(0,10,$bridge['name']);
    $this->Ln(20);
}
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Write(5,$bridge['description']);
$pdf->Output();
?>