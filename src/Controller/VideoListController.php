<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Repository\VideoRepository;

class VideoListController
{

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function processaRequisicao(): void
  {
    $videoList = $this->videoRepository->all();
    require __DIR__ . '/../../Views/video-list.php';
  }
}
