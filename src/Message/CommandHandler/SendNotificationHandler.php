<?php

declare(strict_types=1);

namespace App\Message\CommandHandler;

use App\Message\Command\SendNotification;

class SendNotificationHandler
{
    public function __invoke(SendNotification $message)
    {
        foreach ($message->getUsers() as $user) {
            echo "Send notification to... ".$user."\n";
        }
    }
}
