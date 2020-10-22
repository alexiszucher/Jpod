<?php 
    session_start();
    include_once("../Controller/CheckUser.php"); 
?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Jpod 1.0 - Gestion Finance</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../src/img/logoJpod.png" />
    <!-- Kube CSS -->
    <link rel="stylesheet" href="../src/kube/dist/css/kube.min.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="../src/css/style.css">

</head>
<body>
        <div class="is-navbar-container param-menu is-shadow-3">
            <div class="is-brand padding-accueil">
                <h1><b class="is-logo"><img src='../src/img/logoJpod.png'>&nbsp&nbsp Jpod testtttt2.0</b></h1>
            </div>
            <div class="is-navbar">
                <nav>
                    <ul>
                        <li><a href="#"></a></li>
                    </ul>
                </nav>
                <nav class="is-push-right">
                    <!-- button -->
                    <ul>

                    <?php 
                        $verif_user = check_user();
                        if($verif_user == false)
                        {
                           ?> <li><a href="../" class="button is-small is-secondary padding-bouton-navbar">Se connecter</a></li> <?php
                        }
                        else
                        {
                            ?> 
                                <li><a href="interface.php" class="button is-small is-secondary padding-bouton-navbar">Interface</a></li> 
                                <li><a href="../Controller/Logout.php" class="button is-small is-secondary padding-bouton-navbar">Se déconnecter</a></li>
                            <?php
                        }
                    ?>
                        
                    </ul>
                </nav>
            </div>
        </div>
    
<?php include_once("../Controller/BDDConnection.php");?>

<div class="alert is-focus">
    <h2 class="center">Connexion</h2>
</div>
<form method="post" action="#">
    <fieldset>
        <legend>Informations de connexion</legend>
        <div class="form-item">
            <label>Email</label>
            <input type="text" name="email" class="is-50">
        </div>
        <div class="form-item">
            <label>Mot de passe</label>
            <input type="password" name="mdp" class="is-50">
        </div>
    </fieldset>
    <button type="submit" class="button is-secondary is-icon"><span class="caret is-right"></span>&nbsp&nbspC'est parti !</button>
</form>
<?php include_once("../Controller/Login.php");?>
<?php include_once("footer.php");?>