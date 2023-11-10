<?php
  $title = 'Événement - Liste - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <div class="row justify-content-center mt-5 mb-3">
    <h3 class="subTitle">Liste Events</h3>
  </div>
  <div class="formulaire mx-5">
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Titre</th>
        <th>Image</th>
        <th>Description courte</th>
        <th>Date création</th>
        <th>Créateur</th>
        <th>Catégorie</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($events as $event): ?>
      <tr>
        <th><?= $event->id_E ?></th>
        <td><?= $event->title_E ?></td>
        <td><?= $event->image_E ?></td>
        <td><?= $event->shortContent_E ?></td>
        <td><?= date("d/m/Y", strtotime($event->creationDate_E)) ?></td>
        <td><?= $event->userName_U ?></td>
        <td><?= $event->name_Cat ?></td>
        <td><a href="<?= $event->id_E ?>" class="btn btn-outline-success btn-block"><i class="fas fa-eye"></i></a></td>
        <td><a href="update/<?= $event->id_E ?>" class="btn btn-outline-primary btn-block"><i class="fas fa-edit"></i></a></td>
        <td><a href="delete/<?= $event->id_E ?>" class="btn btn-outline-danger btn-block"><i class="far fa-trash-alt"></i></a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <div class="row justify-content-end mr-5 pr-5 mt-4">
    <a href="/user" class="btn btn-outline-secondary px-4 mr-4">Retour</a>
    <a href="/event/create" class="btn btn-outline-success px-4">Ajout événement</a>
  </div>
</div>
</main>
