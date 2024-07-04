<?php

namespace Alura\MVC\Controller;

use Alura\MVC\Entity\Video;
use Alura\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class JsonVideoListController implements RequestHandlerInterface
{
  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $videoList = array_map(function (Video $video) {
      return [
        'url' => $video->url,
        'titulo' => $video->titulo,
        'filepath' => '/uploads/' . $video->getImagePath(),
      ];

    }, $this->videoRepository->all());

    return new Response(200, ['Content-Type' => 'application/json'], json_encode($videoList));
  }
}