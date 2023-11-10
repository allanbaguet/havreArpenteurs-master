<?php
  class CommentsManager extends Model
  {
      // Permets d'avoir tout les commentaires de la table $table d'id $id
      public function getComments($table, $id)
      {
          // On crée une variable qui aura comme format l'id des tables (id_E, id_A, ...)
          // Pour ce faire on concatène 'id_' à la première lettre de la table, mis en majuscule (Users -> id_U)
          $T = ucfirst(substr($table, 0,1));
          $idTable = 'id_'.$T;

          $var = [];
          $bdd = $this->getBdd();
          $req = $bdd->prepare('SELECT *, DATE_FORMAT(creationDate_C, "%d/%m/%Y à %H:%i:%s") creationDate_C FROM Comments LEFT JOIN Users ON Comments.id_U = Users.id_U WHERE '.$idTable.' = :id ORDER BY id_C DESC');
          $req->bindValue(':id', $id, PDO::PARAM_INT);
          $req->execute();
          $datas = $req->fetchAll(PDO::FETCH_OBJ);
          return $datas;
      }
      // Permets d'avoir un commentaire
      public function getComment($id_C)
      {
        $this->getBdd();
        return $this->getWithId('Comments', 'Comments', $id_C);
      }

      public function createComment($table, $id){
        try {
            $T = ucfirst(substr($table, 0,1));
            $idTable = 'id_'.$T;
            $bdd = $this->getBdd();
            $request = $bdd->prepare("INSERT INTO Comments (`title_C`, `content_C`, `creationDate_C`, `$idTable`, `id_U`)
            VALUES (:title_C, :content_C, :creationDate_C, :id, :id_U)");
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':title_C', $_POST['title'], PDO::PARAM_STR);
            $request->bindValue(':content_C', $_POST['content'], PDO::PARAM_STR);
            $request->bindValue(':creationDate_C', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $request->bindValue(':id', $id, PDO::PARAM_INT);
            $request->bindValue(':id_U', $_SESSION['id_U'], PDO::PARAM_INT);
            $request->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
      }

      public function updateComment($id_C){
        try {
            $bdd = $this->getBdd();
            $request = $bdd->prepare('UPDATE `Comments` SET
                `title_C` = :title_C,
                `content_C` = :content_C,
                `modifDate_C` = :modifDate_C
                WHERE `id_C` = :id_C');
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':title_C', $_POST['title'], PDO::PARAM_STR);
            $request->bindValue(':content_C', $_POST['content'], PDO::PARAM_STR);
            $request->bindValue(':modifDate_C', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $request->bindValue(':id_C', $id_C, PDO::PARAM_INT);
            // Exécution de la requête SQL
            $request->execute();
        }
        catch(PDOException $e) {
            echo $sql . " " . $e->getMessage();
        }
      }

      public function deleteComment($id) {
        $this->getBdd();
        $this->delete('Comments', $id);
        // $bdd = $this->getBdd();
        // $req = $bdd->prepare('DELETE FROM `Comments` WHERE id_C = :id');
        // $req->bindValue(':id', $id, PDO::PARAM_INT);
        // $req->execute();
      }
  }
