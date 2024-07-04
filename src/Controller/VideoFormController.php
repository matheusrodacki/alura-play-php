<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Helper\FlashMessageTrait;
use Alura\MVC\Helper\HtmlRenderTrait;
use Alura\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VideoFormController implements Controller
{

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  use HtmlRenderTrait;
  use FlashMessageTrait;

  public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
  {
    $queryParams = $request->getQueryParams();
    $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);

    if ($id === null || $id === false) {
      $this->addErrorMessage('Id Inválido');
      return new Response(302, ['Location' => '/']);
    }

    $video = null;

    if ($id) {
      $video = $this->videoRepository->find($id);
    }
    
    echo $this->renderTemplate('video-form', ['video' => $video]);
    return new Response(200);
  }
}
