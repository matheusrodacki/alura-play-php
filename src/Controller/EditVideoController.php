<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Entity\Video;
use Alura\MVC\Helper\FlashMessageTrait;
use Alura\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditVideoController implements RequestHandlerInterface
{
  use FlashMessageTrait;

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $queryParams = $request->getQueryParams();
    $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
      $this->addErrorMessage('Id Inválido');
      return new Response(302, ['Location' => '/']);
    }

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
    $files = $request->getUploadedFiles();
    /** @var UploadedFileInterface $uploadedImage */
    $uploadedImage = $files['image'];
    if ($uploadedImage->getError() === UPLOAD_ERR_OK) {
      $finfo = new \finfo(FILEINFO_MIME_TYPE);
      $tmpFile = $uploadedImage->getStream()->getMetadata('uri');
      $mimeType = $finfo->file($tmpFile);

      if (str_starts_with($mimeType, 'image/')) {
        $safeFileName = uniqid('upload_') . '.' . pathinfo($uploadedImage->getClientFilename(), PATHINFO_EXTENSION);
        $uploadedImage->moveTo(__DIR__ . '/../../public/uploads/' . $safeFileName);
        $video->setImagePath($safeFileName);
      }
    }

    $video->setId($id);

    $success = $this->videoRepository->update($video);

    if ($success === false) {
      $this->addErrorMessage('Erro ao editar vídeo');
      return new Response(302, ['Location' => '/']);
    } else {
      return new Response(302, ['Location' => '/']);
    }
  }
}
