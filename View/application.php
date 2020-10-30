<?php 
    include_once("header.php");

    if(isset($_GET['id']))
    {
        $_SESSION['idApp'] = $_GET['id'];
        $_SESSION['img'] = $_GET['img'];
        $_SESSION['libelle'] = $_GET['libelle'];
    }

    if(isset($_POST['gain']))
    {
        $check = addGain($_POST['gain']);
        header('Location: interface.php');
    }

    if(isset($_POST['depense']))
    {
        $check = addDepense($_POST['depense']);
        header('Location: interface.php');
    }
    $budget = showBudget();
?>

<div align="center" class="container">
    <div class="alert">
        <?php echo '<h2 class="center"><img src="../resources/img/'.$_SESSION['img'].'"> '.$_SESSION['libelle'].' </h2>' ?>
    </div>
    <button onclick="showCompte()" class="button is-secondary is-icon"><img src="../resources/img/argent.png"></button>
    <button onclick="showTransaction()" class="button is-secondary is-icon"><img src="../resources/img/transactions.png"></button>
</div>

<br><br><br>

<div id="compte">

    <div align="center" class="container">
        <div class="row">

            <div class="col-6">
                <div class="card" style="width: 18rem;">
                    <div style="background-color:#99FF9F"  class="card-body">
                        <h6> Revenus </h6>
                        <h5 class="card-title"><?php echo getGain(); ?> €</h5>
                        <button onclick="ShowFormGain()" class="btn"><img src="../resources/img/add.png"></button>
                        <form id='gain' method="post" action="#">
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
                </div>
            </div>

            <div class="col-6">
                <div class="card" style="width: 18rem;">
                    <div style="background-color:#FF8991"  class="card-body">
                        <h6> Dépenses </h6>
                        <h5 class="card-title"><?php echo getDepense(); ?> €</h5>
                        <button onclick="ShowFormDepense()" class="btn"><img src="../resources/img/add.png"></button>
                        <form id='depense' method="post" action="#">
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
                </div>
            </div>
        </div>

    </div>
</div>



<div id="transaction">
    <table class="table">
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


<?php include_once("footer.php");?>