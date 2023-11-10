<?php

// Gère le contenu de la page de user de connexion
class ControllerLogin
{
    private $_userManager;

    public function __construct($url) {
        // Si on est déjà connecté --> accueil
        if (isset($_SESSION['id_U'])) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_userManager = new UserManager;
        // Si le formulaire a été envoyé
        if($_POST){
          if ($_POST['login']) {
            // On procède au test avec récupération des erreurs, la connexion et la redirection se fait dans la fonction
            $error = $this->_userManager->testConnexion($_POST['login']);
          }
        }
        require_once 'views/viewLogin.php';
    }
}
