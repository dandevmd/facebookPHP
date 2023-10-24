<?php
use Core\Messaging\Conversation;

validate_csrf_token($_POST['csrf_token']);
(new Conversation())->deleteConversation($_POST['conversation_id']);
redirect($_SERVER['HTTP_REFERER']);