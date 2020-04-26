<?php

declare(strict_types=1);

namespace App\Classes;

class FloorCleaningSpeed
{
    /** @var float */
    private float $cleaningSpeed;

    /**
     * To initialize class objects/variables.
     *
     * @param float $cleaningSpeed
     */
    public function __construct(float $cleaningSpeed)
    {
        $this->cleaningSpeed = $cleaningSpeed;
    }

    /**
     * Returns the area which can be cleaned in the given time.
     *
     * @param float $time
     *
     * @return float
     */
    public function getCleanableAreaForTime(float $time): float
    {
        return $time * $this->cleaningSpeed;
    }

    /**
     * Returns the time that is needed for cleaning the area.
     *
     * @param float $area
     *
     * @return float
     */
    public function getTimeRequiredForCleaningArea(float $area): float
    {
        return $area / $this->cleaningSpeed;
    }
}