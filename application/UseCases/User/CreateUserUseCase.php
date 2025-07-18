<?php

namespace Application\UseCases\User;

use App\Domain\Address\ValueObjects\ZipCode;
use Application\Dto\User\CreateUserDto;
use Application\Interfaces\Address\AddressInterface;

class CreateUserUseCase
{
    public function __construct(
        protected AddressInterface $addressService
    ) {}

    public function execute(CreateUserDto $createUserDto): void
    {
        $zipCode = new ZipCode($createUserDto->zipCode());
        $address = $this->addressService->getAddressByZipCode($zipCode);
    }
}
