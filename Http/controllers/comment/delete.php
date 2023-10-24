<?php
use Core\Comment;

validate_csrf_token($_POST['csrf_token']);
(new Comment())->delete($_POST['comment_id']);
redirect($_SERVER['HTTP_REFERER']);