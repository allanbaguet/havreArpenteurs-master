<?php

// Gère le contenu de la page d'event
class ControllerEvent
{
    private $_eventManager;

    public function __construct($url) {
            $this->content();
    }

    private function content() {
        $this->_eventManager = new EventManager;
        // On récupère tout les événements d'actualités de la BDD
        $events = $this->_eventManager->getFuturEvents();
        // On récupère la liste de tout les événements passés
        $pastEvents = $this->_eventManager->getAllPastEvents();
        require_once('views/viewEvent.php');
    }
}
