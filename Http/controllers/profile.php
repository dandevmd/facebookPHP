<?php

use Core\Messaging\Conversation;
use Core\Middleware\UserMatch;
use Core\Post;
use Core\Session;
use Core\User;

$email = $isUserFound['email'];
$postInstance = new Post();
$friendsPosts = $postInstance->getFriendsPosts($email)->fetchAll();
$authUserFriendsString = UserMatch::check($_SESSION['user'])['friends_array'];



view('profile.view.php', [
  'user' => $isUserFound,
  'errors' => Session::get('errors') ?? [],
  'user_posts' => $postInstance->getUsersPostCount($email)->find()['number_of_posts'],
  'friendsPosts' => $friendsPosts,
  'isFriend' => isEmailInString($authUserFriendsString, $email),
  'mutualFriendsCount' => (new User())->mutualFriendsCount($email),
  'conversation' => (new Conversation())->exist($isUserFound['email']),

]);