<?php
class UserRepository implements UserRepositoryInterface {
  private PDO $pdo;

  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }

  public function save(User $user): void {
    $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$user->getName(), $user->getEmail(), password_hash($user->getPassword(), PASSWORD_BCRYPT)]);
  }

  public function findById(int $id): ?User {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetchObject(User::class);
    return $user;
  }

  public function update(User $user): bool {
    $stmt = $this->pdo->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
    $stmt->execute([$user->getName(), $user->getEmail(), password_hash($user->getPassword(), PASSWORD_BCRYPT), $user->getId()]);
    return $stmt->rowCount() > 0;
  }

  public function delete(int $id): bool {
    $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;
  }
}
