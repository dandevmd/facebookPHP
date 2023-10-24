<?php
use Core\Post;


(new Post())->delete($_POST['post_id']);
redirect($_SERVER['HTTP_REFERER']);