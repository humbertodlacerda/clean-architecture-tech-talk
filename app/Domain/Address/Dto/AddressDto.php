<?php

namespace App\Domain\Address\Dto;

use App\Domain\Address\ValueObjects\ZipCode;

class AddressDto
{
    public function __construct(
        public string $street,
        public string $neighborhood,
        public string $city,
        public string $state,
        public ?string $complement,
        public ZipCode $zipCode,
    ) {}
}
