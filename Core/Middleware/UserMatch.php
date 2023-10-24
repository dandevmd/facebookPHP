<?php


namespace Core\Middleware;

use Core\App;

class UserMatch
{
  static function check($email)
  {
    $user = App::$container->resolve('Core\Database')->query(
      'SELECT * FROM users WHERE email = :email',
      [
        'email' => $email
      ]
    )->find();

    return $user;
  }
}