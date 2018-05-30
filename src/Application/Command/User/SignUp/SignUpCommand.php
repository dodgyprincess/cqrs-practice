<?php

namespace App\Application\Command\User\SignUp;

use App\Domain\User\ValueObject\Auth\Credentials;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Name;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class SignUpCommand
{
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

    public function __construct(string $uuid, string $email, string $plainPassword, string $name)
    {
        $this->uuid = Uuid::fromString($uuid);
        $this->credentials = new Credentials(Email::fromString($email), HashedPassword::encode($plainPassword));
        $this->name = Name::fromString($name);
    }
}
