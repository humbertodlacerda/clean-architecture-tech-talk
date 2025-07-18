<?php

namespace Feature\User;

use App\Models\Address;
use App\Models\User;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    public function test_should_be_able_create_new_user_with_address(): void
    {
        $password = 'Jujuba123+-';
        $data = [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => $password,
            'zip_code' => '35010070',
        ];

        $this->postJson(route('users.store'), $data)
            ->assertOk();

        $user = User::query()->where('email', data_get($data, 'email'))->first();

        $this->assertDatabaseHas(User::class, [
            'name' => data_get($data, 'name'),
            'email' => data_get($data, 'email'),
        ]);
        $this->assertDatabaseHas(Address::class, [
            'user_id' => $user->id,
            'zip_code' => data_get($data, 'zip_code'),
        ]);
    }
}
