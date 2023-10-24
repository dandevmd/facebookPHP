<?php

use Core\Messaging\Conversation;


validate_csrf_token($_POST['csrf_token']);
$cInstance = new Conversation();

if (!$cInstance->exist($_POST['user_email'])) {
  $cInstance->createConversation($_POST['user_email']);

}

redirect('/chat');