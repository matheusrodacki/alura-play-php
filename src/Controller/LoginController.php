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
use Psr\Http\Server\RequestHandlerInterface;

class LoginController implements RequestHandlerInterface
{
  private PDO $pdo;

  use FlashMessageTrait;

  public function __construct()
  {
    $connection = new ConnectionPDO();
    $this->pdo = $connection->getPdo();
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if ($email === false) {
      $this->addErrorMessage('E-mail ou senha inválido');
      return new Response(302, ['Location' => '/login']);
    }

    $password = filter_input(INPUT_POST, 'password');
    if ($password === false) {
      $this->addErrorMessage('E-mail ou senha inválido');
      return new Response(302, ['Location' => '/login']);
    }


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
