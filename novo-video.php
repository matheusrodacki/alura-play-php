<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
  header('Location: /index.php?sucesso=0');
  exit();
}

$titulo =  $_POST['titulo'];


$sql =  'INSERT INTO videos (titulo, url) VALUES (?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $titulo);
$stmt->bindValue(2, $url);

if ($stmt->execute()) {
  header('Location: /index.php?sucesso=1');
} else {
  header('Location: /index.php?sucesso=0');
}
