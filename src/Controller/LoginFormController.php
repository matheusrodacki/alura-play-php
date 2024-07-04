<?php

declare(strict_types=1);

namespace Alura\MVC\Controller;

use Alura\MVC\Helper\HtmlRenderTrait;

class LoginFormController implements Controller
{

  use HtmlRenderTrait;

  public function processaRequisicao(): void
  {



    if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true) {
      header('Location: /');
      return;
    }

    echo $this->renderTemplate('login-form');
  }
}
