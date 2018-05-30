<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use Assert\Assertion;

class Name
{
    /**
     * @var string
     */
    public $name;

    private function __construct()
    {
    }

    public static function fromString(string $name): self
    {
        Assertion::notBlank($name, 'Name cannot be empty');

        $nameObj = new self();

        $nameObj->name = $name;

        return $nameObj;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function toString(): string
    {
        return $this->name;
    }
}