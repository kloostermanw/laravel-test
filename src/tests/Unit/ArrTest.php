<?php

namespace Tests\Unit;

use App\Classes\Arr;
use PHPUnit\Framework\TestCase;

/**
 * Class ArrTest
 *
 * This class tests the `keys` method of the `Arr` class which
 * retrieves all the keys from an input array.
 */
class ArrTest extends TestCase
{
    public function testKeysReturnsKeysFromAssociativeArray()
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $expected = ['a', 'b', 'c'];

        $this->assertSame($expected, Arr::keys($array));
    }

    public function testKeysReturnsKeysFromIndexedArray()
    {
        $array = [10, 20, 30];
        $expected = [0, 1, 2];

        $this->assertSame($expected, Arr::keys($array));
    }

    public function testKeysReturnsKeysForMixedArray()
    {
        $array = ['key1' => 'value1', 0 => 'value2', 'key2' => 'value3'];
        $expected = ['key1', 0, 'key2'];

        $this->assertSame($expected, Arr::keys($array));
    }

    public function testKeysForEmptyArray()
    {
        $array = [];
        $expected = [];

        $this->assertSame($expected, Arr::keys($array));
    }
}
