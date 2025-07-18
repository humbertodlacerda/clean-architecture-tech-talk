<?php

namespace App\Domain\Address\Repositories;

use App\Domain\Address\Dto\CreateAddressDto;
use App\Domain\Address\Entities\AddressEntity;

interface AddressRepositoryInterface
{
    public function create(CreateAddressDto $data): AddressEntity;
}
