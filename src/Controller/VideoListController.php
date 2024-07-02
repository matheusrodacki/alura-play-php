<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Repository\VideoRepository;

class VideoListController extends HTMLController implements Controller
{

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function processaRequisicao(): void
  {
    $videoList = $this->videoRepository->all();
    $this->renderTemplate('video-list', ['videoList' => $videoList]);
  }
}
