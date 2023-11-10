<?php
  $title = 'Accueil - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <div class="row justify-content-center mt-3">
    <div class="col-8 content px-5 py-3">
      <p>L'association sera ouverte ce soir dès 19h sur Amiens au 23 rue Vascosan.<br><br>
      Nous retrouvons les horaires de période scolaire et par la même occasion la jouissance de la salle d'Amiens.<br>
      Veuillez donc noter que sauf contre-indication nous serons sur Amiens tous les samedis soirs dès 19h.<br>
      J'en profite pour vous communiquer d'avance 3 dates où nous ne serons pas sur Amiens mais sur Longueau à partir de 20h :<br>
      <ul>
        <li>Le samedi 28 septembre 2019</li>
        <li>Le samedi 26 octobre 2019</li>
        <li>Le samedi 30 novembre 2019</li>
      </ul>
      Bonne Journée à tous</p>
    </div>
  </div>
    <div id="carousel" class="carousel slide carousel-fade mt-2" data-ride="carousel">
        <ol class="carousel-indicators blend">
            <li data-target="#carousel" data-slide-to="0" class="blend active"></li>
            <li data-target="#carousel" data-slide-to="1" class="blend"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active ">
                <a href="article/1">
                <img class="d-block w-100 image-carousel img-fluid" src="assets/img/welcome2.jpg" alt="Bienvenue !" data-holder-rendered="true">
                </a>
            </div>
            <div class="carousel-item">
                <a href="faq">
                <img class="d-block w-100 image-carousel img-fluid" src="assets/img/qui-sommes-nous.png" alt="Qui nous sommes ?" data-holder-rendered="true">
              </a>
            </div>
        </div>
        <a class="carousel-control-prev blend" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next blend" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <section>
        <h2 class="text-center mt-5 mb-3">Prochains événements</h2>
        <div class="cards-list">
          <?php foreach ($events as $event): ?>
            <a href="event/<?= $event->id_E ?>">
              <div class="card">
                  <div class="card_image">
                      <img src="<?= $event->image_E ?>" alt="image <?= $event->title_E ?>" />
                  </div>
                  <div class="card_title title-white">
                      <p><?= $event->title_E ?></p>
                  </div>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
        <div class="row justify-content-end mr-5">
          <a href="event">Plus d'événements ...</a>
        </div>
    </section>
    <section class="mb-4">
        <h2 class="text-center">Derniers articles</h2>
        <div class="cards-list">
            <?php foreach ($articles as $article): ?>
              <a href="article/<?= $article->id_A ?>">
                <div class="card">
                    <div class="card_image">
                        <img src="<?= $article->image_A ?>" alt="image <?= $article->title_A ?>"/>
                    </div>
                    <div class="card_title title-white">
                        <p><?= $article->title_A ?></p>
                    </div>
                </div>
              </a>
            <?php endforeach; ?>
        </div>
        <div class="row justify-content-end mr-5">
          <a href="article">Plus d'articles ...</a>
        </div>
    </section>
</main>
