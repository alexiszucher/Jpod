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
        $nbApplication = 1;
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
            echo ' <tr>
                        <th scope="row">'.$nbApplication.'</th>
                        <td>'.$app['libelle'].'</td>
                        <td>'.$budget.' €</td>
                        <td>
                            <a href="../View/application.php?id='.$app['id'].'&libelle='.$app['libelle'].'&img='.$app['img'].'">
                                <button class="btn btn-success">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </button>
                            </a>
                        </td>
                    </tr>';
            $nbApplication++;
        }
    }

?>