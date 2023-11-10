<?php

// Gère le contenu de la page de user de l'utilisateur
class ControllerUser
{
    private $_userManager;

    public function __construct($url) {
        if (!isset($_SESSION['id_U'])) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_userManager = new UserManager;
        $userInfo = $this->_userManager->getUser($_SESSION['id_U']);
        // Si le bouton de déconnexion a été utilisé alors on vide et on détruit la session ...
        // ... afin de déconnecter l'utilisateur
        if (isset($_POST['logout'])) {
            $_SESSION = [];
            session_destroy();
            header('Location: accueil');
            exit(0);
        }
        require_once('views/viewUser.php');
    }

}
