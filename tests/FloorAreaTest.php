<?php

declare(strict_types=1);

namespace Tests;

use App\Classes\FloorArea;
use PHPUnit\Framework\TestCase;

class FloorAreaTest extends TestCase
{
    /**
     * Test case for cleaning method.
     *
     * @test
     *
     * @dataProvider getCleaningDataProvider
     *
     * @param float $totalArea
     * @param float $cleanedArea
     * @param float $maxCleaningArea
     * @param bool $isCleaned
     *
     * @return void
     */
    public function cleaning(
        float $totalArea,
        float $cleanedArea,
        float $maxCleaningArea,
        bool $isCleaned
    ): void
    {
        $floorArea = new FloorArea($totalArea);
        $floorArea->cleaning($cleanedArea);
        $this->assertSame($maxCleaningArea, $floorArea->getAreaToBeCleaned());
        $this->assertSame($isCleaned, $floorArea->isCleaned());
    }

    /**
     * Provides data for cleaning test.
     *
     * @return array
     */
    public function getCleaningDataProvider(): array
    {
        return [
            [70, 30, 40, false],
            [30, 30, 0, true],
        ];
    }
}