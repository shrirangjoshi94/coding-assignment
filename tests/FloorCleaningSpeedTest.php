<?php

declare(strict_types=1);

namespace Tests;

use App\Classes\FloorCleaningSpeed;
use PHPUnit\Framework\TestCase;

class FloorCleaningSpeedTest extends TestCase
{
    /**
     * Test for verifying the area that can be cleaned in the given time.
     *
     * @test
     *
     * @dataProvider getCleanableAreaForTimeDataProvider
     *
     * @param float $cleaningSpeed
     * @param float $time
     * @param float $expectedArea
     *
     * @return void
     */
    public function getCleanableAreaForTime(
        float $cleaningSpeed,
        float $time,
        float $expectedArea
    ): void
    {
        $floorTypeSpeed = new FloorCleaningSpeed($cleaningSpeed);
        $area = $floorTypeSpeed->getCleanableAreaForTime($time);
        $this->assertSame($expectedArea, $area);
    }

    /**
     * Provides data for getCleanableAreaForTime.
     *
     * @return array
     */
    public function getCleanableAreaForTimeDataProvider(): array
    {
        return [
            [1.0, 60.0, 60.0],
            [0.5, 60.0, 30.0],
        ];
    }

    /**
     * Test for verifying the time required to clean the area.
     *
     * @test
     *
     * @dataProvider getTimeRequiredForCleaningAreaDataProvider
     *
     * @param float $cleaningSpeed
     * @param float $area
     * @param float $time
     *
     * @return void
     */
    public function getTimeRequiredForCleaningArea(
        float $cleaningSpeed,
        float $area,
        float $time
    ): void
    {
        $floorTypeSpeed = new FloorCleaningSpeed($cleaningSpeed);
        $this->assertSame($time, $floorTypeSpeed->getTimeRequiredForCleaningArea($area));
    }

    /**
     * Provides data for testGetAreaForTime.
     *
     * @return array
     */
    public function getTimeRequiredForCleaningAreaDataProvider(): array
    {
        return [
            [1.0, 60.0, 60.0],
            [0.5, 30.0, 60.0],
        ];
    }
}