<?php
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['nom']);
    unset($_SESSION['prenom']);
    
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
    </head>
    <body>
        <header><img src="logo.png"/> <h2>GSB: Galaxy Swiss Bourdin</h2> </header>
       
        <h5> Vous avez été déconnecté ! Pour vous reconnecter merci de cliquer sur le lien suivant: <a href="cSeConnecter.php" alt="seconnecter" title="Se Connecter">se connecter</a></h5>
                
    </body>

</html>
