<?php

namespace App\UI\Cli\Command;

use App\Application\Command\User\ChangeName\ChangeNameCommand;
use League\Tactician\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChangeUserNameCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:change-user-name')
            ->setDescription('Given a uuid and name, changes user\'s name.')
            ->addArgument('name', InputArgument::REQUIRED, 'User name')
            ->addArgument('uuid', InputArgument::REQUIRED, 'User Uuid');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new ChangeNameCommand(
            $uuid = ($input->getArgument('uuid') ?: Uuid::uuid4()->toString()),
            $name = $input->getArgument('name')
        );

        $this->commandBus->handle($command);

        $output->writeln('<info>User Name Changed: </info>');
        $output->writeln('');
        $output->writeln("Uuid: $uuid");
        $output->writeln("Name: $name");
    }

    public function __construct(CommandBus $commandBus)
    {
        parent::__construct();
        $this->commandBus = $commandBus;
    }

    /**
     * @var CommandBus
     */
    private $commandBus;
}