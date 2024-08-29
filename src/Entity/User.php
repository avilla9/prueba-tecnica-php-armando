<?php
class User {
  private int $id;
  private string $name;
  private string $email;
  private string $password;
  private DateTime $createdAt;
  private ?DateTime $updatedAt;

  public function __construct(string $name, string $email, string $password) {
    $this->name = $name;
    $this->email = $email;
    $this->password = password_hash($password, PASSWORD_BCRYPT);
    $this->createdAt = new DateTime();
  }

  // Getters
  public function getId(): int {
    return $this->id;
  }

  public function getName(): string {
    return $this->name;
  }

  public function getEmail(): string {
    return $this->email;
  }

  public function getPassword(): string {
    return $this->password;
  }

  public function getCreatedAt(): DateTime {
    return $this->createdAt;
  }

  public function getUpdatedAt(): DateTime {
    return $this->updatedAt;
  }

  // Setters
  public function setName(string $name): void {
    $pattern = '/^[a-zA-Z\s]+$/';
    if (empty($name)) {
      throw new InvalidArgumentException('El nombre no puede estar vacío');
    }

    if (!preg_match($pattern, $name)) {
      throw new InvalidArgumentException('El nombre solo puede contener letras y espacios');
    }

    if (strlen($name) > 255) {
      throw new InvalidArgumentException('El nombre no puede exceder los 255 caracteres');
    }

    $this->name = $name;
    $this->updatedAt = new DateTime();
  }

  public function setEmail(string $email): void {
    $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if (empty($email)) {
      throw new InvalidArgumentException('El correo electrónico no puede estar vacío');
    }

    if (!preg_match($pattern, $email)) {
      throw new InvalidArgumentException('El formato del correo electrónico no es válido');
    }

    $this->email = $email;
    $this->updatedAt = new DateTime();
  }

  public function setPassword(string $password): void {
    if (strlen($password) < 8) {
      throw new InvalidArgumentException('La contraseña debe tener al menos 8 caracteres');
    }

    $this->password = password_hash($password, PASSWORD_BCRYPT);
    $this->updatedAt = new DateTime();
  }
}
