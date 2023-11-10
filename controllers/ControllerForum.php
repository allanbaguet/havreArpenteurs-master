<?php

// Gère le contenu du forum
class ControllerForum
{
    public function __construct($url) {
            $this->content();
    }

    private function content() {
        require_once('views/viewForum.php');
    }
}
