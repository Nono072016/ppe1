<?php
ini_set("display_errors",0);error_reporting(0);
session_start();
setlocale (LC_TIME, 'fr_FR','fra');
date_default_timezone_set("Europe/Paris");
mb_internal_encoding("UTF-8");
?>
<?php
require_once"include/dao.php";
require_once('include/_utilitairesEtGestionErreurs.lib.php');

if(isset($_POST["lstMois"])){
$moisChoisi=$_POST["lstMois"];
}
if(isset($_GET["lstUsers"])){
$userChoisi =$_GET["lstUsers"];
}

?>
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
                <a class="navbar-brand" href="cAccueilVisiteur.php">Accueil</a>
            </div>        
            <ul class="nav navbar-nav">
                <li><a href="cSeDeconnecter.php"> Déconnexion</a></li>
            
            
            </ul>
        </div>
        <div class="container" style="text-align:center; border: 3 groove black; border-radius: 10; box-shadow: 5px 5px 5px 5px #777">
        <h3>Bienvenue sur l'intranet de l'entreprise GSB: Galaxy Swiss Bourdin</h3>
              <p><span id="date_heure"></span>
                  <script type="text/javascript">window.onload = date_heure('date_heure');</script> </p>
        <?php
if (!empty($_SESSION['login']) && isset($_SESSION['login'])) {
    if($_SESSION['idType']=='V'){
        ?>
         
    <?php echo "<h3> GESTION DES FICHES DE FRAIS</h3>";
echo "<h4>Bienvenue ".$_SESSION['nom'] . "   " . $_SESSION['prenom']."  ".$_SESSION['id']."</h4>";
echo "<h4> Fonction :".$_SESSION['libelleType']."</h4>";
?>
 
        <form method="POST" action="cEditionPdf.php">
            
  <?php  if(isset ($_SESSION['id'])){ 
      $resu = obtenirReqMoisFicheFraisVisiteur($_SESSION['id']);?>
                
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
        
            </div>
  <?php } ?>
        </form>
        <?php }else{ ?>
        <h3> Vous n'êtes pas un visiteur médical</h3>
<?php }}
else { ?>
        <p><img src='alerte.png' width='80' height='80'style='margin-left: 90'></p>   
     <h3><a href='cAccueil.php' title='Se connecter'>
     Connecter-vous à intranet GSB FRAIS</a></h3>

<?php }
?>
    </body>
</html>