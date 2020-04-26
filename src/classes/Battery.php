<?php

declare(strict_types=1);

namespace App\Classes;

class Battery
{
    /** @var int */
    public int $usableTime;

    /** @var int */
    private int $chargingTime;

    /** @var float */
    private float $capacity;

    /**
     * To initialize class objects/variables.
     *
     * @param int $usableTime
     * @param int $chargingTime
     */
    public function __construct(int $usableTime, int $chargingTime)
    {
        $this->usableTime = $usableTime;
        $this->chargingTime = $chargingTime;
        $this->capacity = 1;
    }

    /**
     * Get the max working time for the battery.
     *
     * @return float
     */
    public function getMaxWorkingTime(): float
    {
        return $this->usableTime * $this->capacity;
    }

    /**
     * Use the battery and then discharge it.
     *
     * @param float $seconds
     *
     * @return void
     */
    public function discharging(float $seconds): void
    {
        $this->capacity = 1 - ($seconds / $this->getMaxWorkingTime());
    }

    /**
     * Charge the battery by setting the capacity to 1.
     *
     * @return void
     */
    public function charging(): void
    {
        $this->capacity = 1;
    }
}