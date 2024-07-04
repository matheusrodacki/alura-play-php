<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Entity\Video;
use Alura\MVC\Helper\FlashMessageTrait;
use Alura\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NewVideoController implements RequestHandlerInterface
{

  use FlashMessageTrait;

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $queryParams = $request->getQueryParams();
    $url = filter_var($queryParams['url'], FILTER_VALIDATE_URL);
    if ($url === false) {
      $this->addErrorMessage('URL Inválida');
      return new Response(302, ['Location' => '/']);
    }

    $titulo = filter_var($queryParams['titulo']);
    if ($titulo === false) {
      $this->addErrorMessage('Título Inválido');
      return new Response(302, ['Location' => '/']);
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
      $this->addErrorMessage('Erro ao editar vídeo');
      return new Response(302, ['Location' => '/']);
    } else {
      return new Response(302, ['Location' => '/']);
    }
  }
}
