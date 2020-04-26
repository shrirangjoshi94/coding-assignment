<?php

declare(strict_types=1);

namespace App\Classes;

class FloorArea
{
    /** @var float */
    private float $totalArea;

    /** @var float */
    private float $cleanedArea;

    /**
     * To initialize class objects/variables.
     *
     * @param float $totalArea
     */
    public function __construct(float $totalArea)
    {
        $this->totalArea = $totalArea;
        $this->cleanedArea = 0;
    }

    /**
     * Returns the area which is not cleaned.
     *
     * @return float
     */
    public function getAreaToBeCleaned(): float
    {
        return $this->totalArea - $this->cleanedArea;
    }

    /**
     * Clean the area.
     *
     * @param float $areaToClean
     *
     * @return float
     */
    public function cleaning(float $areaToClean): float
    {
        $this->cleanedArea += $areaToClean;

        return $this->totalArea - $this->cleanedArea - $areaToClean;
    }

    /**
     * Check whether all the area is cleaned.
     *
     * @return bool
     */
    public function isCleaned(): bool
    {
        return $this->cleanedArea >= $this->totalArea;
    }
}