<?php
use Core\Messaging\Messages;


if (!empty($_POST['conversation_id']) && !empty($_POST['user_email']) && !empty($_POST['body'])) {
  (new Messages())->sendMessage($_POST['conversation_id'], $_POST['body']);
}

redirect($_SERVER['HTTP_REFERER']);