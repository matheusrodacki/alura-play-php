<body>
  <!-- Cabecalho -->
  <header>
    <nav class="cabecalho">
      <a class="logo" href="./"></a>

      <div class="cabecalho__icones">
        <a href="./novo-video" class="cabecalho__videos"></a>
        <a href="../logout" class="cabecalho__sair">Sair</a>
      </div>
    </nav>
  </header>


  <?php if (isset($_SESSION['error_message'])) : ?>
    <h2 class="formulario__titulo erro">
      <?= $_SESSION['error_message'] ?>
      <?php unset($_SESSION['error_message']) ?>
    </h2>
  <?php endif ?>