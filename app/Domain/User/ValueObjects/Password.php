<?php

namespace App\Domain\User\ValueObjects;

use http\Exception\InvalidArgumentException;

class Password
{
    public function __construct(protected string $password)
    {
        $this->validate($password);
    }

    public function value(): string
    {
        return $this->password;
    }

    public function __toString(): string
    {
        return $this->password;
    }

    private function validate(string $password): void
    {
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{5,}$/';

        if (! preg_match($regex, $password)) {
            throw new \Exception('The password is invalid.');
        }
    }
}
