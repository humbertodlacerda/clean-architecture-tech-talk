<?php

namespace App\Domain\Address\ValueObjects;

class Url
{
    public function __construct(protected string $url)
    {
        $this->validate($url);
    }

    private function validate(string $url): void
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException("Invalid URL: {$url}");
        }
    }

    public function value(): string
    {
        return $this->url;
    }

    public function __toString(): string
    {
        return $this->url;
    }
}
