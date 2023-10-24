<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;


$attributes = [
  'log_email' => $_POST['log_email'],
  'log_password' => $_POST['log_password'],
];

$form = new LoginForm($attributes);
$auth = new Authenticator();
$form->validate($attributes);
$logged = $auth->loginAttempt($attributes);


if ($logged === "User does not exist.") {
  $form->passError('reg_password', "User does not exist.");
}
if ($logged === 'You introduced wrong password.') {
  $form->passError('reg_password', 'You introduced wrong password.');
}

Session::storeFlash('errors', $form->errors());
Session::storeFlash('old', $attributes);


if (!empty($form->errors())) {
  redirect('/login');
}
redirect('/home');