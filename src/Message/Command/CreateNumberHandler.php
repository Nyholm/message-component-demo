<?php

declare(strict_types=1);

namespace App\Message\Command;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * This command handler handles message asynchronously. See config in config/packages/messenger.yaml
 * A CommandHandler (Command as in CQRS) should never return anything.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class CreateNumberHandler implements MessageHandlerInterface
{
    public function __invoke(CreateNumber $command)
    {
        /** @var CreateNumber $command */
        $number = rand($command->getMin(), $command->getMax());

        // TODO Store in database... or whatever

        // TODO remove debug code
        echo "Number: $number\n";
    }
}
