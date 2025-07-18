<?php

namespace App\Domain\Address\Repositories;

use App\Domain\Address\Dto\AddressDto;
use App\Domain\Address\ValueObjects\Url;
use App\Domain\Address\ValueObjects\ZipCode;

interface AddressProviderInterface
{
    public function getAddressByZipCode(ZipCode $zipCode): AddressDto;

    public function setUrl(ZipCode $zipCode): Url;
}
