<?php
  // Regex des différents input
  $stringPattern = '/^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿA-Z0-9\.\#<>?!,;:\-&\(\) \/\'\s]+$/';
  // Tableau contenant les erreurs des différents input
  $arrayOfErrors = [];
  // Liste des balises autorisées dans les textarea
  $whiteListTag = '<p><div><ul><li><ol><h1><h2><h3><h4><br><blockquote><sub><sup><a><code><strong><u><i><b>';
  // Extensions autorisees pour l'image
  $validExtention = ['jpg','png','jpeg'];
  // Taille max en octets du fichier
  define('MAX_SIZE', 2*1024*1024);

  // Si on upload une nouvelle image
  if (!empty($_FILES['image']["name"])) {
    // CHECK UPLOAD :
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
  }
  // CHECK INPUT TEXT :
  if (!preg_match($stringPattern, $_POST['title']) && !empty($_POST['title'])) {
    $arrayOfErrors['title'] = 'Titre invalide';
    $_POST['title'] = '';
  }
  if (strlen($_POST['title']) > 20 ) {
    $arrayOfErrors['title'] = 'Titre trop long (20 caractères max)';
    $_POST['title'] = '';
  }
  // Check des champs obligatoires
  if (empty($_POST['title'])){
      $arrayOfErrors['title'] = 'Titre obligatoire';
  }
  if (empty($_POST['shortContent'])){
      $arrayOfErrors['shortContent'] = 'Description courte obligatoire';
  }
  // On "nettoie" les textarea des balises non voulues
  $_POST['shortContent'] = strip_tags($_POST['shortContent'], $whiteListTag);
  if (isset($_POST['longContent'])) {
    $_POST['longContent'] = strip_tags($_POST['longContent'], $whiteListTag);
  }
