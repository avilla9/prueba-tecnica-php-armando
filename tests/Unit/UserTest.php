<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
  public function testSetName() {
    $user = new User('John Doe', 'johndoe@example.com', 'password123');
    $user->setName('Jane Doe');

    $this->assertEquals('Jane Doe', $user->getName());
  }

  // ... otras pruebas para los métodos setName, setEmail, setPassword

  public function testConstructorSetsCreatedAt() {
    $user = new User('John Doe', 'johndoe@example.com', 'password123');

    $this->assertInstanceOf(DateTime::class, $user->getCreatedAt());
  }

  public function testPasswordIsHashed() {
    $user = new User('John Doe', 'johndoe@example.com', 'password123');

    $this->assertTrue(password_verify('password123', $user->getPassword()));
  }
}
