<?php
use Core\Authenticator;
use Core\Validator;


validate_csrf_token($_POST['csrf_token']);

if (Validator::sanitizeText($_POST['fName']) && Validator::sanitizeText($_POST['lName']) && strlen($_POST['password']) >= 4) {
  $attr = [
    'id' => $_POST['user_id'],
    'first_name' => $_POST['fName'],
    'last_name' => $_POST['lName'],
    'password' => $_POST['password'],
  ];

  (new Authenticator)->updateUser($attr);
}