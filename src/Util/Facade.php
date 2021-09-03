<?php

namespace Chat\Util;


/**
 * Provides ability to call methods of instance statically.
 */
trait Facade
{
    /**
     * Instance to call methods of.
     *
     * @var object
     */
    public static $instance;


    /**
     * Invokes statically called method on its instance.
     *
     * @param string $method    Name of method to invoke.
     * @param mixed[] $args     Arguments to pass into method.
     *
     * @return mixed        Result of method invocation.
     */
    public static function __callStatic(string $method, $args)
    {
        switch (count($args)) {
        case 0:
            return self::$instance->$method();
        case 1:
            return self::$instance->$method($args[0]);
        case 2:
            return self::$instance->$method($args[0], $args[1]);
        case 3:
            return self::$instance->$method($args[0], $args[1], $args[2]);
        case 4:
            return self::$instance->$method(
                $args[0], $args[1], $args[2], $args[3]
            );
        default:
            return call_user_func_array([self::$instance, $method], $args);
        }
    }
}
