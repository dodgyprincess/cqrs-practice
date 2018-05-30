<?php

declare(strict_types=1);

namespace App\Application\Command\User\ChangeName;

use App\Domain\User\ValueObject\Name;
use Ramsey\Uuid\Uuid;

class ChangeNameCommand
{
    /** @var \Ramsey\Uuid\UuidInterface */
    public $userUuid;

    /** @var Name */
    public $name;

    public function __construct(string $userUuid, string $name)
    {
        $this->userUuid = Uuid::fromString($userUuid);
        $this->name = Name::fromString($name);
    }
}
