<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\RegistrationForm;

$attributes = [
  'reg_fname' => $_POST['reg_fname'],
  'reg_lname' => $_POST['reg_lname'],
  'reg_email' => $_POST['reg_email'],
  'reg_confirm_email' => $_POST['reg_confirm_email'],
  'reg_password' => $_POST['reg_password'],
  'reg_confirm_password' => $_POST['reg_confirm_password'],
];

$form = new RegistrationForm($attributes);
$auth = new Authenticator();
$form->validate($attributes);
$registered = $auth->registerAttempt($attributes);

if ($registered === 'User already exist.') {
  $form->passError('reg_email', 'User already exist.');
}

Session::storeFlash('errors', $form->errors());
Session::storeFlash('old', $attributes);

if (!empty($form->errors())) {
  redirect('/register');
}


if ($registered === 'User registered with success.') {
  $auth->loginAttempt([
    'log_email' => $attributes['reg_email'],
    'log_password' => $attributes['reg_password'],
  ]);
  redirect('/home');
}