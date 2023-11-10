<?php
  $title = 'Utilisateur - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Bonjour <?= $userInfo->userName() ?> !</h2>
  <div class="row justify-content-center content m-5">
      <div class="col-12 col-lg-7 p-5">
        <p class="text-center mb-5"><b><u>Informations personnelles</u></b></p>
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
        <div class="row justify-content-center">
          <form action="user" method="post">
            <input class="btn btn-outline-danger" type="submit" name="logout" value="Déconnexion">
          </form>
        </div>
      </div>
      <div class="col-12 col-lg-4 p-5">
        <?php if($_SESSION['id_R'] == 3 || $_SESSION['id_R'] == 4 ): ?>
          <div class="d-flex flex-column-reverse mb-4 mt-2">
            <a href="article/liste" class="btn btn-outline-primary">Liste articles</a>
            <a href="article/create" class="btn btn-outline-primary">Créer articles</a>
          </div>
          <div class="d-flex flex-column-reverse mb-4 mt-2">
            <a href="event/liste" class="btn btn-outline-success">Liste événements</a>
            <a href="event/create" class="btn btn-outline-success">Créer événement</a>
          </div>
          <div class="d-flex flex-column-reverse mb-4 mt-2">
            <a href="user/list" class="btn btn-outline-warning">Liste utilisateurs</a>
          </div>
        <?php endif; ?>
        <div class="d-flex flex-column-reverse mb-4">
          <a href="user/password" class="btn btn-outline-warning">Modifier mot de passe</a>
          <a href="user/update" class="btn btn-outline-warning">Modifier info. perso</a>
        </div>
        <div class="d-flex flex-column-reverse mb-4">
          <a href="user/delete/<?= $userInfo->id_U() ?>" class="btn btn-outline-danger">Supprimer son compte</a>
        </div>
      </div>
  </div>
</main>
