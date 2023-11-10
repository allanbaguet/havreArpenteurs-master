<?php
  // Model de base qui servira de classe mère pour plusieurs classes
  abstract class Model
  {
      private static $_bdd;
      // Fonction de connexion à la BDD
      private static function setBdd() {
          self::$_bdd = new PDO('mysql:host=localhost;dbname=havreArpenteurs;charset=utf8','root','');
          self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      }
      // Récupère la connexion à la BDD
      protected function getBdd() {
          // Si on n'est pas connecté, on se connecte
          if(self::$_bdd == null){
              self::setBdd();
          }
         return self::$_bdd;
      }
      // Récupère toute les données d'une table
      protected function getAll($table, $obj) {
          // On crée une variable qui aura comme format l'id de la table (id_E, id_A, ...)
          // Pour ce faire on concatène 'id_' à la première lettre de la table (Users -> id_U)
          $idTable = 'id_'.ucfirst(substr($table, 0,1));
          $var = [];
          $req = self::$_bdd->prepare('SELECT * FROM '.ucfirst(strtolower($table)).' ORDER BY '.$idTable.' DESC');
          $req->execute();
          $datas = $req->fetchAll(PDO::FETCH_ASSOC);
          // Pour chaque jeu d'enregistrement on créera un objet du type de la table
          // Cela nous permettra d'utiliser les méthoses propres à l'objet pour chaque enregistrement
          foreach ($datas as $data) {
              $var[] = new $obj($data);
          }
          return $var;
      }
      // Récupère les données d'un élément d'une table
      protected function getWithId($table, $obj, $id) {
          // On crée une variable qui aura comme format l'id des tables (id_E, id_A, ...)
          // Pour ce faire on concatène 'id_' à la première lettre de la table, mis en majuscule (Users -> id_U)
          $T = ucfirst(substr($table, 0,1));
          $idTable = 'id_'.$T;
          $req = self::$_bdd->prepare('SELECT * FROM '.ucfirst(strtolower($table)).' WHERE '.$idTable.' = :id');
          $req->bindValue(':id', $id, PDO::PARAM_INT);
          $req->execute();
          $data = $req->fetch(PDO::FETCH_ASSOC);
          // Si rien n'a été récupéré par la requete SQL
          if ($data == false) {
            return 0;
          } else {
            $var = new $obj($data);
            return $var;
          }
      }
      // Supprime un élément d'une table
      protected function delete($table, $id) {
        $idTable = 'id_'.ucfirst(substr($table, 0,1));
        $req = self::$_bdd->prepare('DELETE FROM '.$table.' WHERE '.$idTable.' = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
      }
  }
