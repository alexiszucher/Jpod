<?php
    session_start();
    include_once("../Controller/BDDConnection.php");
    include_once("../Controller/RequestBDD.php");
   
    $check = addLeads($_POST['leads']);
    header('Location: ../View/'.$_SESSION['urlApp'].'?check='.$check);
?>