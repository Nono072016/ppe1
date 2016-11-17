<?php

session_start();
if(isset($_POST["lstMois"])){
$moisChoisi=$_POST["lstMois"];
if(isset($_GET["lstUsers"])){
$userChoisi =$_GET["lstUsers"];
}
}

require_once('fpdf/fpdf.php');
require_once('include/dao.php');
require_once('include/_utilitairesEtGestionErreurs.lib.php');


$pdf = new FPDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times','B',16);
$pdf->Image('logo.png',90,6,30);
$pdf->SetY(30);
$pdf->Cell(190,10,utf8_decode('Remboursement des frais engagés'),1,1,'C');

$resu= getUtilisateur($_SESSION['login']);
$nom=utf8_decode($resu['nom']);
$prenom=utf8_decode($resu['prenom']);
$pdf->Setfont('Arial','B',11);
$pdf->Rect(10,30,190,210);
$pdf->SetY(50);
$pdf->Cell(0,0,"Nom :"."  ".$nom." ".$prenom,0,0);
$mois=divert($moisChoisi);
$pdf->SetY(50);
$pdf->Cell(0,20,"Mois: "."  ".utf8_decode($mois),0,0);
$pdf->Rect(15, 70, 180, 160);
$pdf->Setfont('Arial','I',11);
$pdf->SetXY(15,70);
$pdf->SetTextColor(128,128,255);
$pdf->Cell(45,10,"Frais Forfaitaires",1,0,'C');
$pdf->SetXY(60,70);
$pdf->Cell(40,10,"Quantite",1,0,'C');
$pdf->SetXY(100,70);
$pdf->Cell(50,10,"Montant Unitaire",1,0,'C');
$pdf->SetXY(150,70);
$pdf->Cell(45,10,"Total",1,0,'C');

$pdf->Setfont('Arial','B',11);
$pdf->SetTextColor(0,0,0);
$id=$_SESSION['id'];
$resu= obtenirFicheFraisForfait($id,$moisChoisi,$id,$id,$moisChoisi,$moisChoisi);
$pdf->SetY(70);
        foreach($resu as $row){
            
            $pdf->Ln();
            $pdf->SetX(15);
            $pdf->Cell(45,5,utf8_decode($row['libelle']),1,0,'C');
            
            $pdf->SetX(60);
            $pdf->Cell(40,5,$row['quantite'],1,0,'C');
            
            $pdf->SetX(100);
            $pdf->Cell(50,5,$row['montant'],1,0,'C');
            
            $pdf->SetX(150);
            $pdf->Cell(45,5,$row['somme'],1,0,'C');
        }


$pdf->Setfont('Arial','I',11);
$pdf->SetTextColor(128,128,255);
$pdf->SetXY(15,130);
$pdf->Cell(180,10,"Autres Frais",1,0,'C');
$pdf->SetXY(15,140);
$pdf->Cell(45,10,"Date",1,0,'C');
$pdf->SetXY(60,140);
$pdf->Cell(100,10,"Libelle",1,0,'C');
$pdf->SetXY(160,140);
$pdf->Cell(35,10,"Montant",1,0,'C');

$pdf->Setfont('Arial','B',11);


$ressu= obtenirFraisHorsForfait($id, $moisChoisi);
$pdf->SetY(140);
$pdf->SetTextColor(0,0,0);
foreach($ressu as $row){
    $pdf->Ln();
    $dt=  dateFr($row['date']);
    $pdf->SetX(15);
    $pdf->Cell(45,5,$dt,1,0,'C');
    
    $pdf->SetX(60);
    $pdf->Cell(100,5,utf8_decode($row['libelle']),1,0,'C');
    
    $pdf->SetX(160);
    $pdf->Cell(35,5,$row['montant'],1,0,'C');
    
}

$pdf->SETXY(100,210);
$pdf->SetTextColor(128,128,255);
$pdf->Cell(60,10,'Total pour '.utf8_decode($mois),1,0,'C');
$total=  obtenirSommeTotalFicheFrais($id,$moisChoisi,$id, $moisChoisi,$id,$id,$moisChoisi,$moisChoisi);
$pdf->SETXY(160,210);
$pdf->SetTextColor(0,0,0);
foreach($total as $row){
$pdf->Cell(30,10,$row['somme'],1,0,'C');
}

    
$pdf->SetFont('Arial','',11);
$pdf->SetXY(130,260);
$dateformat=  date("d-m-Y");
$date= datemois($dateformat);
$pdf->Cell(0,0,utf8_decode("Fait à Paris, le ").$date);
$pdf->SetXY(130,265);
$pdf->Cell(0,0,"Vu par l'agent comptable");
$pdf->Image('sign.png',140,270,32,32,'png');
$pdf->Output();


?>

