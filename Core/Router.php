<?php

namespace Core;

use Core\Middleware\Permission;
use Core\Middleware\UserMatch;

class Router
{
  protected $routes = [];

  protected function abort($code = 404)
  {
    http_response_code($code);

    echo 'This route does not exist';
    // require base_path("views/{$code}.php");

    die();
  }

  public function add($method, $uri, $controller, $middleware = null)
  {
    $this->routes[] = compact('method', 'uri', 'controller', 'middleware');
    return $this;
  }

  public function only($key)
  {
    $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    return $this;
  }

  public function get($uri, $controller)
  {
    return $this->add('GET', $uri, $controller);
  }
  public function post($uri, $controller)
  {
    return $this->add('POST', $uri, $controller);
  }
  public function delete($uri, $controller)
  {
    return $this->add('DELETE', $uri, $controller);
  }
  public function update($uri, $controller)
  {
    return $this->add('UPDATE', $uri, $controller);
  }



  // public function route($uri, $method)
  // {
  //   foreach ($this->routes as $route) {
  //     // Generate a regular expression pattern based on the route URI ex: /user/{email}
  //     $routePattern = '#^' . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9@.]+)', $route['uri']) . '$#';

  //     // Check if the URI matches the route pattern and the request method matches
  //     if (preg_match($routePattern, $uri, $matches) && $route['method'] === strtoupper($method)) {
  //       // Check if auth or not
  //       Permission::resolve($route['middleware']);


  //       $isUserFound = null;
  //       if (isset($matches[1]) && UserMatch::check($matches[1]) && UserMatch::check($matches[1])['email'] === $_SESSION['user']) {
  //         $isUserFound = UserMatch::check($matches[1]);
  //         redirect('/home');
  //       }

  //       if (isset($matches[1]) && UserMatch::check($matches[1])) {
  //         $isUserFound = UserMatch::check($matches[1]);
  //         return require base_path('Http/controllers/' . $route['controller']);
  //       }
  //       if (isset($matches[1]) && !UserMatch::check($matches[1])) {
  //         $this->abort();
  //       }
  //       return require base_path('Http/controllers/' . $route['controller']);
  //     }
  //   }

  //   $this->abort();
  // }


  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      // Generate a regular expression pattern based on the route URI ex: /user/{email}
      $routePattern = '#^' . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9@.]+)', $route['uri']) . '$#';

      // Check if the URI matches the route pattern and the request method matches
      if (preg_match($routePattern, $uri, $matches) && $route['method'] === strtoupper($method)) {
        // Check if auth or not
        Permission::resolve($route['middleware']);


        $isUserFound = null;
        if (isset($matches[1]) && UserMatch::check($matches[1]) && UserMatch::check($matches[1])['email'] === $_SESSION['user']) {
          $isUserFound = UserMatch::check($matches[1]);
          redirect('/home');
        }

        if (isset($matches[1]) && UserMatch::check($matches[1])) {
          $isUserFound = UserMatch::check($matches[1]);
          return require base_path('Http/controllers/' . $route['controller']);
        }


        if (isset($matches[1])) {
          return require base_path('Http/controllers/' . $route['controller']);
        }

        if (isset($matches[1]) && !UserMatch::check($matches[1])) {
          $this->abort();
        }
        return require base_path('Http/controllers/' . $route['controller']);
      }
    }

    $this->abort();
  }




  public function previousURL()
  {
    return $_SERVER['HTTP_REFERER'];
  }
}