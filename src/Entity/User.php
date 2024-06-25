<?php

declare(strict_types=1);

namespace Alura\MVC\Entity;

class User
{


  public function __construct(public readonly string $email, public readonly string $password)
  {
  }
}
