<?php
  // Regex des différents input
  $stringPattern = '/^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿA-Z0-9\.\#<>?!,;:\-&\(\) \/\'\s]+$/';
  $categoryPattern = '/^(1|2|3|4|5|6|7|8)$/';
  $hourPattern = '/^(?:[01]\d|2[0123]):(?:[012345]\d):(?:[012345]\d)$/';
  $datePattern = '/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/';
  // Liste des balises autorisées dans les textarea
  $whiteListTag = '<p><div><ul><li><ol><h1><h2><h3><h4><br><blockquote><sub><sup><a><code><strong><u><i><b>';
  // Tableau contenant les erreurs des différents input
  $arrayOfErrors = [];
  // Extensions autorisees pour l'image
  $validExtention = ['jpg','png','jpeg'];
  // Taille max en octets du fichier
  define('MAX_SIZE', 2*1024*1024);

  // CHECK UPLOAD :php
  $targetFile = basename($_FILES["image"]["name"]);
  // $imageFileType = extention du fichier envoyé (jpg, png, ...)
  $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
  // Si le document est plus gros que la taille max
  if ($_FILES["image"]["size"] > MAX_SIZE || $_FILES["image"]["error"] == 1) {
    $arrayOfErrors['image'] = 'Image trop volumineuse';
  }
  // Si le type du document n'appartient pas au tableau comportant les extentions autorisées
  if (!in_array($imageFileType, $validExtention)) {
    $arrayOfErrors['image'] = 'Type de document incorrect';
  }
  if(empty($_FILES['image']['name'])) {
    $arrayOfErrors['image'] = 'Image obligatoire';
  }
  // Check des champs obligatoires
  if (empty($_POST['category'])){
    $arrayOfErrors['category'] = 'Categorie obligatoire';
  }
  if (empty($_POST['title'])){
      $arrayOfErrors['title'] = 'Titre obligatoire';
  }
  if (empty($_POST['shortContent'])){
      $arrayOfErrors['shortContent'] = 'Description courte obligatoire';
  }
  // CHECK INPUT TEXT :
  if (!preg_match($stringPattern, $_POST['title']) && !empty($_POST['title'])) {
    $arrayOfErrors['title'] = 'Titre invalide';
    $_POST['title'] = '';
  }
  if (strlen($_POST['title']) > 25 ) {
    $arrayOfErrors['title'] = 'Titre trop long (20 caractères max)';
    $_POST['title'] = '';
  }
  if (!preg_match($stringPattern, $_POST['title']) && !empty($_POST['title'])) {
    $arrayOfErrors['category'] = 'Catégorie invalide';
    $_POST['category'] = '';
  }

  // Vérification de la date de l'événement
  $hourComplete = $_POST['hourEvent'].':00';
  $dateEvent = new DateTime($_POST['dateEvent']);
  $today = new DateTime();
  // $interval = différence entre aujourd'hui et la date de l'événement futur
  // $interval = $dateEvent->diff($today);
  $interval = $today->diff($dateEvent);
  // $result = affichage sous forme de jour au format integer
  // %r = signe "-" lorsque négatif, vide si positif
  $result = (int) $interval->format('%r%a');
  if ($result < 0) {
    $arrayOfErrors['dateEvent'] = 'La date doit être supérieur à la date d\'aujourd\'hui !';
    $_POST['hour'] = '';
    $_POST['minute'] = '';
  }
  if (!preg_match($hourPattern, $hourComplete)) {
    $arrayOfErrors['hourEvent'] = 'Heure invalide';
    $_POST['hourEvent'] = '';
  }
  if (!preg_match($datePattern, $_POST['dateEvent'])) {
    $arrayOfErrors['dateEvent'] = 'Date invalide';
    $_POST['dateEvent'] = '';
  }
  // On "nettoie" les textarea des balises non voulues
  $_POST['shortContent'] = strip_tags($_POST['shortContent'], $whiteListTag);
  if (isset($_POST['longContent'])) {
    $_POST['longContent'] = strip_tags($_POST['longContent'], $whiteListTag);
  }
