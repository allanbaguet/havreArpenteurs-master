<?php
  $title = 'Commentaire - Modification - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Mise à jour commentaire</h2>
  <div class="row justify-content-center">
    <div class="col-10 col-lg-8 formulaire">
      <form action="../update/<?= $comment->id_C() ?>" method="post">
        <div class="form-group">
            <label for="title"><i class="fas fa-user mr-2"></i>Titre commentaire :</label>
            <span class="error"> * <?= $arrayOfErrors['title'] ?? '' ?></span>
            <input type="text" class="form-control <?= !empty($arrayOfErrors['title']) ? 'border-danger' : '' ?>" name="title" value="<?= $comment->title() ?>">
        </div>
        <div class="form-group">
            <label for="shortContent"><i class="fas fa-align-left mr-2"></i>Contenu commentaire :</label>
            <span class="error"> * <?= $arrayOfErrors['content'] ?? '' ?></span>
            <textarea type="text" rows="6" class="form-control textareaComment <?= !empty($arrayOfErrors['content']) ? 'border-danger' : '' ?>" name="content"><?= $comment->content()?></textarea>
        </div>
        <div class="row justify-content-center pt-3">
            <div class="col-12 col-md-6 order-2 order-md-1">
              <a href="../../<?= $return ?>/<?= $id ?>" class="btn btn-outline-secondary btn-lg btn-block">Retour</a>
            </div>
            <div class="col-12 col-md-6 order-1 order-md-2">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="update" value="Modifier commentaire">
            </div>
        </div>
      </form>
    </div>
  </div>
</main>
