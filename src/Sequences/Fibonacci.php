<?php

namespace Peixinchen\RetryDecorator\Sequences;

class Fibonacci implements SequenceInterface
{
    protected $previous;

    protected $current;

    protected $times;

    protected $max;

    public function __construct(int $start, int $times, int $max = null)
    {
        $this->previous = 0;
        $this->current = $start;
        $this->times = $times - 1;
        $this->max = $max;
    }

    public function sequence()
    {
        for ($i = 0; $i < $this->times; $i++) {
            $current = $this->current;

            if ($this->max !== null && $current > $this->max) {
                yield $this->max;
            } else {
                yield $current;
            }

            $this->current = $this->previous + $this->current;
            $this->previous = $current;
        }
    }
}
