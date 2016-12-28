<?php

namespace Peixinchen\RetryDecorator;

use Exception;

class RetryDecorator
{
    protected $instance;

    protected $intervals;

    public function __construct(&$instance, $intervals)
    {
        $this->instance = $instance;

        $this->intervals = $intervals;
    }

    public function __call(string $method, array $arguments)
    {
        return $this->retry($this->instance, $method, $arguments, $this->intervals);
    }

    public static function retry(&$instance, string $method, array $arguments, $intervals)
    {
        $exc = null;

        foreach ($intervals as $interval) {
            try {
                return call_user_func_array([&$instance, $method], $arguments);
            } catch (Exception $e) {
                if ($exc === null) {
                    $exc = $e;
                } else {
                    $exc = new Exception($e->getMessage(), $e->getCode(), $exc);
                }
            }

            usleep($interval);
        }

        try {
            return call_user_func_array([&$instance, $method], $arguments);
        } catch (Exception $e) {
            if ($exc === null) {
                $exc = $e;
            } else {
                $exc = new Exception($e->getMessage(), $e->getCode(), $exc);
            }
        }

        throw $exc;
    }
}
