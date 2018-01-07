<?php

declare(strict_types=1);

namespace App\Message\QueryHandler;

use App\Entity\User;
use App\Message\Query\FetchUser;

class FetchUserHandler
{
    public function __invoke(FetchUser $query)
    {
        // TODO go to database and fetch the user
        // We fake it at the moment

        $user = new User($query->getUserId());
        $user->setName('Tobias');

        return $user;
    }

}