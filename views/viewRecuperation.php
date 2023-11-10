<?php
  $title = 'Mot de passe oublié - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Mot de passe oublié :</h2>
  <div class="row justify-content-center mb-5">
    <div class="d-flex formulaire col-5 flex-column">
      <div>
        <form action="recuperation" method="post">
          <div class="form-group">
              <label for="login"><i class="fas fa-user mr-2"></i>Login du compte :</label>
              <span class="error"> * <?= $message ?? '' ?></span>
              <input type="text" class="form-control" name="login">
          </div>
          <div class="form-group">
              <label for="email"><i class="fas fa-envelope mr-2"></i>Adresse mail du compte :</label>
              <span class="error"> * </span>
              <input type="text" class="form-control" name="email">
          </div>
          <div class="row justify-content-center pt-5">
              <div class="col-6">
                <a href="../login" class="btn btn-outline-secondary btn-lg btn-block">Retour</a>
              </div>
              <div class="col-6">
                  <input class="btn btn-outline-primary btn-lg btn-block" name="recuperation" type="submit" value="Validation">
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
