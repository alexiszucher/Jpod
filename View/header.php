<?php 
    session_start();
    include_once("../Function/user.php");
    include_once("../Function/application.php");
    include_once("../Function/transaction.php");
    include_once("../Function/lead.php");
    include_once("../Function/transactionAutomatique.php");

    if(check_user() == false)
    {
        ?>
            <script>
                document.location.href="connexion.php";
            </script>
        <?php
    }

    if(isset($_GET['deco']) && $_GET['deco'] == true)
    {
        unset($_SESSION['email']);
        ?>
            <script>
                document.location.href="connexion.php";
            </script>
        <?php
    }
?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Jpod 3.0 - Gestion Finance</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../src/img/logoJpod.png" />
    <!-- Kube CSS -->
    <link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="../resources/css/style.css">

</head>
<body>
    <div style="background: linear-gradient(135deg, #FFAD16, #FF4528);" class="container-fluid">
        <div class="row">
            <div class="col-6">
                <h3 style="color:white;"><img src='../resources/img/logoJpod.png'>&nbsp&nbsp Jpod 3.0 Gestion Finance</b></h3>
            </div>
            <div align="right" style="margin-top:3%" class="col-6">
                <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                </svg>
                <b style="font-size:30px;color:white;"><?php echo showBudgetTotalWithoutEconomy(); ?> €</b>
            </div>
        </div>
    </div>
    <div align="right" style="margin-top:2%;" class="col-12">
                <?php 
                    $verif_user = check_user();
                    if($verif_user == false)
                    {
                        ?> <a href="../" class="button is-small is-secondary padding-bouton-navbar">Se connecter</a> <?php
                    }
                    else
                    {
                        ?> 
                            <h5><?php echo $_SESSION['email'] ?>
                                &nbsp&nbsp&nbsp
                                <a href="interface.php" class="btn btn-primary">Interface</a>
                                &nbsp
                                <a href="transactionAutomatique.php" class="btn btn-primary">Transactions Auto</a>
                                &nbsp
                                <a href="?deco=true" class="btn btn-primary">Se déconnecter</a>
                            </h5>
                        <?php
                    }
                ?>
    </div>
    <br><br><br>

                    

    