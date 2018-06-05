<?php

declare(strict_types=1);

namespace App\Message\Command;

class SendNotification
{
    private $message;
    private $users;

    public function __construct(string $message, array $users)
    {
        $this->message = $message;
        $this->users = $users;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getUsers(): array
    {
        return $this->users;
    }
}