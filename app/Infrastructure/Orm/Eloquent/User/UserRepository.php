<?php

namespace App\Infrastructure\Orm\Eloquent\User;

use App\Domain\Address\Dto\CreateAddressDto;
use App\Domain\User\Entities\UserEntity;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\Email;
use App\Infrastructure\Orm\Eloquent\Address\AddressRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(protected AddressRepository $addressRepository) {}

    public function create(UserEntity $data): UserEntity
    {
        $user = User::query()->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);

        $addressData = new CreateAddressDto(
            $user->id,
            $data->address->street,
            $data->address->neighborhood,
            $data->address->city,
            $data->address->state,
            $data->address->complement,
            $data->address->zipCode,
        );
        $address = $this->addressRepository->create($addressData);

        return new UserEntity(
            $user->name,
            $user->email,
            $user->password,
            $address
        );
    }

    public function findByEmail(Email $email): ?UserEntity
    {
        $user = User::query()->where('email', $email->value())->first();

        if (! $user) {
            return null;
        }

        return new UserEntity($user->name, $user->email, $user->password, $user->address);
    }
}
