<?php

declare(strict_types=1);

namespace App\Message\QueryHandler;

use App\Entity\User;
use App\Message\Query\FetchUser;

/**
 * Since this is a QueryHandler (Query in CQRS context) we MUST return a value.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
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
