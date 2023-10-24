<?php

use Core\Authenticator;
use Core\Middleware\UserMatch;
use Core\Post;
use Core\Session;

$email = $_SESSION['user'];
$postInstance = new Post();

view('home.view.php', [
  'user' => UserMatch::check($email),
  'errors' => Session::get('errors') ?? [],
  'user_posts' => $postInstance->getUsersPostCount($email)->find()['number_of_posts'],
  'friendsPosts' => $postInstance->getFriendsPosts($email)->fetchAll()

]);