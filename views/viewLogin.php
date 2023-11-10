<?php
  $title = 'Connexion - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Connexion</h2>
  <div class="row justify-content-center mt-4 mb-3">
    <div class="col-10 col-lg-4 formulaire">
      <form action="login" method="post">
        <div class="form-group">
            <label for="login"><i class="fas fa-user mr-2"></i>Login : </label>
            <span class="error"><?= $error['login'] ?? '' ?></span>
            <input id="login" type="text" class="form-control" name="login">
        </div>
        <div class="form-group">
            <label for="password"><i class="fas fa-key mr-2"></i>Mot de passe : </label>
            <input id="password" type="password" class="form-control" name="password">
            <div class="mt-2">
              <i>
                <small>Minimum 8 caractères, contenant au moins une minuscule, une majuscule,
                  un nombre et un caractère spécial</small>
              </i>
            </div>
        </div>
        <div class="row justify-content-center pt-2">
            <div class="col-10 col-md-6">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="connexion" value="Connexion">
            </div>
        </div>
        <div class="mt-4 mr-md-3 row justify-content-center justify-content-md-end">
          <a href="recuperation">
            <span>Mot de passe oublié ?</span>
          </a>
        </div>
        <div class="mt-2 mr-md-3 row justify-content-center justify-content-md-end">
          <a href="register">
            <span>Pas encore inscrit ?</span>
          </a>
        </div>
      </form>
    </div>
  </div>
</main>
