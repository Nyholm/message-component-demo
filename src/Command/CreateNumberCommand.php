<?php

declare(strict_types=1);

namespace App\Command;

use App\Message\Command\CreateNumber;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class CreateNumberCommand extends Command
{
    protected static $defaultName = 'app:create-number';

    /** @var MessageBusInterface */
    private $messageBus;

    /** @var SymfonyStyle */
    private $io;

    /**
     * @param MessageBusInterface $queryBus
     */
    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Creates a really nice number');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Create a command and put it on the bus
        $command = new CreateNumber(10, 100);

        // The message is async so we do not need to return anything
        $this->messageBus->dispatch($command);

        $this->io->writeln('We put a command/message on the queue. No work has been done at the moment.');
        $this->io->writeln('Run "bin/console messenger:consume-messages default" to start reading form the queue.');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
    }
}
