<?php

namespace Core;



class User
{
  public $db;

  public function __construct()
  {
    $this->db = App::$container->resolve('Core\Database');
  }


  function getUserById($userId)
  {

    return $this->db->query('SELECT * FROM users WHERE id = :userId', ['userId' => $userId])->fetch;
  }
  public function follow($email)
  {
    $query = 'UPDATE users
              SET friends_array = CONCAT(
                IFNULL(friends_array, ""),
                IFNULL(CASE
                  WHEN friends_array IS NULL THEN :email
                  WHEN friends_array = "" THEN :email
                  ELSE CONCAT(",", :email)
                END, "")
              )
              WHERE email = :currentUserEmail';

    $params = [
      'email' => $email,
      'currentUserEmail' => $_SESSION['user']
    ];

    return $this->db->query($query, $params);
  }

  public function unfollow($email)
  {
    $query = 'UPDATE users
              SET friends_array = TRIM(BOTH "," FROM REPLACE(CONCAT(",", friends_array, ","), CONCAT(",", :email, ","), ","))
              WHERE email = :currentUserEmail';

    $params = [
      'email' => $email,
      'currentUserEmail' => $_SESSION['user']
    ];

    return $this->db->query($query, $params);
  }

  public function updateProfilePic($filePath)
  {
    $query = 'UPDATE users SET profile_pic = :filePath WHERE email = :email';

    $params = [
      'email' => $_SESSION['user'],
      'filePath' => $filePath
    ];

    return $this->db->query($query, $params);
  }

  public function mutualFriendsCount($strangerEmail)
  {

    $query = 'SELECT friends_array
    FROM users
    WHERE email = :currentUserEmail OR email = :strangerEmail';

    $params = [
      'currentUserEmail' => $_SESSION['user'],
      'strangerEmail' => $strangerEmail
    ];


    $result = $this->db->query($query, $params)->fetchAll();

    if (empty($result)) {
      return 'No matches found.';
    }

    $countMatchingFriends = count(array_intersect(explode(',', $result[0]['friends_array']), explode(',', $result[1]['friends_array'])));

    return $countMatchingFriends;
  }


  public function getUserPic(string $email)
  {
    $sql = 'SELECT profile_pic FROM users WHERE email = :email';
    $params = ['email' => $email];

    return $this->db->query($sql, $params)->fetchAll();
  }
}