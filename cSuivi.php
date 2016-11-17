<?php
session_start();
if (isset($_GET['action'])){
$lienChoisi=$_GET['action'];
switch($lienChoisi){ 
case 'mp':
    miseEnPaiementFicheFraisForfait($_GET['lstUsers'], $_GET['lstMois']);
    break;
}
}
else $lienChoisi=''; 

require_once ('include/dao.php');
require_once('include/_utilitairesEtGestionErreurs.lib.php');?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="dist/css/bootstrap.css">
        <link rel="stylesheet" href="dist/css/style.css">
        <title> GSB: Galaxy Swiss Bourdin </title>
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
         <script type="text/javascript" src="include/date.js"></script>
    </head>
    <body>
        <header><img src="logo.png" /> <h2>GSB: Galaxy Swiss Bourdin</h2> </header>
      
        
        <div class="navbar navbar-inverse" style="margin-left: 2; margin-right: 2">
            <div class="navbar-header">
                <a class="navbar-brand" href="cAccueil.php">Accueil</a>
            </div>        
            <ul class="nav navbar-nav">
                <li class="active"><a href="cValidFichesFrais.php"> Validation</a></li>
                <li><a href="cSuivi.php"> Suivi</a></li>
                <li><a href="cSeDeconnecter.php"> Déconnexion</a></li>
            
            
            </ul>
        </div>
         
    
        
<div class="container" style="text-align: center;border: 3 groove black; border-radius:10;  box-shadow: 5px 5px 5px 5px #777"><br/>
        <h3>Bienvenue sur l'intranet de l'entreprise GSB: Galaxy Swiss Bourdin</h3>
              <p><span id="date_heure"></span>
                  <script type="text/javascript">window.onload = date_heure('date_heure');</script> </p><br/><br/>
                        
                         
                        <form name="miseEnPaiement" method="GET" action="">
        <table class="table table-bordered" style="text-align: center; width:1125;  border-radius: 20">
            <thead>
            <tr>
                <th rowspan="2" class="th"> Visiteur Médical</th>
                <th rowspan="2" class="th"> Mois </th>
                <th colspan="3" class="th"> Fiche de frais </th>
                <th rowspan ="2" class="th"> Actions </th>
            </tr>
            <tr>
                <th class="th"> Frais Forfait </th>
                <th class="th"> Hors Forfait</th>
                <th class="th"> Total </th>
            </tr>
            </thead>
            <tbody>
               <?php $resu= obtenirReqTableau();
               foreach($resu as $row){ 
                   $mois=$row['mois'];
                   $visiteur=$row['id'];
                   $ligne=divert($mois);
                           ?>
                <tr>
                    <td><?php echo $row['nom']." ".$row['prenom'] ?></td>
               <td><?php echo $ligne; ?></td><?php 
                    $somme=  obtenirReqSommeTableau($visiteur,$mois, $visiteur, $visiteur, $mois, $mois, $visiteur, $mois);
                    foreach($somme as $miu){?>
                    <td><?php echo $miu['sommeF']; ?></td>
                    <?php }
                    $total= obtenirSommeTotalFicheFrais($visiteur, $mois, $visiteur, $mois, $visiteur, $visiteur, $mois, $mois);
                    foreach($total as $col){?>
                    <td><?php echo $col['somme'];?></td>
                    <?php }?>
                    <td><a href="<?php echo '?action=mp&lstUsers='.$visiteur.'&lstMois='.$mois;?>" type="button"  id="button1id" name="button1id" class="btn btn-success">Mettre en paiement</a></td> 
                 
               </tr>
               <?php } ?>
            </tbody>
        </table>
                        </form>
        
                        </div><br/>
        
        
        

    </body>
</html>
