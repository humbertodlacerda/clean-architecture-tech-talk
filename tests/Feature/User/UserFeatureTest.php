<?php

namespace Feature\User;

use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    public function testShouldBeAbleCreateNewUser(): void
    {
        $data = [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => fake()->password(),
            'zip_code' => '35010070'
        ];
        $response = $this->postJson(route('users.store'), $data)
            ->assertOk();
    }
}
