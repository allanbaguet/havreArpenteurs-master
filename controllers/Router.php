<?php

class Router {

    private $_ctrl;   // Variable qui va prendre le nom du controller voulu

    public function routeReq() {
        try {
            // Permet d'include automatiquement des classes demandées depuis le dossier 'models'
            spl_autoload_register(function ($class) {
              // On test si ce n'est pas un objet SwiftMailer d'instancier
              // Évite les problèmes à l'envoi du mail
              if (substr($class, 0,5) != 'Swift') {
                include('models/'.$class.'.php');
              }
            });
            $url = '';
            // GET['url']: correspond à où souhaite aller l'utilisateur (ex: accueil, article, event, ...)
            if (isset($_GET['url'])) {
                // On récupère tout les paramètre de l'url
                // FILTER_SANITIZE_URL: permet de supprimer tous les caractères sauf ...
                // ... les lettres, chiffres et $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
                $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
                // $action: correspond à certaine action réalisable par l'utilisateur
                // (ex: create, update, delete)
                if (isset($_GET['action'])) {
                  $action = filter_var($_GET['action'], FILTER_SANITIZE_URL);
                } else {
                  $action = '';
                }
                // $controller sera égale à 'Accueil', 'Article', etc ...
                $controller = ucfirst(strtolower($url)) . ucfirst(strtolower($action));
                // On concatène afin d'avoir le nom du controller souhaité, ex: 'ControllerAccueil
                $controllerClass = "Controller" . $controller;
                // On crée une variable qui aura comme valeur le chemin de controller
                $controllerFile = "controllers/" . $controllerClass . ".php";
                // Si le fichier exite :
                if (file_exists($controllerFile)) {
                    // On le require le controller souhaité
                    require_once($controllerFile);
                    // Puis on instancie un nouveau controller et on appel son constructeur
                    $this->_ctrl = new $controllerClass($url);
                } else {
                    // Si le fichier n'existe pas on lance une nouvelle exception
                    throw new Exception('Page introuvable');
                }
            } else {
                // On require et on instancie pour afficher l'accueil en appelant son constructeur
                require_once('controllers/ControllerAccueil.php');
                $this->_ctrl = new ControllerAccueil($url);
            }
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            require_once('views/viewError.php');
        }
    }
}
