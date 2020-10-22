<?php 
    session_start();
    include_once("Controller/CheckUser.php"); 
    $verif_user = check_user();
    if($verif_user == false)
    {
        header('Location: View/connexion.php');
    }
    else
    {
        header('Location: View/interface.php');
    }
?>
