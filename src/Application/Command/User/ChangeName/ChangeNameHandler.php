<?php

declare(strict_types=1);

namespace App\Application\Command\User\ChangeName;

use App\Application\Command\CommandHandlerInterface;
use App\Domain\User\Repository\UserRepositoryInterface;

class ChangeNameHandler implements CommandHandlerInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(ChangeNameCommand $command): void
    {
        $user = $this->userRepository->get($command->userUuid);
        $user->changeName($command->name);

        $this->userRepository->store($user);
    }
}
