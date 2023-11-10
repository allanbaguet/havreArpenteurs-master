<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/all.min.css"/>
        <!-- CSS -->
        <link href="/assets/css/style.css" rel="stylesheet"/>
        <link rel="stylesheet" href="/assets/css/trumbowyg.min.css">
        <title><?= $title ?></title>
    </head>
    <body>
    <div class="container-fluid">
        <?php if (isset($_SESSION['message'])):?>
          <div class="row justify-content-center">
            <div id="snackbar"><?= $_SESSION['message'] ?></div>
          </div>
          <?php
          unset($_SESSION['message']);
        endif;
        ?>
        <header>
            <div class="jumbotron jumbotron-fluid text-center">
                <div class="container">
                    <h1>Bienvenue au Havre des Arpenteurs</h1>
                </div>
            </div>
        </header>
        <nav class="d-none d-lg-flex navbar justify-content-center sticky-top">
            <ul class="nav text-center">
                <li class="nav-item">
                    <a class="nav-link" href="/accueil">ACCUEIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/article">ARTICLES</a>
                </li>
                <li class="nav-item mr-1">
                    <a class="nav-link" href="/event">EVENTS</a>
                </li>
                <li class="nav-item">
                    <img id="logoMini" src="/assets/img/logoMini.png" alt="Logo Havre des Arpenteurs">
                </li>
                <li class="nav-item ml-1">
                    <a class="nav-link" href="/forum">FORUM</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/faq">F.A.Q</a>
                </li>
                <?php
                // Si la session existe on affiche le bouton de user plutot que celui de connexion
                if (isset($_SESSION['id_U'])) {
                ?>
                  <li class="nav-item">
                    <a class="nav-link pl-2" href="/user">PROFIL</a>
                  </li>
                <?php } else {  ?>
                  <li class="nav-item">
                    <a class="nav-link pl-2" href="/login">CONNEXION</a>
                  </li>
                <?php } ?>
            </ul>
        </nav>
        <nav class="d-flex d-lg-none navbar justify-content-between sticky-top">
            <a class="nav-link-mini d-flex flex-column text-center" href="/accueil">
                <i class="fas fa-home fa-2x"></i>
                <small class="detail">Accueil</small>
            </a>
            <a class="nav-link-mini d-flex flex-column text-center" href="/article">
                <i class="fas fa-book-open fa-2x"></i>
                <small class="detail">Articles</small>
            </a>
            <a class="nav-link-mini d-flex flex-column text-center" href="/event">
                <i class="fas fa-calendar-alt fa-2x"></i>
                <small class="detail">Events</small>
            </a>
            <a class="nav-link-mini d-flex flex-column text-center" href="/forum">
                <i class="fas fa-comments fa-2x"></i>
                <small class="detail">Forum</small>
            </a>
            <a class="nav-link-mini d-flex flex-column text-center" href="/faq">
                <i class="fas fa-question fa-2x"></i>
                <small class="detail">F.A.Q</small>
            </a>
            <?php
            // Si la session existe on affiche le bouton de user plutot que celui de connexion
            if (isset($_SESSION['id_U']) AND isset($_SESSION['userName_U'])) {
            ?>
              <a class="nav-link-mini d-flex flex-column text-center" href="/user">
                  <i class="fas fa-user fa-2x"></i>
                  <small class="detail">User</small>
              </a>
            <?php } else {  ?>
              <a class="nav-link-mini d-flex flex-column text-center" href="/login">
                  <i class="fas fa-user fa-2x"></i>
                  <small class="detail">Login</small>
              </a>
            <?php } ?>
        </nav>
