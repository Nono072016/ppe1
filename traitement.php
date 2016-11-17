
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
        <header><img src="logo.png" width="100" height="80" /> <h2>GSB: Galaxy Swiss Bourdin</h2> </header>
        
        <nav>
            <table><tr><th>Menu</th></tr>
                <tr><td>
            <div><a href="cAccueil.php"> Accueil </a></div>
            <div><a href="cSeDeconnecter.php" title="Se déconnecter">Se déconnecter</a></div>
            <div><a href="cValidFichesFrais.php"> Validation fiches frais </a></div>
            </td></tr></table>
           
        </nav>
        
    
        <table border='1'>
            <tr>
                <th>Login</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Mois</th>
                <th>Somme </th>
            </tr>
        <?php
        require_once("include/dao.php");
        $resu=  obtenirReqSommeFrais();
        foreach ($resu as $ligne) {
        ?>
    <tr>
        <td><?php echo $ligne['login']; ?></td>
        <td><?php echo $ligne['nom']; ?></td>
        <td><?php echo $ligne['prenom']; ?></td>
        <td><?php echo $ligne['mois']; ?></td>
        <td><?php echo $ligne['somme']; ?></td>
    </tr>
        <?php } ?>
</table>
    </body>
</html>
