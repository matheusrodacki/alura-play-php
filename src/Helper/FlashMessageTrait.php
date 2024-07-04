<?php

declare(strict_types=1);

namespace Alura\MVC\Helper;

trait FlashMessageTrait
{
  private function addErrorMessage(string $errorMessage): void
  {
    $_SESSION['error_message'] = $errorMessage;
  }
}
