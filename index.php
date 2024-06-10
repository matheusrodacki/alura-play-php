<?php

declare(strict_types=1);

if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
  require_once 'listar-videos.php';
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once 'formulario.php';
  } else {
    require_once 'novo-video.php';
  }
} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once 'formulario.php';
  } else {
    require_once 'editar-video.php';
  }
} elseif ($_SERVER['PATH_INFO'] === '/deleta-video') {
  require_once 'deleta-video.php';
} else {
  http_response_code(404);
}
