<?php
  $title = 'Utilisateur - Modification - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Bonjour, <?= $userInfo->userName() ?></h2>
  <div class="row justify-content-center mb-5">
    <div class="d-flex flex-column formulaire">
        <p>Modification informations personnelles :</p>
        <form action="update" method="post">
          <div class="form-group">
            <label for="pseudo"><i class="fas fa-user mr-2"></i>Pseudo :</label><span class="error"> * <?= $arrayOfErrors['pseudo'] ?? '' ?></span>
            <input type="text" class="form-control <?= !empty($arrayOfErrors['pseudo']) ? 'border-danger' : '' ?>" name="pseudo" value="<?= $userInfo->userName() ?>">
            <div class="mt-2">
              <i>
                <small>Entre 3 et 16 caractères.</small>
              </i>
            </div>
          </div>
          <div class="form-group">
              <label for="email"><i class="fas fa-envelope mr-2"></i>Email :</label>
              <span class="error"> * <?= $arrayOfErrors['email'] ?? '' ?></span>
              <input type="email" class="form-control <?= !empty($arrayOfErrors['email']) ? 'border-danger' : '' ?>" name="email" value="<?= $userInfo->email() ?>">
          </div>
          <hr>
          <div class="form-group">
              <label for="firstName"><i class="fas fa-user mr-2"></i>Prénom :</label>
              <span class="error"> <?= $arrayOfErrors['firstName'] ?? '' ?></span>
              <input type="text" class="form-control <?= !empty($arrayOfErrors['firstName']) ? 'border-danger' : '' ?>" name="firstName" value="<?= $userInfo->firstName() ?>">
          </div>
          <div class="form-group">
              <label for="lastName"><i class="fas fa-user mr-2"></i>Nom :</label>
              <span class="error"> <?= $arrayOfErrors['lastName'] ?? '' ?></span>
              <input type="text" class="form-control <?= !empty($arrayOfErrors['lastName']) ? 'border-danger' : '' ?>" name="lastName" value="<?= $userInfo->lastName() ?>">
          </div>
          <hr>
          <div class="form-group">
              <label for="birthDate"><i class="fas fa-calendar-alt mr-2"></i>Date de naissance :</label>
              <span class="error"> <?= $arrayOfErrors['birthDate'] ?? '' ?></span>
              <input type="date" class="form-control <?= !empty($arrayOfErrors['birthDate']) ? 'border-danger' : '' ?>" name="birthDate" value="<?= $userInfo->birthDate() ?>">
          </div>
          <div class="form-group">
              <label for="phone"><i class="fas fa-phone mr-2"></i>Téléphone :</label>
              <span class="error"> <?= $arrayOfErrors['phone'] ?? '' ?></span>
              <input type="text" class="form-control <?= !empty($arrayOfErrors['phone']) ? 'border-danger' : '' ?>" name="phone" value="<?= $userInfo->phone() ?>">
          </div>
          <hr>
          <div class="form-group">
              <label for="address"><i class="fas fa-home mr-2"></i>Adresse :</label>
              <div class="row">
                <div class="col-3 d-inline-block">
                  <input type="text" class="form-control <?= !empty($arrayOfErrors['streetNumber']) ? 'border-danger' : '' ?>" name="streetNumber" placeholder="N°" value="<?= $userInfo->streetNumber() ?>">
                  <small class="error"><?= $arrayOfErrors['streetNumber'] ?? '' ?></small>
                </div>
                <div class="col-9 d-inline-block">
                  <input type="text" class="form-control <?= !empty($arrayOfErrors['streetName']) ? 'border-danger' : '' ?>" name="streetName" placeholder="Rue, avenue, ..." value="<?= $userInfo->address() ?>">
                  <small class="error"><?= $arrayOfErrors['streetName'] ?? '' ?></small>
                </div>
              </div>
              <div class="my-3">
                <input type="text" class="form-control <?= !empty($arrayOfErrors['additionalAddress']) ? 'border-danger' : '' ?>" name="additionalAddress" placeholder="Complément ..." value="<?= $userInfo->additionalAddress() ?>">
                <small class="error"><?= $arrayOfErrors['additionalAddress'] ?? '' ?></small>
              </div>
              <div class="row">
                <div class="col-4 d-inline-block">
                  <input type="text" class="form-control <?= !empty($arrayOfErrors['zipCode']) ? 'border-danger' : '' ?>" name="zipCode" placeholder="Code Postal" value="<?= $userInfo->zipCode() ?>">
                  <small class="error"><?= $arrayOfErrors['zipCode'] ?? '' ?></small>
                </div>
                <div class="col-8 d-inline-block">
                  <input type="text" class="form-control <?= !empty($arrayOfErrors['city']) ? 'border-danger' : '' ?>" name="city" placeholder="Ville" value="<?= $userInfo->city() ?>">
                  <small class="error"><?= $arrayOfErrors['city'] ?? '' ?></small>
                </div>
              </div>
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
</main>
