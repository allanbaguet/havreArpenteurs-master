<?php

// Gère la suppression d'un article
class ControllerArticleDelete extends Model
{
    private $_articleManager;

    public function __construct($url) {
        // Si nous n'avons pas un rôle de modérateur ou d'aministrateur
        if (isset($_SESSION['id_R']) && ($_SESSION['id_R'] == 1 || $_SESSION['id_R'] == 2)) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_articleManager = new ArticleManager;
        // Si on a submit la suppression de l'article
        if (isset($_POST['delete'])) {
            // On procède à la suppression de l'article grâce à son id
            if ($this->_articleManager->deleteArticle($_GET['id'])) {
                // Si suppression OK alors on supprime l'image de l'article
                array_map('unlink', glob("uploads/article" . $_GET['id'] . ".*"));
                $_SESSION['message'] = 'Article supprimé avec succès !';
            }
            // Puis on se redirige vers l'accueil
            header('Location: /accueil');
            exit(0);
        }
        require_once('views/viewArticleDelete.php');
    }
}
