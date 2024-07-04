<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Helper\HtmlRenderTrait;
use Alura\MVC\Repository\VideoRepository;

class VideoFormController implements Controller
{

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  use HtmlRenderTrait;

  public function processaRequisicao(): void
  {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $video = null;

    if ($id) {
      $video = $this->videoRepository->find($id);
    }
    echo $this->renderTemplate('video-form', ['video' => $video]);
  }
}
