<?php

// Gère l'affichage en liste des events
class ControllerEventListe
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
        // On récupère tout les event
        $events = $this->_eventManager->getAllEvents();
        require_once('views/viewEventList.php');
    }
}
