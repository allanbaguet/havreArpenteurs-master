<?php

// Gère l'affichage en liste des events (admin/modo)
class ControllerUserList
{
    private $_userManager;
    private $_roleManager;

    public function __construct($url) {
        if (isset($_SESSION['id_R']) && ($_SESSION['id_R'] == 1 || $_SESSION['id_R'] == 2)) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_userManager = new UserManager;
        $this->_roleManager = new RoleManager;
        // Si une recherche a été faite
        if ($_POST && $_POST['search']) {
            // On affichera la liste filtrée
            $users = $this->_userManager->searchUsers($_POST['column'], $_POST['search']);
        } else {
            // Sinon on affiche la liste complète des users
            $users = $this->_userManager->getUsers();
        }
      require_once('views/viewUserList.php');
    }
}
