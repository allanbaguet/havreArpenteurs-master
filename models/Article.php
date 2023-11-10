<?php
  class Article
  {
      // Nom des colonnes de la table Article
      private $_id_A;
      private $_id_U;
      private $_title;
      private $_creationDate;
      private $_modifDate;
      private $_image;
      private $_shortContent;
      private $_longContent;
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
              // $key = id_A, title_A, etc ...
              // L'on doit enlever le _A pour que le nom de la méthode corresponde avec le nom de la colonne de la BDD ...
              // ... sauf pour l'id, pour que l'on puisse faire la différence entre l'id_A et l'id_U
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
      // Setter de l'id de l'article
      public function setId_A($id)
      {
          $id = (int) $id;
          if($id > 0)
          {
              $this->_id_A = $id;
          }
      }
      // Setter de l'id du créateur de l'article
      public function setId_U($id)
      {
          $id = (int) $id;
          if($id > 0)
          {
              $this->_id_U = $id;
          }
      }
      public function setTitle($title)
      {
          if(is_string($title))
          {
              $this->_title = $title;
          }
      }
      public function setImage($image)
      {
          if(is_string($image))
          {
              $this->_image = $image;
          }
      }
      public function setCreationDate($date)
      {
          $this->_creationDate = $date;
      }
      public function setModifDate($date)
      {
          $this->_modifDate = $date;
      }
      public function setShortContent($shortContent)
      {
          if(is_string($shortContent))
          {
              $this->_shortContent = $shortContent;
          }
      }
      public function setLongContent($longContent)
      {
          if(is_string($longContent))
          {
              $this->_longContent = $longContent;
          }
      }
      public function setUserName($userName) {
        if(is_string($userName)) {
          $this->_userName = $userName;
        }
      }

      // GETTERS
      public function id_A()
      {
          return $this->_id_A;
      }
      public function id_U()
      {
          return $this->_id_U;
      }
      public function title()
      {
          return $this->_title;
      }
      public function image()
      {
          return $this->_image;
      }
      public function date()
      {
          return $this->_creationDate;
      }
      public function modifDate()
      {
          return $this->_modifDate;
      }
      public function shortContent()
      {
          return $this->_shortContent;
      }
      public function longContent()
      {
          return $this->_longContent;
      }
      public function userName() {
        return $this->_userName;
      }
  }
