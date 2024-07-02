<?php

declare(strict_types=1);

return [
  'GET|/' => \Alura\MVC\Controller\VideoListController::class,
  'GET|/novo-video' => \Alura\MVC\Controller\VideoFormController::class,
  'POST|/novo-video' => \Alura\MVC\Controller\NewVideoController::class,
  'GET|/editar-video' => \Alura\MVC\Controller\VideoFormController::class,
  'POST|/editar-video' => \Alura\MVC\Controller\EditVideoController::class,
  'GET|/deleta-video' => \Alura\MVC\Controller\DeleteVideoController::class,
  'GET|/login' => \Alura\MVC\Controller\LoginFormController::class,
  'POST|/login' => \Alura\MVC\Controller\LoginController::class,
  'GET|/logout' => \Alura\MVC\Controller\LogoutController::class,
  'GET|/remove-thumb' => \Alura\MVC\Controller\RemoveThumbnailController::class,
  'GET|/videos-json' => \Alura\MVC\Controller\JsonVideoListController::class,
  'POST|/videos' => \Alura\MVC\Controller\NewJsonVideoController::class,
];
