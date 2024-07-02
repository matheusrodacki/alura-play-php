<?php

namespace Alura\MVC\Controller;

abstract class HTMLController implements Controller
{
  private const TEMPLATE_PATH = __DIR__ . "/../../views/";

  protected function renderTemplate(string $templateName, array $context = []): void
  {
    extract($context);
    require self::TEMPLATE_PATH . "{$templateName}.php";
  }
}