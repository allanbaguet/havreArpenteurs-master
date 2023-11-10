<?php
  class CategoryManager extends Model
  {
      // Fonction permettant d'avoir tout les events de la BDD
      public function getAllCategory()
      {
        $var = [];

        $bdd = $this->getBdd();
        $req = $bdd->prepare('SELECT * FROM Category');
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datas as $data) {
            $var[] = new Category($data);
        }
        return $var;
      }
      // Fonction permettant d'avoir tout les events de la BDD
      public function getCategory($id)
      {
          // On appel la méthode afin de ce connecter à la BDD
          $this->getBdd();
          // On récupère les données de l'events d'id_E = $id
          return $this->getWithId('Category', 'Category', $id);
      }
  }
