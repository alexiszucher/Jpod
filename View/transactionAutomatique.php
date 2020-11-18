<?php 
    include_once("header.php");

    if(isset($_GET['supprTransAuto']) && $_GET['supprTransAuto'] == true)
    {
        supprTransactionAutomatique($_GET['id']);
    }
?>

<button onclick="showAddTransactAuto()" style="margin-left:4%" type="button" class="btn btn-info">
    <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </svg>
</button>

<div class="container">

    <div align="center" class="col-12">
        <?php 
            //===============================================
            //    Affichage des transactions automatiques   /
            //===============================================
        ?>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Projet</th>
                    <th>Montant</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php getTransactionsAutomatiques(); ?>
            </tbody>
        </table>
    </div>

    <div id="addTransactAuto">
        <?php 
            //===============================================
            //    Formulaire de création transaction auto   /
            //===============================================
        ?>
        <form action="#" method="post">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Application</label>
                <select name="idapp" class="form-control" id="exampleFormControlSelect1">
                    <?php getApplicationsForAddTransactAuto() ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Montant</label>
                <select name="montant" class="form-control" id="exampleFormControlSelect1">
                    <?php getPossiblityOfAmount() ?>
                </select>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gains" id="exampleRadios1" value="1" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Gain
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gains" id="exampleRadios2" value="0">
                <label class="form-check-label" for="exampleRadios2">
                    Dépense
                </label>
            </div><br>
            <button class="btn btn-success">CREER LE MONTANT AUTOMATIQUE / JOUR </button>
        </form>

        <?php 
        //===============================================
        //      Traitement création transaction auto    /
        //===============================================
        registerTransactionAuto();
        ?>

    </div>

</div>

<script>
    document.getElementById("addTransactAuto").style.display = "none";
</script>
<?php 
    include_once("footer.php");
?>