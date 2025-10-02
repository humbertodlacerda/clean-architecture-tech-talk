<?php

namespace App\Infrastructure\AddressValidation;

use App\Infrastructure\AddressValidation\BrazilApi\BrazilApiService;
use App\Infrastructure\AddressValidation\ViaCep\ViaCepService;
use Illuminate\Support\Manager;

class AddressManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return config('services.address_validation.default_driver');
    }

    public function createViaCepDriver(): ViaCepService
    {
        return $this->container->make(ViaCepService::class);
    }

    public function createBrazilApiDriver(): BrazilApiService
    {
        return $this->container->make(BrazilApiService::class);
    }
}
