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
    $sql = 'INSERT INTO videos (url, titulo) VALUES (?, ?)';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $video->url);
    $stmt->bindValue(2, $video->titulo);
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
    $stmt = $this->pdo->prepare('UPDATE videos SET url = ?, titulo = ? WHERE id = ?');
    $stmt->bindValue(1, $video->url);
    $stmt->bindValue(2, $video->titulo);
    $stmt->bindValue(3, $video->id, \PDO::PARAM_INT);
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
    return $video;
  }
}
