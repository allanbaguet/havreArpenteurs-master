<?php
  $title = 'Article - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Articles</h2>
  <!-- <div class="row mainArticle">
    <div class="col-6">
      <img src="<?= $articles[0]->image_A ?>" alt="image dernier article">
    </div>
    <div class="col-6 py-4">
      <div class="d-flex justify-content-center">
        <p><?= $articles[0]->title_A ?></p>
      </div>
      <p><?= $articles[0]->shortContent_A ?></p>
    </div>
  </div> -->
<!-- </a> -->
  <!-- Regroupement des cards d'articles -->
  <div class="d-flex flex-wrap mb-4">
    <div class="cards-list">
        <?php foreach ($articles as $article): ?>
          <a href="article/<?= $article->id_A ?>">
            <div class="card">
                <div class="card_image">
                  <img src="<?= $article->image_A ?>" alt="<?= $article->title_A ?>"/>
                </div>
                <div class="card_title title-white">
                    <p><?= $article->title_A ?></p>
                </div>
            </div>
          </a>
        <?php endforeach; ?>
    </div>
  </div>
</main>
