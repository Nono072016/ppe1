<?php
ini_set("display_errors",0);error_reporting(0);
session_start();
?>
<?php
require "include/dao.php";
if (isset($_POST['login']) && isset($_POST['password'])) {
    $user = $_POST['login'];
    $password = $_POST['password'];
    //echo $user . "   " . $password;
    $resu = getUtilisateur($user);
    $login = $resu['login'];
    $nom = $resu['nom'];
    $prenom = $resu['prenom'];
    $pass = $resu['mdp'];
    $type=$resu['idType'];
    $id=$resu['id'];
    $get= libelleType($type);
    $libelleType=$get['libelleType'];
     $_SESSION['login'] = $user;
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['idType']= $type;
        $_SESSION['libelleType']= $libelleType;
        $_SESSION['id']=$id;
        
        if(empty($user)|| empty($password)){
            echo"<h1>Erreur aucun mot de passe et login saisie veuillez recommencer</h1>";
            include 'cSeConnnecter.php';
        }
    if ($pass!= "" && $pass == $password) {
      if($type=='C'){
        require"cAccueil.php";
        exit(0);
      }
     else {
          require"cAccueilVisiteur.php";
          exit(0);
      
      
    } } else {
            echo'<h3> Erreur: login et/ou mot de passe incorrect veuillez recommencer</h3>';
            header('Location:cSeConnecter.php');
            
        }
        
    }
    



?>
<html>
    <head>
        <meta charset="utf-8" >
        <link rel="stylesheet" href="dist/css/bootstrap.css">
        <link rel="stylesheet" href="dist/css/style.css">
        <script type="text/javascript" src="include/date.js"></script>
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <title>Se connecter </title>
    </head>
    <body>
   <html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="dist/css/bootstrap.css">
        <link rel="stylesheet" href="dist/css/style.css">
        <title> GSB: Galaxy Swiss Bourdin </title>
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body style="text-align: center">
        <header><img src="logo.png" /> <h2>GSB: Galaxy Swiss Bourdin</h2> </header>
     
         
              <span id="date_heure"></span>
              <script type="text/javascript">window.onload = date_heure('date_heure');</script><br/><br/>
 <div border="1" class="container">  
         <form class="form-horizontal" method="POST" action="">
<fieldset style="width: 300; margin-left: 422">
<div class="row" style="border: 2 groove black; border-radius: 10; box-shadow: 5px 5px 5px 5px #777">   
<!-- Form Name -->
<legend>Identification GSB 2015</legend>

<!-- Text input-->
<div class="control-group" style="text-align: center">
  <label class="control-label " for="login">Login</label>
  <div class="controls"style="text-align: center">
    <input id="login" name="login" placeholder="login" class="input-xlarge" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" for="password">Password</label>
  <div class="controls">
    <input id="password" name="password" placeholder="password" class="input-xlarge" type="password">
    
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="button"></label>
  <div class="controls">
      <button type="submit" id="button1id" name="button1id" class="btn btn-success">Valider</button>
      <button type="reset" id="button2id" name="button2id" class="btn btn-danger">Effacer</button>
  </div>
  
</div><br/>
</div>    
</fieldset>
</form>
 </div>
    </body>
</html>

