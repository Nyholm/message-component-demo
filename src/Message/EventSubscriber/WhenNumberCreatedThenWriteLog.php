<?php


declare(strict_types=1);

namespace App\Message\EventSubscriber;


use App\Message\Event\NumberCreated;

class WhenNumberCreatedThenWriteLog
{
    public function __invoke(NumberCreated $event)
    {
        $x =2;
        // TODO: Implement __invoke() method.
    }

}