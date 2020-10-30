<?php 
    include_once("headerConnexion.php"); 
    login();
?>


<form method="post" action="#">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe</label>
    <input type="password" name="mdp" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>

<?php include_once("footer.php");?>