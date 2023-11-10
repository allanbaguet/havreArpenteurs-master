<?php
  $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/';
  $arrayOfErrors = [];

  if (!preg_match($passwordPattern, $_POST['password'])) {
    $arrayOfErrors['password'] = 'Mot de passe invalide';
  }
  if ($_POST['password'] != $_POST['confirmPassword']) {
    $arrayOfErrors['password'] = 'Mots de passe différents';
  }
