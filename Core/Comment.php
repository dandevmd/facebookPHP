<?php

namespace Core;

class Comment
{
  private $attributes;
  private $db;

  public function __construct(array $attributes = null)
  {
    $this->attributes = $attributes;
    $this->db = App::$container->resolve('Core\Database');
  }

  public function store()
  {
    return $this->db->query('INSERT INTO post_comments (post_body, posted_by, post_id)
    VALUES (
      :post_body,
      :posted_by,
      :post_id
    )', [
      'post_body' => $this->attributes['post_body'],
      'posted_by' => $this->attributes['posted_by'],
      'post_id' => $this->attributes['post_id']
    ]);
    ;
  }

  public function delete($comment_id)
  {
    $this->db->query(
      'DELETE FROM post_comments WHERE id = :comment_id',
      [
        'comment_id' => $comment_id,
      ]
    );

    return 'Post with id ' . $comment_id . ' was deleted';
  }
}