<?php
  class ArticleManager extends Model
  {
      // Fonction permettant d'avoir tout les articles de la BDD
      public function getAllArticles() {
        $bdd = $this->getBdd();
        $req = $bdd->prepare('SELECT * FROM Articles LEFT JOIN Users ON Articles.id_U = Users.id_U ORDER BY id_A DESC');
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_OBJ);
        return $datas;
      }
      public function getFourArticles() {
          $bdd = $this->getBdd();
          $req = $bdd->prepare('SELECT * FROM Articles ORDER BY id_A DESC LIMIT 4');
          $req->execute();
          $datas = $req->fetchAll(PDO::FETCH_OBJ);
          return $datas;
      }
      // Fonction permettant d'avoir tout les articles de la BDD
      public function getArticle($id) {
          // On appel la méthode afin de ce connecter à la BDD
          $this->getBdd();
          // On récupère les données de l'article d'id_A = $id
          return $this->getWithId('Articles', 'Article', $id);
      }
      public function createArticle() {
        try {
            $bdd = $this->getBdd();
            $request = $bdd->prepare("INSERT INTO Articles (`title_A`, `image_A`, `shortContent_A`, `longContent_A`, `creationDate_A`, `id_U`)
            VALUES (:title_A, :image_A, :shortContent_A, :longContent_A, :creationDate_A, :id_U)");
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':title_A', $_POST['title'], PDO::PARAM_STR);
            // On mets une fausse valeur à image_id que l'on changera après par le chemin de l'image contenant l'id de l'article
            // On ne peux avoir l'id de l'article s'il n'est pas encore crée
            $request->bindValue(':image_A', 'aChanger', PDO::PARAM_STR);
            $request->bindValue(':shortContent_A', $_POST['shortContent'], PDO::PARAM_STR);
            $request->bindValue(':longContent_A', $_POST['longContent'], PDO::PARAM_STR);
            $request->bindValue(':creationDate_A', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $request->bindValue(':id_U', $_SESSION['id_U'], PDO::PARAM_INT);
            if($request->execute()){
              $targetFile = basename($_FILES["image"]["name"]);
              // $imageFileType = extention du fichier envoyé (jpg, png, ...)
              $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
              // On récupère l'identifiant de la dernière ligne insérée
              $lastId = $bdd->lastInsertId();
              // Corresponds au chemin de l'image (ex : uploads/article1.png)
              $fileName = 'uploads/article' . $lastId . '.' . $imageFileType;
              $request2 = $bdd->prepare("UPDATE Articles SET `image_A` = :fileName WHERE id_A = $lastId");
              $request2->bindValue(':fileName', $fileName, PDO::PARAM_STR);
              if($request2->execute()){
                move_uploaded_file($_FILES["image"]["tmp_name"], $fileName);
              }
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
      }

      public function updateArticle($id) {
        try {
            $bdd = $this->getBdd();
            // On récupère les données de l'article id_A = $id
            $article = $this->getWithId('Articles', 'Article', $id);
            // Et si on a upload une nouvelle image
            $targetFile = basename($_FILES["image"]["name"]);
            // $imageFileType = extention du fichier envoyé (jpg, png, ...)
            $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
            // Corresponds au chemin de l'image (ex : uploads/article1.png)
            $fileName = 'uploads/article' . $id. '.' . $imageFileType;
            $request = $bdd->prepare('UPDATE `Articles` SET
                `title_A` = :title_A,
                `image_A` = :image_A,
                `shortContent_A` = :shortContent_A,
                `longContent_A` = :longContent_A,
                `modifDate_A` = :modifDate_A
                WHERE `id_A` = :id_A');
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':title_A', $_POST['title'], PDO::PARAM_STR);
            $request->bindValue(':image_A', !empty($_FILES['image']["name"]) ? $fileName : $article->image(), PDO::PARAM_STR);
            $request->bindValue(':shortContent_A', $_POST['shortContent'], PDO::PARAM_STR);
            $request->bindValue(':longContent_A', $_POST['longContent'], PDO::PARAM_STR);
            $request->bindValue(':modifDate_A', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $request->bindValue(':id_A', $id, PDO::PARAM_INT);
            // Exécution de la requête SQL
            if($request->execute()){
              if (!empty($_FILES['image']["name"])) {
                  // On supprimer l'ancienne image (évite les doublons, ex : event1.jpg event1.png)
                  unlink($article->image());
                  // On déplace la nouvelle image
                  move_uploaded_file($_FILES["image"]["tmp_name"], $fileName);
              }
            }
        }
        catch(PDOException $e) {
            echo $sql . " " . $e->getMessage();
        }
      }

      public function deleteArticle($id) {
        $this->getBdd();
        $this->delete('Articles', $id);
      }
  }
