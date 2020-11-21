<?php

    function getApplicationsForAddTransactAuto()
    {
        include("BDDConnection.php");
        $request = $bdd->prepare("SELECT id,libelle,url,img
                    FROM applications 
                    INNER JOIN droits_applications ON applications.id = droits_applications.id_application
                    WHERE id_user=:id_user");
        $request->bindParam(':id_user', $_SESSION['id']);
        $request->execute();
        while($app = $request->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$app['id'].'">'.$app['libelle'].'</option>';
        }
    }

    function getPossiblityOfAmount()
    {
        $fin = 100;
        for($i=1;$i<=$fin;$i++)
        {
            echo "<option value='".$i."'>".$i."</option>";
        }
    }

    function registerTransactionAuto()
    {
        if(isset($_POST['gains']))
        {
            include("BDDConnection.php");
            $date = date('Y-m-d');
            $request = $bdd->prepare("INSERT INTO transactions_automatiques(id_application,montant,gains,dateDerniereMAJ) VALUES(:idapp,:montant,:gains,:datedernieremaj)");
            $request->bindParam(':idapp', $_POST['idapp']);
            $request->bindParam(':montant', $_POST['montant']);
            $request->bindParam(':gains', $_POST['gains']);
            $request->bindParam(':datedernieremaj', $date);

            if($request->execute())
            {
                ?><div class="alert alert-success">Transaction automatique ajoutée ! attention : la transaction n'a pas été ajouté pour aujourd'hui mais sera exécuté demain.</div><?php
            }
        }
    }

    function checkMAJTransactionsAutos()
    {
        include("BDDConnection.php");
        $date = date('Y-m-d');
        $request = $bdd->prepare("SELECT * from transactions_automatiques");
        $request->execute();

        while($transaction_auto = $request->fetch(PDO::FETCH_ASSOC))
        {
            while($transaction_auto['dateDerniereMAJ'] != $date)
            {
                $request2 = $bdd->prepare("INSERT INTO transactions(id_application,montant,gains,date) VALUES(".$transaction_auto['id_application'].", ".$transaction_auto['montant'].", ".$transaction_auto['gains'].", '".$transaction_auto['dateDerniereMAJ']."')");
                $request2->execute();
                $transaction_auto['dateDerniereMAJ'] = date('Y-m-d', strtotime($transaction_auto['dateDerniereMAJ'].' + 1 days'));
            }
            $request2 = $bdd->prepare("INSERT INTO transactions(id_application,montant,gains,date) VALUES(".$transaction_auto['id_application'].", ".$transaction_auto['montant'].", ".$transaction_auto['gains'].", '".$transaction_auto['dateDerniereMAJ']."')");
            $request2->execute();
            $transaction_auto['dateDerniereMAJ'] = date('Y-m-d', strtotime($transaction_auto['dateDerniereMAJ'].' + 1 days'));
            $bdd->query("UPDATE transactions_automatiques SET dateDerniereMAJ = '".$transaction_auto['dateDerniereMAJ']."' WHERE id = ".$transaction_auto['id']);
        }
    }

    function getTransactionsAutomatiques()
    {
        include("BDDConnection.php");
        $libelle = " ";
        $request = $bdd->prepare("SELECT * from transactions_automatiques");
        $request->execute();
        while($transaction_auto = $request->fetch(PDO::FETCH_ASSOC))
        {
            $requestLibelle = $bdd->prepare("SELECT libelle FROM applications WHERE id=".$transaction_auto['id_application']);
            $requestLibelle->execute();
            while($getLibelle = $requestLibelle->fetch(PDO::FETCH_ASSOC))
            {
                $libelle = $getLibelle['libelle'];
            }
            if($transaction_auto['gains'] == 1)
            {
                echo "<tr><td><h4 style='color:green'>".$libelle."</h4></td><td><h4 style='color:green'>".$transaction_auto['montant']." €</h4></td><td><a href='?supprTransAuto=true&id=".$transaction_auto['id']."'><img src='../resources/img/supprimer.png'></a></td></tr>";
            }
            else
            {
                echo "<tr><td><h4 style='color:red'>".$libelle."</h4></td><td><h4 style='color:red'>- ".$transaction_auto['montant']." €</h4></td><td><a href='?supprTransAuto=true&id=".$transaction_auto['id']."'><img src='../resources/img/supprimer.png'></a></td></tr>";
            }
        }
    }

    function supprTransactionAutomatique($id)
    {
        include("BDDConnection.php");
        $request =  $bdd->prepare("DELETE FROM transactions_automatiques WHERE id=:id");
        $request->bindParam(':id',$id);
        if($request->execute())
        {
            echo "<div class='alert is-success'>Transaction Supprimée !</div>";
        }
        else
        {
            echo "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
    }

?>