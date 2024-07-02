<?php

namespace Alura\MVC\Controller;

use Alura\MVC\Entity\Video;
use Alura\MVC\Repository\VideoRepository;

class JsonVideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
      $videoList = array_map( function (Video $video){
        return [
          'url' => $video->url,
          'titulo' => $video->titulo,
          'filepath' => '/uploads/' . $video->getImagePath(),
                ];

          },$this->videoRepository->all());

        echo json_encode($videoList);
    }
}