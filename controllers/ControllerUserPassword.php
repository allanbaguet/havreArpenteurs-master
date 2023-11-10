<?php

// Gère la modification du mot de passe de son compte
class ControllerUserPassword extends Model
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
        $userInfo = $this->_userManager->getUser($_SESSION['id_U']);
        // Si on a submit l'update
        if (isset($_POST['update'])) {
            // On require le fichier servant à tester l'update du mot de passe
            require_once('tester/testUpdatePasswordUser.php');
            // S'il n'a pas d'erreurs on update le mot de passe utilisateur
            if (empty($arrayOfErrors)) {
                $this->_userManager->updatePassword();
                $_SESSION['message'] = 'Mot de passe mise à jour !';
                header('Location: /user');
                exit(0);
            }
        }
        require_once('views/viewUserPassword.php');
    }
}
