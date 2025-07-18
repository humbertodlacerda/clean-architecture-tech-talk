<?php

namespace App\Domain\User\Entities;

class UserEntity
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password // já deve estar criptografada
    ) {}
}
