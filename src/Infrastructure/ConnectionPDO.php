<?php

declare(strict_types=1);

namespace Alura\MVC\Infrastructure;

use PDO;

class ConnectionPDO
{
  private PDO $pdo;

  public function __construct()
  {
  }

  public function getPdo(): PDO
  {
    $dbPath = __DIR__ . '/../../banco.sqlite';
    $this->pdo = new PDO("sqlite:$dbPath");
    return $this->pdo;
  }
}
