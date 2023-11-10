<?php
  $title = 'Événements - Le Havre des Arpenteurs';
  require_once 'header.php';
?>
<main>
  <h2 class="title">Événements</h2>
  <!-- Mise en avant du dernier event + calendrier -->
  <div class="row">
    <div class="col-12 text-center">
      <h3 class="subTitle">Prochain événement</h3>
    </div>
  </div>
  <?php if(!empty($events)): ?>
  <div class="row">
    <div class="col-12 text-center">
      <a href="event/<?= $events[0]->id_E ?>">
        <div class="card">
            <div class="card_image">
                <img src="<?= $events[0]->image_E ?>" alt="image <?= $events[0]->title_E ?>"/>
            </div>
            <div class="card_title title-white">
                <p><?= $events[0]->title_E ?></p>
            </div>
        </div>
      </a>
    </div>
  </div>
<?php endif; ?>
  <div class="row justify-content-center">
      <h3 class="subTitle">Événement en cours</h3>
  </div>
  <!-- Regroupement des cards d'events -->
  <div class="d-flex flex-wrap mb-4">
    <div class="cards-list">
      <?php if(!empty($events)): ?>
        <?php foreach ($events as $event): ?>
          <a href="event/<?= $event->id_E ?>">
            <div class="card">
                <div class="card_image">
                    <img src="<?= $event->image_E ?>" alt="<?= $event->title_E ?>"/>
                </div>
                <div class="card_title title-white">
                    <p><?= $event->title_E ?></p>
                </div>
            </div>
          </a>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Pas d'evénements de prévus</p>
      <?php endif; ?>
    </div>
  </div>
  <div class="row justify-content-center">
      <h3 class="subTitle">Événement passés</h3>
  </div>
  <div class="d-flex flex-wrap mb-4">
    <div class="cards-list">
      <?php foreach ($pastEvents as $pastEvent): ?>
        <a href="event/<?= $pastEvent->id_E ?>">
          <div class="card">
              <div class="card_image">
                  <img src="<?= $pastEvent->image_E ?>" alt="<?= $event->title_E ?>"/>
              </div>
              <div class="card_title title-white">
                  <p><?= $pastEvent->title_E ?></p>
              </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</main>
