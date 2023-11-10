<?php

// Gère l'affichage des erreurs
class ControllerError
{
    public function __construct($url) {
            $this->content();
    }

    private function content() {
        require_once('views/viewError.php');
    }
}
