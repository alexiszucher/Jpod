<?php 
    include_once("header.php");

    if(isset($_GET['suppr']) && $_GET['suppr'] == true)
    {
        supprTransaction($_GET['id']);
    }
?>

<!--=====================================
/       Affichage des applications      /
======================================-->
<table style="font-size: 30px;" class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Compte</th>
      <th scope="col">Gérer</th>
    </tr>
  </thead>
  <tbody>
    <?php getApplications(); ?>
  </tbody>
</table>

<!--=====================================
/       Affichage des transactions      /
======================================-->
<br><br><br><br><br><br>
<table class="table table-dark">
    <thead>
        <tr>
            <th>Projet</th>
            <th>Date</th>
            <th>Montant</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php echo getLastTransactions(); ?>
    </tbody>
</table>

<?php 
    include_once("footer.php");
?>