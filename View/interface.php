<?php include_once("header.php");?>
<?php include_once("../Controller/BDDConnection.php");?>
<?php include_once("../Controller/RequestBDD.php");?>
<?php 
    if(isset($_GET['suppr']) && $_GET['suppr'] == true)
    {
        supprTransaction($_GET['id']);
    }
?>
<?php $budget = showBudgetTotal();?>
<?php $budgetE = showBudgetTotalWithoutEconomy();?>
<div class="margin-top">
    <h2 class="center"><img src="../src/img/applications.png"> Applications Disponibles</h2>
</div>

<div class="alert is-success"><h2>BUDGET TOTAL : <?php echo $budget; ?> €</H2></div>
<div class="alert is-success"><h2>BUDGET SANS ECONOMIE : <?php echo $budgetE; ?> €</H2></div>

<?php
    getApplications();
?>


<br><br><br><br><br><br>
<table>
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



<?php include_once("../Controller/Login.php");?>
<?php include_once("footer.php");?>