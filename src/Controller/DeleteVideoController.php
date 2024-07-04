<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Helper\FlashMessageTrait;
use Alura\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DeleteVideoController implements Controller
{
  public function __construct(private VideoRepository $videoRepository)
  {
  }

  use FlashMessageTrait;

  public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
  {
    $queryParams = $request->getQueryParams();
    $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
    if ($id === null || $id === false) {
      $this->addErrorMessage('Id Inválido');
      return new Response(302, ['Location' => '/']);
    }

    $success = $this->videoRepository->remove($id);
    if ($success === false) {
      $this->addErrorMessage('}Erro ao remover vídeo');
      return new Response(302, ['Location' => '/']);
    } else {
      return new Response(302, ['Location' => '/']);
    }
  }
}
