<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Entity\Video;
use Alura\MVC\Helper\FlashMessageTrait;
use Alura\MVC\Repository\VideoRepository;

class NewVideoController implements Controller
{

  use FlashMessageTrait;

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function processaRequisicao(): void
  {
    $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
    if ($url === false) {
      $this->addErrorMessage('Url inválida');
      header('Location: /novo-video');
      return;
    }
    $titulo = filter_input(INPUT_POST, 'titulo');
    if ($titulo === false) {
      $this->addErrorMessage('Título inválido');
      header('Location: /novo-video');
      return;
    }

    $video = new Video($url, $titulo);

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $safeFileName = uniqid('upload_') . '_' . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);
      $finfo = new \finfo(FILEINFO_MIME_TYPE);
      $mimeType = $finfo->file($_FILES['image']['tmp_name']);
      if (str_starts_with($mimeType, 'image/')) {
        move_uploaded_file(
          $_FILES['image']['tmp_name'],
          __DIR__ . '/../../public/uploads/' . $safeFileName
        );
        $video->setImagePath($safeFileName);
      }
    }

    $success = $this->videoRepository->add($video);
    if ($success === false) {
      $this->addErrorMessage('Erro ao inserir novo vídeo');
      header('Location: /novo-video');
    } else {
      header('Location: /?sucesso=1');
    }
  }
}
