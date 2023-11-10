<?php

// Gère le page de FAQ
class ControllerFAQ
{
    public function __construct($url) {
            $this->content();
    }

    private function content() {
        require_once('views/viewFAQ.php');
    }

}
