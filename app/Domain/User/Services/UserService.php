<?php

namespace App\Domain\User\Services;

use App\Domain\Address\Dto\CreateAddressDto;
use App\Domain\Address\Repositories\AddressProviderInterface;
use App\Domain\Address\Services\AddressService;
use App\Domain\User\Dto\CreateUserDto;
use App\Domain\User\Entities\UserEntity;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Exception;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $repository,
        protected AddressProviderInterface $addressProvider,
        protected AddressService $addressService,
    ) {}

    public function create(CreateUserDto $data): UserEntity
    {
        if ($this->repository->findByEmail($data->email)) {
            throw new Exception('There is already a user with the email sent.');
        }

        $user = new UserEntity(
            name: $data->name,
            email: $data->email,
            password: $data->password,
        );

        $userCreated = $this->repository->create($user);
        $addressData = new CreateAddressDto(
            userId: $userCreated->userId,
            zipCode: $data->zipCode,
        );

        $addressCreated = $this->addressService->create($addressData);
        $userCreated->address = $addressCreated;

        return $userCreated;
    }
}
