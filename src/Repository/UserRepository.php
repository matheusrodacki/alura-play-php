<?php

declare(strict_types=1);

namespace Alura\MVC\Repository;

use Alura\MVC\Entity\User;

class UserRepository
{
  public function __construct(private \PDO $pdo)
  {
  }

  public function add(User $user): bool
  {
    $sql = 'INSERT INTO users (password, email) VALUES (?, ?)';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $user->password);
    $stmt->bindValue(2, $user->email);
    $result = $stmt->execute();

    $id = $this->pdo->lastInsertId();

    return $result;
  }

  public function remove(int $id): bool
  {
    $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
    $stmt->bindValue(1, $id, \PDO::PARAM_INT);
    $result = $stmt->execute();

    return $result;
  }

  public function update(User $user): bool
  {
    $stmt = $this->pdo->prepare('UPDATE users SET password = ?, email = ? WHERE id = ?');
    $stmt->bindValue(1, $user->password);
    $stmt->bindValue(2, $user->email);
    $result = $stmt->execute();

    return $result;
  }

  public function all(): array
  {

    $userList = $this->pdo->query('SELECT * FROM users')->fetchAll();

    return array_map(
      $this->hydrateUser(...),
      $userList
    );
  }

  public function find(int $id): User
  {
    $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->bindValue(1, $id, \PDO::PARAM_INT);
    $stmt->execute();
    return $this->hydrateUser($stmt->fetch(\PDO::FETCH_ASSOC));
  }

  private function hydrateUser(array $userData): User
  {
    $user = new User($userData['password'], $userData['email']);
    return $user;
  }
}
