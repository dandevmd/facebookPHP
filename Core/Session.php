<?php

namespace Core;

class Session
{
  public static function get($key)
  {
    return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? null;
  }
  public static function store($key, $value)
  {
    return $_SESSION[$key] = $value;
  }

  public static function storeFlash($key, $value)
  {
    return $_SESSION['_flash'][$key] = $value;

  }

  public static function getOldFlash($key, $default = '')
  {
    return $_SESSION['_flash']['old'][$key] ?? $default;
  }
  public static function clearFlash()
  {
    unset($_SESSION['_flash']);
  }

  public static function destroy()
  {
    //clear the session file
    $_SESSION = [];

    // Destroy the session
    session_destroy();

    //delete the cookie by setting it in the past
    $params = session_get_cookie_params(); //get all the cookie info 
    setcookie('PHPSESSID', '', -3600, $params['path'], $params['domain']);
  }

}