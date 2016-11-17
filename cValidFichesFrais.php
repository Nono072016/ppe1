<?php
//ini_set("display_errors",0);error_reporting(0);
session_start()
?>
<?php
require_once"include/dao.php";
require_once('include/_utilitairesEtGestionErreurs.lib.php');

if(isset($_GET["lstUsers"])){
$userChoisi =$_GET["lstUsers"];
}
if(isset($_POST["lstMois"])){
$moisChoisi=$_POST["lstMois"];
}

  if (isset($_POST['etape'])){
  if ($_POST['etape'] == "actualiserFraisForfait") {
if(!empty($_POST['initialRep'])){
      if($_POST['initialRep']!=$_POST['modifREP']){

      updateQuantiteFraisForfait($_POST['initialRep'], $userChoisi, $moisChoisi, 'REP');
	}
        if($_POST['initialNui']!=$_POST['modifNUI']){
         updateQuantiteFraisForfait($_POST['initialNui'], $userChoisi, $moisChoisi, 'NUI');   
        }
        if($_POST['initialEtp']!=$_POST['modifETP']){
         updateQuantiteFraisForfait($_POST['initialEtp'], $userChoisi, $moisChoisi, 'ETP');   
        }
        if($_POST['initialKm']!=$_POST['modifKM']){
         updateQuantiteFraisForfait($_POST['initialKm'], $userChoisi, $moisChoisi, 'KM');   
        }
 
    }
} 
}
if(isset($_POST['justifi'])){
   if($_POST['justifi']=="actualiserJustificatifs"){
       if(!empty($_POST['iniJusti'])){
           if($_POST['iniJusti']!=$_POST['newJusti']){
                updateNbJustificatifs($_POST['newJusti'],$userChoisi,$moisChoisi);
           }
       }
   }
}	
      
if (isset($_GET['action'])){
$lienChoisi=$_GET['action'];
switch($lienChoisi){ 
case 'reporter':
    $test=  ajouterMois($_GET['lstMois']);
    reporterFicheFraisForfait($test, $_GET['id']);
    echo '<h4><b>La ligne sélectionner a été reporté au mois suivant !</b><h4> ';
    break;
case 'supp' : 
    insererRejetFicheFraisHorsForfait($_GET['id'], $_GET['lstUsers'], $_GET['lstMois'], $_GET['libelle'], $_GET['date'], $_GET['montant'], date("Y-m-d"));
    supprimerLigneFraisHorsForfait($_GET['id']);

    break;

	} 
}
else $lienChoisi=''; 


 if(isset($_POST['valide'])){
     if($_POST['valide']=="validerFiche"){
         updateFicheFraisForfait($userChoisi, $moisChoisi);
     }
 }



?>
<?php
setlocale (LC_TIME, 'fr_FR','fra');
date_default_timezone_set("Europe/Paris");
mb_internal_encoding("UTF-8");
?>


<html>
    
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="dist/css/bootstrap.css">
        <link rel="stylesheet" href="dist/css/style.css">
        <title> GSB: Galaxy Swiss Bourdin </title>
        <script type="text/javascript" src="include/date.js"></script>
       
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    
    </head>
    <body>
        
        <header><img src="logo.png"/> <h2>GSB: Galaxy Swiss Bourdin</h2></header>
        
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
        <div class="container" style="border: 3 groove black; border-radius: 10; box-shadow: 5px 5px 5px 5px #777"> 
            <div class="row"> 
                
             
     <?php if ((!empty($_SESSION["login"])) && isset($_SESSION["login"])) {
         if($_SESSION['idType']=='C'){
    echo "<h4> GESTION DES FICHES DE FRAIS</h4>";
echo "<h5>Identité: ".$_SESSION["nom"] . "   " . $_SESSION["prenom"]."  ".$_SESSION['id']."</h5>";
echo "<h6> Fonction :".$_SESSION["libelleType"]."</h6>"; ?><br/>
        <div class="row"  style="text-align: center; text-decoration: bold" >
              <span id="date_heure"></span>
                  <script type="text/javascript">window.onload = date_heure('date_heure');</script><br/><br/>
         <div class="row" style="text-align: center">
                        <form method="GET" action="" >
            <div class="container" style="text-align: center">
            <label style=" text-decoration: underline"> Veuillez choisir un visiteur </label>
                <div class="row"><select name="lstUsers" onchange="this.form.submit();">
                    <option value="-1"> === Choisir un utilisateur === </option>
    <?php
    
    $resu = obtenirReqListeVisiteurs();
    foreach ($resu as $row) 
        {
            ?>       
            <option value="<?php echo $row['id']; ?>"  
            <?php
            if (isset($userChoisi)){
                if($userChoisi == $row['id']) {
                ?> selected="selected" <?php }} ?>>
            <?php echo $row['nom'] . " " . $row['prenom']." || ".$row['id']; ?></option>
        <?php } ?>
                    </select></div><br/>
        </form>   
</div>
 <?php if(isset($userChoisi)) {
    $resu = obtenirReqMoisFicheFrais($userChoisi);?>
              <div class="row" style="text-align: center">             
            <form method="POST" action="">
            <div class="container">    
        
                
                    <label style="text-decoration: underline"> Mois concerné </label>
                    <div class="row"><select  name="lstMois" onchange="this.form.submit();">  
                            <option value="-1"> === MOIS === </option>
    <?php 
   
    foreach ($resu as $row) {
        $date= $row['mois'];
        $get= divert($date);
        
       ?>
       
        <option value="<?php echo $row['mois']; ?>" <?php 
        if(isset($moisChoisi)&& $moisChoisi== $row['mois']){?>
        selected="selected"<?php }?>> <?php echo $get;?> </option>
        <?php } ?>
        
                        </select></div><br/>
        <?php } ?>
            </div>
        </form>
                  </div> 

              
                            <div class="row" style="text-align: center">
        <form>
            <div class="container">
        <?php 
                     if (isset($moisChoisi)&& isset($userChoisi)){ 
                        $resu = obtenirReqListeTypeVehicule($userChoisi,$moisChoisi);?>
                        <label style="text-decoration: underline"> Type de véhicule </label>
                            <?php
                            foreach ($resu as $row) {
                                ?>   
                        <table class="table table-bordered" style="text-align: center" style="width:300;  border-radius: 20">
                                <tr><th><?php echo $row['libelleType']."(".$row['indemniteKm']."€/km)"; ?></th></tr></table>
                         <?php } }?> 
                        
                    
                        
                     
            </div>
      </form>
                            </div> 
                            
        <?php
        
if (isset($userChoisi)  && isset($moisChoisi) ) {
    $resuFF = obtenirReqEltsForfaitFicheFrais($moisChoisi, $userChoisi);

    foreach ($resuFF as $ligneFF) {
        //echo $ligneFF[0];
        switch ($ligneFF['idFraisForfait']) {
            case "ETP":
                $etp = $ligneFF['quantite'];
                break;
            case "KM":
                $km = $ligneFF['quantite'];
                break;
            case "NUI":
                $nui = $ligneFF['quantite'];
                break;
            case "REP":
                $rep = $ligneFF['quantite'];
                break;
        }
    }
    ?>
        
          <form id="formFraisForfait" method="POST" action="">      
                 
<input type="hidden" name="etape" value="actualiserFraisForfait" />
<input type="hidden" name="lstVisiteur" value="<?php echo $userChoisi; ?>" />
<input type="hidden" name="lstMois" value="<?php echo $moisChoisi; ?>" />
<input type="hidden" name="modifREP" value="<?php echo $rep; ?>" />
<input type="hidden" name="modifNUI" value="<?php echo $nui; ?>" />
<input type="hidden" name="modifETP" value="<?php echo $etp; ?>" />
<input type="hidden" name="modifKM" value="<?php echo $km; ?>" />

            
            
                <label style=" text-decoration: underline"> Fiche frais forfait </label>
                <table  style="margin-left: 200">
                    <tr><th class="th" style=" width: 150px">Repas midi</th>
                        <th class="th" style=" width: 150px">Nuitée </th>
                        <th class="th" style=" width: 150px">Etape</th>
                        <th class="th" style=" width: 150px">Km </th>
                        <th class="th"  style=" width: 150px">Actions</th></tr>
                    
                    <tr align="center">
                        <td style="width:80px;"><input type="text" size="3" id="idREP"  name="initialRep" value="<?php echo $rep; ?>"  /></td>
                        <td style="width:80px;"><input type="text" size="3" id="idNUI"  name="initialNui" value="<?php echo $nui; ?>"  /></td> 
                        <td style="width:80px;"><input type="text" size="3" id="idETP"   name="initialEtp"  value="<?php echo $etp; ?>" /></td>
                        <td style="width:80px;"><input type="text" size="3" id="idKM"  name="initialKm" value="<?php echo $km; ?>"  /></td> 
                   
                     <td style="height: 50; width: 200">
                    <div id="actionsFraisForfait" class="actions">  
                       <button type="button" onclick="actualiserLigneFraisForfait(<?php echo $rep;?>,<?php echo $nui;?>,<?php echo $etp;?>,<?php echo $km;?>);" id="button1id" name="button1id" class="btn btn-warning">Actualiser</button>
                            <button type="button" id="button2id"  onclick="reinitialiserLigneFraisForfait();" name="button2id" class="btn btn-danger">Réinitialiser</button>
                    </div>
                    </td>
                    </tr>
     
            </table>    
            <?php  }?>  
        </form>
        </div>  
        
                            <div class="row" style="text-align: center">
        <form id="formFraisHorsForfait" method="GET" action="">
            
            
            <?php if(isset($moisChoisi)&& isset($userChoisi)){
            $resu=obtenirReqEltsHorsForfaitFicheFrais($moisChoisi,$userChoisi);?>
            <label style="text-decoration: underline"> Fiche frais hors forfait </label>
            
            <?php 
            foreach ($resu as $ligne) {
                $date=$ligne['date'];
                $libelle= $ligne['libelle'];
                $montant=$ligne['montant'];
                $get=dateFR($date);
                $id= $ligne['id'];
                
            ?>
            <table class="case2"><tr>
                    <th class="th">Date</th>
                    <th class="th">Libellé </th>
                    <th class="th">Montant </th>
                    <th class="th"> Action</th>
                </tr>
                 
                <tr>
                    <td style="height: 50; width: 150"><input type="text" id="idDate" name="NDate" style="width: 100"  value="<?php echo $get;?>"/> </td>
                    <td style="height: 50; width: 150"><input type="text" id="idLibelle" name="NLibelle" style="width: 300"  value="<?php echo $libelle;?>"/></td>
                    <td style="height: 50; width: 150"><input type="text" id="idMontant" name="NMontant" style="width: 100" value="<?php echo $montant;?>"/></td>
                    
                    <td style="height: 50; width: 200"><a href="<?php echo '?lstUsers='.$userChoisi.'&lstMois='.$moisChoisi.'&action=reporter&id='.$id;?>" type="button" id="button1id"  name="button1id" class="btn btn-success">Reporter</a>
                        <a href="<?php echo '?lstUsers='.$userChoisi.'&lstMois='.$moisChoisi.'&action=supp&id='.$id.'&libelle='.$libelle.'&date='.$date.'&montant='.$montant; ?>" onclick="supprimerLigneFraisHorsForfait(<?php echo $id;?>);" type="button" id="button2id" name="button2id" class="btn btn-danger" >Supprimer</a>
                        
                    
             
                </tr>
            
            </table>    
             
            <?php }}?>
        </form>
                            </div>
        
        <?php if(isset($moisChoisi) && isset($userChoisi)){
                $resu=  nbJustificatifs($moisChoisi, $userChoisi);
                foreach($resu as $row){
            ?>
       
        <form id="formJustificatifs" method="POST" action="">
               <div class="row" style="text-align: center">
           <input type="hidden" name="justifi" value="actualiserJustificatifs" />
           <input type="hidden" name="lstVisiteur" value="<?php echo $userChoisi; ?>" />
           <input type="hidden" name="lstMois" value="<?php echo $moisChoisi; ?>" />
           <input type="hidden" name="iniJusti" value="<?php echo $row['nbJustificatifs'];?>"/>
           
            
            <div style="text-decoration: underline"><b> Nombre de justificatif: </b></div>
            <div class="row" border="2">
               <input style="width:50" type="text" id="nbJusti" name="newJusti" value="<?php echo $row['nbJustificatifs']; ?>"/> </div><br/>
            <div> 
                <a type="button" onclick="actualiserJustificatifs(<?php echo $row['nbJustificatifs'];?>);" id="button1id" name="button1id" class="btn btn-success">Actualiser</a>
            </div>
            <?php } } ?>
        </form>
                            </div>
        
                            <div class="row" style="text-align: center">
                            
                        <?php if(isset($moisChoisi) && isset($userChoisi)){ ?>
                       <?php if(isset($userChoisi) && isset($moisChoisi)){
          $resu=  obtenirSommeTotalFicheFrais($userChoisi,$moisChoisi,$userChoisi, $moisChoisi,$userChoisi,$userChoisi,$moisChoisi,$moisChoisi);
          foreach($resu as $row){
              
              echo" Le total des frais du visiteur ".$userChoisi." est de ". $row['somme']." €";
          }
      }  
      ?></div><br/><?php } ?>
      <?php if(isset($moisChoisi) && isset($userChoisi)){ ?>
      <form id="formValidFiche" method="POST" action="">
          <input type="hidden" name="valide" value="validerFiche"/>
          <input type="hidden" name="lstUsers" value="<?php echo $userChoisi; ?>"/>
          <input type="hidden" name="lstMois" value="<?php echo $moisChoisi; ?>"/>
          
           
            <table style="margin-left: 440; margin-bottom: 100"><tr>
                    <th style="width: 150"><button type="button" onclick="validerFicheFrais()" id="button1id" name="button1id" class="btn btn-info">Valider cette fiche</button></th>
            
                   
                        <th style="width: 150 "><button type="button" onclick="changerVisiteur();" id="button2id" name="button2id" class="btn btn-danger">Changer d'utilisateur</button></th>
                        <?php }?></tr></table>
            
        
      </form>
     <?php }else{ ?>
      <h3> Vous n'êtes pas un comptable</h3>
     <?php }} 
     else
         { ?>
        <p><img src='alerte.png' width='80' height='80'style='margin-left: 90'></p>    
        <h3><a href='cSeConnecter.php' title='Se connecter'>
     Connecter-vous à intranet GSB FRAIS</a></h3>

     <?php }     
?>
     
                
                </div>
      </div>
         <script type="text/javascript"> <?php require("include/_fonctionsValidFichesFrais.inc.js");?></script>
        </div><br/>
      </body>
</html>