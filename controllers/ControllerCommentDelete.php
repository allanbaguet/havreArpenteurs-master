<?php

// Gère la suppression d'un commentaire
class ControllerCommentDelete extends Model
{
    private $_commentManager;

    public function __construct($url) {
        $this->_commentManager = new CommentsManager;
        $comment = $this->_commentManager->getComment($_GET['id']);
        // Si vous êtes le créateur de ce commentaire ou vous êtes un admin
        if ($comment->id_U() == $_SESSION['id_U'] || $_SESSION['id_R'] == 4) {
            $this->content();
        } else {
            header('Location: /accueil');
        }
    }

    private function content() {
        $this->_commentManager = new CommentsManager;
        $comment = $this->_commentManager->getComment($_GET['id']);

        // $return: permet de s'avoir s'il l'on supprime le commentaire d'un article ou d'un event ...
        // .. on l'utilisera pour le bouton de retour du formulaire et le header location
        // $id: servira aussi pour retourner sur le bon article / event
        // Si le commentaire ne possède pas de clé étreangère d'un event alors on vient d'un article
        if ($comment->id_E() != null) {
            $return = 'event';
            $id = $comment->id_E();
        }
        // Si le commentaire ne possède pas de clé étreangère d'un article alors on vient d'un event
        if ($comment->id_A() != null) {
            $return = 'article';
            $id = $comment->id_A();
        }
        // Si on a submit la suppression
        if (isset($_POST['delete'])) {
            // On procède à la suppression du commentaire grâce à son id
            $this->_commentManager->deleteComment($_GET['id']);
            // Puis on se redirige l'article ou l'event sur lequel nous étions
            $_SESSION['message'] = 'Commentaire supprimé avec succès !';
            header('Location: /' . $return . '/' . $id);
            exit(0);
        }
        require_once('views/viewCommentDelete.php');
    }
}
