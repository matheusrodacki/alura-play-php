<?php

namespace Alura\MVC\Controller;

use Alura\MVC\Controller\Controller;
use Alura\MVC\Entity\Video;
use Alura\MVC\Repository\VideoRepository;

class NewJsonVideoController implements Controller
{

  public function __construct(private VideoRepository $videoRepository)
  {
  }
  public function processaRequisicao(): void
  {
    $request = file_get_contents('php://input');
    $videoDada = json_decode($request, true);
    $video = new Video($videoDada['url'], $videoDada['titulo']);
    $this->videoRepository->add($video);

    http_response_code(201);
  }
}