<?php

namespace App\Domain\Address\Repositories;

use App\Domain\Address\Dto\AddressDto;
use App\Domain\Address\Entities\AddressEntity;

interface AddressRepositoryInterface
{
    public function create(AddressDto $data): AddressEntity;
}
