<?php
  $rolePattern = '/^(1|2|3|4)$/';
  $arrayOfErrors = [];

  if (!preg_match($rolePattern, $_POST['role'])) {
    $arrayOfErrors['role'] = 'Role invalide';
  }
