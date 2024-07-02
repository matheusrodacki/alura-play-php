<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

class LoginFormController extends HTMLController implements Controller
{
  public function processaRequisicao(): void
  {
    if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true) {
      header('Location: /');
      return;
    }
    $this->renderTemplate('login-form',);
  }
}
