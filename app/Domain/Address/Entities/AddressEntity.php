<?php

namespace App\Domain\Address\Entities;

use App\Domain\Address\ValueObjects\ZipCode;

class AddressEntity
{
    public function __construct(
        public string $street,
        public string $neighborhood,
        public string $city,
        public string $state,
        public ?string $complement,
        public ZipCode $zipCode,
        public ?int $userId,
    ) {}
}
