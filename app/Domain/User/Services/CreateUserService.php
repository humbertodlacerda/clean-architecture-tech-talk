<?php

namespace App\Domain\User\Services;

use App\Domain\User\Entities\UserEntity;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Application\Dto\User\CreateUserDto;
use http\Exception\InvalidArgumentException;

class CreateUserService
{
    public function __construct(protected UserRepositoryInterface $repository) {}

    public function create(CreateUserDto $data): UserEntity
    {
        if (! $this->repository->findByEmail($data->email)) {
            throw new InvalidArgumentException('There is already a user with the email sent.');
        }

        $user = new UserEntity(
            $data->name,
            $data->email,
            $data->password
        );

        return $this->repository->create($user);
    }
}
