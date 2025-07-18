<?php

namespace App\Domain\User\Entities;

use App\Domain\Address\Entities\AddressEntity;

readonly class UserEntity
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public AddressEntity $address
    ) {}
}
