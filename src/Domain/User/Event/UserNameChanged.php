<?php

declare(strict_types=1);

namespace App\Domain\User\Event;

use App\Domain\User\ValueObject\Name;
use Assert\Assertion;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class UserNameChanged
 * @package App\Domain\User\Event
 */
final class UserNameChanged implements Serializable
{
    /**
     * @var UuidInterface
     */
    public $uuid;
    /**
     * @var Name
     */
    public $name;

    public function __construct(UuidInterface $uuid, Name $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }

    public static function deserialize(array $data): self
    {
        Assertion::keyExists($data, 'uuid');
        Assertion::keyExists($data, 'name');

        return new self(
            Uuid::fromString($data['uuid']),
            Name::fromString($data['name'])
        );
    }

    public function serialize(): array
    {
        return [
            'uuid' => $this->uuid->toString(),
            'name' => $this->name->toString()
        ];
    }
}