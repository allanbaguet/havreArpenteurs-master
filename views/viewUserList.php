<?php
  $title = 'Utilisateur - Liste - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <div class="row justify-content-center mt-5 mb-3">
    <h3 class="subTitle">Liste Utilisateurs</h3>
  </div>
  <form class="mb-4" action="user/list" method="post">
    <div class="row justify-content-center my-3">
      <div class="col-6 input-group">
        <select class="mr-4" name="column">
          <option value="userName">Pseudo</option>
          <option value="lastName">Nom</option>
          <option value="firstName">Prénom</option>
          <option value="email">Email</option>
          <option value="phone">Téléphone</option>
          <option value="address">Adresse</option>
          <option value="zipCode">Code postal</option>
          <option value="city">Ville</option>
          <option value="id_R">Niveau droit</option>
        </select>
        <input type="text" class="form-control" name="search">
        <div class="input-group-append">
          <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </div>
  </form>
  <div class="formulaire table-responsive">
    <table class="table table-sm text-center">
      <thead>
        <tr>
          <th>#</th>
          <th>Pseudo</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Date de naissance</th>
          <th>Téléphone</th>
          <th>Adresse</th>
          <th>Code postal</th>
          <th>Ville</th>
          <th>Date de création</th>
          <th>Niveau</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody class="userList">
        <?php foreach ($users as $user): ?>
        <tr>
          <th><?= $user->id_U ?></th>
          <td><?= $user->userName_U ?></td>
          <td><?= $user->lastName_U ?></td>
          <td><?= $user->firstName_U ?></td>
          <td><?= $user->email_U ?></td>
          <td><?= $user->birthDate_U ?></td>
          <td><?= $user->phone_U ?></td>
          <td><?= $user->streetNumber_U ?> <?= $user->address_U ?> <?= $user->additionalAddress_U ?></td>
          <td><?= $user->zipCode_U ?></td>
          <td><?= $user->city_U ?></td>
          <td><?= date("d/m/Y", strtotime($user->creationDate_U)) ?></td>
          <td><?= $user->name_R ?></td>
          <?php if ($_SESSION['id_R'] == 4 || $user->id_R != 4): ?>
            <td><a href="<?= $user->id_U ?>" class="btn btn-outline-success btn-block"><i class="fas fa-eye"></i></a></td>
          <?php endif; ?>
          <?php if ($_SESSION['id_R'] == 4): ?>
            <td><a href="delete/<?= $user->id_U ?>" class="btn btn-outline-danger btn-block"><i class="far fa-trash-alt"></i></a></td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <div class="row justify-content-end mr-5 pr-5 mt-4">
      <a href="/user" class="btn btn-outline-secondary px-4 mr-4">Retour</a>
    </div>
  </div>
</main>
