<?php

declare(strict_types=1);

namespace App\Domain\User\Query;

use App\Domain\User\ValueObject\Auth\Credentials;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Name;
use Broadway\ReadModel\SerializableReadModel;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UserView implements SerializableReadModel
{
    /** @var UuidInterface */
    public $uuid;

    /** @var Credentials */
    public $credentials;

    /**
     * @var Name
     */
    public $name;

    public static function fromSerializable(Serializable $event): self
    {
        return self::deserialize($event->serialize());
    }

    public static function deserialize(array $data): self
    {
        $instance = new self;

        $instance->uuid = Uuid::fromString($data['uuid']);
        $instance->credentials = new Credentials(
            Email::fromString($data['credentials']['email']),
            HashedPassword::fromHash($data['credentials']['password'] ?? '')
        );

        $instance->name = Name::fromString($data['name']);

        return $instance;
    }

    public function serialize(): array
    {
        return [
            'uuid' => $this->getId(),
            'credentials' => [
                'email' => (string)$this->credentials->email,
            ],
            'name' => $this->getName()
        ];
    }

    public function getId(): string
    {
        return $this->uuid->toString();
    }

    public function getName(): string
    {
        return $this->name->toString();
    }
}
