<?php
    session_start();
    include_once("../Controller/BDDConnection.php");
    include_once("../Controller/RequestBDD.php");
   
    $check = addDepense($_POST['depense']);
    header('Location: ../View/application.php?check='.$check);
?>