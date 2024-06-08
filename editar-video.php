<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
  header('Location: /index.php?sucesso=0');
  exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

if (!$url) {
  header('Location: /index.php?sucesso=0');
  exit();
}

$titulo = filter_input(INPUT_POST, 'titulo');

if (!$titulo) {
  header('Location: /index.php?sucesso=0');
  exit();
}

$sql = 'UPDATE videos SET url = :url, titulo = :titulo WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':url', $url);
$stmt->bindValue(':titulo', $titulo);

if ($stmt->execute()) {
  header('Location: /index.php?sucesso=1');
} else {
  header('Location: /index.php?sucesso=0');
}
