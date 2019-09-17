<?php

declare(strict_types=1);

namespace App\Message;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * A query bus that decorate our message bus.
 *
 * See https://symfony.com/doc/current/messenger/handler_results.html
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class QueryBus
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param object|Envelope $query
     *
     * @return mixed The handler returned value
     */
    public function query($query)
    {
        return $this->handle($query);
    }
}
