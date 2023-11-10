<?php

// Gère le contenu de la page d'accueil
class ControllerAccueil
{
    private $_articleManager;
    private $_eventManager;

    public function __construct($url) {
            $this->content();
    }

    private function content() {
        $this->_articleManager = new ArticleManager;
        $this->_eventManager = new EventManager;
        // On récupère tout les quatres derniers articles et événements
        $articles = $this->_articleManager->getFourArticles();
        $events = $this->_eventManager->getFourEvents();
        require_once('views/viewAccueil.php');
    }
}
