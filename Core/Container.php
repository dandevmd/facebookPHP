<?php

namespace Core;

use Exception;

class Container
{

  protected $services = [];

  public function bind($name, $content)
  {
    $this->services[$name] = $content;
  }

  public function resolve($name)
  {
    if (!array_key_exists($name, $this->services)) {
      throw new Exception("Service '$name' not found in the container.");
    }

    if (array_key_exists($name, $this->services)) {
      $content = $this->services[$name];

      return call_user_func($content);
    }
  }

}