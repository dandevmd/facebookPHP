<?php
use Core\Post;

$postInstance = new Post();
$_POST['action'] === 'increment' ? $postInstance->likeIncrement() : $postInstance->likeDecrement();
redirect($_SERVER['HTTP_REFERER']);