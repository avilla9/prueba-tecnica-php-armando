<?php
class CreateUserUseCase {
  private UserRepositoryInterface $userRepository;

  public function __construct(UserRepositoryInterface $userRepository) {
    $this->userRepository = $userRepository;
  }

  public function setUserRepository(UserRepositoryInterface $userRepository) {
    $this->userRepository = $userRepository;
  }

  public function execute(CreateUserDto $createUserDto): void {
    if (empty($createUserDto->getName())) {
      throw new InvalidArgumentException('El nombre es obligatorio');
    }
    if (!filter_var($createUserDto->getEmail(), FILTER_VALIDATE_EMAIL)) {
      throw new InvalidArgumentException('El correo electrónico no es válido');
    }
    if (strlen($createUserDto->getPassword()) < 8) {
      throw new InvalidArgumentException('La contraseña debe tener al menos 8 caracteres');
    }

    // Crear entidad User y asignar valores del DTO
    $user = new User(
      $createUserDto->getName(),
      $createUserDto->getEmail(),
      $createUserDto->getPassword()
    );
    $user->setName($createUserDto->getName());
    $user->setEmail($createUserDto->getEmail());
    $user->setPassword(password_hash($createUserDto->getPassword(), PASSWORD_BCRYPT));

    // Persistir usuario utilizando el repositorio
    $this->userRepository->save($user);
  }
}
