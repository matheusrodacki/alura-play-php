<?php

declare(strict_types=1);

namespace Alura\MVC\Entity;

class User
{

  public readonly int $id;

  public function __construct(public readonly string $email, public readonly string $password)
  {
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }
  public function getId(): int
  {
    return $this->id;
  }
}
