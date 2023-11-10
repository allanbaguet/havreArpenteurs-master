<?php
  // S'il n'y a pas de session existante, on en démarre une
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  require_once 'controllers/Router.php';
  // On instancie un Routeur
  // Routeur sert à include des pages en fonction de l'url et de l'action de l'utilisateur
  $router = new Router;
  $router->routeReq();
  require_once 'footer.php';
