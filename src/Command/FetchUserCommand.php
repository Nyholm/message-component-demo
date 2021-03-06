<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\User;
use App\Message\Query\FetchUser;
use App\Message\QueryBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class FetchUserCommand extends Command
{
    protected static $defaultName = 'app:fetch-user';

    /** @var QueryBus */
    private $queryBus;

    /** @var SymfonyStyle */
    private $io;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Fetch a user from database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Create a query and put it on the bus
        $command = new FetchUser(4711);

        /** @var User $user */
        $user = $this->queryBus->query($command);

        $this->io->writeln(sprintf('We found a user named "%s" with id: %d', $user->getName(), $user->getId()));
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
    }
}
