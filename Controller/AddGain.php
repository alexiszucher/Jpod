<?php
    session_start();
    include_once("../Controller/BDDConnection.php");
    include_once("../Controller/RequestBDD.php");
   
    $check = addGain($_POST['gain']);
    header('Location: ../View/application.php?check='.$check);
?>