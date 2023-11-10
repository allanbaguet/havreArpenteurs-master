<?php

// Gère le contenu de la page d'article
class ControllerArticle
{
    private $_articleManager;
    private $_commentManager;

    public function __construct($url) {
            $this->content();
    }

    private function content() {
        $this->_articleManager = new ArticleManager;
        $this->_commentManager = new CommentsManager;
        if (isset($_GET['id']) && empty($_GET['action'])) {
            if ($_POST['comment']) {
                // On require le fichier servant à tester l'update
                require_once('tester/testComment.php');
                // Et s'il n'a pas d'erreurs on update le commentaire
                if (empty($arrayOfErrors)) {
                    $this->_commentManager->createArticleComment($_GET['id']);
                }
            }
            $comments = $this->_commentManager->getArticleComment($_GET['id']);
            $article = $this->_articleManager->getArticle($_GET['id']);
            require_once('views/viewArticleDetail.php');
        } else {
            // On récupère tout les articles et événements de la BDD
            $articles = $this->_articleManager->getAllArticles();
            require_once('views/viewArticle.php');
        }
    }
}
