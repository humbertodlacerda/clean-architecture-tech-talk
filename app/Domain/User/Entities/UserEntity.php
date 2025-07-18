<?php

namespace App\Domain\User\Entities;

use App\Domain\Address\Entities\AddressEntity;

class UserEntity
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?int $userId = null,
        public ?AddressEntity $address = null,
    ) {}
}
