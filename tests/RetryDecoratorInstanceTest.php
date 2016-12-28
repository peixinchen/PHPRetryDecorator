<?php

use PHPUnit\Framework\TestCase;
use Peixinchen\RetryDecorator\RetryDecorator;
use Peixinchen\RetryDecorator\Sequences\Power;
use Mockery as Mock;

$failedTimes = 2;

class RetryDecoratorTest extends TestCase
{
    public function testCase1()
    {
        $mock = Mock::mock('Actual')
            ->shouldReceive('func')
            ->times(3)
            ->andReturnUsing(function () {
                global $failedTimes;

                if ($failedTimes > 0) {
                    $failedTimes -= 1;
                    throw new Exception($failedTimes.' times');
                }

                return 'Success';
            })
            ->mock();

        $instance = new RetryDecorator($mock, [1, 1]);

        $r = $instance->func();

        $this->assertEquals('Success', $r);
    }

    public function testCase2()
    {
        $mock = Mock::mock('Actual')
            ->shouldReceive('func')
            ->times(3)
            ->andReturnUsing(function () {
                global $failedTimes;

                if ($failedTimes > 0) {
                    $failedTimes -= 1;
                    throw new Exception($failedTimes.' times');
                }

                return 'Success';
            })
            ->mock();

        $instance = new RetryDecorator($mock, [1, 1, 1, 1]);

        $r = $instance->func();

        $this->assertEquals('Success', $r);
    }

    /**
     * @expectedException Exception
     */
    public function testCase3()
    {
        $mock = Mock::mock('Actual')
            ->shouldReceive('func')
            ->times(3)
            ->andReturnUsing(function () {
                global $failedTimes;

                if ($failedTimes > 0) {
                    $failedTimes -= 1;
                    throw new Exception($failedTimes.' times');
                }

                return 'Success';
            })
            ->mock();

        $instance = new RetryDecorator($mock, [1]);

        $instance->func();
    }

    public function testCase4()
    {
        $mock = Mock::mock('Actual')
            ->shouldReceive('func')
            ->times(3)
            ->andReturnUsing(function () {
                global $failedTimes;

                if ($failedTimes > 0) {
                    $failedTimes -= 1;
                    throw new Exception($failedTimes.' times');
                }

                return 'Success';
            })
            ->mock();

        $instance = new RetryDecorator($mock, (new Power(1, 3))->sequence());

        $r = $instance->func();

        $this->assertEquals('Success', $r);
    }
}
