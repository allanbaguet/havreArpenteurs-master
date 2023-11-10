<?php

// Gère la mise à jour d'article
class ControllerArticleUpdate extends Model {

    private $_articleManager;

    public function __construct($url) {
        // Si on n'a pas les droits
        if (isset($_SESSION['id_R']) && ($_SESSION['id_R'] == 1 || $_SESSION['id_R'] == 2) || !isset($_GET['id'])) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_articleManager = new ArticleManager;
        // Si on a submit l'update
        if (isset($_POST['update'])) {
            // On require le fichier servant à tester l'update d'article
            require_once('tester/testUpdateArticle.php');
            // On test le formulaire avec récupération des erreurs
            // Et s'il n'a pas d'erreurs on update l'article
            if (empty($arrayOfErrors)) {
                $this->_articleManager->updateArticle($_GET['id']);
                $_SESSION['message'] = 'Article modifié avec succès !';
                header('Location: /article');
                exit(0);
            }
        }
        // On récupère les informations de l'article voulu
        $article = $this->_articleManager->getArticle($_GET['id']);
        require_once('views/viewArticleUpdate.php');
    }
}
