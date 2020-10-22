<?php 
    session_start();
    include_once("../Controller/CheckUser.php");
    if(check_user() == false)
    {
        header('Location: connexion.php');
    }
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
                <h1><b class="is-logo"><img src='../src/img/logoJpod.png'>&nbsp&nbsp Jpod 2.0</b></h1>
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
    