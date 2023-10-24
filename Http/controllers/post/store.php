<?php
use Core\Post;
use Core\Session;
use Core\Validator;

$errors = [];

$body = !empty($_POST['post_text'])
  ? Validator::sanitizeText($_POST['post_text'])
  : $errors['textarea'] = 'The body could not be empty!';

if (!empty($errors)) {
  Session::storeFlash('errors', $errors);
  redirect($_SERVER['HTTP_REFERER']);
}

$attributes = [
  'body' => $body,
  'date_added' => date('Y-m-d H:i:s'),
  'added_by' => $_SESSION['user'],
  'user_to' => 'none'
];

(new Post($attributes))->store();
redirect($_SERVER['HTTP_REFERER']);