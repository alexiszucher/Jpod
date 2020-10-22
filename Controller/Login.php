<?php
if(isset($_POST["email"]))
{
    //Recupération des valeurs du formuaire dans des variables
    $email=$_POST['email'];
    $mdp=$_POST['mdp'];

    //Connexion de l'utilisateur

    if($email == '' || $mdp =='')
    {
        echo'<div class="alert is-error">Erreur lors de la connexion, vérifiez vos identifiants puis réessayez</div>';
    }
    else
    {
        $requete = $bdd->prepare("SELECT * from users where email = :email");
        $requete->bindParam(':email', $email);
        // exécute
        $requete->execute();
        $data=$requete->fetch();

        if (md5($mdp) == $data['mdp']) // Acces OK !
        {
            $_SESSION['id'] = $data['id'];
            $_SESSION['email'] = $data['email'];	
            echo'<div class="alert is-success">Authentification Réussi, chargement de l\'interface...</div>';
            ?>

            <script>
                    function redirect()
                    {
                        document.location.href="interface.php";
                    }
                    setTimeout(redirect,1000);
            </script>

            <?php
        }
        else
        {
            echo'<div class="alert is-error">Erreur lors de la connexion, vérifiez vos identifiants puis réessayez</div>';
        }
        $requete->closeCursor();
    }        
}
?>