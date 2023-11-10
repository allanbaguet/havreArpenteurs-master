<?php
  $title = 'Événement - Détails - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <div class="text-center content py-3">
    <?php if ($resultDays < 0 || $resultHours < 0): ?>
      <p class="m-0"><b><u>Cet événement a déjà été réalisé !</u></b></p>
    <?php else: ?>
      <p><b><u>Événement prévu pour le </u></b> : <?=date("d/m/Y à H:i", strtotime($event->dateEvent())) ?></p>
      <p>Encore <?= $resultDays != '0' ? '<b>'.$resultDays.' jour(s)</b> et' : '' ?> <?= $resultHours != '0' ? '<b>'.$resultHours.' heures(s)</b>' : '' ?> avant l'événement !</p>
    <?php endif; ?>
  </div>
  <div class="content">
    <div class="mx-5 mt-4 mb-3 mb-lg-5">
      <?php if(!empty($message)): ?>
        <div class="row justify-content-center">
          <div class="alert alert-success" role="alert">
            <p><?= $message ?></p>
          </div>
        </div>
      <?php endif; ?>
      <div class="row justify-content-end">
        <small><i>le <?=date("d/m/Y à H:i:s", strtotime($event->creationDate())) ?></i></small>
      </div>
      <?php if(!empty($event->modifDate())): ?>
        <div class="row justify-content-end mb-3">
          <small><i>Modifié le <?=date("d/m/Y à H:i:s", strtotime($event->modifDate())) ?></i></small>
        </div>
      <?php endif; ?>
      <div class="row">
        <!-- Image de l'event -->
        <div class="col-12 col-lg-4 my-4 my-lg-0 text-center">
          <img class="image" src="../<?= $event->image() ?>" alt="Image de l'event">
        </div>
        <!-- Description courte de l'event -->
        <div class="col-12 col-lg-7 ml-lg-5">
          <div class="d-flex justify-content-center">
            <h3 class="subTitle"><u><?= $event->title() ?></u></h3>
          </div>
          <p><b>Description rapide :</b></p>
          <div>
            <p><?= $event->shortContent() ?></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Description longue de l'event -->
      <?php  if(!empty($event->longContent())): ?>
        <div class="d-flex justify-content-center">
          <hr class="hrEvent">
        </div>
        <div class="m-4 m-lg-5 px-2">
          <p><b><u>Description complète :</u></b></p>
          <p><?= $event->longContent() ?></p>
      </div>
      <?php endif; ?>
  </div>
  <div class="text-center content py-3">
    <p class="m-0"><b><u>Nombre de participant(s) à cet événement</u></b> : <?= $numberParticipants ?></p>
  </div>
  <?php //Partie admin pour l'event ?>
  <?php if (isset($_SESSION['id_R']) && ($_SESSION['id_R'] == 4 || $_SESSION['id_R'] == 3)): ?>
    <div class="row">
      <div class="col-12 text-center text-lg-right pr-lg-5">
        <a href="update/<?= $_GET['id'] ?>" class="">Modifier le contenu de l'événement ?</a>
      </div>
      <div class="col-12 text-center text-lg-right pr-lg-5">
        <a href="delete/<?= $_GET['id'] ?>">Supprimer cet événement ?</a>
      </div>
    </div>
  <?php endif; ?>
  <?php if ($resultDays > 0 || $resultHours > 0): ?>
    <?php if (isset($_SESSION['id_U'])): ?>
      <?php if ($alreadyRegistered == false): ?>
        <div class="row justify-content-center text-center content py-4">
          <form action="../event/<?= $event->id_E() ?>" method="post">
            <div>
              <label for="registered">S'inscrire pour cet événement ?</label>
            </div>
            <div>
              <button id="registered" class="btn btn-outline-success" type="submit" name="registered" value="registered" ><i class="fas fa-check"></i></button>
            </div>
          </form>
        </div>
      <?php else: ?>
        <div class="content py-4">
          <div class="row justify-content-center text-center mb-2 mx-3">
            <p><u><b>Vous êtes déjà inscrit pour cet événement.</b></u></p>
          </div>
          <div class="row justify-content-center">
            <div>
              <form action="../event/<?= $event->id_E() ?>" method="post">
                <label for="unsubscribe">Se désinscrire ?</label>
                <button id="unsubscribe" class="btn btn-outline-danger ml-5" type="submit" name="unsubscribe" value="unsubscribe" ><i class="fas fa-times"></i></button>
              </form>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
  <?php // Partie commentaire ?>
    <?php if(isset($_SESSION['id_U'])): ?>
    <div class="text-center content py-3 px-5">
      <p>Réagir à l'événement :</p>
      <form action="../event/<?= $event->id_E() ?>" method="post">
        <div class="form-group m-0">
            <label for="title"><i class="fas fa-user mr-2"></i>Titre commentaire :</label>
            <span class="error"><?= $arrayOfErrors['title'] ?? '' ?></span>
            <input id="title" type="text" class="form-control <?= !empty($arrayOfErrors['title']) ? 'border-danger' : '' ?>" name="title" value="<?= $_POST['title'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="content"><i class="fas fa-align-left mr-2"></i>Contenu commentaire :</label>
            <span class="error"> * <?= $arrayOfErrors['content'] ?? '' ?></span>
            <div class="textarea text-left">
              <textarea rows="3" id="content" class="form-control textareaComment <?= !empty($arrayOfErrors['content']) ? 'border-danger' : '' ?>" name="content"><?= $_POST['content'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="row justify-content-end justify-content-lg-center pt-3 pb-2 pr-0">
            <div class="col-12 col-lg-3">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="comment" value="Commenter">
            </div>
        </div>
      </form>
    </div>
    <?php else: ?>
      <div class="text-center content py-3">
        <p class="m-0"><u><b>Vous devez être <a href="/login">connecter</a> pour pouvoir réagir ou participer à cet événement.</b></u></p>
      </div>
    <?php endif; ?>
  <?php // Liste des commentaires lié à l'événement ?>
  <div>
    <?php foreach ($comments as $comment): ?>
      <div class="row content">
        <div class="col-12 col-lg-2 text-center align-center mt-3 mt-lg-4 mb-2">
          <span><b><u><?= $comment->userName_U == null ? 'Anonyme' : $comment->userName_U ?></u></b></span>
        </div>
        <div class="col-12 col-lg-10">
          <?php // Titre + date création / modification ?>
          <div class="row justify-content-between mt-lg-3 mr-2">
            <div class="col-12 col-lg-8 order-2 order-lg-1">
              <span><i class="fas fa-arrow-right mr-3"></i><b><?= $comment->title_C ?></b></span>
            </div>
            <div class="col-12 col-lg-4 d-flex flex-row-reverse order-1 order-lg-2 mb-1">
              <?php if (empty($comment->modifDate_C)): ?>
                <small><i>le <?= $comment->creationDate_C ?></i></small>
              <?php else: ?>
                <small><i>Modifié le <?=date("d/m/Y à H:i:s", strtotime($comment->modifDate_C)) ?></i></small>
              <?php endif; ?>
            </div>
          </div>
          <div class="mt-4">
            <p><?= $comment->content_C ?></p>
          </div>
          <?php if (($comment->id_U == $_SESSION['id_U']) || ($_SESSION['id_R'] == 4)): ?>
            <div class="d-flex justify-content-end mb-3">
              <small><a class="mr-5" href="../comment/update/<?= $comment->id_C ?>">Modifier...</a></small>
              <small><a class="mr-4" href="../comment/delete/<?= $comment->id_C ?>">Supprimer...</a></small>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>
