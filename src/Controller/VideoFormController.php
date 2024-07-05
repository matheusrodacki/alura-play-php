<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Entity\Video;
use Alura\MVC\Helper\FlashMessageTrait;
use Alura\MVC\Helper\HtmlRenderTrait;
use Alura\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoFormController implements RequestHandlerInterface
{

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  use HtmlRenderTrait;
  use FlashMessageTrait;

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $queryParams = $request->getQueryParams();
    $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);

    /** @var ?Video $video */
    $video = null;

    if ($id) {
      $video = $this->videoRepository->find($id);
    }

    echo $this->renderTemplate('video-form', ['video' => $video]);
    return new Response(200);
  }
}
