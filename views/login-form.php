<?php
require_once __DIR__ . '/head.php';
require_once __DIR__ . '/cabecalho.php'; ?>

<main class="container">
    <form class="container__formulario">
        <h2 class="formulario__titulo">Efetue login</h3>
            <div class="formulario__campo">
                <label class="campo__etiqueta" for="email">E-mail</label>
                <input name="email" class="campo__escrita" required placeholder="Digite seu usuário" id='usuario' />
            </div>
            <div class="formulario__campo">
                <label class="campo__etiqueta" for="password">Senha</label>
                <input type="password" name="password" class="campo__escrita" required placeholder="Digite sua senha" id='senha' />
            </div>
            <input class="formulario__botao" type="submit" value="Entrar" />
    </form>
</main>

<?php require_once __DIR__ . '/footer.php';
