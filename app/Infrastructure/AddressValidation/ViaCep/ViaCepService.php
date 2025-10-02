<?php

namespace App\Infrastructure\AddressValidation\ViaCep;

use App\Domain\Address\Dto\AddressDto;
use App\Domain\Address\Repositories\AddressProviderInterface;
use App\Domain\Address\ValueObjects\Url;
use App\Domain\Address\ValueObjects\ZipCode;
use Exception;
use Illuminate\Support\Facades\Http;

class ViaCepService implements AddressProviderInterface
{
    public function getAddressByZipCode(ZipCode $zipCode): AddressDto
    {
        try {
            $address = Http::get($this->setUrl($zipCode)->value())->throw();
            $addressData = $address->json();

            return new AddressDto(
                street: data_get($addressData, 'logradouro'),
                neighborhood: data_get($addressData, 'bairro'),
                city: data_get($addressData, 'localidade'),
                state: data_get($addressData, 'uf'),
                complement: data_get($addressData, 'complemento'),
                zipCode: new ZipCode(str_replace('-', '', data_get($addressData, 'cep')))
            );

        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }

    public function setUrl(ZipCode $zipCode): Url
    {
        return new Url(config('services.address_validation.via_cep.base_url').'/'.$zipCode->value().'/json/');
    }
}
