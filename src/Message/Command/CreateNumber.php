<?php

declare(strict_types=1);

namespace App\Message\Command;

/**
 * This is the "Command" in CQRS
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class CreateNumber
{
    /**
     * @var int
     */
    private $max;

    /**
     * @var int
     */
    private $min;

    /**
     *
     * @param int $max
     * @param int $min
     */
    public function __construct(int $max, int $min)
    {
        $this->max = $max;
        $this->min = $min;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }



}