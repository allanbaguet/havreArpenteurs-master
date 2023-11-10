<?php

// Gère la mise à jour d'un commentaire
class ControllerCommentUpdate extends Model
{
    private $_commentManager;

    public function __construct($url) {
        $this->_commentManager = new CommentsManager;
        $comment = $this->_commentManager->getComment($_GET['id']);
        // Si vous avez réaliser ce commentaire ou vous êtes un admin
        if ($comment->id_U() == $_SESSION['id_U'] || $_SESSION['id_R'] == 4) {
            $this->content();
        } else {
            header('Location: /accueil');
        }
    }

    private function content() {
        $this->_commentManager = new CommentsManager;
        $comment = $this->_commentManager->getComment($_GET['id']);

        // $return permet de s'avoir s'il l'on modifie le commentaire d'un article ou d'un event ...
        // .. on l'utilisera pour le bouton de retour du formulaire et le header location
        // $id servira aussi pour retourner sur le bon article / event
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
        // Si on a submit l'update
        if (isset($_POST['update'])) {
            // On require le fichier servant à tester l'update
            require_once('tester/testComment.php');
            // Et s'il n'a pas d'erreurs on update le commentaire
            if (empty($arrayOfErrors)) {
                $this->_commentManager->updateComment($_GET['id']);
                $_SESSION['message'] = 'Commentaire modifié avec succès !';
                header('Location: /' . $return . '/' . $id);
                exit(0);
            }
        }
        require_once('views/viewCommentUpdate.php');
    }
}
