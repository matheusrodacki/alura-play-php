<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Repository\UserRepository;
use PDO;

class LoginController implements Controller
{
  private PDO $pdo;

  public function __construct()
  {
    $dbPath = __DIR__ . '/../../banco.sqlite';
    $this->pdo = new PDO("sqlite:$dbPath");
  }

  public function processaRequisicao(): void
  {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    $videoRepository = new UserRepository($this->pdo);
    $user = $videoRepository->findByEmail($email);
    $correctPassword = password_verify($password, $user->password);


    if ($correctPassword) {
      $_SESSION['logado'] = true;
      header('Location: /');
      return;
    } else {
      header('Location: /login?success=0');
    }
  }
}
