<?php

// Gère l'affichage détaillé d'un utilisateur (option admin/modo)
class ControllerUserDetail extends Model
{
    private $_userManager;
    private $_roleManager;

    public function __construct($url) {
        $this->_userManager = new UserManager;
        $user = $this->_userManager->getUser($_GET['id']);
        // Si $user = 0 alors il n'y a pas d'user d'id $_GET['id']
        if ($user === 0) {
            header('Location: /user/list');
        }
          // Si vous avez les droits (modo ou admin)
        if ($_SESSION['id_R'] == 3 || $_SESSION['id_R'] == 4) {
            // Si on souhaite modifier un admin et que l'on n'est pas admin
            if ($user->id_R() == 4 && $_SESSION['id_R'] != 4) {
                // On est redirigé vers la liste des users
                header('Location: /user/list');
            } else {
                $this->content();
            }
        } else {
            header('Location: /user/list');
        }
    }

    private function content() {
        $this->_userManager = new UserManager;
        $this->_roleManager = new RoleManager;
        // Si on a submit le formulaire de modification d'information
        if (isset($_POST['update'])) {
            // On require le fichier contenant le test d'inscription d'un utilisateur
            require_once('tester/testUser.php');
            // S'il n'y a pas d'erreurs
            if (empty($arrayOfErrors)) {
                $this->_userManager->updateUser($_GET['id']);
                $_SESSION['message'] = 'Le profil a bien été mis à jour !';
                // On renvoi vers la même page avec d'éviter des problèmes sur l'actualisation
                header('Location: /user/' . $_GET['id']);
                exit(0);
            }
        }
        // Si on a submit le formulaire de modification de rôle (admin only)
        if (isset($_POST['updateRole'])) {
            require_once('tester/testRole.php');
            if (empty($arrayOfErrors)) {
                $this->_userManager->updateUserRole($_GET['id'], $_POST['role']);
                // On renvoi vers la même page avec d'éviter des problèmes sur l'actualisation
                $_SESSION['message'] = 'Votre profil a bien été mis à jour !';
                header('Location: /user/' . $_GET['id']);
                exit(0);
            }
        }
        // On récupère les info de l'utilsiateur
        $userInfo = $this->_userManager->getUser($_GET['id']);
        // On récupère la liste des différents rôles
        $roles = $this->_roleManager->getAllRoles();
        require_once('views/viewUserDetail.php');
    }
}
