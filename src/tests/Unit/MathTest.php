<?php

namespace Tests\Unit;

use App\Classes\Math;
use PHPUnit\Framework\TestCase;

/**
 * Test class for the Math class.
 *
 * This class tests the `sum` method of the `Math` class which is responsible
 * for performing addition of two numbers.
 */
class MathTest extends TestCase
{
    /** @test */
    public function it_can_sum_two_positive_numbers()
    {
        $result = Math::sum(5, 3);
        $this->assertEquals(8, $result);
    }

    /** @test */
    public function it_can_sum_two_negative_numbers()
    {
        $result = Math::sum(-4, -6);
        $this->assertEquals(-10, $result);
    }

    /** @test */
    public function it_can_sum_a_positive_and_a_negative_number()
    {
        $result = Math::sum(7, -3);
        $this->assertEquals(4, $result);
    }

    /** @test */
    public function it_can_sum_a_number_with_zero()
    {
        $result = Math::sum(10, 0);
        $this->assertEquals(10, $result);
    }

    /** @test */
    public function it_can_sum_two_floats()
    {
        $result = Math::sum(2.5, 3.5);
        $this->assertEquals(6.0, $result);
    }

    /** @test */
    public function it_can_sum_a_float_and_an_integer()
    {
        $result = Math::sum(4.2, 3);
        $this->assertEquals(7.2, $result);
    }
}
