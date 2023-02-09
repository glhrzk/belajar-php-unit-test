<?php

namespace ProgrammerZamanNow\Test;

class Counter
{

    private int $counter = 0;

    public function increement(): void
    {
        $this->counter++;
    }

    public function getCounter(): int
    {
        return $this->counter;
    }

}