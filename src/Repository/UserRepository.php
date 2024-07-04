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
    $sql = 'INSERT INTO users (email, password) VALUES (?, ?)';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $user->email);
    $stmt->bindValue(2, $user->password);
    $result = $stmt->execute();

    $id = $this->pdo->lastInsertId();
    $user->setId(intval($id));

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
    $stmt->bindValue(3, $user->id, \PDO::PARAM_INT);
    $result = $stmt->execute();

    return $result;
  }

  public function updatePassword(int $id, string $password): bool
  {
    $stmt = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
    $stmt->bindValue(1, $password);
    $stmt->bindValue(2, $id, \PDO::PARAM_INT);
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

  public function findById(int $id): User
  {
    $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->bindValue(1, $id, \PDO::PARAM_INT);
    $stmt->execute();
    return $this->hydrateUser($stmt->fetch(\PDO::FETCH_ASSOC));
  }

  public function findByEmail(string $email): ?User
  {
    $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bindValue(1, $email, \PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    if ($result) {
      return $this->hydrateUser($result);
    } else {
      return null;
    }
  }

  private function hydrateUser(array $userData): User
  {
    $user = new User($userData['email'], $userData['password'],);
    $user->setId($userData['id']);
    return $user;
  }
}
