<?php

declare(strict_types=1);

use \Alura\MVC\Repository\VideoRepository;
use \Alura\MVC\Controller\Error404Controller;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;


require_once __DIR__ . '/../vendor/autoload.php';

$routes = require_once __DIR__ . '/../config/routes.php';
/** @var ContainerInterface $diContainer */
$diContainer = require_once __DIR__ . '/../config/dependencies.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

session_start();
session_regenerate_id();
$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute) {
  header('Location: /login');
}

$key = "$httpMethod|$pathInfo";
if (array_key_exists($key, $routes)) {
  $controllerClass = $routes["$httpMethod|$pathInfo"];
  $controller = $diContainer->get($controllerClass);
} else {
  $controller = new Error404Controller();
}

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
  $psr17Factory, // ServerRequestFactory
  $psr17Factory, // UriFactory
  $psr17Factory, // UploadedFileFactory
  $psr17Factory  // StreamFactory
);

$serverRequest = $creator->fromGlobals();

/** @var RequestHandlerInterface $controller */
$response = $controller->handle($serverRequest);

http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
  foreach ($values as $value) {
    header(sprintf('%s: %s', $name, $value), false);
  }
}

echo $response->getBody();