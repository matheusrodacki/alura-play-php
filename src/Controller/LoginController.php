<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Helper\FlashMessageTrait;
use Alura\MVC\Repository\UserRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginController implements RequestHandlerInterface
{


  use FlashMessageTrait;

  private \PDO $pdo;

  public function __construct(private UserRepository $userRepository)
  {
  }


  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $queryParams = $request->getParsedBody();
    $email = filter_var($queryParams['email'], FILTER_VALIDATE_EMAIL);
    if ($email === false) {
      $this->addErrorMessage('E-mail ou senha inválido');
      return new Response(302, ['Location' => '/login']);
    }

    $password = filter_var($queryParams['password']);
    if ($password === false) {
      $this->addErrorMessage('E-mail ou senha inválido');
      return new Response(302, ['Location' => '/login']);
    }

    $user = $this->userRepository->findByEmail($email);

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
