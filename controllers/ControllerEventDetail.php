<?php

// Gère le contenu étaillé d'un event
class ControllerEventDetail {

    private $_eventManager;
    private $_commentManager;
    private $_registeredManager;

    public function __construct($url) {
        $this->_eventManager = new EventManager;
        // On récupère tout les événements de la base de donnée
        $event = $this->_eventManager->getEvent($_GET['id']);
        if ($event === 0) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        // Instantiation des différents Manager
        $this->_eventManager = new EventManager;
        $this->_commentManager = new CommentsManager;
        $this->_registeredManager = new RegisteredManager;
        // On récupère les informations de l'événément
        $event = $this->_eventManager->getEvent($_GET['id']);
        // $alreadyRegistered: variable de test servant à savoir si l'utilisateur est déjà inscrit
        $alreadyRegistered = false;
        // On crée un DateTime correspondant à la date de l'événement
        $dateEvent = new DateTime($event->dateEvent());
        // On récupère la date d'aujourd'ui
        $today = new DateTime();
        // On stocke la différence entre les deux dates
        $interval = $today->diff($dateEvent);
        // On change le format afin d'afficher dans la view le nombre de jours / heures avant l'event
        $resultDays = (int) $interval->format('%R%a');
        $resultHours = (int) $interval->format('%R%h');
        // Si submit d'inscription à l'événement
        if ($_POST && $_POST['registered']) {
            // On inscrit l'utilisateur connecté à l'event
            $this->_registeredManager->createRegistered($_GET['id']);
            $_SESSION['message'] = 'Inscription réussie !';
            header('Location: ../event/' . $_GET['id']);
            exit(0);
        }
        // Si submit désinscription à l'événement
        if ($_POST && $_POST['unsubscribe']) {
            // On supprime l'inscription de l'utilisteur à l'event
            $this->_registeredManager->deleteRegistered($_SESSION['id_U'], $_GET['id']);
            $_SESSION['message'] = 'Désinscrption réussie !';
            header('Location: ../event/' . $_GET['id']);
            exit(0);
        }
        // Si submit d'ajout de commentaire
        if ($_POST && $_POST['comment']) {
            // On require le fichier contenant les tests pour les commentaires
            require_once('tester/testComment.php');
            // Et s'il n'a pas d'erreurs on crée le commentaire
            if (empty($arrayOfErrors)) {
                $this->_commentManager->createComment('Events', $_GET['id']);
                $_SESSION['message'] = 'Commentaire créé !';
                // On redirige sur la même page afin d'éviter des doublons de commentaires en cas de rafraichissement
                header('Location: /event/' . $_GET['id']);
                exit(0);
            }
        }
        // Récupération des commentaires liés à l'event
        $comments = $this->_commentManager->getComments('Events', $_GET['id']);
        // Récupération de tout les utilisateurs inscrit à l'event
        $registeredUsers = $this->_registeredManager->getEventRegistered($_GET['id']);
        // On récupère le nombre de participant à l'event
        $numberParticipants = $this->_eventManager->getNumberParticipants($_GET['id']);
        // Test servant à savoir si l'utilisateur est déjà inscrit ou non
        // On parcours toutes les inscriptions à cet event
        foreach ($registeredUsers as $registeredUser) {
            // Si l'id utilisateur d'un inscrit correspond à l'id utilisateur de la personne connectée
            if ($registeredUser->id_U == $_SESSION['id_U']) {
                // Alors l'utilisateur s'est déjà inscrit à cet événement
                $alreadyRegistered = true;
            }
        }
        require_once('views/viewEventDetail.php');
    }
}
