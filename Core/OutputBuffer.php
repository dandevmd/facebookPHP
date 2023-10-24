<?php

namespace Core;

class OutputBuffer
{

  private static $buffer;

  public static function start()
  {
    ob_start();
  }

  public static function content()
  {
    self::$buffer = ob_get_contents();
  }

  public static function manipulate()
  {

  }

  public static function endClean()
  {
    ob_end_clean();
  }
  public static function endFlush()
  {
    ob_end_clean();
  }
}