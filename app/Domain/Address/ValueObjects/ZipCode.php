<?php

namespace App\Domain\Address\ValueObjects;

use http\Exception\InvalidArgumentException;

class ZipCode
{
    public function __construct(protected string $zipCode)
    {
        $this->validate($zipCode);
    }

    private function validate(string $zipCode): void
    {
        if (! preg_match('/^\d{8}$/', $zipCode)) {
            throw new InvalidArgumentException('Invalid zip code, must be 8 digits.');
        }
    }

    public function value(): string
    {
        return $this->zipCode;
    }

    public function __toString(): string
    {
        return $this->zipCode;
    }
}
