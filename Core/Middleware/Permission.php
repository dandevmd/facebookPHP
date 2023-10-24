<?php


namespace Core\Middleware;

class Permission
{
  public const MAP = [
    'guest' => Guest::class,
    'auth' => Auth::class
  ];
  public static function resolve($key)
  {
    if (!$key) {
      return;
    }

    $checker = static::MAP[$key] ?? false;

    (new $checker)->handle();

  }
}