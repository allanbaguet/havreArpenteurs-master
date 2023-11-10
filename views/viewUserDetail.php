<?php
$title = 'Utilisateur - Détail - Le Havre des Arpenteurs';
require_once 'header.php';
?>
<main>
  <h2 class="title">Profil de <?= $userInfo->userName() ?></h2>
  <div class="row content justify-content-center">
    <div class="my-4 px-5">
      <h3 class="subTitle">Informations de l'utilisateurs :</h3>
      <table class="table">
        <tr>
          <td>Pseudo :</td>
          <td><?= $userInfo->userName() ?></td>
        </tr>
        <tr>
          <td>Nom :</td>
          <td><?= $userInfo->lastName() ?></td>
        </tr>
        <tr>
          <td>Prénom :</td>
          <td><?= $userInfo->firstName() ?></td>
        </tr>
        <tr>
          <td>Email :</td>
          <td><?= $userInfo->email() ?></td>
        </tr>
        <tr>
          <td>Téléphone :</td>
          <td><?= $userInfo->phone() ?></td>
        </tr>
        <tr>
          <td>Date de naissance :</td>
          <td><?= $userInfo->birthDate() ?></td>
        </tr>
        <tr>
          <td>Adresse :</td>
          <td><?= $userInfo->streetNumber() ?> <?= $userInfo->address() ?> <?= $userInfo->additionalAddress() ?></td>
        </tr>
        <tr>
          <td>Ville :</td>
          <td><?= $userInfo->zipCode() ?> <?= $userInfo->city() ?></td>
        </tr>
        <tr>
          <td>Date d'inscription :</td>
          <td><?=date("d/m/Y", strtotime($userInfo->creationDate())) ?></td>
        </tr>
        <tr>
          <td>Niveau de droit :</td>
          <td><?= $userInfo->id_R() ?></td>
        </tr>
      </table>
    </div>
  </div>
<?php if($_SESSION['id_R'] == 4): ?>
  <div class="row content justify-content-center py-3">
    <h3 class="subTitle col-12 text-center">Modifier son rôle ?</h3>
    <div>
      <form action="../user/<?= $_GET['id'] ?>" method="post">
            <label for="role"><i class="fas fa-user mr-2"></i>Niveau :</label>
            <span class="error"> <?= $arrayOfErrors['role'] ?? '' ?></span>
            <select id="role" name="role">
              <?php foreach($roles as $role): ?>
                <option value="<?= $role->id_R() ?>" <?= $userInfo->id_R() == $role->id_R() ? 'selected' : '' ?> ><?= $role->id_R() ?>. <?= $role->name() ?></option>
              <?php endforeach; ?>
            </select>
            <div class="my-3">
              <input class="btn btn-outline-primary btn-lg btn-block" name="updateRole" type="submit" value="Changer">
            </div>
      </form>
    </div>
  </div>
<?php endif; ?>
  <div class="row content justify-content-center py-5">
    <h3 class="subTitle col-12 text-center">Modifier informations personnelles :</h3>
    <div class="col-6">
      <form action="../user/<?= $_GET['id'] ?>" method="post">
        <div class="form-group">
          <label for="pseudo"><i class="fas fa-user mr-2"></i>Pseudo :</label><span class="error"> * <?= $arrayOfErrors['pseudo'] ?? '' ?></span>
          <input id="pseudo" type="text" class="form-control <?= !empty($arrayOfErrors['pseudo']) ? 'border-danger' : '' ?>" name="pseudo" value="<?= $userInfo->userName() ?>">
          <div class="mt-2">
            <i>
              <small>Entre 3 et 16 caractères.</small>
            </i>
          </div>
        </div>
        <div class="form-group">
          <label for="email"><i class="fas fa-envelope mr-2"></i>Email :</label>
          <span class="error"> * <?= $arrayOfErrors['email'] ?? '' ?></span>
          <input id="email" type="email" class="form-control <?= !empty($arrayOfErrors['email']) ? 'border-danger' : '' ?>" name="email" value="<?= $userInfo->email() ?>">
        </div>
        <hr>
        <div class="form-group">
          <label for="firstName"><i class="fas fa-user mr-2"></i>Prénom :</label>
          <span class="error"> <?= $arrayOfErrors['firstName'] ?? '' ?></span>
          <input id="firstName" type="text" class="form-control <?= !empty($arrayOfErrors['firstName']) ? 'border-danger' : '' ?>" name="firstName" value="<?= $userInfo->firstName() ?>">
        </div>
        <div class="form-group">
          <label for="lastName"><i class="fas fa-user mr-2"></i>Nom :</label>
          <span class="error"> <?= $arrayOfErrors['lastName'] ?? '' ?></span>
          <input id="lastName" type="text" class="form-control <?= !empty($arrayOfErrors['lastName']) ? 'border-danger' : '' ?>" name="lastName" value="<?= $userInfo->lastName() ?>">
        </div>
        <hr>
        <div class="form-group">
          <label for="birthDate"><i class="fas fa-calendar-alt mr-2"></i>Date de naissance :</label>
          <span class="error"> <?= $arrayOfErrors['birthDate'] ?? '' ?></span>
          <input id="birthDate" type="date" class="form-control <?= !empty($arrayOfErrors['birthDate']) ? 'border-danger' : '' ?>" name="birthDate" value="<?= $userInfo->birthDate() ?>">
        </div>
        <div class="form-group">
          <label for="phone"><i class="fas fa-phone mr-2"></i>Téléphone :</label>
          <span class="error"> <?= $arrayOfErrors['phone'] ?? '' ?></span>
          <input id="phone" type="text" class="form-control <?= !empty($arrayOfErrors['phone']) ? 'border-danger' : '' ?>" name="phone" value="<?= $userInfo->phone() ?>">
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
            <a href="../user/list" class="btn btn-outline-secondary btn-lg btn-block">Retour</a>
          </div>
          <div class="col-6">
            <input class="btn btn-outline-primary btn-lg btn-block" name="update" type="submit" value="Validation">
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php if($_SESSION['id_R'] == 4): ?>
    <div class="row content justify-content-center py-3">
      <h3 class="subTitle col-12 text-center">Supprimer <?= $userInfo->userName() ?> ?</h3>
      <div class="d-flex flex-column-reverse mb-4">
        <a href="../user/delete/<?= $_GET['id'] ?>" class="btn btn-outline-danger">Supprimer</a>
      </div>
    </div>
  <?php endif; ?>
</main>
