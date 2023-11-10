<?php

// Connexion à la BDD
$bdd = $this->getBdd();
$request = $bdd->prepare('SELECT id_U, userName_U, password_U, id_R FROM Users WHERE userName_U = :login ');
$request->bindValue(':login', $login, PDO::PARAM_STR);
$request->execute();
$result = $request->fetch(PDO::FETCH_OBJ);

// Tableau regroupant les erreurs
$arrayOfErrors = [];

// Si on a jeu un résultat c'est que le login est enregistré dans la BDD
if ($result) {
    // Si le MdP renseigné correspond au MdP de l'utilisateur trouvé
    if (!password_verify($_POST['password'], $result->password_U)) {
        // Si le MdP ne correspond pas au login
        $arrayOfErrors['login'] = 'Identifiant ou mot de passe incorrect !';
    }
    // S'il n'y a pas de résultat c'est que le login est erroné
} else {
    $arrayOfErrors['login'] = 'Identifiant ou mot de passe incorrect !';
}
