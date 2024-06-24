<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
  header('Location: /?sucesso=0');
  exit();
}

$titulo =  filter_input(INPUT_POST, 'titulo');
if ($titulo === null || $titulo === false) {
  header('Location: /?sucesso=0');
  exit();
}

$repository = new \Alura\MVC\Repository\VideoRepository($pdo);
$result = $repository->add(new \Alura\MVC\Entity\Video($url, $titulo));

if ($result) {
  header('Location: /?sucesso=1');
} else {
  header('Location: /?sucesso=0');
}
