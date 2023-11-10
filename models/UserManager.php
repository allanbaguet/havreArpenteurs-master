<?php
  class UserManager extends Model
  {
      // Fonction permettant d'avoir tout les utilisateurs de la BDD
      public function getUsers() {
        try {
            $bdd = $this->getBdd();
            $req = $bdd->prepare('SELECT * FROM `Users` INNER JOIN `Roles` ON Users.id_R = Roles.id_R');
            $req->execute();
            $datas = $req->fetchAll(PDO::FETCH_OBJ);
            return $datas;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
      }
      // Récupère un utilisateur grâce à son pseudo
      public function getUserByUserName($userName) {
        try {
            $bdd = $this->getBdd();
            $req = $bdd->prepare('SELECT * FROM `Users` WHERE userName_U = :userName_U ');
            $req->bindValue(':userName_U', $userName, PDO::PARAM_STR);
            $req->execute();
            $user = $req->fetch(PDO::FETCH_OBJ);
            return $user;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
      }
      public function activateUser($userName){
        try {
            $bdd = $this->getBdd();
            $req = $bdd->prepare('UPDATE `Users` SET `status_U` = 1 WHERE `userName_U` = :userName_U');
            $req->bindValue(':userName_U', $userName, PDO::PARAM_STR);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
      }
      // Permets d'avoir les info d'un utilisateur en fonction d'un id
      public function getUser($id) {
        // On appel la méthode de la classe mère afin de ce connecter à la BDD
        $this->getBdd();
        // On récupère les données sur la table Users dans des objets de type User de l'utilisateur ayant un id = $id
        return $this->getWithId('Users', 'User', $id);
      }
      public function searchUsers($column, $search) {
        try {
            $bdd = $this->getBdd();
            $request = $bdd->prepare('SELECT * FROM `Users` WHERE '.$column.'_U LIKE :search');
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
            $request->execute();
            $datas = $request->fetchAll(PDO::FETCH_OBJ);
            return $datas;
        }
        catch(PDOException $e) {
            echo $sql . " " . $e->getMessage();
        }
      }
      public function testConnexion($login) {
        // Connexion à la BDD
        $bdd = $this->getBdd();
        $request = $bdd->prepare('SELECT id_U, userName_U, password_U, status_U, id_R FROM Users WHERE userName_U = :login ');
        $request->bindValue(':login', $login, PDO::PARAM_STR);
        $request->execute();
        $result = $request->fetch(PDO::FETCH_OBJ);
        // Tableau regroupant les erreurs
        $arrayOfErrors = [];
        // Si on a jeu de résultat c'est qu'n utilisateur possède ce login
        if ($result) {
            // Si le compte n'a pas encore été activé
            if ($result->status_U == 0) {
              $arrayOfErrors['login'] = 'Compte non activé !';
            } else {
              // Si le MdP renseigné correspond au MdP de l'utilisateur trouvé
              if (!password_verify($_POST['password'], $result->password_U)) {
                // Si le MdP ne correspond pas au login
                $arrayOfErrors['login'] = 'Identifiant ou mot de passe incorrect !';
              }
            }
        // S'il n'y a pas de résultat c'est que le login est erroné
        } else {
            $arrayOfErrors['login'] = 'Identifiant ou mot de passe incorrect !';
        }
        // Si nous n'avons pas recontré d'erreurs alors les identifiants sont corrects
        if (empty($arrayOfErrors)) {
            session_start();
            // On récupère comme info l'id de l'utilisateur, son pseudo et son niveau de droit dans le $_SESSION
            $_SESSION['id_U'] = $result->id_U;
            $_SESSION['userName_U'] = $result->userName_U;
            $_SESSION['id_R'] = $result->id_R;
            $_SESSION['message'] = 'Bienvenue '.$result->userName_U.' !';
            header('Location: /accueil');
            exit(0);
        }
        // On retourne le tableau d'erreur pour le retour utilisateur
        return $arrayOfErrors;
    }

    public function createUser() {
        try {
            $bdd = $this->getBdd();
            // Hachage du mot de passe :
            $pwdHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // Génération aléatoire d'une clé
            $cle = md5(microtime(TRUE)*100000);
            // On prépare une requête SQL à l'exécution
            $request = $bdd->prepare("INSERT INTO Users (`userName_U`, `lastName_U`, `firstName_U`, `password_U`, `email_U`, `birthDate_U`, `phone_U`, `streetNumber_U`, `address_U`, `additionalAddress_U`, `zipCode_U`, `city_U`, `creationDate_U`,`status_U`, `activationKey_U`, `id_R`)
            VALUES (:userName_U, :lastName_U, :firstName_U, :pwdHash, :email_U, :birthDate_U, :phone_U, :streetNumber_U, :address_U, :additionalAddress_U, :zipCode_U, :city_U, :creationDate_U, 0, :activationKey_U, 1)");
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':userName_U', $_POST['pseudo'], PDO::PARAM_STR);
            $request->bindValue(':lastName_U', $_POST['lastName'], PDO::PARAM_STR);
            $request->bindValue(':firstName_U', $_POST['firstName'], PDO::PARAM_STR);
            $request->bindValue(':pwdHash', $pwdHash, PDO::PARAM_STR);
            $request->bindValue(':email_U', $_POST['email'], PDO::PARAM_STR);
            $request->bindValue(':birthDate_U', empty($_POST['birthDate']) ? NULL : $_POST['birthDate'], PDO::PARAM_STR);
            $request->bindValue(':phone_U', $_POST['phone'], PDO::PARAM_STR);
            $request->bindValue(':streetNumber_U', $_POST['streetNumber'], PDO::PARAM_STR);
            $request->bindValue(':address_U', $_POST['streetName'], PDO::PARAM_STR);
            $request->bindValue(':additionalAddress_U', $_POST['additionalAddress'], PDO::PARAM_STR);
            $request->bindValue(':zipCode_U', $_POST['zipCode'], PDO::PARAM_STR);
            $request->bindValue(':city_U', $_POST['city'], PDO::PARAM_STR);
            $request->bindValue(':creationDate_U', date('Y-m-d'), PDO::PARAM_STR);
            $request->bindValue(':activationKey_U', $cle, PDO::PARAM_STR);
            $request->execute();
            // Puis on lui envoi un mail de confirmation
            require_once('email/emailActivation.php');
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
      }
      public function updateUser($id_U) {
        try {
            $bdd = $this->getBdd();
            $request = $bdd->prepare('UPDATE `Users` SET
                `userName_U` = :userName_U,
                `lastName_U` = :lastName_U,
                `firstName_U` = :firstName_U,
                `email_U` = :email_U,
                `birthDate_U` = :birthDate_U,
                `phone_U` = :phone_U,
                `streetNumber_U` = :streetNumber_U,
                `address_U` = :address_U,
                `additionalAddress_U` = :additionalAddress_U,
                `zipCode_U` = :zipCode_U,
                `city_U` = :city_U
                WHERE `id_U` = :id_U');
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':userName_U', $_POST['pseudo'], PDO::PARAM_STR);
            $request->bindValue(':lastName_U', $_POST['lastName'], PDO::PARAM_STR);
            $request->bindValue(':firstName_U', $_POST['firstName'], PDO::PARAM_STR);
            $request->bindValue(':email_U', $_POST['email'], PDO::PARAM_STR);
            $request->bindValue(':birthDate_U', empty($_POST['birthDate']) ? NULL : $_POST['birthDate'], PDO::PARAM_STR);
            $request->bindValue(':phone_U', $_POST['phone'], PDO::PARAM_STR);
            $request->bindValue(':streetNumber_U', $_POST['streetNumber'], PDO::PARAM_STR);
            $request->bindValue(':address_U', $_POST['streetName'], PDO::PARAM_STR);
            $request->bindValue(':additionalAddress_U', $_POST['additionalAddress'], PDO::PARAM_STR);
            $request->bindValue(':zipCode_U', $_POST['zipCode'], PDO::PARAM_STR);
            $request->bindValue(':city_U', $_POST['city'], PDO::PARAM_STR);
            $request->bindValue(':id_U', $id_U, PDO::PARAM_INT);
            // Exécution de la requête SQL
            $request->execute();
        }
        catch(PDOException $e) {
            echo $sql . " " . $e->getMessage();
        }
      }
      public function updatePassword() {
        try {
            $bdd = $this->getBdd();
            $pwdHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $request = $bdd->prepare('UPDATE `Users` SET `password_U` = :password_U WHERE `id_U` = :id_U');
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':password_U', $pwdHash, PDO::PARAM_STR);
            $request->bindValue(':id_U', $_SESSION['id_U']);
            // Exécution de la requête SQL
            $request->execute();
        }
        catch(PDOException $e) {
            echo $sql . " " . $e->getMessage();
        }
      }
      public function recuperationPassword($userName) {
        try {
            $bdd = $this->getBdd();
            $pwdHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $request = $bdd->prepare('UPDATE `Users` SET `password_U` = :password_U, `recuperationKey_U` = \'\' WHERE `userName_U` = :userName_U');
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':password_U', $pwdHash, PDO::PARAM_STR);
            $request->bindValue(':userName_U', $userName, PDO::PARAM_STR);
            // Exécution de la requête SQL
            $request->execute();
        }
        catch(PDOException $e) {
            echo $sql . " " . $e->getMessage();
        }
      }
      public function updateUserRole($id_U, $id_R) {
        try {
            $bdd = $this->getBdd();
            $request = $bdd->prepare('UPDATE `Users` SET `id_R` = :id_R WHERE `id_U` = :id_U');
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':id_U', $id_U, PDO::PARAM_INT);
            $request->bindValue(':id_R', $id_R, PDO::PARAM_INT);
            // Exécution de la requête SQL
            $request->execute();
        }
        catch(PDOException $e) {
            echo $sql . " " . $e->getMessage();
        }
      }
      // Permets de stocker la clé de récupération de mot de passe chez un utilisateur
      public function updateRecuperation($userName){
        try {
            // Génération aléatoire d'une clé
            $cle = md5(microtime(TRUE)*100000);
            $bdd = $this->getBdd();
            // On met à jour l'user avec sa clé
            $req = $bdd->prepare('UPDATE `Users` SET `recuperationKey_U` = :recuperationKey_U WHERE `userName_U` = :userName_U');
            $req->bindValue(':recuperationKey_U', $cle, PDO::PARAM_STR);
            $req->bindValue(':userName_U', $userName, PDO::PARAM_STR);
            $req->execute();
            // Puis on lui envoi un mail de récupération de mot de passe
            require_once('email/emailRecuperation.php');
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
      }
      public function deleteUser($id) {
        $this->getBdd();
        $this->delete('Users', $id);
      }
  }
