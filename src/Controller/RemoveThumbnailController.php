<?php

namespace Alura\MVC\Controller;

use Alura\MVC\Helper\FlashMessageTrait;
use Alura\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RemoveThumbnailController implements RequestHandlerInterface
{
  use FlashMessageTrait;

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $queryParams = $request->getQueryParams();
    $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
    if ($id === null || $id === false) {
      $this->addErrorMessage('Id Inválido');
      return new Response(302, ['Location' => '/']);
    }

    $success = $this->videoRepository->removeImage($id);
    if ($success === false) {
      $this->addErrorMessage('Erro ao remover imagem');
      return new Response(302, ['Location' => '/']);
    } else {
      return new Response(200, ['Location' => '/']);
    }
  }
}