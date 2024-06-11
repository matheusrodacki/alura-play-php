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

$videoList = $pdo->query('SELECT * FROM videos')->fetchAll(\PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/reset.css" />
  <link rel="stylesheet" href="../css/estilos.css" />
  <link rel="stylesheet" href="../css/estilos-form.css" />
  <link rel="stylesheet" href="../css/flexbox.css" />
  <title>AluraPlay</title>
  <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon" />
</head>

<body>
  <!-- Cabecalho -->
  <header>
    <nav class="cabecalho">
      <a class="logo" href="../index.html"></a>

      <div class="cabecalho__icones">
        <a href="./enviar-video.html" class="cabecalho__videos"></a>
        <a href="../pages/login.html" class="cabecalho__sair">Sair</a>
      </div>
    </nav>
  </header>

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
</body>

</html>