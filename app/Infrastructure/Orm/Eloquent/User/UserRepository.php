<?php

namespace App\Infrastructure\Orm\Eloquent\User;

use App\Domain\User\Entities\UserEntity;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\Email;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create(UserEntity $data): UserEntity
    {
        $user = User::query()->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);

        return new UserEntity($user->name, $user->email, $user->password);
    }

    public function findByEmail(Email $email): ?UserEntity
    {
        // TODO: Implement findByEmail() method.
    }
}
