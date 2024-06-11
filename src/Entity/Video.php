<?php

declare(strict_types=1);

namespace Alura\MVC\Entity;

class Video
{
  private ?int $id;
  private string $titulo;
  private string $descricao;
  private string $url;
  private string $dataPublicacao;

  public function __construct(?int $id, string $titulo, string $descricao, string $url, string $dataPublicacao)
  {
    $this->id = $id;
    $this->titulo = $titulo;
    $this->descricao = $descricao;
    $this->url = $url;
    $this->dataPublicacao = $dataPublicacao;
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getTitulo(): string
  {
    return $this->titulo;
  }

  public function getDescricao(): string
  {
    return $this->descricao;
  }

  public function getUrl(): string
  {
    return $this->url;
  }

  public function getDataPublicacao(): string
  {
    return $this->dataPublicacao;
  }
}
// Path: src/Entity/Video.php