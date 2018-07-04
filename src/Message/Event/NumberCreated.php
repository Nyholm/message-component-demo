<?php

declare(strict_types=1);

namespace App\Message\Event;

class NumberCreated
{
    private $number;

    /**
     *
     * @param $number
     */
    public function __construct(int $number)
    {
        $this->number = $number;
    }


}