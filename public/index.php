<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
date_default_timezone_set('Europe/Bucharest');



const BASE_PATH = __DIR__ . '/../';

spl_autoload_register(function ($class) {
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

  require base_path("{$class}.php");
});

require BASE_PATH . 'Core/functions.php';
require base_path('bootstrap.php');

use Core\Router;
use Core\ValidationException;
use Core\Session;
use Core\OutputBuffer;

//is not used. should be deleted
OutputBuffer::start();


$router = new Router();
$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];



try {
  $router->route($uri, $method);
} catch (ValidationException $e) {
  $router->previousURL();
}

Session::clearFlash();