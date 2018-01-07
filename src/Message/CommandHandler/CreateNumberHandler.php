<?php

declare(strict_types=1);

namespace App\Message\CommandHandler;

use App\Message\Command\CreateNumber;
use App\Message\Query\FetchUser;

/**
 * This command handler handles message asynchronously. See config in config/packages/framework.yaml
 * A CommandHandler (Command as in CQRS) should never return anything.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class CreateNumberHandler
{
    public function __invoke(CreateNumber $command)
    {
        $number = rand($command->getMin(), $command->getMax());

        // TODO Store in database... or whatever


    }

}