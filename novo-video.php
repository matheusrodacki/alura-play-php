<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$titulo = $_POST['titulo'];
$url = $_POST['url'];

$sql =  'INSERT INTO videos (titulo, url) VALUES (?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $titulo);
$stmt->bindValue(2, $url);




var_dump($stmt->execute());
