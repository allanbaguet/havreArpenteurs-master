<?php
  class Role
  {
      // Nom des colonnes de la table Category
      private $_id_R;
      private $_name;

      // CONSTRUCTEUR
      public function __construct(array $data)
      {
          $this->hydrate($data);
      }

      // HYDRATATION
      public function hydrate(array $data)
      {
          foreach($data as $key => $value)
          {
              // $key = id_E, title_E, etc ...
              // L'on doit enlever le _E pour que le nom de la méthode corresponde avec le nom de la colonne de la BDD ...
              // ... sauf pour l'id, pour que l'on puisse faire la différence entre l'id_E et l'id_U
              if (substr($key, 0, -2) != 'id') {
                $keyParse = substr($key, 0, -2);
                $method = 'set'.ucfirst($keyParse);
              } else {
                $method = 'set'.ucfirst($key);
              }
              if(method_exists($this, $method)) {
                  $this->$method($value);
              }
          }
      }
      // SETTERS
      // Setter de l'id de la catégorie de l'event
      public function setId_R($id)
      {
          $id = (int) $id;
          if($id > 0)
          {
              $this->_id_R = $id;
          }
      }
      public function setName($name) {
        if(is_string($name)) {
          $this->_name = $name;
        }
      }

      // GETTERS
      public function id_R()
      {
          return $this->_id_R;
      }
      public function name()
      {
          return $this->_name;
      }
  }
