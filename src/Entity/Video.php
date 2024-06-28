<?php

declare(strict_types=1);

namespace Alura\MVC\Entity;

class Video
{

    public readonly int $id;
    public readonly string $url;
    private ?string $imagePath;

    public function __construct(string $url, public readonly string $titulo)
    {
        $this->setUrl($url);
    }

    public function setUrl(string $url): void
    {

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('URL inválida');
        }

        $this->url = $url;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }
}