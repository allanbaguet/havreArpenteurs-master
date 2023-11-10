<?php
  $title = 'Événement - Modification - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Mise à jour événement</h2>
  <div class="row justify-content-center">
    <div class="col-8 formulaire">
      <form action="../update/<?= $event->id_E() ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title"><i class="fas fa-user mr-2"></i>Titre événement :</label>
            <span class="error"> * <?= $arrayOfErrors['title'] ?? '' ?></span>
            <input id="title" type="text" class="form-control <?= !empty($arrayOfErrors['title']) ? 'border-danger' : '' ?>" name="title" value="<?= $event->title() ?>">
        </div>
        <div class="form-group">
            <label for="dateEvent"><i class="fas fa-calendar-alt mr-2"></i>Date de l'événement :</label>
            <span class="error"> * <?= $arrayOfErrors['dateEvent'] ?? '' ?></span>
            <input id="dateEvent" type="date" class="form-control <?= !empty($arrayOfErrors['dateEvent']) ? 'border-danger' : '' ?>" name="dateEvent" value="<?= $dateEvent[0] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="hourEvent"><i class="fas fa-clock mr-2"></i>Heure de l'événement :</label>
            <span class="error"> * <?= $arrayOfErrors['hourEvent'] ?? '' ?></span>
            <input id="hourEvent" type="time" class="form-control <?= !empty($arrayOfErrors['hourEvent']) ? 'border-danger' : '' ?>" name="hourEvent" value="<?= $dateEvent[1] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="image"><i class="fas fa-image mr-2"></i>Image : (.jpg, .png)</label>
            <span class="error"> * <?= $arrayOfErrors['image'] ?? '' ?></span>
            <div>
              <input id="image" type="file" class="<?= !empty($arrayOfErrors['image']) ? 'border-danger' : '' ?>" name="image">
            </div>
        </div>
        <div class="form-group">
          <label for="category"><i class="fas fa-layer-group mr-2"></i>Catégorie :</label>
          <span class="error"> * <?= $arrayOfErrors['category'] ?? '' ?></span>
          <div>
            <select id="category" name="category">
              <option value="">--</option>
              <?php foreach($categories as $category): ?>
                <option value="<?= $category->id_Cat() ?>" <?= $event->id_Cat() == $category->id_Cat() ? 'selected' : '' ?>><?= $category->id_Cat() ?>. <?= $category->name() ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
            <label for="shortContent"><i class="fas fa-align-left mr-2"></i>Description courte :</label>
            <span class="error"> * <?= $arrayOfErrors['shortContent'] ?? '' ?></span>
            <textarea id="shortContent" rows="6" class="form-control <?= !empty($arrayOfErrors['shortContent']) ? 'border-danger' : '' ?>" name="shortContent"><?= $event->shortContent()?></textarea>
        </div>
        <div class="form-group">
            <label for="longContent"><i class="fas fa-align-justify mr-2"></i>Description longue (optionel) :</label>
            <span class="error"> <?= $arrayOfErrors['longContent'] ?? '' ?></span>
            <textarea id="longContent" rows="10" class="form-control <?= !empty($arrayOfErrors['longContent']) ? 'border-danger' : '' ?>" name="longContent"><?= $event->longContent() ?></textarea>
        </div>
        <div class="row justify-content-center pt-3">
            <div class="col-6">
              <a href="../../event/<?= $event->id_E() ?>" class="btn btn-outline-secondary btn-lg btn-block">Retour</a>
            </div>
            <div class="col-6">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="update" value="Modifier l'event">
            </div>
        </div>
      </form>
    </div>
  </div>
</main>
