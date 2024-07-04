<?php

namespace Alura\MVC\Controller;

use Alura\MVC\Controller\Controller;
use Alura\MVC\Entity\Video;
use Alura\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NewJsonVideoController implements RequestHandlerInterface
{

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $request = $request->getBody()->getContents();
    $videoDada = json_decode($request, true);
    $video = new Video($videoDada['url'], $videoDada['titulo']);
    $this->videoRepository->add($video);

    return new Response(201,);
  }
}