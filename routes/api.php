<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->prefix('users')
    ->name('users.')
    ->group(function (): void {
        Route::post('/', 'store')->name('store');
    });
