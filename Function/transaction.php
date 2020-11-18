 <?php   
    function getLastTransactions()
    {
        include("BDDConnection.php");
        try
        {
            $libelle = " ";
            $request = $bdd->prepare("SELECT * FROM transactions ORDER BY id desc");
            $request->execute();
            while($transact = $request->fetch(PDO::FETCH_ASSOC))
            {
                $requestLibelle = $bdd->prepare("SELECT libelle FROM applications WHERE id=".$transact['id_application']);
                $requestLibelle->execute();
                while($getLibelle = $requestLibelle->fetch(PDO::FETCH_ASSOC))
                {
                    $libelle = $getLibelle['libelle'];
                }
                if($transact['gains'] == 1)
                {
                    echo "<tr><td><h4 style='color:green'>".$libelle."</h4></td><td><h4 style='color:green'>".strftime('%d-%m-%Y',strtotime($transact['date']))."</h4></td><td><h4 style='color:green'>".$transact['montant']." €</h4></td><td><a href='interface.php?suppr=true&id=".$transact['id']."'><img src='../resources/img/supprimer.png'></a></td></tr>";
                }
                else
                {
                    echo "<tr><td><p style='color:grey'>".$libelle."</p></td><td><p style='color:grey'>".strftime('%d-%m-%Y',strtotime($transact['date']))."</p></td><td><p style='color:grey'>- ".$transact['montant']." €</p></td><td><a href='interface.php?suppr=true&id=".$transact['id']."'><img src='../resources/img/supprimer.png'></a></td></tr>";
                }                
            }
        }
        catch(Exception $e)
        {
            echo "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
    }

    function getTransactions()
    {
        include("BDDConnection.php");
        try
        {
            $libelle = " ";
            $request = $bdd->prepare("SELECT * FROM transactions WHERE id_application=".$_SESSION['idApp']." ORDER BY id desc");
            $request->execute();
            while($transact = $request->fetch(PDO::FETCH_ASSOC))
            {
                $requestLibelle = $bdd->prepare("SELECT libelle FROM applications WHERE id=".$transact['id_application']);
                $requestLibelle->execute();
                while($getLibelle = $requestLibelle->fetch(PDO::FETCH_ASSOC))
                {
                    $libelle = $getLibelle['libelle'];
                }
                if($transact['gains'] == 1)
                {
                    echo "<tr><td><h4 style='color:green'>".$libelle."</h4></td><td><h4 style='color:green'>".strftime('%d-%m-%Y',strtotime($transact['date']))."</h4></td><td><h4 style='color:green'>".$transact['montant']." €</h4></td></tr>";
                }
                else
                {
                    echo "<tr><td><h4 style='color:red'>".$libelle."</h4></td><td><h4 style='color:red'>".strftime('%d-%m-%Y',strtotime($transact['date']))."</h4></td><td><h4 style='color:red'>- ".$transact['montant']." €</h4></td></tr>";
                }                
            }
        }
        catch(Exception $e)
        {
            echo "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
    }

    function supprTransaction($id)
    {
        include("BDDConnection.php");
        $request =  $bdd->prepare("DELETE FROM transactions WHERE id=:id");
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

    function showBudgetTotalWithoutEconomy()
    {
        include("BDDConnection.php");
        $budget = 0;
        try
        {
            $requestIdEco = $bdd->prepare("SELECT id from applications WHERE libelle='Economie'");
            $requestIdEco->execute();
            $idEco = 0;
            while($idEconomie = $requestIdEco->fetch(PDO::FETCH_ASSOC))
            {
                $idEco = $idEconomie['id'];
            }
            $request = $bdd->prepare("SELECT * from transactions WHERE id_application!=".$idEco);
            $request->execute();
            $budget = 0;
            while($transact = $request->fetch(PDO::FETCH_ASSOC))
            {
                //SI GAIN
                if($transact['gains'] == 1)
                {
                    $budget += $transact['montant'];
                }
                //SI DEPENSE
                else
                {
                    $budget -= $transact['montant'];
                }
            }
        }
        catch(Exception $e)
        {
            $budget = "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
        return $budget;
    }

    function showBudget()
    {
        include("BDDConnection.php");
        $budget = "";
        try
        {
            $request = $bdd->prepare("SELECT * from transactions where id_application=".$_SESSION['idApp']);
            $request->execute();
            $budget = 0;
            while($transact = $request->fetch(PDO::FETCH_ASSOC))
            {
                //SI GAIN
                if($transact['gains'] == 1)
                {
                    $budget += $transact['montant'];
                }
                //SI DEPENSE
                else
                {
                    $budget -= $transact['montant'];
                }
            }
        }
        catch(Exception $e)
        {
            $budget = "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
        return $budget;
    }

    function getGain()
    {
        include("BDDConnection.php");
        $gain = 0;
        try
        {
            $request = $bdd->prepare("SELECT montant from transactions where id_application=".$_SESSION['idApp']." AND gains=1");
            $request->execute();
            while($argent = $request->fetch(PDO::FETCH_ASSOC))
            {
                $gain += $argent['montant'];
            }
        }
        catch(Exception $e)
        {
            $gain = "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
        return $gain;
    }

    function getDepense()
    {
        include("BDDConnection.php");
        $gain = 0;
        try
        {
            $request = $bdd->prepare("SELECT montant from transactions where id_application=".$_SESSION['idApp']." AND gains=0");
            $request->execute();
            while($argent = $request->fetch(PDO::FETCH_ASSOC))
            {
                $gain += $argent['montant'];
            }
        }
        catch(Exception $e)
        {
            $gain = "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
        return $gain;
    }

    function addGain($gain)
    {
        include("BDDConnection.php");
        $check = "";
        try
        {
            $request = $bdd->prepare("INSERT INTO transactions(id_application,montant,gains,date)
                                VALUES(:id_app,:montant,1,:date)");
            $request->bindParam(':id_app', $_SESSION['idApp']);
            $request->bindParam(':montant', $gain);
            $request->bindParam(':date', date('Y-m-d'));
            $request->execute();

            $check = "<div class='alert is-success'>Le montant a été ajouté !</div>";
        }
        catch(Exception $e)
        {
            $check = "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
        return $check;
    }

    function addDepense($depense)
    {
        include("BDDConnection.php");
        $check = "";
        try
        {
            $request = $bdd->prepare("INSERT INTO transactions(id_application,montant,gains,date)
                                VALUES(:id_app,:montant,0,:date)");
            $request->bindParam(':id_app', $_SESSION['idApp']);
            $request->bindParam(':montant', $depense);
            $request->bindParam(':date', date('Y-m-d'));
            $request->execute();

            $check = "<div class='alert is-success'>Le montant a été ajouté !</div>";
        }
        catch(Exception $e)
        {
            $check = "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
        return $check;
    }
?>