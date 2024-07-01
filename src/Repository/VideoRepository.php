<?php

namespace Alura\MVC\Repository;

use Alura\MVC\Entity\Video;

class VideoRepository
{

  public function __construct(private \PDO $pdo)
  {
  }

  public function add(Video $video): bool
  {
    $sql = 'INSERT INTO videos (url, titulo, image_path) VALUES (?, ?,?)';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $video->url);
    $stmt->bindValue(2, $video->titulo);
    $stmt->bindValue(3, $video->getImagePath());
    $result = $stmt->execute();

    $id = $this->pdo->lastInsertId();
    $video->setId(intval($id));

    return $result;
  }

  public function remove(int $id): bool
  {
    $stmt = $this->pdo->prepare('DELETE FROM videos WHERE id = ?');
    $stmt->bindValue(1, $id, \PDO::PARAM_INT);
    $result = $stmt->execute();

    return $result;
  }

  public function update(Video $video): bool
  {

    $updateImageSql = '';
    if ($video->getImagePath() !== null) {
      $updateImageSql = ', image_path = :image_path';
    }

    $sql = "UPDATE videos SET 
                  url = :url, 
                  titulo = :titulo
                  $updateImageSql
              WHERE id = :id;";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':url', $video->url);
    $stmt->bindValue(':titulo', $video->titulo);
    $stmt->bindValue(':id', $video->id, \PDO::PARAM_INT);

    if ($video->getImagePath() !== null) {
      $stmt->bindValue(':image_path', $video->getImagePath());
    }

    $result = $stmt->execute();

    return $result;
  }

  public function removeImage(int $id): bool
  {
    $sql = "UPDATE videos SET image_path = NULL WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $result = $stmt->execute();

    return $result;

  }

  public function all(): array
  {

    $videoList = $this->pdo->query('SELECT * FROM videos')->fetchAll();

    return array_map(
      $this->hydrateVideo(...),
      $videoList
    );
  }

  public function find(int $id): Video
  {
    $stmt = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?');
    $stmt->bindValue(1, $id, \PDO::PARAM_INT);
    $stmt->execute();
    return $this->hydrateVideo($stmt->fetch(\PDO::FETCH_ASSOC));
  }

  private function hydrateVideo(array $videoData): Video
  {
    $video = new Video($videoData['url'], $videoData['titulo']);
    $video->setId($videoData['id']);

    if ($videoData['image_path'] !== null) {
      $video->setImagePath($videoData['image_path']);
    }

    return $video;
  }
}
