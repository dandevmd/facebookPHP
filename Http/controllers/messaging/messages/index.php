<?php
use Core\Messaging\Conversation;
use Core\Messaging\Messages;

$id = explode('/', $uri)[3];
$conversation = (new Conversation())->findById($id);
if (!$conversation) {
  return;

}


return view('messages.view.php', [
  'messages' => ((new Messages())->getMessages($id)),
  'convName' => $conversation['user1_email'] === $_SESSION['user'] ? $conversation['user2_email'] : $conversation['user1_email'],
  'conversation' => $conversation
]);