<?php
/** @var ContainerInterface $container */

use Psr\Container\ContainerInterface;

$dbPath = __DIR__ . '/../banco.sqlite';

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
  PDO::class => \DI\create(PDO::class)->constructor("sqlite:$dbPath"),
]);

$container = $builder->build();

return $container;