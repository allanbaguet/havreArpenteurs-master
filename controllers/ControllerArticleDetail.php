<?php

// Gère l'affichage détaillé d'un article
class ControllerArticleDetail extends Model {

    private $_articleManager;
    private $_commentManager;

    public function __construct($url) {
        $this->_articleManager = new ArticleManager;
        $article = $this->_articleManager->getArticle($_GET['id']);
        // Si $article = 0 alors il n'y a pas d'article d'id $_GET['id']
        if ($article === 0) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_articleManager = new ArticleManager;
        $this->_commentManager = new CommentsManager;
        if ($_POST && $_POST['comment']) {
            // On require le fichier contenant les tests de création de commentaire
            require_once('tester/testComment.php');
            // Et s'il n'a pas d'erreurs on crée le commentaire
            if (empty($arrayOfErrors)) {
                $this->_commentManager->createComment('Articles', $_GET['id']);
                $_SESSION['message'] = 'Commentaire créé !';
                header('Location: /article/' . $_GET['id']);
                exit(0);
            }
        }
        // On récupère les informations de l'article ainsi que ces commentaires
        $comments = $this->_commentManager->getComments('Articles', $_GET['id']);
        $article = $this->_articleManager->getArticle($_GET['id']);
        require_once('views/viewArticleDetail.php');
    }
}
