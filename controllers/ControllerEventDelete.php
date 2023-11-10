<?php

// Gère la suppression d'un event
class ControllerEventDelete extends Model
{
    private $_eventManager;

    public function __construct($url) {
        // Si nous sommes un inscrit ou un membre --> accueil
        if (isset($_SESSION['id_R']) && ($_SESSION['id_R'] == 1 || $_SESSION['id_R'] == 2)) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_eventManager = new EventManager;
        // Si on a submit la suppression de l'événement
        if (isset($_POST['delete'])) {
            // On procède à la suppression de l'event grâce à son id
            $this->_eventManager->deleteEvent($_GET['id']);
            // On supprime l'image de l'event
            array_map('unlink', glob("uploads/event" . $_GET['id'] . ".*"));
            $_SESSION['message'] = 'Événement supprimé avec succès !';
            // Puis on se redirige vers l'accueil
            header('Location: /accueil');
            exit(0);
        }
        require_once('views/viewEventDelete.php');
    }
}
