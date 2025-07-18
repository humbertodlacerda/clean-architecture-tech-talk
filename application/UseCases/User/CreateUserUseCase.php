<?php

namespace App\UseCases\User;

use App\Interfaces\Address\AddressInterface;
use Application\Dto\User\CreateUserDto;

class CreateUserUseCase
{
    public function __construct(
        protected AddressInterface $addressService
    ) {}

    public static function execute(CreateUserDto $createUserDto)
    {
        $address = $this->addressService->getAddressByZipCode();
    }
}
