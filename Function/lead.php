<?php
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
?>