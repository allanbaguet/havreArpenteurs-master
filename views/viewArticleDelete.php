<?php
  $title = 'Article - Suppression - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <div class="row justify-content-center">
    <div class="col-8 m-5 p-5 content text-center">
        <h1 class="text-danger">ATTENTION !</h1>
        <h2 class="mt-5">Êtes-vous sur de vouloir supprimer cet article ?</h2>
        <h3 class="mb-5">Cette action sera irréversible.</h3>
        <div class="row justify-content-center pt-3">
            <div class="col-4">
                <?php // On peux retourner sur la page d'accueil ?>
                <a href="../event" class="btn btn-outline-secondary btn-block">NON</a>
            </div>
            <div class="col-4">
                <?php // Si l'on valide la suppression on se redirigera sur la page index.php avec comme action: DELETE et l'id de l'utilisateur ?>
                <form action="../delete/<?= $_GET['id'] ?>" method="post">
                    <input class="btn btn-outline-danger btn-block" type="submit" name="delete" value="OUI">
                </form>
            </div>
        </div>
    </div>
  </div>
</main>
