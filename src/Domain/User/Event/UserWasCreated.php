<?php

declare(strict_types=1);

namespace App\Domain\User\Event;

use App\Domain\User\ValueObject\Auth\Credentials;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Name;
use Assert\Assertion;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserWasCreated implements Serializable
{
    public static function deserialize(array $data): self
    {
        Assertion::keyExists($data, 'uuid');
        Assertion::keyExists($data, 'credentials');
        Assertion::keyExists($data, 'name');

        return new self(
            Uuid::fromString($data['uuid']),
            new Credentials(
                Email::fromString($data['credentials']['email']),
                HashedPassword::fromHash($data['credentials']['password'])
            ),
            Name::fromString($data['name'])
        );
    }

    public function serialize(): array
    {
        return [
            'uuid' => $this->uuid->toString(),
            'credentials' => [
                'email' => $this->credentials->email->toString(),
                'password' => $this->credentials->password->toString()
            ],
            'name' => $this->name->toString()
        ];
    }

    public function __construct(UuidInterface $uuid, Credentials $credentials, Name $name)
    {
        $this->uuid = $uuid;
        $this->credentials = $credentials;
        $this->name = $name;
    }

    /**
     * @var UuidInterface
     */
    public $uuid;

    /**
     * @var Credentials
     */
    public $credentials;
    /**
     * @var Name
     */
    public $name;
}
