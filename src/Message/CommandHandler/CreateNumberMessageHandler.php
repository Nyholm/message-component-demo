<?php

declare(strict_types=1);

namespace App\Message\CommandHandler;

use App\Message\Command\CreateNumber;
use App\Message\Event\NumberCreated;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Messenger\MessageRecorderInterface;

/**
 * This command handler handles message asynchronously. See config in config/packages/framework.yaml
 * A CommandHandler (Command as in CQRS) should never return anything.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class CreateNumberMessageHandler implements MessageSubscriberInterface
{
    private $eventRecorder;

    /**
     *
     * @param $eventRecorder
     */
    public function __construct(MessageRecorderInterface $eventRecorder)
    {
        $this->eventRecorder = $eventRecorder;
    }


    /**
     * {@inheritdoc}
     */
    public static function getHandledMessages(): array
    {
        return [CreateNumber::class];
    }

    public function __invoke($command)
    {
        /** @var CreateNumber $command */
        $number = rand($command->getMin(), $command->getMax());

        // TODO Store in database... or whatever

        // Dispatch event
        $event = new NumberCreated($number);
        $this->eventRecorder->record($event);

    }
}
