<?php

namespace App\Infrastructure\Orm\Eloquent\Address;

use App\Domain\Address\Dto\AddressDto;
use App\Domain\Address\Entities\AddressEntity;
use App\Domain\Address\Repositories\AddressRepositoryInterface;
use App\Domain\Address\ValueObjects\ZipCode;
use App\Models\Address;

class AddressRepository implements AddressRepositoryInterface
{
    public function create(AddressDto $data): AddressEntity
    {
        $address = Address::query()->create([
            'user_id' => $data->userId,
            'street' => $data->street,
            'neighborhood' => $data->neighborhood,
            'city' => $data->city,
            'state' => $data->state,
            'complement' => $data->complement,
            'zip_code' => $data->zipCode->value(),
        ]);

        return new AddressEntity(
            $address->street,
            $address->neighborhood,
            $address->city,
            $address->state,
            $address->complement,
            new ZipCode($address->zip_code),
            $address->id,
        );
    }
}
