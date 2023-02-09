<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Framework\TestCase;
use PHPUnit\Util\Exception;

class PersonTest extends TestCase
{
    private Person $person;

    /**
     * fungsi ini akan selalu dipanggil terlebih dahulu sebelum melakukan unitTest, ini adalah function dari unitTest
     */
    // public function setUp(): void
    // {
    //     $this->person = new Person("Galih");
    // }

    /**
     * @before
     * 
     * fungsi ini akan selalu dipanggil terlebih dahulu, sama saja dengan function setup, tetapi kita buat bebas nama classnya
     */
    public function createPerson(): void
    {
        $this->person = new Person("Galih");
    }


    public function testSuccess()
    {
        $this->assertEquals("Hello Budi, my name is Galih", $this->person->sayHello("Budi"));
    }

    // berharap ada exception yang ditangkap, maka akan dianggap benar oleh phpunit
    public function testException()
    {
        $this->expectException(Exception::class);
        $this->person->sayHello(null);
    }

    public function testGoodyByeSuccess()
    {
        // assertions
        $this->person->sayGoodBye("laely");
        $this->expectOutputString("Good bye laely" . PHP_EOL);
    }


}