<?php

// Gère la création d'un event
class ControllerEventCreate extends Model
{
    private $_eventManager;
    private $_categoryManager;

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
        $this->_categoryManager = new CategoryManager;
        // On récupère toutes les catégories
        $categories = $this->_categoryManager->getAllCategory();
        // Si on a submit la création
        if (isset($_POST['create'])) {
            // On require le fichier contenant les tests de création d'événement
            require_once('tester/testCreateEvent.php');
            // Et s'il n'a pas d'erreurs on crée l'événément
            if (empty($arrayOfErrors)) {
                $this->_eventManager->createEvent();
                $_SESSION['message'] = 'Événement créé avec succès !';
                header('Location: /user');
                exit(0);
            }
        }
        require_once('views/viewEventCreate.php');
    }
}
