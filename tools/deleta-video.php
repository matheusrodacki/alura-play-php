<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = $_GET['id'];
$repository = new \Alura\MVC\Repository\VideoRepository($pdo);
$result = $repository->remove($id);

if ($result) {
  header('Location: /?sucesso=1');
} else {
  header('Location: /?sucesso=0');
}
