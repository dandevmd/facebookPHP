<?php
use Core\Authenticator;
use Core\Middleware\UserMatch;



$authUserFollowed = UserMatch::check($_SESSION['user'])['friends_array'] ?? 'You have no friends :(';



view('followedDashboard.view.php', [
  'followed' => generate_followed_divs($authUserFollowed)
]);