<?php
$this->insert('head');
$this->insert('cabecalho');
/** @var \Alura\MVC\Entity\Video $video */
?>

<main class="container">
  <form class="container__formulario" method="POST" enctype="multipart/form-data">
    <h2 class="formulario__titulo">Envie um vídeo!</h2>
    <div class="formulario__campo">
      <label class="campo__etiqueta" for="url">Link embed</label>
      <input name="url" value="<?= $video?->url; ?>" class="campo__escrita" placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id="url" required />
    </div>

    <div class="formulario__campo">
      <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
      <input name="titulo" value="<?= $video?->titulo; ?>" class="campo__escrita" placeholder="Neste campo, dê o nome do vídeo" id="titulo" required />
    </div>

    <div class="formulario__campo">
      <label class="campo__etiqueta" for="image">Imagem</label>
      <input name="image" type="file" accept="image/*" class="campo__escrita" id="titulo" />
    </div>

    <input class="formulario__botao" type="submit" value="Enviar" />
  </form>
</main>
<?php $this->insert('footer');
