<?php

declare(strict_types=1);

use \Alura\MVC\Repository\VideoRepository;
use \Alura\MVC\Controller\{
  Controller,
  DeleteVideoController,
  EditVideoController,
  Error404Controller,
  NewVideoController,
  VideoListController,
  VideoFormController
};


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
    $controller = new NewVideoController($videoRepository);
  }
} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new VideoFormController($videoRepository);
  } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EditVideoController($videoRepository);
  }
} elseif ($_SERVER['PATH_INFO'] === '/deleta-video') {
  $controller = new DeleteVideoController($videoRepository);
} else {
  $controller = new Error404Controller();
}
/** @var Controller $controller */
$controller->processaRequisicao();
