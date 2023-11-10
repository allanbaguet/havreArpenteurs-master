<?php

// Gère la réinitialisation du mot de passe utilisateurs
class ControllerReinitialisation
{
    private $_userManager;

    public function __construct($url) {
            $this->content();
    }

    private function content() {
        $this->_userManager = new UserManager;
        $user = $this->_userManager->getUserByUserName($_GET['pseudo']);

        // Si on a submit l'update
        if (isset($_POST['update'])) {
            // On require le fichier servant à tester le mot de passe
            require_once('tester/testRecuperationPassword.php');
            // S'il n'a pas d'erreurs on update le mot de passe utilisateur
            if (empty($arrayOfErrors)) {
                $this->_userManager->recuperationPassword($_GET['pseudo']);
                $_SESSION['message'] = 'Mot de passe réinitialisé avec succès !';
                header('Location: /accueil');
                exit(0);
            }
        }

        // S'il n'y a pas d'utilisateur avec le pseudo $_GET['pseudo']
        if ($user != null) {
          if ($user->recuperationKey_U == $_GET['cle'] ) {
            require_once('views/viewPasswordLost.php');
          } else {
            header('Location: /accueil');
          }
        } else {
          header('Location: /accueil');
        }
    }
}
