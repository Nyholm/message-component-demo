<?php

declare(strict_types=1);

namespace App\Message\Query;

/**
 * This is the "Query" in CQRS.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class FetchUser
{
    /** @var int */
    private $userId;

    /**
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
