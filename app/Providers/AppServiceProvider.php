<?php

namespace App\Providers;

use App\Domain\Address\Repositories\AddressProviderInterface;
use App\Domain\Address\Repositories\AddressRepositoryInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\BrazilApi\BrazilApiService;
use App\Infrastructure\Orm\Eloquent\Address\AddressRepository;
use App\Infrastructure\Orm\Eloquent\User\UserRepository;
use App\Infrastructure\ViaCep\ViaCepService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(AddressProviderInterface::class, ViaCepService::class);
        //        $this->app->bind(AddressProviderInterface::class, BrazilApiService::class);
    }
}
