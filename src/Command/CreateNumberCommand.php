<?php

declare(strict_types=1);

namespace App\Command;

use App\Message\Command\CreateNumber;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Message\MessageBusInterface;

class CreateNumberCommand extends Command
{
    protected static $defaultName = 'app:create-number';

    /** @var MessageBusInterface */
    private $messageBus;

    /** @var SymfonyStyle */
    private $io;

    /**
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Creates a really nice number');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Create a command and put it on the bus
        $command = new CreateNumber(10,100);

        // The message is async so we do not need to return anything
        $this->messageBus->dispatch($command);

        $this->io->writeln('We put a command/message on the queue. No work has been done at the moment.');
        $this->io->writeln('Run "bin/console message:consume enqueue_bridge.receiver" to start reading form the queue.');
    }


    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
    }
}
