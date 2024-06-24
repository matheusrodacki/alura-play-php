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

    require_once __DIR__ . '/../../head.php';
    require_once __DIR__ . '/../../cabecalho.php'; ?>

    <ul class="videos__container" alt="videos alura">
      <?php foreach ($videoList as $video) : ?>
        <li class="videos__item">
          <iframe width="100%" height="72%" src=<?php echo $video->url ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <div class="descricao-video">
            <img src="./img/logo.png" alt="logo canal alura">
            <h3><?php echo $video->titulo ?></h3>
            <div class="acoes-video">
              <a href="/editar-video?id=<?= $video->id ?>">Editar</a>
              <a href="/deleta-video?id=<?= $video->id ?>">Excluir</a>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
<?php require_once __DIR__ . '/../../footer.php';
  }
}
