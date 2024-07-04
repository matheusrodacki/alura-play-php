<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Helper\HtmlRenderTrait;
use Alura\MVC\Repository\VideoRepository;

class VideoListController implements Controller
{

  use HtmlRenderTrait;

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function processaRequisicao(): void
  {
    $videoList = $this->videoRepository->all();
    echo $this->renderTemplate('video-list', ['videoList' => $videoList]);
  }
}
