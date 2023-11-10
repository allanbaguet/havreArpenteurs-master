<?php
  $title = 'Article - Modification - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Mise à jour événement</h2>
  <div class="row justify-content-center">
    <div class="col-8 formulaire">
      <form action="../update/<?= $article->id_A() ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title"><i class="fas fa-user mr-2"></i>Titre événement :</label>
            <span class="error"> * <?= $arrayOfErrors['title'] ?? '' ?></span>
            <input type="text" class="form-control <?= !empty($arrayOfErrors['title']) ? 'border-danger' : '' ?>" name="title" value="<?= $article->title() ?>">
        </div>
        <div class="form-group">
            <label for="image"><i class="fas fa-image mr-2"></i>Image : (.jpg, .png)</label>
            <span class="error"> * <?= $arrayOfErrors['image'] ?? '' ?></span>
            <div>
              <input type="file" class="<?= !empty($arrayOfErrors['image']) ? 'border-danger' : '' ?>" name="image">
            </div>
        </div>
        <div class="form-group">
            <label for="shortContent"><i class="fas fa-align-left mr-2"></i>Description courte :</label>
            <span class="error"> * <?= $arrayOfErrors['shortContent'] ?? '' ?></span>
            <textarea type="text" rows="6" class="form-control <?= !empty($arrayOfErrors['shortContent']) ? 'border-danger' : '' ?>" name="shortContent"><?= $article->shortContent()?></textarea>
        </div>
        <div class="form-group">
            <label for="longContent"><i class="fas fa-align-justify mr-2"></i>Description longue (optionel) :</label>
            <span class="error"> <?= $arrayOfErrors['longContent'] ?? '' ?></span>
            <textarea type="text" rows="10" class="form-control <?= !empty($arrayOfErrors['longContent']) ? 'border-danger' : '' ?>" name="longContent"><?= $article->longContent() ?></textarea>
        </div>
        <div class="row justify-content-center pt-3">
            <div class="col-6">
              <a href="../../article/<?= $article->id_A() ?>" class="btn btn-outline-secondary btn-lg btn-block">Retour</a>
            </div>
            <div class="col-6">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="update" value="Modifier l'article">
            </div>
        </div>
      </form>
    </div>
  </div>
</main>
