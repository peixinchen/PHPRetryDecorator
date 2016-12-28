<?php

use PHPUnit\Framework\TestCase;
use Peixinchen\RetryDecorator\Sequences\Fibonacci;

class FibonacciTest extends TestCase
{
    public function testGenerate1()
    {
        $sequence = (new Fibonacci(1, 5))->sequence();

        $this->assertEquals(1, $sequence->current());

        $sequence->next();
        $this->assertEquals(1, $sequence->current());

        $sequence->next();
        $this->assertEquals(2, $sequence->current());

        $sequence->next();
        $this->assertEquals(3, $sequence->current());

        $sequence->next();
        $this->assertEquals(null, $sequence->current());
    }

    public function testGenerate2()
    {
        $sequence = (new Fibonacci(10, 10))->sequence();

        $this->assertEquals(10, $sequence->current());

        $sequence->next();
        $this->assertEquals(10, $sequence->current());

        $sequence->next();
        $this->assertEquals(20, $sequence->current());

        $sequence->next();
        $this->assertEquals(30, $sequence->current());

        $sequence->next();
        $this->assertEquals(50, $sequence->current());

        $sequence->next();
        $this->assertEquals(80, $sequence->current());

        $sequence->next();
        $this->assertEquals(130, $sequence->current());

        $sequence->next();
        $this->assertEquals(210, $sequence->current());

        $sequence->next();
        $this->assertEquals(340, $sequence->current());

        $sequence->next();
        $this->assertEquals(null, $sequence->current());
    }

    public function testGenerate3()
    {
        $sequence = (new Fibonacci(1, 10, 4))->sequence();

        $this->assertEquals(1, $sequence->current());

        $sequence->next();
        $this->assertEquals(1, $sequence->current());

        $sequence->next();
        $this->assertEquals(2, $sequence->current());

        $sequence->next();
        $this->assertEquals(3, $sequence->current());

        $sequence->next();
        $this->assertEquals(4, $sequence->current());

        $sequence->next();
        $this->assertEquals(4, $sequence->current());

        $sequence->next();
        $this->assertEquals(4, $sequence->current());

        $sequence->next();
        $this->assertEquals(4, $sequence->current());

        $sequence->next();
        $this->assertEquals(4, $sequence->current());

        $sequence->next();
        $this->assertEquals(null, $sequence->current());
    }
}
