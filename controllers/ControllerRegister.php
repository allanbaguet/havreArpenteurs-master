<?php

// Gère le contenu de la page d'inscription
class ControllerRegister
{
    private $_registerManager;

    public function __construct($url) {
        // Si nous sommes déjà connecté --> accueil
        if (isset($_SESSION['id_U'])) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_registerManager = new UserManager;
        // Si le formulaire d'inscription a été envoyé
        if ($_POST) {
            // On require le fichier contenant les tests d'inscription d'un utilisateur
            require_once('tester/testUser.php');
            // S'il n'y a pas d'erreur
            if (empty($arrayOfErrors)) {
                // On crée un nouvel utilisateur
                $this->_registerManager->createUser();
                $_SESSION['message'] = 'Compte enregistré avec succès !<br>Un mail vous a été envoyé afin de confirmer votre inscription.';
                header('Location: /accueil');
                exit(0);
            }
        }
        require_once 'views/viewRegister.php';
    }
}
