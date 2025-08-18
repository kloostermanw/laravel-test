<?php

namespace Tests\Classes;

use App\Classes\Year;
use PHPUnit\Framework\TestCase;

class YearTest extends TestCase
{
    /**
     * Test if addTwoYears method correctly adds two years to a given date.
     */
    public function testAddTwoYearsAddsExactlyTwoYears()
    {
        $givenDate = new \DateTime('2025-08-18');
        $expectedDate = new \DateTime('2027-08-18');

        $resultDate = Year::addTwoYears($givenDate);

        $this->assertEquals($expectedDate, $resultDate);
    }

    /**
     * Test if addTwoYears method handles leap years correctly.
     */
    public function testAddTwoYearsHandlesLeapYearsCorrectly()
    {
        $givenDate = new \DateTime('2024-02-29'); // Leap Day
        $expectedDate = new \DateTime('2026-02-28'); // Non-Leap Day in 2026

        $resultDate = Year::addTwoYears($givenDate);

        $this->assertEquals($expectedDate, $resultDate);
    }

    /**
     * Test if addTwoYears method works correctly with a date in the past.
     */
    public function testAddTwoYearsWithPastDates()
    {
        $givenDate = new \DateTime('2000-01-01');
        $expectedDate = new \DateTime('2002-01-01');

        $resultDate = Year::addTwoYears($givenDate);

        $this->assertEquals($expectedDate, $resultDate);
    }

    /**
     * Test if addTwoYears method works correctly with timezone-aware dates.
     */
    public function testAddTwoYearsWithTimezoneAwareDates()
    {
        $timezone = new \DateTimeZone('America/New_York');
        $givenDate = new \DateTime('2025-08-18', $timezone);
        $expectedDate = new \DateTime('2027-08-18', $timezone);

        $resultDate = Year::addTwoYears($givenDate);

        $this->assertEquals($expectedDate, $resultDate);
        $this->assertEquals($timezone, $resultDate->getTimezone());
    }

    /**
     * Test if addTwoYears does not mutate the original date object.
     */
    public function testAddTwoYearsDoesNotMutateOriginalDate()
    {
        $givenDate = new \DateTime('2025-08-18');
        $originalDateClone = clone $givenDate;

        Year::addTwoYears($givenDate);

        $this->assertEquals($originalDateClone, $givenDate);
    }
}
