<?php

declare(strict_types=1);

use \Alura\MVC\Repository\VideoRepository;
use \Alura\MVC\Controller\{Controller, VideoListController, VideoFormController};


require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
  $controller = new VideoListController($videoRepository);
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new VideoFormController($videoRepository);
  } else {
    require_once __DIR__ .  '/../novo-video.php';
  }
} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new VideoFormController($videoRepository);
  } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ .  '/../editar-video.php';
  }
} elseif ($_SERVER['PATH_INFO'] === '/deleta-video') {
  require_once __DIR__ .  '/../deleta-video.php';
} else {
  http_response_code(404);
}
/** @var Controller $controller */
$controller->processaRequisicao();
