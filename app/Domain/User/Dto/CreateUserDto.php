<?php

namespace App\Domain\User\Dto;

use App\Domain\Address\ValueObjects\ZipCode;
use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Password;

class CreateUserDto
{
    public function __construct(
        public string $name,
        public Email $email,
        public Password $password,
        public ZipCode $zipCode,
    ) {}
}
