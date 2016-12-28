<?php

use PHPUnit\Framework\TestCase;
use Peixinchen\RetryDecorator\Sequences\Power;

class PowerTest extends TestCase
{
    public function testGenerate1()
    {
        $sequence = (new Power(1, 5))->sequence();

        $this->assertEquals(1, $sequence->current());

        $sequence->next();
        $this->assertEquals(2, $sequence->current());

        $sequence->next();
        $this->assertEquals(4, $sequence->current());

        $sequence->next();
        $this->assertEquals(8, $sequence->current());

        $sequence->next();
        $this->assertEquals(null, $sequence->current());
    }

    public function testGenerate2()
    {
        $sequence = (new Power(2, 10))->sequence();

        $this->assertEquals(2, $sequence->current());

        $sequence->next();
        $this->assertEquals(4, $sequence->current());

        $sequence->next();
        $this->assertEquals(8, $sequence->current());

        $sequence->next();
        $this->assertEquals(16, $sequence->current());

        $sequence->next();
        $this->assertEquals(32, $sequence->current());

        $sequence->next();
        $this->assertEquals(64, $sequence->current());

        $sequence->next();
        $this->assertEquals(128, $sequence->current());

        $sequence->next();
        $this->assertEquals(256, $sequence->current());

        $sequence->next();
        $this->assertEquals(512, $sequence->current());

        $sequence->next();
        $this->assertEquals(null, $sequence->current());
    }

    public function testGenerate3()
    {
        $sequence = (new Power(1, 10, 10))->sequence();

        $this->assertEquals(1, $sequence->current());

        $sequence->next();
        $this->assertEquals(2, $sequence->current());

        $sequence->next();
        $this->assertEquals(4, $sequence->current());

        $sequence->next();
        $this->assertEquals(8, $sequence->current());

        $sequence->next();
        $this->assertEquals(10, $sequence->current());

        $sequence->next();
        $this->assertEquals(10, $sequence->current());

        $sequence->next();
        $this->assertEquals(10, $sequence->current());

        $sequence->next();
        $this->assertEquals(10, $sequence->current());

        $sequence->next();
        $this->assertEquals(10, $sequence->current());

        $sequence->next();
        $this->assertEquals(null, $sequence->current());
    }
}
