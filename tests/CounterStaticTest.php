<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Framework\TestCase;

class CounterStaticTest extends TestCase
{

    public static Counter $counter;

    /**
     * bisa menggunakan anotation beforeclass atau langsung overide dari class TestCase
     */
    public static function setUpBeforeClass(): void
    {
        self::$counter = new Counter();
        echo "Membuat object class" . PHP_EOL;
    }

    /** @test */
    public function CounterSatu()
    {
        // assertions
        self::$counter->increement();
        $this->assertEquals(1, self::$counter->getCounter());
    }

    /** @test */
    public function CounterDua()
    {
        // assertions
        self::$counter->increement();
        $this->assertEquals(2, self::$counter->getCounter());
    }

    public static function tearDownAfterClass(): void
    {
        echo "TearDown AfterClass" . PHP_EOL;
    }
}