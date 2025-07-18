<?php

namespace App\Infrastructure\BrazilApi;

use App\Domain\Address\Dto\AddressDto;
use App\Domain\Address\Repositories\AddressProviderInterface;
use App\Domain\Address\ValueObjects\Url;
use App\Domain\Address\ValueObjects\ZipCode;
use Exception;
use Illuminate\Support\Facades\Http;

class BrazilApiService implements AddressProviderInterface
{
    public function getAddressByZipCode(ZipCode $zipCode): AddressDto
    {
        try {
            $address = Http::get($this->setUrl($zipCode)->value())->throw();
            $addressData = $address->json();

            return new AddressDto(
                data_get($addressData, 'street'),
                data_get($addressData, 'neighborhood'),
                data_get($addressData, 'city'),
                data_get($addressData, 'state'),
                data_get($addressData, 'complement'),
                new ZipCode(str_replace('-', '', data_get($addressData, 'cep')))
            );

        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }

    public function setUrl(ZipCode $zipCode): Url
    {
        return new Url(config('services.brazil_api.base_url').'/'.$zipCode->value());
    }
}
