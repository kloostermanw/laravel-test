<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    /**
     * Test that dateToString correctly formats a given date using the provided ISO format.
     */
    public function test_date_to_string_with_valid_date()
    {
        $date = new \DateTime('2025-08-13');
        $formattedDate = \App\Classes\Date::dateToString('MMMM YYYY', $date);

        $this->assertEquals('August 2025', $formattedDate);
    }

//    /**
//     * Test that dateToString returns an empty string when $objDate is null.
//     */
//    public function test_date_to_string_with_null_date()
//    {
//        $formattedDate = \App\Classes\Date::dateToString('MMMM YYYY', null);
//
//        $this->assertEquals('', $formattedDate);
//    }
//
//    /**
//     * Test that dateToString uses the current date when $objDate is empty but not null.
//     */
//    public function test_date_to_string_with_empty_date()
//    {
//        $formattedDate = \App\Classes\Date::dateToString('YYYY-MM-DD', '');
//
//        $this->assertMatchesRegularExpression('/\d{4}-\d{2}-\d{2}/', $formattedDate);
//    }

}
