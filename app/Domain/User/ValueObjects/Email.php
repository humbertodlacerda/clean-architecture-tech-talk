<?php

namespace App\Domain\User\ValueObjects;

use http\Exception\InvalidArgumentException;

class Email
{
    public function __construct(protected string $email)
    {
        $this->validate($email);
    }

    public function value(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    private function validate(string $email): void
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('The mail is invalid.');
        }
    }
}
