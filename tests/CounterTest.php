<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CounterTest extends TestCase
{

    private Counter $counter;

    protected function setUp(): void
    {
        $this->counter = new Counter();
        echo "Membuat Counter" . PHP_EOL;
    }

    public function testIncrement()
    {
        // assertions

        $this->markTestSkipped("SKIPPED, masih ada yang error bingung!");
        $this->assertEquals(0, $this->counter->getCounter());
        $this->markTestIncomplete("Belum di hitung");
    }


    public function testCounter()
    {

        $this->counter->increement();
        Assert::assertEquals(1, $this->counter->getCounter());

        $this->counter->increement();
        $this->assertEquals(2, $this->counter->getCounter());

        $this->counter->increement();
        self::assertEquals(3, $this->counter->getCounter());

    }


    public function testFirst(): Counter
    {
        $this->counter->increement();
        Assert::assertEquals(1, $this->counter->getCounter());

        return $this->counter;
    }

    /**
     * @depends testFirst
     */
    public function testSecond(Counter $counterSecond): void
    {
        $counterSecond->increement();
        $this->assertEquals(2, $counterSecond->getCounter());
    }

    protected function tearDown(): void
    {
        echo "Tear Down" . PHP_EOL;
    }


    /**
     * @after
     */
    public function after(): void
    {
        echo "After" . PHP_EOL;
    }


    /**
     * @test
     * @requires OSFAMILY Darwin
     */
    public function OnlyMac()
    {
        $this->assertTrue(true, "Only in MacOS");
    }

    /**
     * @test
     * @requires OSFAMILY Windows
     * @requires PHP >=8
     */
    public function OnlyWindows()
    {
        $this->assertTrue(true, "Only in Windows and PHP >= 8");
    }

}