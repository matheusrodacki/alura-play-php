<?php


$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$video = [
  'titulo' => '',
  'url' => ''
];

if ($id) {
  $stmt = $pdo->prepare('SELECT * FROM videos WHERE id = :id');
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $video = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<?php require_once 'head.php'; ?>
<?php require_once 'cabecalho.php'; ?>
<main class="container">
  <form class="container__formulario" method="POST">
    <h2 class="formulario__titulo">Envie um vídeo!</h2>
    <div class="formulario__campo">
      <label class="campo__etiqueta" for="url">Link embed</label>
      <input name="url" value="<?= $video['url']; ?>" class="campo__escrita" required placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id="url" />
    </div>

    <div class="formulario__campo">
      <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
      <input name="titulo" value="<?= $video['titulo']; ?>" class="campo__escrita" required placeholder="Neste campo, dê o nome do vídeo" id="titulo" />
    </div>

    <input class="formulario__botao" type="submit" value="Enviar" />
  </form>
</main>
<?php require_once 'footer.php'; ?>