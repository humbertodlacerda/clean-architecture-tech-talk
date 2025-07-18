<?php

namespace App\Domain\Address\Services;

use App\Domain\Address\Dto\AddressDto;
use App\Domain\Address\Repositories\AddressProviderInterface;
use App\Domain\Address\Repositories\AddressRepositoryInterface;
use App\Domain\Address\ValueObjects\ZipCode;

class AddressService
{
    public function __construct(
        protected AddressRepositoryInterface $addressRepository,
        protected AddressProviderInterface $addressProvider,
    ) {}

    public function getByZipCode(ZipCode $zipCode): AddressDto
    {
        $address = $this->addressProvider->getAddressByZipCode($zipCode);

        return new AddressDto(
            data_get($address, 'logradouro'),
            data_get($address, 'bairro'),
            data_get($address, 'localidade'),
            data_get($address, 'complemento'),
            data_get($address, 'cep'),
            data_get($address, 'numero'),
        );
    }
}
