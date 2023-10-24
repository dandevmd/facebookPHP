<?php

namespace Core\Messaging;

use Core\App;

class Messages
{
  private int $conversation;
  private string $sender;
  private string $message;
  private $db;


  // Constructor
  public function __construct()
  {
    $this->sender = $_SESSION['user'];
    $this->db = App::$container->resolve('Core\Database');

  }

  function sendMessage($conversation, $message)
  {

    $sql = 'INSERT INTO messages (conversation_id, sender_email, body) VALUES (:conversation_id, :sender_email, :body)';
    $params = [
      'conversation_id' => $conversation,
      'sender_email' => $this->sender,
      'body' => $message,

    ];

    return $this->db->query($sql, $params);
  }


  function getMessages($conversation)
  {
    $sql = 'SELECT * FROM messages WHERE conversation_id = :conversation_id ORDER BY sent_at ASC';

    $params = ['conversation_id' => $conversation];

    $res = $this->db->query($sql, $params)->fetchAll();

    if (empty($res))
      return;

    $this->updateUnread($conversation);

    return $res;
  }

  function getUnreadMessages()
  {
    $sql = 'SELECT conversation_id, CONCAT("[", GROUP_CONCAT(JSON_OBJECT("id", id, "readed", readed)), "]") AS messages
    FROM messages
    WHERE readed = :readed
    GROUP BY conversation_id
    ORDER BY conversation_id;
    ';
    $params = [
      'readed' => 0
    ];

    $res = $this->db->query($sql, $params)->fetchAll();
    if (!empty($res)) {
      $unread = [];
      foreach ($res as $m) {
        $convertedMessages = [];
        foreach (json_decode($m['messages']) as $message) {
          $convertedMessage = [
            'id' => $message->id,
            'readed' => $message->readed,
          ];
          $convertedMessages[] = $convertedMessage;
        }
        ;
        $unread[$m['conversation_id']] = $convertedMessages;

      }
      return $unread;
    }
  }

  function updateUnread($conversation)
  {
    $sql = 'UPDATE messages SET readed = :readed WHERE conversation_id = :conversation_id';

    $params = ['conversation_id' => $conversation, 'readed' => 1];

    return $this->db->query($sql, $params);
  }

}