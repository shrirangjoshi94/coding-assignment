<?php

declare(strict_types=1);

namespace App\Classes;

class Robot
{
    /** @var int BATTERY_CHARGING_TIME */
    const BATTERY_CHARGING_TIME = 30;

    /** @var int BATTERY_PRODUCTIVE_TIME */
    const BATTERY_PRODUCTIVE_TIME = 60;

    /** @var array FLOOR_TYPES */
    const FLOOR_TYPES = ['hard' => 1, 'carpet' => 0.5];

    /** @var FloorArea */
    private FloorArea $floorArea;

    /** @var FloorCleaningSpeed */
    private FloorCleaningSpeed $floorCleaningSpeed;

    /** @var Battery */
    private Battery $battery;

    /**
     * To initialize class objects/variables.
     *
     * @param string $floorType
     * @param float $floorArea
     */
    public function __construct(string $floorType, float $floorArea)
    {
        $this->floorArea = new FloorArea($floorArea);
        $this->floorCleaningSpeed = new FloorCleaningSpeed(self::FLOOR_TYPES[$floorType]);
        $this->battery = new Battery(self::BATTERY_PRODUCTIVE_TIME, self::BATTERY_CHARGING_TIME);
    }

    /**
     * Make the robot clean the floor.
     *
     * @return void
     */
    public function work(): void
    {
        while (true) {
            [$area, $cleaningTime] = $this->getCleaningAreaTime();
            //Clean the floor.
            $this->floorArea->cleaning($area);
            echo "cleaned $area m^2" . PHP_EOL;

            //The battery gets discharged.
            $this->battery->discharging($cleaningTime);
            echo "discharged $cleaningTime seconds" . PHP_EOL;

            //Charge the battery.
            $this->battery->charging();
            echo "Battery fully charged" . PHP_EOL;

            //Check if all the area is cleaned.
            if ($this->floorArea->isCleaned()) {
                break;
            }
        }
    }

    /**
     * Find the size of area and time that can be used for cleaning.
     *
     * @return array
     */
    private function getCleaningAreaTime(): array
    {
        //Get the max working time for the robot.
        $maxWorkingTime = $this->battery->getMaxWorkingTime();
        $totalAreaToBeCleaned = $this->floorArea->getAreaToBeCleaned();
        //The minimum area that can be cleaned in one go.
        $minCleanableArea = min(
            $this->floorCleaningSpeed->getCleanableAreaForTime($maxWorkingTime),
            $totalAreaToBeCleaned
        );
        $minCleaningTime = min(
            $maxWorkingTime,
            $this->floorCleaningSpeed->getTimeRequiredForCleaningArea($totalAreaToBeCleaned)
        );

        return [$minCleanableArea, $minCleaningTime];
    }
}