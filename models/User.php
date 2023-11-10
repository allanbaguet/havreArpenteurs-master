<?php
  class User
  {
      // Nom des colonnes de la table Users
      protected $_id_U;
      protected $_userName;
      protected $_lastName;
      protected $_firstName;
      protected $_password;
      protected $_email;
      protected $_birthDate;
      protected $_phone;
      protected $_streetNumber;
      protected $_address;
      protected $_additionalAddress;
      protected $_zipCode;
      protected $_city;
      protected $_creationDate;
      protected $_id_R;

      // CONSTRUCTEUR
      public function __construct(array $data) {
          $this->hydrate($data);
      }
      // HYDRATATION
      public function hydrate(array $data)
      {
          foreach($data as $key => $value)
          {
            // $key = id_U, title_U, etc ...
            // L'on doit enlever le _U pour que le nom de la méthode corresponde avec le nom de la colonne de la BDD ...
            // ... sauf pour l'id, pour que l'on puisse faire la différence entre l'id_U et l'id_R
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
      public function setId_U($id) {
          $id = (int) $id;
          if($id > 0) {
              $this->_id_U = $id;
          }
      }
      public function setId_R($id) {
          $id = (int) $id;
          if($id > 0) {
              $this->_id_R = $id;
          }
      }
      public function setUserName($userName) {
        if(is_string($userName)) {
          $this->_userName = $userName;
        }
      }
      public function setLastName($lastName) {
        if(is_string($lastName)) {
          $this->_lastName = $lastName;
        }
      }
      public function setFirstName($firstName) {
          if(is_string($firstName)) {
              $this->_firstName = $firstName;
          }
      }
      public function setPassword($password){
        if(is_string($password)) {
            $this->_password = $password;
        }
      }
      public function setEmail($email) {
          if(is_string($email)) {
              $this->_email = $email;
          }
      }
      public function setBirthDate($birthDate) {
        $this->_birthDate = $birthDate;
      }
      public function setPhone($phone) {
        if(is_numeric($phone)) {
            $this->_phone = $phone;
        }
      }
      public function setStreetNumber($streetNumber) {
        if(is_string($streetNumber)) {
            $this->_streetNumber = $streetNumber;
        }
      }
      public function setAddress($address) {
        if(is_string($address)) {
            $this->_address = $address;
        }
      }
      public function setAdditionalAddress($additionalAddress) {
        if(is_string($additionalAddress)) {
            $this->_additionalAddress = $additionalAddress;
        }
      }
      public function setZipCode($zipCode) {
          $zipCode = (int) $zipCode;
          if($zipCode > 0) {
              $this->_zipCode = $zipCode;
          }
      }
      public function setCity($city) {
        if(is_string($city)) {
            $this->_city = $city;
        }
      }
      public function setCreationDate($creationDate) {
        $this->_creationDate = $creationDate;
      }

      // GETTERS
      public function id_U() {
          return $this->_id_U;
      }
      public function id_R() {
          return $this->_id_R;
      }
      public function userName() {
        return $this->_userName;
      }
      public function lastName() {
        return $this->_lastName;
      }
      public function firstName() {
          return $this->_firstName;
      }
      public function password() {
          return $this->_password;
      }
      public function email() {
          return $this->_email;
      }
      public function birthDate() {
          return $this->_birthDate;
      }
      public function phone() {
          return $this->_phone;
      }
      public function streetNumber() {
          return $this->_streetNumber;
      }
      public function address() {
          return $this->_address;
      }
      public function additionalAddress() {
          return $this->_additionalAddress;
      }
      public function zipCode() {
          return $this->_zipCode;
      }
      public function city() {
          return $this->_city;
      }
      public function creationDate() {
          return $this->_creationDate;
      }
  }
