<?php
ini_set("display_errors",0);error_reporting(0);
session_start();
?>
<?php
require_once('fpdf/fpdf.php');
require_once('include/dao.php');

$pdf = new FPDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',16);
$pdf->Image('logo.png',90,6,30);
$pdf->Cell(190,10,'Remboursement des frais engages',1,1,'C');
$resu= getVisiteur();
$nom=$resu['nom'];
$prenom=$resu['prenom'];
$pdf->Cell(190,190," ",1,0);
$pdf->SetY(50);
$pdf->Cell(0,0,"Nom :",0,0);
$pdf->Cell(0,0,$nom." ".$prenom,0,0);
$pdf->SetY(50);
$pdf->Cell(0,20,'Mois: ',0,0);
$pdf->Output();






?>