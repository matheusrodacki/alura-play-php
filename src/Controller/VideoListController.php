<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Repository\VideoRepository;
use League\Plates\Engine as PlatesEngine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoListController implements RequestHandlerInterface
{

  public function __construct(private VideoRepository $videoRepository, private PlatesEngine $templates)
  {
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $videoList = $this->videoRepository->all();
    return new Response(200, body: $this->templates->render('video-list', ['videoList' => $videoList]));
  }
}
