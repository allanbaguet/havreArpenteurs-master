<?php
  class Comments
  {
      // Nom des colonnes de la table EventComments
      private $_id_C;
      private $_title;
      private $_creationDate;
      private $_modifDate;
      private $_content;
      private $_id_E;
      private $_id_A;
      private $_id_U;
      private $_userName;

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
              // $key = id_C, title_C, etc ...
              // L'on doit enlever le _C pour que le nom de la méthode corresponde avec le nom de la colonne de la BDD ...
              // ... sauf pour l'id, pour que l'on puisse faire la différence entre l'id_C, l'id_U et l'id_E
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
      // Setter de l'id du commentaire
      public function setId_C($id)
      {
          $id = (int) $id;
          if($id > 0)
          {
              $this->_id_C = $id;
          }
      }
      // Setter de l'id du créateur du commentaire
      public function setId_U($id)
      {
          $id = (int) $id;
          if($id > 0)
          {
              $this->_id_U = $id;
          }
      }
      // Setter de l'id de l'event concerné
      public function setId_E($id)
      {
          $id = (int) $id;
          if($id > 0)
          {
              $this->_id_E = $id;
          }
      }
      // Setter de l'id de l'article concerné
      public function setId_A($id)
      {
          $id = (int) $id;
          if($id > 0)
          {
              $this->_id_A = $id;
          }
      }
      public function setTitle($title)
      {
          if(is_string($title))
          {
              $this->_title = $title;
          }
      }
      public function setcreationDate($date)
      {
          $this->_creationDate = $date;
      }
      public function setModifDate($date)
      {
          $this->_modifDate = $date;
      }
      public function setContent($content)
      {
          if(is_string($content))
          {
              $this->_content = $content;
          }
      }
      public function setUserName($userName) {
        if(is_string($userName)) {
          $this->_userName = $userName;
        }
      }
      // GETTERS
      public function id_C()
      {
          return $this->_id_C;
      }
      public function id_U()
      {
          return $this->_id_U;
      }
      public function id_E()
      {
          return $this->_id_E;
      }
      public function id_A()
      {
          return $this->_id_A;
      }
      public function title()
      {
          return $this->_title;
      }
      public function date()
      {
          return $this->_creationDate;
      }
      public function modifDate()
      {
          return $this->_modifDate;
      }
      public function content()
      {
          return $this->_content;
      }
      public function userName() {
        return $this->_userName;
      }
  }
