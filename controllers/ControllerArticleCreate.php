<?php

// Gère le contenu de la création d'article
class ControllerArticleCreate extends Model
{
    private $_articleManager;

    public function __construct($url) {
        // Si l'utilisateur est un inscrit ou un membre, il ne peux créer d'articles, il est alors renvoyé vers l'accueil
        if (isset($_SESSION['id_R']) && ($_SESSION['id_R'] == 1 || $_SESSION['id_R'] == 2)) {
            header('Location: accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_articleManager = new ArticleManager;
        // Si on a submit la création
        if (isset($_POST['create'])) {
            // On require le fichier contenant les tests de création d'article
            require_once('tester/testCreateArticle.php');
            // Et s'il n'a pas d'erreurs on crée l'article
            if (empty($arrayOfErrors)) {
                $this->_articleManager->createArticle();
                $_SESSION['message'] = 'Article crée avec succès !';
                header('Location: ../user');
                exit(0);
            }
        }
        require_once('views/viewArticleCreate.php');
    }
}
