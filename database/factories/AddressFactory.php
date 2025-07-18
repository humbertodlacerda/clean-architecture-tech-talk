<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => fn () => User::factory(),
            'street' => fake()->streetAddress(),
            'neighborhood' => fake()->words(2),
            'city' => fake()->city(),
            'state' => fake()->regexify('[A-Z]{2}'),
            'zipCode' => fake()->randomNumber(8),
        ];
    }
}
