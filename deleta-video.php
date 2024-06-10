<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = $_GET['id'];
$sql = 'DELETE FROM videos WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $id);

if ($stmt->execute()) {
  header('Location: /?sucesso=1');
} else {
  header('Location: /?sucesso=0');
}
