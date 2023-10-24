<?php
use Core\Comment;
use Core\Validator;


validate_csrf_token($_POST['csrf_token']);
$text = Validator::sanitizeText($_POST['post_comment']);
$attributes = [
  'post_id' => $_POST['post_id'],
  'post_body' => $_POST['post_comment'],
  'posted_by' => $_SESSION['user'],
];


(new Comment($attributes))->store();
redirect($_SERVER['HTTP_REFERER']);