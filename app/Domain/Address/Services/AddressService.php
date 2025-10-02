<?php

namespace App\Domain\Address\Services;

use App\Domain\Address\Dto\AddressDto;
use App\Domain\Address\Dto\CreateAddressDto;
use App\Domain\Address\Entities\AddressEntity;
use App\Domain\Address\Repositories\AddressRepositoryInterface;
use App\Domain\Address\ValueObjects\ZipCode;
use App\Infrastructure\AddressValidation\AddressManager;

class AddressService
{
    public function __construct(
        protected AddressRepositoryInterface $addressRepository
    ) {}

    public function create(CreateAddressDto $data): AddressEntity
    {
        $addressDada = $this->getByZipCode($data->zipCode);
        $addressDada->userId = $data->userId;

        return $this->addressRepository->create($addressDada);
    }

    public function getByZipCode(ZipCode $zipCode): AddressDto
    {
        //        $address = $this->addressProvider->getAddressByZipCode($zipCode);
        $addressProvider = app(AddressManager::class);
        $address = $addressProvider->getAddressByZipCode($zipCode);

        return new AddressDto(
            $address->street,
            $address->neighborhood,
            $address->city,
            $address->state,
            $address->complement,
            $address->zipCode,
        );
    }
}
