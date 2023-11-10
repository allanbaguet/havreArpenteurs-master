<?php

// Gère l'activation d'un compte utilisateur
class ControllerActivation
{
    private $_userManager;

    public function __construct($url) {
            $this->content();
    }

    private function content() {
        $this->_userManager = new UserManager;
        $user = $this->_userManager->getUserByUserName($_GET['pseudo']);
        // S'il n'y a pas d'utilisateur avec le pseudo $_GET['pseudo']
        if ($user == null) {
          $message = 'Erreur lors de l\'activation du compte !';
        } else {
          // Si le compte de l'utilisateur est déjà activé
          if ($user->status_U == 1) {
            $message = 'Le compte de l\'utilisateur est déjà activé !';
          } else {
            // Si la clé de l'utilisateur correspond à la clé du mail
            if ($user->activationKey_U == $_GET['cle']) {
              // On active le compte de l'utilisateur
              $this->_userManager->activateUser($_GET['pseudo']);
              $_SESSION['message'] = 'Compte utilisateur activé avec succès !';
              header('Location: /accueil');
              exit(0);
            } else {
              $message = 'Erreur lors de l\'activation du compte !';
            }
          }
        }

        require_once('views/viewActivation.php');
    }
}
