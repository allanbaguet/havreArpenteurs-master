<?php

// Gère la mise à jour d'un event
class ControllerEventUpdate extends Model
{
    private $_eventManager;
    private $_categoryManager;

    public function __construct($url) {
        // Si nous sommes un inscrit ou un membre ou que l'id n'est pas défini --> accueil
        if (isset($_SESSION['id_R']) && ($_SESSION['id_R'] == 1 || $_SESSION['id_R'] == 2) || !isset($_GET['id'])) {
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
        // Si on a submit la mise à jour de l'event
        if (isset($_POST['update'])) {
            // On require le fichier servant à tester l'update d'event
            require_once('tester/testUpdateEvent.php');
            // Et s'il n'a pas d'erreurs on update l'event
            if (empty($arrayOfErrors)) {
                $this->_eventManager->updateEvent($_GET['id']);
                $_SESSION['message'] = 'Événement modifié avec succès !';
                header('Location: /event');
                exit(0);
            }
        }
        // Récupération des informations de l'event à mettre à jour
        $event = $this->_eventManager->getEvent($_GET['id']);
        // On sépare la date et l'heure de l'event, afin de l'afficher dans la view
        $dateEvent = explode(' ', $event->dateEvent());
        // On sépare les heures, les minutes et les secondes
        $hourMinuteEvent = explode(':', $dateEvent[1]);
        require_once('views/viewEventUpdate.php');
    }
}
