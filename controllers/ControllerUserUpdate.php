<?php

// Gère la mise à jour d'un utilisateur
class ControllerUserUpdate extends Model
{
    private $_userManager;

    public function __construct($url) {
        if (!isset($_SESSION['id_U'])) {
            header('Location: /accueil');
        } else {
            $this->content();
        }
    }

    private function content() {
        $this->_userManager = new UserManager;
        // On récupère les info de l'user connecté
        $userInfo = $this->_userManager->getUser($_SESSION['id_U']);
        // Si on a submit l'update
        if (isset($_POST['update'])) {
            // On require le fichier contenant le test d'inscription d'un utilisateur
            require_once('tester/testUser.php');
            // Et s'il n'a pas d'erreurs on update l'utilisateur
            if (empty($arrayOfErrors)) {
                $this->_userManager->updateUser($_SESSION['id_U']);
                // On change le nom enregistré dans la session
                $_SESSION['userName_U'] = $_POST['pseudo'];
                $_SESSION['message'] = 'Profil mise à jour !';
                header('Location: /user');
                exit(0);
            }
        }
        require_once('views/viewUserUpdate.php');
    }
}
