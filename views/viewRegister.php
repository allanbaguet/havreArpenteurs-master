<?php
  $title = 'Inscription - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Inscription</h2>
  <div class="row justify-content-center">
    <div class="col-6 formulaire">
      <h3 class="text-center mt-3 mb-5"><u>Informations obligatoires</u></h3>
      <!-- <p class="mt-3 mb-5 error">* : Champ obligatoire</p> -->
      <form action="register" method="post">
        <div class="form-group">
          <label for="pseudo"><i class="fas fa-user mr-2"></i>Pseudo :</label><span class="error"> * <?= $arrayOfErrors['pseudo'] ?? '' ?></span>
          <input id="pseudo" type="text" class="form-control <?= !empty($arrayOfErrors['pseudo']) ? 'border-danger' : '' ?>" name="pseudo" value="<?= $_POST['pseudo'] ?? '' ?>">
          <div class="mt-2">
            <i>
              <small>Entre 3 et 16 caractères.</small>
            </i>
          </div>
        </div>
        <div class="form-group">
            <label for="password"><i class="fas fa-key mr-2"></i>Mot de passe :</label>
            <span class="error"> * <?= $arrayOfErrors['password'] ?? '' ?></span>
            <input id="password" type="password" class="form-control <?= !empty($arrayOfErrors['password']) ? 'border-danger' : '' ?>" name="password">
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
            <input id="confirmPassword" type="password" class="form-control <?= !empty($arrayOfErrors['password']) ? 'border-danger' : '' ?>" name="confirmPassword">
        </div>
        <div class="form-group">
            <label for="email"><i class="fas fa-envelope mr-2"></i>Email :</label>
            <span class="error"> * <?= $arrayOfErrors['email'] ?? '' ?></span>
            <input id="email" type="email" class="form-control <?= !empty($arrayOfErrors['email']) ? 'border-danger' : '' ?>" name="email" value="<?= $_POST['email'] ?? '' ?>">
        </div>
        <hr class="hrForm">
        <h3 class="text-center mb-5"><u>Informations complémentaires</u></h3>
        <div class="form-group">
            <label for="firstName"><i class="fas fa-user mr-2"></i>Prénom :</label>
            <span class="error"> <?= $arrayOfErrors['firstName'] ?? '' ?></span>
            <input id="firstName" type="text" class="form-control <?= !empty($arrayOfErrors['firstName']) ? 'border-danger' : '' ?>" name="firstName" value="<?= $_POST['firstName'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="lastName"><i class="fas fa-user mr-2"></i>Nom :</label>
            <span class="error"> <?= $arrayOfErrors['lastName'] ?? '' ?></span>
            <input id="lastName" type="text" class="form-control <?= !empty($arrayOfErrors['lastName']) ? 'border-danger' : '' ?>" name="lastName" value="<?= $_POST['lastName'] ?? '' ?>">
        </div>
        <hr class="hrForm">
        <div class="form-group">
            <label for="birthDate"><i class="fas fa-calendar-alt mr-2"></i>Date de naissance :</label>
            <span class="error"> <?= $arrayOfErrors['birthDate'] ?? '' ?></span>
            <input id="birthDate" type="date" class="form-control <?= !empty($arrayOfErrors['birthDate']) ? 'border-danger' : '' ?>" name="birthDate" value="<?= $_POST['birthDate'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="phone"><i class="fas fa-phone mr-2"></i>Téléphone :</label>
            <span class="error"> <?= $arrayOfErrors['phone'] ?? '' ?></span>
            <input id="phone" type="text" class="form-control <?= !empty($arrayOfErrors['phone']) ? 'border-danger' : '' ?>" name="phone" value="<?= $_POST['phone'] ?? '' ?>">
        </div>
        <hr class="hrForm">
        <div class="form-group">
            <label for="address"><i class="fas fa-home mr-2"></i>Adresse :</label>
            <div class="row">
              <div class="col-3 d-inline-block">
                <input type="text" class="form-control <?= !empty($arrayOfErrors['streetNumber']) ? 'border-danger' : '' ?>" name="streetNumber" placeholder="N°" value="<?= $_POST['streetNumber'] ?? '' ?>">
                <small class="error"><?= $arrayOfErrors['streetNumber'] ?? '' ?></small>
              </div>
              <div class="col-9 d-inline-block">
                <input type="text" class="form-control <?= !empty($arrayOfErrors['streetName']) ? 'border-danger' : '' ?>" name="streetName" placeholder="Rue, avenue, ..." value="<?= $_POST['streetName'] ?? '' ?>">
                <small class="error"><?= $arrayOfErrors['streetName'] ?? '' ?></small>
              </div>
            </div>
            <div class="my-3">
              <input type="text" class="form-control <?= !empty($arrayOfErrors['additionalAddress']) ? 'border-danger' : '' ?>" name="additionalAddress" placeholder="Complément ..." value="<?= $_POST['additionalAddress'] ?? '' ?>">
              <small class="error"><?= $arrayOfErrors['additionalAddress'] ?? '' ?></small>
            </div>
            <div class="row">
              <div class="col-4 d-inline-block">
                <input type="text" class="form-control <?= !empty($arrayOfErrors['zipCode']) ? 'border-danger' : '' ?>" name="zipCode" placeholder="Code Postal" value="<?= $_POST['zipCode'] ?? '' ?>">
                <small class="error"><?= $arrayOfErrors['zipCode'] ?? '' ?></small>
              </div>
              <div class="col-8 d-inline-block">
                <input type="text" class="form-control <?= !empty($arrayOfErrors['city']) ? 'border-danger' : '' ?>" name="city" placeholder="Ville" value="<?= $_POST['city'] ?? '' ?>">
                <small class="error"><?= $arrayOfErrors['city'] ?? '' ?></small>
              </div>
            </div>
            <hr class="hrForm">
            <div class="row justify-content-center">
              <div class="g-recaptcha" data-sitekey="6Lfql7AUAAAAAFLbOdVWFNf9ABbtnTS3fQT4pEyB"></div>
            </div>
        </div>
        <div class="text-center my-3">
          <i><small>En appuyant sur le bouton créer mon compte, vous reconnaissez avoir lu et
            accepté <a href="terms&Conditions.php">les conditions générales</a> du Havre des Arpenteurs.</small></i>
        </div>
        <div class="row justify-content-center pt-3">
            <div class="col-6">
              <a href="login" class="btn btn-outline-secondary btn-lg btn-block">Retour</a>
            </div>
            <div class="col-6">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Créer mon compte">
            </div>
        </div>
      </form>
    </div>
  </div>
</main>
