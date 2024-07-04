<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Helper\HtmlRenderTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginFormController implements RequestHandlerInterface
{

  use HtmlRenderTrait;

  public function handle(ServerRequestInterface $request): ResponseInterface
  {

    if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true) {
      return new Response(200, ['Location' => '/']);
    }

    echo $this->renderTemplate('login-form');
    return new Response(401);
  }
}
