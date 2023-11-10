<?php
  $title = 'Article - Liste - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <div class="row justify-content-center mt-5">
    <h3 class="subTitle">Liste Articles</h3>
  </div>
  <div class="formulaire table-responsive">
    <table class="table table-sm text-center">
      <thead class="">
        <tr>
          <th>#</th>
          <th>Titre</th>
          <th>Image</th>
          <th>Description courte</th>
          <th>Date création</th>
          <th>Créateur</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($articles as $article): ?>
        <tr>
          <th><?= $article->id_A ?></th>
          <td><?= $article->title_A ?></td>
          <td><?= $article->image_A ?></td>
          <td><?= $article->shortContent_A ?></td>
          <td><?= date("d/m/Y", strtotime($article->creationDate_A)) ?></td>
          <td><?= $article->userName_U ?></td>
          <td><a href="<?= $article->id_A ?>" class="btn btn-outline-success btn-block"><i class="fas fa-eye"></i></a></td>
          <td><a href="update/<?= $article->id_A ?>" class="btn btn-outline-primary btn-block"><i class="fas fa-edit"></i></a></td>
          <td><a href="delete/<?= $article->id_A ?>" class="btn btn-outline-danger btn-block"><i class="far fa-trash-alt"></i></a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <div class="row justify-content-end mr-5 pr-5 mt-4">
      <a href="/user" class="btn btn-outline-secondary px-4 mr-4">Retour</a>
      <a href="/article/create" class="btn btn-outline-success px-4">Ajout article</a>
    </div>
  </div>
</main>
