<?php

namespace Core;

class Post
{
  private $attributes;
  private $db;

  public function __construct(array $attributes = null)
  {
    $this->attributes = $attributes;
    $this->db = App::$container->resolve('Core\Database');
  }

  public function getPosts()
  {
    return $this->db->query('SELECT * FROM posts');
  }

  public function getUsersPostCount($user)
  {
    return $this->db->
      query(
        'SELECT COUNT(*) AS number_of_posts FROM posts WHERE added_by = :email;',
        [
          'email' => $user
        ]
      );
  }


  // THIS QUERY IS GETTING THE friends POSTS AND WITH THE EACH POST COMMENTS 
  public function getFriendsPosts($email)
  {
    $getFriendsPosts = 'SELECT p.*, 
    (SELECT CONCAT("[", GROUP_CONCAT(CONCAT("{\"post_comment_id\":", pc.id, ",\"post_body\":\"", pc.post_body, "\",\"posted_by\":\"", pc.posted_by, "\",\"post_id\":", pc.post_id, "}")), "]")
    FROM post_comments pc
    WHERE pc.post_id = p.id) AS comments
    FROM posts p
    WHERE p.added_by IN (
      SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(friends_array, ",", numbers.n), ",", -1) AS friend_email
      FROM (
          SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 -- Add more numbers if needed
      ) numbers INNER JOIN users ON CHAR_LENGTH(friends_array) - CHAR_LENGTH(REPLACE(friends_array, ",", "")) >= numbers.n - 1
      WHERE email = :email AND user_closed = :user_closed
    )';

    return $this->db->query(
      $getFriendsPosts,
      [
        'email' => $email,
        'user_closed' => "NO"
      ]
    );
  }


  public function store()
  {
    $this->db
      ->query(
        'INSERT INTO posts (body, date_added, added_by, user_to) VALUES (:body, :date_added, :added_by, :user_to)',
        [
          'body' => $this->attributes['body'],
          'date_added' => $this->attributes['date_added'],
          'added_by' => $this->attributes['added_by'],
          'user_to' => $this->attributes['user_to'],
        ]
      );

    return 'New post stored';
  }

  public function delete($postId)
  {
    $this->db->query('DELETE FROM posts WHERE id = :postId AND added_by =:creator;
                      DELETE FROM post_comments WHERE post_id = :postId', [
      'postId' => $postId,
      'creator' => $_SESSION['user']
    ]);

    return 'Post with id ' . $postId . ' was deleted';
  }

  public function ifLiked($action)
  {
    $sql = 'SELECT COUNT(*) as total_likes FROM likes WHERE post_id = :post_id AND email = :email AND action = :action';
    $params = ['post_id' => $_POST['post_id'], 'email' => $_SESSION['user'], 'action' => $action];

    return $this->db->query($sql, $params)->fetchAll();
  }

  public function likeIncrement()
  {
    if ($this->ifLiked('increment')[0]['total_likes']) {
      return;
    }

    return $this->db->query(
      'UPDATE posts 
    SET likes = likes + 1 
    WHERE id = :post_id;
    
    INSERT INTO likes (email, post_id, action) 
    VALUES (:email, :post_id, :action )',
      [
        'post_id' => $_POST['post_id'],
        'email' => $_SESSION['user'],
        'action' => 'increment',
      ]
    );

  }
  public function likeDecrement()
  {
    if (!$this->ifLiked('increment')[0]['total_likes']) {
      return;
    }

    return $this->db->query(
      'UPDATE posts 
    SET likes = likes - 1 
    WHERE id = :post_id;
    
   DELETE FROM  likes WHERE post_id = :post_id AND email = :email AND action = :action',
      [
        'post_id' => $_POST['post_id'],
        'email' => $_SESSION['user'],
        'action' => 'increment',

      ]
    );
  }


}