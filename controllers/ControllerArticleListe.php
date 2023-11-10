<?php

// Gère l'affichage en liste des articles
class ControllerArticleListe extends Model
{
    private $_articleManager;

    public function __construct($url) {
        // Si nous n'avons pas le rôle requis
        if (isset($_SESSION['id_R']) && ($_SESSION['id_R'] == 1 || $_SESSION['id_R'] == 2)) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_articleManager = new ArticleManager;
        // On récupère tout les articles de le BDD
        $articles = $this->_articleManager->getAllArticles();
        require_once('views/viewArticleList.php');
    }
}
