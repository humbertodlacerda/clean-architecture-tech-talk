<?php

namespace Infra\ViaCep;

use Application\Dto\Address\AddressDto;
use Application\Interfaces\Address\AddressInterface;
use Application\ObjectsValue\Address\ZipCode;
use Illuminate\Support\Facades\Http;

class ViaCepService implements AddressInterface
{
    public function getAddressByZipCode(ZipCode $zipCode): AddressDto
    {
        try {
            $address = Http::get($this->setUrl($zipCode))->throw()->json();

            return new AddressDto(
                data_get($address, 'logradouro'),
                data_get($address, 'bairro'),
                data_get($address, 'localidade'),
                data_get($address, 'uf'),
                data_get($address, 'complemento'),
                new ZipCode(data_get($address, 'cep'))
            );

        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }

    public function setUrl(ZipCode $zipCode): string
    {
        return config('services.via_cep.base_url').$zipCode->value().'/json';
    }
}
