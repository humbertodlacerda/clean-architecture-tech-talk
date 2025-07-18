<?php

namespace App\Domain\User\Services;

use App\Domain\Address\Entities\AddressEntity;
use App\Domain\Address\Repositories\AddressProviderInterface;
use App\Domain\User\Dto\CreateUserDto;
use App\Domain\User\Entities\UserEntity;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Exception;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $repository,
        protected AddressProviderInterface $addressProvider
    ) {}

    public function create(CreateUserDto $data): UserEntity
    {
        if ($this->repository->findByEmail($data->email)) {
            throw new Exception('There is already a user with the email sent.');
        }

        $addressData = $this->addressProvider->getAddressByZipCode($data->zipCode);
        $address = new AddressEntity(
            $addressData->street,
            $addressData->neighborhood,
            $addressData->city,
            $addressData->state,
            $addressData->complement,
            $addressData->zipCode,
        );

        $user = new UserEntity(
            $data->name,
            $data->email,
            $data->password,
            $address
        );

        return $this->repository->create($user);
    }
}
