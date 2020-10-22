<?php
      
    function getApplications()
    {
        include("BDDConnection.php");
        $budget = 0;
        $request = $bdd->prepare("SELECT id,libelle,url,img
                    FROM applications 
                    INNER JOIN droits_applications ON applications.id = droits_applications.id_application
                    WHERE id_user=:id_user");
        $request->bindParam(':id_user', $_SESSION['id']);
        $request->execute();
        $budget = 0;
        while($app = $request->fetch(PDO::FETCH_ASSOC))
        {
            $budget = 0;
            $request2 = $bdd->prepare("SELECT * from transactions where id_application=".$app['id']);
            $request2->execute();
            while($transact = $request2->fetch(PDO::FETCH_ASSOC))
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
            echo '<a href="../View/application.php?id='.$app['id'].'&libelle='.$app['libelle'].'&img='.$app['img'].'"><button class="button is-secondary padding-accueil"><img src="../src/img/'.$app['img'].'">'.$app['libelle'].'<br/>'.$budget.' €</button></a>';
        }
    }

    function addGain($gain)
    {
        session_start();
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

            $request = $bdd->prepare("UPDATE budget_applications SET budget=budget+:gain WHERE id_application=:id_app");
            $request->bindParam(':id_app', $_SESSION['idApp']);
            $request->bindParam(':gain', $gain);
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
        session_start();
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

            $request = $bdd->prepare("UPDATE budget_applications SET budget=budget-:depense WHERE id_application=:id_app");
            $request->bindParam(':id_app', $_SESSION['idApp']);
            $request->bindParam(':depense', $depense);
            $request->execute();

            $check = "<div class='alert is-success'>Le montant a été ajouté !</div>";
        }
        catch(Exception $e)
        {
            $check = "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
        return $check;
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

    function getLeads()
    {
        include("BDDConnection.php");
        $leads = 0;
        try
        {
            $request = $bdd->prepare("SELECT leads from applications where id=".$_SESSION['idApp']);
            $request->execute();
            while($lead = $request->fetch(PDO::FETCH_ASSOC))
            {
                $leads = $lead['leads'];
            }
        }
        catch(Exception $e)
        {
            $leads = "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
        return $leads;
    }

    function addLeads($leads)
    {
        session_start();
        include("BDDConnection.php");
        $check = "";
        try
        {
            $request = $bdd->prepare("UPDATE applications SET leads=leads+:leads WHERE id=:id_app");
            $request->bindParam(':id_app', $_SESSION['idApp']);
            $request->bindParam(':leads', $leads);
            $request->execute();

            $check = "<div class='alert is-success'>Les Leads ont été ajouté !</div>";
        }
        catch(Exception $e)
        {
            $check = "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
        return $check;
    }

    function addSubject($sujet)
    {
        session_start();
        include("BDDConnection.php");
        $check = "";
        try
        {
            $request = $bdd->prepare("INSERT INTO sujets(id_application,libelle,visible)
                                VALUES(:id_app,:libelle,1)");
            $request->bindParam(':id_app', $_SESSION['idApp']);
            $request->bindParam(':libelle', $sujet);
            $request->execute();

            $check = "<div class='alert is-success'>Le sujet a été ajouté !</div>";
        }
        catch(Exception $e)
        {
            $check = "<div class='alert is-error'>ERREUR ! Le traitement de la base n'a pas pu être effectué !</div>";
        }
        return $check;
    }

    function getSubjects()
    {
        include("BDDConnection.php");
        $nbTaches = 0;
        $request = $bdd->prepare("SELECT *
                    FROM sujets
                    WHERE id_application=:id_app");
        $request->bindParam(':id_app', $_SESSION['idApp']);
        $request->execute();
        while($sujet = $request->fetch(PDO::FETCH_ASSOC))
        {
            include("BDDConnection.php");
            $request = $bdd->prepare("SELECT COUNT(id) as nb_taches
                                    FROM taches
                                    WHERE id_sujet=:id_sujet");
            $request->bindParam(':id_sujet', $sujet['id']);
            $request->execute();
            while($tache = $request->fetch(PDO::FETCH_ASSOC))
            {
                $nbTaches = $tache['nb_taches'];
            }
            echo '<a href="../View/'.$_SESSION['urlApp'].'?id_sujet='.$sujet['id'].'"><button class="button is-secondary">'.$sujet['libelle'].'<br><br><br>'.$nbTaches.' Taches Restantes</button></a>';
        }
    }

    function showBudgetTotal()
    {
        include("BDDConnection.php");
        $budget = "";
        try
        {
            $request = $bdd->prepare("SELECT * from transactions");
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
                    echo "<tr><td><h4 style='color:green'>".$libelle."</h4></td><td><h4 style='color:green'>".strftime('%d-%m-%Y',strtotime($transact['date']))."</h4></td><td><h4 style='color:green'>".$transact['montant']." €</h4></td><td><a href='interface.php?suppr=true&id=".$transact['id']."'><button class='button is-tertiary is-icon'><img src='../src/img/supprimer.png'></button></a></td></tr>";
                }
                else
                {
                    echo "<tr><td><h4 style='color:red'>".$libelle."</h4></td><td><h4 style='color:red'>".strftime('%d-%m-%Y',strtotime($transact['date']))."</h4></td><td><h4 style='color:red'>- ".$transact['montant']." €</h4></td><td><a href='interface.php?suppr=true&id=".$transact['id']."'><button class='button is-tertiary is-icon'><img src='../src/img/supprimer.png'></button></a></td></tr>";
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

?>