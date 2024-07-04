<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Helper\FlashMessageTrait;
use Alura\MVC\Infrastructure\ConnectionPDO;
use Alura\MVC\Repository\UserRepository;
use Nyholm\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController implements Controller
{
  private PDO $pdo;

  use FlashMessageTrait;

  public function __construct()
  {
    $connection = new ConnectionPDO();
    $this->pdo = $connection->getPdo();
  }

  public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
  {
    $queryParams = $request->getQueryParams();
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    $videoRepository = new UserRepository($this->pdo);
    $user = $videoRepository->findByEmail($email);

    if (!$user) {
      $this->addErrorMessage('Usuário ou senha inválidos');
      return new Response(302, ['Location' => '/login']);
    }

    $correctPassword = password_verify($password, $user->password);

    if (!$correctPassword) {
      $this->addErrorMessage('Usuário ou senha inválidos');
      return new Response(302, ['Location' => '/login']);
    }

    if (password_needs_rehash($user->password, PASSWORD_ARGON2ID)) {
      $newHashedPassword = password_hash($password, PASSWORD_ARGON2ID);
      $userRepository = new UserRepository($this->pdo);
      $userRepository->updatePassword($user->id, $newHashedPassword);
    }

    $_SESSION['logado'] = true;
    return new Response(200, ['Location' => '/']);

  }
}
