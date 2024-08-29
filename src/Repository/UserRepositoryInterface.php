<?php
interface UserRepositoryInterface {
  public function save(User $user): void;
  public function findById(int $id): ?User;
  public function update(User $user): bool;
  public function delete(int $id): bool;
}
