<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
  header('Location: /?sucesso=0');
  exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

if (!$url) {
  header('Location: /?sucesso=0');
  exit();
}

$titulo = filter_input(INPUT_POST, 'titulo');

if (!$titulo) {
  header('Location: /?sucesso=0');
  exit();
}


$video = new \Alura\MVC\Entity\Video($url, $titulo);
$video->setId($id);

$repository = new \Alura\MVC\Repository\VideoRepository($pdo);
$result = $repository->update($video);


if ($result) {
  header('Location: /?sucesso=1');
} else {
  header('Location: /?sucesso=0');
}
