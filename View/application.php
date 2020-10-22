<?php include_once("header.php");?>
<?php include_once("../Controller/BDDConnection.php");?>
<?php include_once("../Controller/RequestBDD.php");?>
<?php 
    if(isset($_GET['id']))
    {
        $_SESSION['idApp'] = $_GET['id'];
        $_SESSION['img'] = $_GET['img'];
        $_SESSION['libelle'] = $_GET['libelle'];
    }
    $budget = showBudget();
?>

<div class="alert">
    <?php echo '<h2 class="center"><img src="../src/img/'.$_SESSION['img'].'"> '.$_SESSION['libelle'].' </h2>' ?>
</div>

<button onclick="showCompte()" class="button is-secondary is-icon"><img src="../src/img/argent.png"></button>
<button onclick="showObjectif()" class="button is-secondary is-icon"><img src="../src/img/objectif.png"></button>
<button onclick="showTransaction()" class="button is-secondary is-icon"><img src="../src/img/transactions.png"></button>

<div id="compte">
    <div class="alert is-success"><h2>ARGENT SUR LE COMPTE : <?php echo $budget; ?> €</H2></div>



    <div class="alert is-focus width-30 display-block center">
        Gains 
        <br>
        <h3>
            <?php echo getGain(); ?> €
        </h3>
        <br>
        <button onclick="ShowFormGain()" class="button is-secondary is-icon"><img src="../src/img/add.png"></button>
        <form id='gain' method="post" action="../Controller/AddGain.php">
            <div class="form-item">
                <label>Montant</label>
                <div class="is-prepend is-50">
                    <span>$</span>
                    <input name="gain" type="text">
                </div>
            </div>
            <div class="form-item is-buttons">
                <button type="submit" class="button">Ajouter</button>
            </div>
        </form>
    </div>



    <div class="alert is-error width-30 display-block center">
        Dépenses 
        <br>
        <h3>
            <?php echo getDepense() ?> €
        </h3>
        <br>
        <button onclick="ShowFormDepense()" class="button is-secondary is-icon"><img src="../src/img/add.png"></button>
        <form id="depense" method="post" action="../Controller/AddDepense.php">
            <div class="form-item">
                <label>Montant</label>
                <div class="is-prepend is-50">
                    <span>$</span>
                    <input name="depense" type="text">
                </div>
            </div>
            <div class="form-item is-buttons">
                <button type="submit" class="button">Ajouter</button>
            </div>
        </form>
    </div>


    <div class="alert is-focus center-leads width-70">
        Leads
        <br>
        <h3>
            <?php echo getLeads(); ?>
        </h3>
        <br>
        <button onclick="ShowFormLeads()" class="button is-secondary is-icon"><img src="../src/img/add.png"></button>
        <form id='leads' method="post" action="../Controller/AddLeads.php">
            <div class="form-item">
                <label>Nombre</label>
                <div class="is-prepend is-50">
                    <span>i</span>
                    <input name="leads" type="text">
                </div>
            </div>
            <div class="form-item is-buttons">
                <button type="submit" class="button">Ajouter</button>
            </div>
        </form>
    </div>
    <?php
        if(isset($_GET['check']))
        {
            echo $_GET['check'];
        }
    ?>
</div>














<div id="objectif">
        <h2> Créer un projet </h2><button onclick="ShowFormSujet()" class="button is-secondary is-icon"><img id="img-creation-sujet" src="../src/img/creation-sujet.png"></button>
        <?php
            if(isset($_GET['check']))
            {
                echo $_GET['check'];
            }
        ?>
        <form id='sujets' method="post" action="../Controller/AddSubject.php">
            <div class="form-item">
                <label></label>
                <div class="is-prepend is-50">
                    <span>Nom</span>
                    <input name="sujet" type="text">
                </div>
            </div>
            <div class="form-item is-buttons">
                <button type="submit" class="button">Ajouter</button>
            </div>
        </form>

        <br><br><br><br><br><br>
        
        <h2> Tous les projets </h2>
        <br><br>
        <?php
            getSubjects();
        ?>
        <br><br><br><br><br><br>
</div>










<div id="transaction">
<table>
    <thead>
        <tr>
            <th>Projet</th>
            <th>Date</th>
            <th>Montant</th>
        </tr>
    </thead>
    <tbody>
        <?php echo getTransactions(); ?>
    </tbody>
</table>
</div>





<?php include_once("../Controller/Login.php");?>
<?php include_once("footer.php");?>