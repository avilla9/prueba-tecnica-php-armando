<?php

use UserRepository;
use User;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase {
  private UserRepository $userRepository;

  protected function setUp(): void {
    // Configurar la conexión a la base de datos
    $this->userRepository = new UserRepository(new PDO('mysql:host=localhost;dbname=prueba_tecnica', 'tu_usuario', 'tu_contraseña'));
  }

  public function testSave(): void {
    $user = new User('John Doe', 'johndoe@example.com', 'mypassword');
    $this->userRepository->save($user);

    // Verificar si el usuario se ha guardado correctamente
    $foundUser = $this->userRepository->findById($user->getId());
    $this->assertNotNull($foundUser);
    $this->assertEquals($user->getName(), $foundUser->getName());
    $this->assertEquals($user->getEmail(), $foundUser->getEmail());
    // Verificar la contraseña (puede ser necesario compararla con un hash)
  }

  // ... (tests para los otros métodos: findById, update, delete)
}
