<?php

namespace Alura\MVC\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LogoutController implements Controller
{

  public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
  {
    session_destroy();
    return new Response(200, ['Location' => '/login']);
  }
}