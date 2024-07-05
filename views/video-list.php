<?php
$this->insert('head');
$this->insert('cabecalho');

/** @var \Alura\MVC\Entity\Video[] $videoList */ ?>

?>
<ul class="videos__container" alt="videos alura">
  <?php foreach ($videoList as $video) : ?>
    <li class="videos__item">
      <?php if ($video->getImagePath() !== null) : ?>
        <a href="<?= $video->url ?>">
          <img src="/uploads/<?= $video->getImagePath() ?>" alt="miniatura do vídeo" style="width: 100%">
        </a>
      <?php else : ?>
        <iframe width="100%" height="72%" src="<?php echo $video->url ?>" title=" YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <?php endif; ?>
      <div class="descricao-video">
        <img src="./img/logo.png" alt="logo canal alura">
        <h3><?php echo $video->titulo ?></h3>
        <div class="acoes-video">
          <a href="/editar-video?id=<?= $video->id ?>">Editar</a>
          <a href="/deleta-video?id=<?= $video->id ?>">Excluir</a>
          <a href="/remove-thumb?id=<?= $video->id ?>">Remover Capa</a>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>

<?php $this->insert('footer');
