<?php

// Gère la récupération du mot de passe
class ControllerRecuperation
{
    private $_userManager;

    public function __construct($url) {
            $this->content();
    }

    private function content() {
        $this->_userManager = new UserManager;

        $message = '';
        // Si on a envoyé le formulaire
        if ($_POST['recuperation']) {
          // On récupère les info de l'utilisateur grâce à son pseudo
          $user = $this->_userManager->getUserByUserName($_POST['login']);
          // S'il n'y a pas d'utilisateur avec le pseudo $_POST['login']
          if ($user == null) {
            $message = 'Identifiant(s) incorrect(s) !';
          } else {
            // Si l'adresse mail renseignée ne correspond pas à l'adresse mail de l'utilisateur trouvé
            if ($user->email_U != $_POST['email']) {
              $message = 'Identifiant(s) incorrect(s) !';
            } else {
              // On met à jour l'user avec sa clé de récupération de mot de passe
              $this->_userManager->updateRecuperation($_POST['login']);
              $_SESSION['message'] = 'Demande de réinitialisation réussie !<br>Un mail a été envoyé sur l\'adresse mail renseignée.';
              header('Location: /accueil');
              exit(0);
            }
          }
        }

        require_once('views/viewRecuperation.php');
    }
}
