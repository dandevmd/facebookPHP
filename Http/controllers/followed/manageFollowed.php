<?php
use Core\User;


$email = $_POST['user_email'] ?? throw new Exception('No friend email provided');
$action = $_POST['action'] ?? throw new Exception('No action provided');
$userInstance = new User();

validate_csrf_token($_POST['csrf_token']);


if ($action === 'follow') {
  $userInstance->follow($email);
} elseif ($action === 'unfollow') {
  $userInstance->unfollow($email);
} else {
  throw new Exception('Invalid action provided');
}

redirect($_SERVER['HTTP_REFERER']);