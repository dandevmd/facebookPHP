<?php

namespace Core;

class Validator
{
  public static function sanitizeText($text)
  {
    $text = strip_tags(trim($text));

    return !empty($text) ? $text : false;
  }
  public static function validateEmail($email)
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }
  public static function confirmEmail($em, $em2)
  {
    $em = static::validateEmail($em);
    $em2 = static::validateEmail($em2);

    if ($em != $em2) {
      return false;
    }
    return true;
  }
  public static function confirmPassword($pass1, $pass2)
  {

    return static::sanitizeText($pass1) == static::sanitizeText($pass2) ? true : false;
  }

}