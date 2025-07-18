<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\UserEntity;
use App\Domain\User\ValueObjects\Email;

interface UserRepositoryInterface
{
    public function create(UserEntity $data): UserEntity;

    public function findByEmail(Email $email): ?UserEntity;
}
