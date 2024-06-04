<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$pdo->exec('CREATE TABLE videos (
    id INTEGER PRIMARY KEY,
    titulo TEXT,
    url TEXT
)');
