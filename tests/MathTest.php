<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    /**
     * @test
     * menggunakan anotation test, tanpa harus menggunakan keyword test
     */

    public function Manual()
    {
        $this->assertEquals(10, Math::sum([5, 5]));
        $this->assertEquals(20, Math::sum([4, 4, 4, 4, 4]));
        $this->assertEquals(9, Math::sum([3, 3, 3]));
        $this->assertEquals(0, Math::sum([]));
        $this->assertEquals(2, Math::sum([2]));
    }

    // =============================[ ]=============================

    /**
     * @dataProvider mathSumData
     */
    public function testDataProvider(int $expected, array $values)
    {
        $this->assertEquals($expected, Math::sum($values));
    }

    public function mathSumData(): array
    {
        return [
            [10, [5, 5]],
            [20, [4, 4, 4, 4, 4]],
            [9, [3, 3, 3]],
            [0, []],
            [2, [2]],
        ];
    }

    // =============================[ ]=============================

    /**
     * @testWith [10, [5, 5]]
     *           [20, [4, 4, 4, 4, 4]]
     */
    public function testWith(int $expected, array $values)
    {
        $this->assertEquals($expected, Math::sum($values));
    }
}