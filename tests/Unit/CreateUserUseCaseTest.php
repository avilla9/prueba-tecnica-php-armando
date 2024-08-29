<?php

use CreateUserUseCase;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CreateUserUseCaseTest extends TestCase {
  /**
   * @var UserRepositoryInterface|MockObject
   */
  private $mockUserRepository;

  private CreateUserUseCase $createUserUseCase;

  protected function setUp(): void {
    $this->mockUserRepository = $this->createMock(UserRepositoryInterface::class);

    $this->createUserUseCase = new CreateUserUseCase($this->mockUserRepository);
  }

  public function testExecuteWithValidData(): void {
    $this->mockUserRepository->expects($this->once())->method('save');

    $createUserDto = new CreateUserDto('John Doe', 'johndoe@example.com', 'password123');

    $this->createUserUseCase->execute($createUserDto);
  }

  public function testExecuteWithEmptyName(): void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('El nombre es obligatorio');

    $createUserDto = new CreateUserDto('', 'johndoe@example.com', 'password123');

    $this->createUserUseCase->execute($createUserDto);
  }

  // ... otros test methods
}
