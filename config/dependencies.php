<?php

/** @var ContainerInterface $container */

use League\Plates\Engine;
use Psr\Container\ContainerInterface;

$dbPath = __DIR__ . '/../banco.sqlite';

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
  PDO::class => \DI\create(PDO::class)->constructor("sqlite:$dbPath"),
  Engine::class => function () {
    $templatesPath = __DIR__ . '/../views';
    return new Engine($templatesPath);
  }
]);

$container = $builder->build();

return $container;
