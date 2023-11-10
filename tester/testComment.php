<?php
  // Regex des différents input
  $stringPattern = '/^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿA-Z0-9\.\#<>?!,;:\-&\(\) \'\s]+$/';
  // Liste des balises autorisées dans les textarea
  $whiteListTag = '<p><div><ul><li><ol><h1><h2><h3><h4><br><blockquote><sub><sup><a><code><strong><u><i><b>';
  // Tableau contenant les erreurs des différents input
  $arrayOfErrors = [];

  // CHECK INPUT TEXT :
  if (!preg_match($stringPattern, $_POST['title']) && !empty($_POST['title'])) {
    $arrayOfErrors['title'] = 'Titre invalide';
    $_POST['title'] = '';
  }
  // if (!preg_match($stringPattern, $_POST['content']) && !empty($_POST['content'])) {
  //     $arrayOfErrors['content'] = 'Contenu incorrect';
  // }
  // Check des champs obligatoires
  if (empty($_POST['content'])){
      $arrayOfErrors['content'] = 'Contenu obligatoire';
  }
  // On "nettoie" les textarea des balises non voulues
  $_POST['content'] = strip_tags($_POST['content'], $whiteListTag);
