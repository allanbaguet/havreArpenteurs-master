<?php
  // Regex des différents input
  $stringPattern = '/^[a-zA-ZéèôöîïçÉÈÎÏ]{1}[a-zA-ZéèôöîïçÉÈÎÏ \'-]+([-\'\s][a-zA-ZéèôöîïçÉÈÎÏ \'-][a-zéèôöîïç \']+)?$/';
  $emailPattern = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
  $numberPattern = '/^[0-9]+$/';
  $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/';
  $phonePattern = '/^[0][0-9]{9}$/';
  $datePattern = '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/';
  $pseudoPattern = '/[a-zA-Z0-9_\-]{3,16}/' ;
  $numberStreetPattern = '/^[0-9]+$/';
  $zipCodePattern = '/^[0-9]{5}$/';
  // Tableau contenant les erreurs des différents input
  $arrayOfErrors = [];

  // Nettoyage du $_POST
  foreach ($_POST as $input => $value) {
    $_POST[$input] = strip_tags(trim($_POST[$input]));
  }

  // Check des champs obligatoires
  if (empty($_POST['pseudo'])){
      $arrayOfErrors['pseudo'] = 'Pseudo obligatoire';
  }
  if (empty($_POST['email'])){
      $arrayOfErrors['email'] = 'Email obligatoire';
  }
  // Check validité de tout les champs
  if (!preg_match($stringPattern, $_POST['pseudo']) && !empty($_POST['pseudo'])) {
    $arrayOfErrors['pseudo'] = 'Pseudo invalide';
    $_POST['pseudo'] = '';
  }
  if (!preg_match($stringPattern, $_POST['firstName']) && !empty($_POST['firstName'])) {
      $arrayOfErrors['firstName'] = 'Prénom invalide';
      $_POST['firstName'] = '';
  }
  if (!preg_match($stringPattern, $_POST['lastName']) && !empty($_POST['lastName'])) {
      $arrayOfErrors['lastName'] = 'Nom de famille invalide';
      $_POST['lastName'] = '';
  }

  // Si on a bien envoyé les mots de passe (non présent sur l'update utilisateur)
  if (isset($_POST['password']) && isset($_POST['confirmPassword']))
  {
    if (empty($_POST['password'])){
        $arrayOfErrors['password'] = 'Mot de passe obligatoire';
    }
    if (empty($_POST['confirmPassword'])){
        $arrayOfErrors['confirmPassword'] = 'Confirmation de mot de passe obligatoire';
    }
    if (!preg_match($passwordPattern, $_POST['password'])) {
      $arrayOfErrors['password'] = 'Mot de passe invalide';
    }
    if ($_POST['password'] != $_POST['confirmPassword']) {
      $arrayOfErrors['password'] = 'Mots de passe différents';
    }
  }

  if (!preg_match($emailPattern, $_POST['email']) && !empty($_POST['email'])) {
      $arrayOfErrors['email'] = 'Email invalide';
      $_POST['email'] = '';
  }

  // Vérification de la date de naissance de l'utilisateur
  $birthDateUser = new DateTime($_POST['birthDate']);
  $today = new DateTime();
  // $interval = différence entre aujourd'hui et la date de naissance du futur inscrit
  $interval = $birthDateUser->diff($today);
  // $result = affichage sous forme d'année au format integer
  $result = (int) $interval->format('%y');

  // Test si le futur utilisateur à l'âge minimum requis (13 ans)
  if($result < 13 && !empty($_POST['birthDate'])) {
    $arrayOfErrors['birthDate'] = 'Vous n\'avez pas l\'âge requis pour vous inscrire (13 ans)';
    $_POST['birthDate'] = '';
  }
  if (!preg_match($datePattern, $_POST['birthDate']) && !empty($_POST['birthDate'])) {
    $arrayOfErrors['birthDate'] = 'Date de naissance invalide';
    $_POST['birthDate'] = '';
  }
  if (!preg_match($phonePattern, $_POST['phone']) && !empty($_POST['phone'])) {
      $arrayOfErrors['phone'] = 'Numéro de téléphone invalide';
      $_POST['phone'] = '';
  }
  if (!preg_match($numberStreetPattern, $_POST['streetNumber']) && !empty($_POST['streetNumber'])) {
      $arrayOfErrors['streetNumber'] = 'Numéro invalide';
      $_POST['streetNumber'] = '';
  }
  if (!preg_match($stringPattern, $_POST['streetName']) && !empty($_POST['streetName'])) {
      $arrayOfErrors['streetName'] = 'Nom rue invalide';
      $_POST['streetName'] = '';
  }
  if (!preg_match($stringPattern, $_POST['additionalAddress']) && !empty($_POST['additionalAddress'])) {
      $arrayOfErrors['additionalAddress'] = 'Complément d\'adresse invalide';
      $_POST['additionalAddress'] = '';
  }
  if (!preg_match($zipCodePattern, $_POST['zipCode']) && !empty($_POST['zipCode'])) {
      $arrayOfErrors['zipCode'] = 'Code postal invalide';
      $_POST['zipCode'] = '';
  }
  if (!preg_match($stringPattern, $_POST['city']) && !empty($_POST['city'])) {
      $arrayOfErrors['city'] = 'Ville invalide';
      $_POST['city'] = '';
  }
  // Si on ne mets pas à jour l'utilisateur
  if (!isset($_POST['update'])) {
    // On test si le pseudo est déjà utilisé ou non
    $listUsers = $this->_registerManager->getUsers();
    // var_dump($listUsers);
    // die();
    foreach ($listUsers as $user) {
      if ($user->userName_U  == $_POST['pseudo']) {
        // $arrayOfErrors['pseudo'] = 'Pseudo déjà utilisé';
        // $_POST['pseudo'] = '';
      }
    }
  }
