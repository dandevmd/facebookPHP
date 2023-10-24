<?php

namespace Core\Messaging;

use Core\App;


// Conversation class
class Conversation
{
  private string $user1;
  private string $user2;
  private $db;

  public function __construct()
  {
    $this->user1 = $_SESSION['user'];
    $this->db = App::$container->resolve('Core\Database');

  }

  public function findById($id)
  {
    $sql = ('SELECT * FROM conversations WHERE id = :id');
    $params = [
      'id' => $id
    ];

    return $this->db->query($sql, $params)->find();
  }

  public function exist($user2)
  {
    $sql = ('SELECT * FROM conversations WHERE user1_email = :user1 AND user2_email = :user2');
    $params = [
      'user1' => $this->user1,
      'user2' => $user2,
    ];

    return $this->db->query($sql, $params)->find();
  }

  public function getAuthConversations()
  {
    $sql = ('SELECT * FROM conversations WHERE user1_email = :user1 OR  user2_email = :user1 ');
    $params = [
      'user1' => $this->user1,
    ];

    return $this->db->query($sql, $params)->fetchAll();
  }

  public function createConversation($user2)
  {
    $sql = ('INSERT INTO conversations (user1_email, user2_email) VALUES (:user1, :user2)');
    $params = [
      'user1' => $this->user1,
      'user2' => $user2,
    ];

    return $this->db->query($sql, $params);
  }

  public function deleteConversation($id)
  {
    $sql = ('DELETE FROM conversations WHERE id = :id');
    $params = [
      'id' => $id,
    ];

    return $this->db->query($sql, $params);
  }

}