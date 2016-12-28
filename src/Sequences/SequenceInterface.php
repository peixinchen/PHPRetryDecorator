<?php

namespace Peixinchen\RetryDecorator\Sequences;

interface SequenceInterface
{
    /**
     * construct
     *
     * @param int $start start
     * @param int $times times
     * @param int $max   max
     */
    public function __construct(int $start, int $times, int $max = null);
    
    /**
     * sequence
     *
     * @return Generator
     */
    public function sequence();
}
