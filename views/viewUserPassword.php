<?php
  $title = 'Utilisateur - Modification mot de passe - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Modification mot de passe</h2>
  <div class="row justify-content-center mb-5">
    <div class="d-flex formulaire flex-column">
      <div>
        <form action="password" method="post">
          <div class="form-group">
              <label for="oldPassword"><i class="fas fa-key mr-2"></i>Ancien mot de passe :</label>
              <span class="error"> * <?= $arrayOfErrors['oldPassword'] ?? '' ?></span>
              <input type="password" class="form-control <?= !empty($arrayOfErrors['oldPassword']) ? 'border-danger' : '' ?>" name="oldPassword">
          </div>
          <div class="form-group">
              <label for="password"><i class="fas fa-key mr-2"></i>Nouveau mot de passe :</label>
              <span class="error"> * <?= $arrayOfErrors['password'] ?? '' ?></span>
              <input type="password" class="form-control <?= !empty($arrayOfErrors['password']) ? 'border-danger' : '' ?>" name="password">
              <div class="mt-2">
                <i>
                  <small>Minimum 8 caractères, contenant au moins une minuscule, une majuscule,
                    un nombre et un caractère spécial</small>
                </i>
              </div>
          </div>
          <div class="form-group">
              <label for="confirmPassword"><i class="fas fa-key mr-2"></i>Confirmation mot de passe :</label>
              <span class="error"> * <?= $arrayOfErrors['confirmPassword'] ?? '' ?></span>
              <input type="password" class="form-control <?= !empty($arrayOfErrors['password']) ? 'border-danger' : '' ?>" name="confirmPassword">
          </div>
          <hr class="my-5">
          <div class="row justify-content-center pt-3">
              <div class="col-6">
                <a href="../user" class="btn btn-outline-secondary btn-lg btn-block">Retour</a>
              </div>
              <div class="col-6">
                  <input class="btn btn-outline-primary btn-lg btn-block" name="update" type="submit" value="Validation">
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
