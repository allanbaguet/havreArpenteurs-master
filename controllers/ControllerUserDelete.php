<?php
  // Gère la suppression d'un user utilisateur
  class ControllerUserDelete
  {
      private $_userManager;

      public function __construct($url) {
          $this->_userManager = new UserManager;
          $user = $this->_userManager->getUser($_GET['id']);
          // Si $user = 0 alors il n'y a pas d'user d'id = $_GET['id']
          if ($user === 0) {
            header('Location: /user/list');
          }
          // Si tu es admin ou que tu souhaite supprimer ton propre compte
          if ($_SESSION['id_R'] == 4 || $_SESSION['id_U'] == $_GET['id'])  {
            // Tu accèdes au contenu de la page
              $this->content();
          } else {
              $_SESSION['message'] = 'Votre compte a bien été supprimé !';
              header('Location: /accueil');
              exit(0);
          }
      }

      private function content() {
          $this->_userManager = new UserManager;
          $user = $this->_userManager->getUser($_GET['id']);
          // Si on a submit le formulaire de suppression
          if (isset($_POST['delete'])) {
            // Si nous supprimons une autre personne (action administrateur)
            // Donc si notre id user est différent de l'id de l'user supprimé
            if ($_SESSION['id_U'] != $_GET['id']) {
              // On supprime la personne puis nous retournons vers la liste des utilisateurs
              $this->_userManager->deleteUser($_GET['id']);
              header('Location: /user/list');
            // Et sinon nous supprimons notre compte
            } else {
              $this->_userManager->deleteUser($_SESSION['id_U']);
              // On se déconnecte puis repartons à l'accueil
              $_SESSION = [];
              session_destroy();
              header('Location: /accueil');
            }
          }
          require_once('views/viewUserDelete.php');
      }
  }
