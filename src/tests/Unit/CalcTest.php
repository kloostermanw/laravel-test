<?php

namespace Tests\Unit;

use App\Classes\Calc;
use PHPUnit\Framework\TestCase;

/**
 * CalcTest
 *
 * This class tests the `add` method of the `Calc` class.
 */
class CalcTest extends TestCase
{
    /**
     * Test that the `add` method correctly adds two positive numbers.
     */
    public function testAddTwoPositiveNumbers(): void
    {
        $result = Calc::add(5.5, 3.2);
        $this->assertEquals(8.7, $result);
    }

    /**
     * Test that the `add` method correctly adds two negative numbers.
     */
    public function testAddTwoNegativeNumbers(): void
    {
        $result = Calc::add(-5.5, -3.2);
        $this->assertEquals(-8.7, $result);
    }

    /**
     * Test that the `add` method correctly adds a positive and a negative number.
     */
    public function testAddPositiveAndNegative(): void
    {
        $result = Calc::add(5.5, -3.2);
        $this->assertEquals(2.3, $result);
    }

    /**
     * Test that the `add` method correctly adds zero to a number.
     */
    public function testAddWithZero(): void
    {
        $result = Calc::add(5.5, 0);
        $this->assertEquals(5.5, $result);

        $result = Calc::add(0, 5.5);
        $this->assertEquals(5.5, $result);
    }
}
