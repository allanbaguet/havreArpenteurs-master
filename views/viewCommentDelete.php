<?php
  $title = 'Commentaire - Suppression - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <div class="row justify-content-center">
    <div class="col-10 col-lg-8 m-4 p-4 m-lg-5 p-lg-5 text-center content">
        <h1 class="text-danger">ATTENTION !</h1>
        <h2 class="mt-5">Êtes-vous sur de vouloir supprimer votre commentaire ?</h2>
        <h3 class="mb-5">Cette action sera irréversible.</h3>
        <div class="row justify-content-center pt-3">
            <div class="col-4">
                <a href="../../<?= $return ?>/<?= $id ?>" class="btn btn-outline-secondary btn-block">NON</a>
            </div>
            <div class="col-4">
                <form action="../delete/<?= $_GET['id'] ?>" method="post">
                    <input class="btn btn-outline-danger btn-block" type="submit" name="delete" value="OUI">
                </form>
            </div>
        </div>
    </div>
  </div>
</main>
