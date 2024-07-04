<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Helper\HtmlRenderTrait;
use Alura\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VideoListController implements Controller
{

  use HtmlRenderTrait;

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
  {
    $videoList = $this->videoRepository->all();
    $body = $this->renderTemplate('video-list', ['videoList' => $videoList]);
    return new Response(200, [], $body);
  }
}
