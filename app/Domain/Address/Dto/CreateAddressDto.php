<?php

namespace App\Domain\Address\Dto;

use App\Domain\Address\ValueObjects\ZipCode;

class CreateAddressDto
{
    public function __construct(
        public int $userId,
        public ZipCode $zipCode,
    ) {}
}
