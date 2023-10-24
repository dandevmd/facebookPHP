<?php

namespace Core;

use Core\App;
use Core\Middleware\UserMatch;

class Authenticator
{


  public function login($email)
  {
    Session::store('user', $email);
    session_regenerate_id(true);
  }

  public function logout()
  {
    validate_csrf_token($_POST['csrf_token']);
    Session::destroy();
    redirect('/login');
  }



  public function registerAttempt($attributes)
  {

    $user = UserMatch::check($attributes['reg_email']);
    if ($user) {
      return 'User already exist.';

    }

    App::$container
      ->resolve('Core\Database')
      ->query('
  INSERT INTO users (first_name, last_name, email, username, password) VALUES (:first_name, :last_name, :email, :username, :password
  )', [
        'email' => $attributes['reg_email'],
        'first_name' => $attributes['reg_fname'],
        'last_name' => $attributes['reg_lname'],
        'username' => $attributes['reg_fname'] . $attributes['reg_lname'],
        'password' => password_hash($attributes['reg_password'], PASSWORD_BCRYPT)
      ]);
    return 'User registered with success.';
  }

  public function loginAttempt($attributes)
  {
    $user = UserMatch::check($attributes['log_email']);
    if (!$user) {
      return 'User does not exist.';
    }
    if (password_verify($attributes['log_password'], $user['password'])) {
      $this->login($attributes['log_email']);
      if ($user['user_closed']) {
        App::$container
          ->resolve('Core\Database')
          ->query('UPDATE users SET user_closed = :user_closed WHERE email = :email', [
            'user_closed' => 'NO',
            'email' => $user['email']
          ]);
        return 'User account reopened.';
      }
      return 'User logged successfully.';
    }
    return 'You introduced wrong password.';
  }

  public function updateUser(array $attr)
  {
    $attr['password'] = password_hash($attr['password'], PASSWORD_BCRYPT);
    $query = 'UPDATE users SET first_name = :first_name, last_name = :last_name,  password = :password WHERE id = :id';

    $params = [
      'id' => $attr['id'],
      'first_name' => $attr['first_name'],
      'last_name' => $attr['last_name'],
      'password' => $attr['password']
    ];


    App::$container
      ->resolve('Core\Database')
      ->query($query, $params);


    $this->logout();

  }
}