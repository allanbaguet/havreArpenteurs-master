<?php
  $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/';
  $arrayOfErrors = [];

  // Test si le mot de passe correspond en cas de modif de MdP
  $user = $this->getWithId('Users', 'User', $_SESSION['id_U']);
  if (!password_verify($_POST['oldPassword'], $user->password())) {
    $arrayOfErrors['oldPassword'] = 'Ancien mot de passe invalide';
    $_POST['oldPassword'] = '';
  }
  if (!preg_match($passwordPattern, $_POST['password'])) {
    $arrayOfErrors['password'] = 'Mot de passe invalide';
  }
  if ($_POST['password'] != $_POST['confirmPassword']) {
    $arrayOfErrors['password'] = 'Mots de passe différents';
  }
